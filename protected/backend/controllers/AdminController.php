<?php

class AdminController extends Controller
{
	
	public function actionIndex()
	{
		if(Yii::app()->user->isGuest) {
                        $this->redirect(Yii::app()->request->baseUrl.'/admin.php/user/');
			$this->actionLogin();
		} else {
			$this->redirect(Yii::app()->request->baseUrl.'/admin.php/user/');
		}
		//$this->render('index');
	}
	
	

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()) {
				$this->lastVisit();
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
	
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	private function lastVisit() {
		$lastVisit = User::model()->findByPk(Yii::app()->user->id);
		$lastVisit->last_login = time();
		$lastVisit->save();
	}
}