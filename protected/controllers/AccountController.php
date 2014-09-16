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
            return $this->render('profile');
        }
    }
?>