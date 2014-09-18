<?php

class UserController extends Controller {

    public $layout = '//layouts/column1';
    public $_model;
    public $_jobAssignments;
    public $_jobAssignments_1;
    public $type;
    public $_quotejobModel;
    public $_commentsModel;
    public $_quoteMessage;
    public $status;
    public $trad;

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'inactiveUsers', 'view', 'create', 'update', 'admin', 'delete', 'dashboard', 'TrademanDashboard', 'users'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        if (Yii::app()->user->isGuest) {
            $this->actionLogin();
        } else {
            $dataProvider = new CActiveDataProvider('User');
            $this->render('index', array('dataProvider' => $dataProvider,));
        }
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionCreate() {
        $model = new User;

        if (isset($_POST['User'])) {
            $this->performAjaxValidation($model);
        }


        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array('model' => $model,));
    }

    public function uploadMultifile($model, $attr, $path) {

        if ($sfile = CUploadedFile::getInstances($model, $attr)) {
            foreach ($sfile as $i => $file) {
                $formatName = time() . $i . '.' . $file->getExtensionName();
                $file->saveAs(Yii::app()->basePath . DIRECTORY_SEPARATOR . '..' . $path . $formatName);
                $ffile[$i] = $formatName;
                return $formatName;
            }
        }
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];

            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();
        
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

    public function actionAdmin() {
        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionTrademanDashboard() {

        $this->_quotejobModel = new QuoteJob();
        $this->_commentsModel = new QuoteComments();
        $this->_quoteMessage = new QuoteMessage();

        $this->trad = 1;

        $model = new JobAssignment('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['JobAssignment']))
            $model->attributes = $_GET['JobAssignment'];

        $model->id = Yii::app()->user->id;
        $this->type = 'job';
        $this->_model = $model;


        $this->render('trademan_dashboard', array(
            'model' => $model,
        ));
    }

    public function actionUsers() {
        $model = new User('search');

        $this->active = 1;
        $this->_model = $model;
        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionInactiveUsers() {
        $model = new User('search');

        $this->active = 0;
        $this->_model = $model;
        $this->render('index', array(
            'model' => $model,
        ));
    }
}
