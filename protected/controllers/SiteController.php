<?php

class SiteController extends Controller {
	
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    function actionGetRetailers() {
        if (!empty($_GET['term'])) {
            $sql = 'SELECT name as id, name as value, name as label FROM retailer WHERE name LIKE :qterm ';
            $sql .= ' ORDER BY name ASC';
            $command = Yii::app()->db->createCommand($sql);
            $qterm = $_GET['term'] . '%';
            $command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
            $result = $command->queryAll();
            echo CJSON::encode($result);
            exit;
        } else {
            return false;
        }
    }

    public function actionIndex() {
        $program = Yii::app()->params['program'];
        $homeContent = PageContent::model()->find("program_id = $program AND page_id = 1");
        $welcomeContent = PageContent::model()->find("program_id = $program AND page_id = 6");
        // $offers = Offer::model()->findAll("is_home_page = 1 and current = 1", array("limit" => 1));

        $criteria = new CDbCriteria;
        $criteria->together = true;
        $criteria->with = array('retailer');
        $criteria->limit = 4;
        $criteria->addCondition("is_home_page = 1 and current = 1");

        $offers = Offer::model()->findAll($criteria);

        $criteria_news = new CDbCriteria;
        $criteria_news->together = true;
        $criteria_news->limit = 4;
        $criteria_news->addCondition("program_id = $program and current = 1");

        $news = News::model()->findAll($criteria_news);
        //$news = News::model()->findAll("program_id = $program and current = 1", array("limit" => "1"));
        $about = PageContent::model()->find("program_id = $program AND page_id = 2");
        $this->render('index', array('offers' => $offers, 'home' => $homeContent, 'about' => $about, 'news' => $news, 'welcome' => $welcomeContent));
    }

	
	function actionGetIDRetailers() {
		$id = Yii::app()->request->getParam('id');
		if($id){
			$result = Retailer::model()->find('id ='.$id);
			$this->layout = false;
	
			$this->render('viewRetailer', array('retailer'=>$result));
        } else {
            return false;
        }
    }
	
	
	function actionAjax() {
		$id = Yii::app()->request->getParam('id');
		if($id){
			$result = Offer::model()->find('id ='.$id);
			$this->layout = false;
			
			$this->render('viewOffer', array('offer'=>$result));

        } else {
            return false;
        }
    }

    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $headers = "From: {$model->email}\r\nReply-To: {$model->email}";
                mail(Yii::app()->params['adminEmail'], $model->subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    public function actionAboutUs() {
		$template = Yii::app()->params['template_about'];
		//$program = Yii::app()->params['program'];
		//$idtemplate = $template["template_about"];
		if($template["template_about"] == 2){
			Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/skin/giveback/css/grid.css');
		}
		else{
			Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/skin/giveback/css/list.css');
		}
		$result = Abouts::model()->findAll("program_id = ".PROGRAM_ID."  and current = 1 ORDER BY sort_order ASC");
		
		$this->render('aboutus' , array('abouts'=>$result));
    }

    public function actionHotdeals($type = 0) {
        $cat = "";
        if (isset($_REQUEST) && isset($_REQUEST['cat']) && $_REQUEST['cat'] != '') {
            $cat = "and t.offer_type_id = " . $_REQUEST['cat'];
        }
        $criteria = new CDbCriteria;
        $criteria->together = true;
        $criteria->with = array('retailer');
        $now = new CDbExpression("NOW()");
        $criteria->addCondition(" (retailer.id =  retailer_id)"
                . " and (start_date is null or start_date<= now()) and end_date >= now() and current = 1 $cat");

        $model = Offer::model()->findAll($criteria);
        $program = Yii::app()->params['program'];
        $content = PageContent::model()->find("program_id = $program AND page_id = 4");
        $this->render('hotdeals', array('model' => $model, 'content' => $content));
    }

    public function actionNews() {
        $model = News::model()->findAll('program_id = ' . Yii::app()->params['program']);
        $this->render('news', array(
            'model' => $model,
        ));
    }

    public function actionFaq() {
        $model = Faq::model()->findAll();
        $this->render('faq', array(
            'model' => $model,
        ));
    }

    public function actionShop() {

        $program = Yii::app()->params['program'];
        $content = PageContent::model()->find("program_id = $program AND page_id = 5");
        $categories = RetailerCategory::model()->findAll("parent_id <> '' or parent_id is null ORDER BY RAND() limit 5");

        $this->render('shop', array('content' => $content, 'categories' => $categories));
    }

    public function actionRetailers() {
        $categories = RetailerCategory::model()->findAll("parent_id <> '' or parent_id is null ORDER BY RAND() limit 6");

        //TODO: Need to filter on the base of categories.
        $model = Retailer::model()->findAll("logo_url <> '' and logo_url is not null");

        $program = Yii::app()->params['program'];
        $content = PageContent::model()->find("program_id = $program AND page_id = 5");
		$layout = Yii::app()->params['layout'];
		 
        $this->render('retailer', array('model' => $model, 'content' => $content, 'categories' => $categories , 'layout'=>$layout));
    }

    public function actionCategory($id) {
        $category = RetailerCategory::model()->findByPk($id);
        $categories = RetailerCategory::model()->findAll("parent_id <> '' or parent_id is null ORDER BY RAND() limit 6");
        //TODO: Need to filter on the base of categories.
        $model = Retailer::model()->findAll("logo_url <> '' and logo_url is not null order by rand() limit 100");

        $program = Yii::app()->params['program'];
        $content = PageContent::model()->find("program_id = $program AND page_id = 5");

        $this->render('category', array('model' => $model, 'content' => $content,'current_cat'=>$category, 'categories'=>$categories));
    }

    function actionGetCategory() {
        if (!empty($_GET['term'])) {
            $sql = 'SELECT name as id, name as value, name as label FROM retailer_category WHERE name LIKE :qterm ';
            $sql .= ' ORDER BY name ASC';
            $command = Yii::app()->db->createCommand($sql);
            $qterm = '%' . $_GET['term'] . '%';
            $command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
            $result = $command->queryAll();
            echo CJSON::encode($result);
            exit;
        } else {
            return false;
        }
    }

    public function actionSearch() {
        $model = Retailer::model()->findAll('name like "%' . $_REQUEST['retailer'] . '%"');
        $this->render('search', array('model' => $model));
    }

    public function actionSearchCategory() {
        $model = Retailer::model()->findAll('name like "%' . $_REQUEST['category'] . '%"');
        $this->render('search_category', array('model' => $model));
    }

    public function actionError() {


        if ($error = Yii::app()->errorHandler->error) {

            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

	public function actionStore(){
        if (Yii::app()->request->isPostRequest){

            $pager = Yii::app()->request->getPost('pager');

            if (empty($pager)){
                $offset = 0;
                $pager = 1;
            }
            else $offset = ($pager - 1) * 10;

            $location_search = Yii::app()->request->getPost('location');
            $postcode = '';

            if (empty($location_search)){
                $postcode = Yii::app()->request->getPost('store_query');
                $location = Retailer::get_lat_long($postcode);
                $latitude = $location['lat'];
                $longitude = $location['lng'];
            }
            else{
                $latitude = Yii::app()->request->getPost('latitude');
                $longitude = Yii::app()->request->getPost('longitude');
            }

            $sql = "SELECT *,
                    (((acos(sin((".$latitude."*pi()/180)) * sin((`lat`*pi()/180))
                    +cos((".$latitude."*pi()/180)) * cos((`lat`*pi()/180))
                    * cos(((".$longitude."- `lng`)*pi()/180))))*180/pi())*60*1.1515)
                    as distance
                    FROM `retailer`
                    WHERE lat <> '' AND lng <> ''
                    ORDER BY distance ASC LIMIT {$offset},10";
            $results = Yii::app()->db->createCommand($sql)->queryAll();

            $request_type = Yii::app()->request->getPost('type');

            if ($request_type == 'json'){
                header ('Content-Type: application/json');
                echo json_encode($results);
                exit();
            }
            return $this->render('store_locators', array(
                'stores' => $results,
                'query' => $postcode,
                'position' => $location_search,
                'position_detail' => array('lat' => $latitude, 'lng' => $longitude),
                'pager' => $pager
            ));
        }
        return $this->render('store_locators', array('query' => '', 'pager' => 0, 'position_detail' => array('lat' => '', 'lng' => '')));
    }
	
	public function actionCalculate()
    {
        $model = RetailerCategory::model()->findAll();

        if (isset($_GET['calccash'])) {
            if ($_GET['calccash'] == 1) {
                $param = true;
            }
        } else {
            $param = false;
        }

        $retailer = array();
        foreach ($model as $retailerValue) {
            $retailer[$retailerValue->id] = $retailerValue->name;
        }


        if (!$param) {
            $this->render('calculate_bonuscash', array(
                'model' => $model,
                'retailer' => $retailer
            ));
        } else {

            $cat_id = $_POST['cat_id'];

            $sql = "SELECT CONCAT(ROUND(AVG(bonus_cash),2),'%') avg_bonus_cash
                    FROM retailer
                    WHERE retailer_category_id = :qterm and bonus_cash is NOT NULL and bonus_cash NOT LIKE '$%' GROUP BY retailer_category_id ";
            $command = Yii::app()->db->createCommand($sql);
            $command->bindParam(":qterm", $cat_id, PDO::PARAM_STR);
            $result = $command->queryAll();
            echo $result[0]['avg_bonus_cash'];

        }
    }

}
