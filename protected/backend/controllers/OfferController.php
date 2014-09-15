<?php

class OfferController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'addFieldAjax'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {

        $model = new Offer;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Offer'])) {
            foreach ($_POST['Offer'] as $offer) {
                $model1 = new Offer;
                $model1->attributes = $offer;
                if (!$model1->save()) {
                    
                }
            }


            $this->redirect(array('index', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        
        $model = Retailer::model()->findByPk($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Offer'])) {
            foreach ($_POST['Offer'] as $offer) {
                if(isset($offer['id']) && $offer['id'] != '') {
                    $model1 = Offer::model()->findByPk($offer['id']);
                } else {
                    $model1 = new Offer;
                }
                
                $model1->attributes = $offer;
                if(isset($offer['id']) && $offer['id'] != '') {
                    $model1->update();
                } else {
                    $model1->save();
                }
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
//		$dataProvider=new CActiveDataProvider('Offer');
//		$this->render('index',array(
//			'dataProvider'=>$dataProvider,
//		));


        $model = new Offer('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Offer']))
            $model->attributes = $_GET['Offer'];

        //$dataProvider = new CActiveDataProvider('RetailerCategory');
        $this->render('index', array(
            'dataProvider' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Offer('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Offer']))
            $model->attributes = $_GET['Offer'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Offer the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Offer::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Offer $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'offer-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionAddFieldAjax($rowindx, $index, $quote_id) {
        $model = new Offer();
        $form = new CActiveForm();
        $this->renderPartial('_form_part', array('offer' => $model, 'form' => $form, 'rowindx' => $rowindx, 'index' => $index, 'quote_id' => $quote_id), false, true);
    }

}
