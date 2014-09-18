<?php

class RetailerController extends Controller {

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
                'actions' => array('create', 'update', 'admin', 'delete', 'coupon', 'banner'),
                'users' => array('@'),
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

    public function actionCoupon($id) {
        $cupons = AffiliateCoupon::model()->findAll('retailer_id =' . $id);
        $this->render('coupons', array(
            'model' => $cupons,
        ));
    }

    public function actionBanner($id) {
        $cupons = Banner::model()->findAll('retailer_id =' . $id);
        $this->render('banner', array(
            'model' => $cupons,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Retailer;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Retailer'])) {
            $model->attributes = $_POST['Retailer'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
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
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Retailer'])) {
            $model->attributes = $_POST['Retailer'];

            if (!empty($_FILES['logo']['name'])) {
                $targetDir = dirname(Yii::app()->basePath) . '/assets/uploads/';
                if (!file_exists($targetDir))
                    mkdir($targetDir);

                //Check for valid file type
                if (strpos($_FILES['logo']['type'], 'image') >= 0) {

                    //Check for valid image
                    $imageSize = getimagesize($_FILES['logo']['tmp_name']);
                    if ($imageSize[0] > 0) {
                        move_uploaded_file($_FILES['logo']['tmp_name'], $targetDir . basename($_FILES['logo']['name']));
                        $imagePath = '/assets/uploads/' . basename($_FILES['logo']['name']);
                        $model->logo = $imagePath;
                    } else
                        unset($model->logo);
                } else
                    unset($model->logo);
            }

            if ($model->save())
                $this->redirect(array('index'));
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

        $model = new Retailer('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Retailer']))
            $model->attributes = $_GET['Retailer'];

        //$dataProvider = new CActiveDataProvider('RetailerCategory');
        $this->render('index', array(
            'dataProvider' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Retailer('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Retailer']))
            $model->attributes = $_GET['Retailer'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Retailer the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Retailer::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Retailer $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'retailer-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
