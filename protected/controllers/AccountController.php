<?php

    class AccountController extends Controller{

        public function actions() {
            return array(
                // page action renders "static" pages stored under 'protected/views/site/pages'
                // They can be accessed via: index.php?r=site/page&view=FileName
                'page' => array(
                    'class' => 'CViewAction',
                ),
            );
        }

        //For ajax load customer
        public function actionLoadCustomer(){
            $result = array('status' => 'Failure', 'msg' => 'No action performed');
            header ('ContentType: application/json');
            $data = $_POST;
            if (empty($data) || !isset($data['cardNumber']) || !isset($data['lastname']))
                $result = array('status' => 'Failure', 'msg' => 'Invalid input value');
            else{

                $Account = new Account();
                $accountData = $Account->model()->findAll("cardNumber = '{$data['cardNumber']}' AND lastname = '{$data['lastname']}'");

                //Check if data is empty or not
                if (empty($accountData))
                    $result = array('status' => 'Failure', 'msg' => 'No Record found');
                else{
                    $accountData = $accountData[0];
                    //Set the result and prepare to send back
                    $result = array('status' => 'Success', 'account' => array('Info' => $accountData->attributes));
                }
            }
            echo json_encode($result);exit();
        }

        public function actionProfile(){
            if (Yii::app()->request->isPostRequest){
                $data = Yii::app()->request->getPost('data');
                $account = Account::model()->findByPk(Yii::app()->user->id);

                if (empty($data['password']))
                    unset($data['password']);

                foreach($data as $key => $value)
                    $account->setAttribute($key, $value);

                $account->setAttribute('updated', date("Y-m-d H:i:s"));

                if ($account->save()){
                    $error = false;
                    $message = "Your profile has been updated";
                }
                else{
                    $error = true;
                    $message = "Update failed";
                }
                $account = Account::model()->find(Yii::app()->user->id);
                return $this->render('profile', array('account' => $account, 'error' => $error, 'message' => $message));
            }
            $account = Account::model()->find(Yii::app()->user->id);
            return $this->render('profile', array('account' => $account));
        }
    }
?>