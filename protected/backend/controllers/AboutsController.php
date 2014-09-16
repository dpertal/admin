<?php
class AboutsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
		'accessControl', // perform access control for CRUD operations
		'postOnly + delete', // we only allow deletion via POST request
		);
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('update',array(
		'model'=>$this->loadModel($id),
		));
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function actionIndex(){
		
		$dataProvider=new CActiveDataProvider('Abouts');
		$this->render('index',array(
		'dataProvider'=>$dataProvider,
		));
	
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(Yii::app()->request->isPostRequest)
		{
			$model->attributes=Yii::app()->request->getPost('Abouts');
			if($model->save())
			$this->redirect(array('index','id'=>$model->id));
		}
		
		$this->render('update',array(
		'model'=>$model,
		));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return News the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Abouts::model()->findByPk($id);
		if($model===null)
		throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id = null)
	{
		$model=new Abouts;
		$file = dirname(__FILE__).'../../../config/params.inc';
        $content = file_get_contents($file);
        $arr = unserialize(base64_decode($content));
		
		if(Yii::app()->request->isPostRequest)
		{
			$model->attributes=Yii::app()->request->getPost('Abouts');
			if($model->save())
			$this->redirect(array('index','id'=>$model->id));
		}
		
		$this->render('create',array(
		'model'=>$model,
		'template' => $arr
		));
		
		
	}
}
?>