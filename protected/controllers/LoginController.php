<?php

/*
 * @LoginController
 * @Tran Tuan
 * @10/09/2014
 * */

class LoginController extends Controller {

    public $url = '';

    public function actions() {
        return array(
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    public function shopNow() {
        
    }

    public function actionIndex() {
        if (Yii::app()->user->id != 0 && Yii::app()->request->getPost('url') != '') {
            header("Location:" . Yii::app()->request->getPost('url') . Yii::app()->user->id);
        } else if (Yii::app()->request->isPostRequest) {
            $username = Yii::app()->request->getPost('username');
            $password = Yii::app()->request->getPost('password');
            $remember_me = Yii::app()->request->getPost('remember_me');

            if (empty($username))
                $error = "Please fill your username";
            if (!isset($error) && empty($password))
                $error = "Please fill your password";

            if (!isset($error)) {
                $result = $this->checkLogin($username, $password, $remember_me);
                if ($result) {
                    //if (Yii::app()->request->getPost('url') != '') {
                        //header("Location:" . Yii::app()->request->getPost('url') . Yii::app()->user->id);
                    //} else {
                        $this->redirect(array('Site/index'));
                    //}
                } else
                    $error = 'Invalid login information';
            }


            return $this->render('index', array("message" => $error));
        }
        return $this->render('index');
    }

    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(array('Site/index'));
    }

    private function checkLogin($username, $password, $remember_me = null) {

        $identity = new UserIdentity($username, $password);
        $identity->authenticate();

        if ($identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = !empty($remember_me) ? 3600 * 24 * 30 : 3600 * 24 * 1; // 30 days
            Yii::app()->user->login($identity, $duration);
            return true;
        } else
            return false;
    }

}
