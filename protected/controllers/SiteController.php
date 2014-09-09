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

    public function actionIndex() {
        $program = Yii::app()->params['program'];
        $offers = Offer::model()->findAll("is_home_page = 1 and current = 1", array("limit" => "4"));
        $news = News::model()->findAll("program_id = $program and current = 1", array("limit" => "1"));
        print_r($news);
        $this->render('index', array('offers' => $offers));
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

        $this->render('aboutus');
    }
    
    public function actionHotdeals($type=0) {
        $criteria = new CDbCriteria;
        $criteria->together = true;
        $criteria->with = array('retailer');
        $now = new CDbExpression("NOW()");
        $criteria->addCondition(" (retailer.id =  retailer_id)"
                . " and (start_date is null or start_date<= now()) and end_date >= now() and current = 1");
        
        $model = Offer::model()->findAll($criteria);
        
        $this->render('hotdeals', array('model'=>$model));
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

        $this->render('shop');
    }

    public function actionRetailers() {

        $this->render('retailer');
    }

    public function actionError() {


        if ($error = Yii::app()->errorHandler->error) {

            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

}
