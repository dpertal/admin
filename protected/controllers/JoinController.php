<?php
/*
 * @JoinController
 * @Tran Tuan
 * @10/09/2014
 * */

class JoinController extends Controller{

    public function actions() {
        return array(
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /*
     * IndexAction
     * @Handle and render for join home
     * */
    public function actionIndex(){

        $data = null;

        if (Yii::app()->request->isPostRequest){
            $data = Yii::app()->request->getPost('data');

            //Check if this is update or create new
            if (isset($data['accountId'])){
                $Account = Account::model()->findAllByPk($data['accountId']);
                $Account = $Account[0];
                $checkRecord['status'] = false;
            }
            else {
                $Account = new Account();
                $checkRecord = $Account->checkExistRecord($data['email'], $data['username']);
            }

            if (!$checkRecord['status']){
                $day = str_pad($data['dobD'], 2, '0', STR_PAD_LEFT) ;
                $month = str_pad($data['dobM'], 2, '0', STR_PAD_LEFT);
                $year = $data['dobY'];

                unset($data['dobD']);
                unset($data['dobM']);
                unset($data['dobY']);

                //Set new data
                foreach ($data as $key => $value)
                    $Account->setAttribute($key, $value);

                if (!isset($data['accountId'])){
                    $Account->setAttribute('created', date("Y-m-d H:i:s"));
                    $Account->setAttribute('partnerProgramID', PROGRAM_ID);
                    $Account->setAttribute('payRef', 'FREE');
                }

                $Account->setAttribute('updated', date("Y-m-d H:i:s"));
                $Account->setAttribute('dob', "$month/$day/$year");
                $Account->setAttribute('confirmationStatus', 0);
                $Account->setAttribute('synced', NULL);
                $Account->setAttribute('deleted', NULL);
                $Account->setAttribute('email_token', md5(uniqid() . $data['email']));

                //Saving record
                $save = $Account->save();

                //If saving to DB is fine and no error comes
                if ($save){

                    if (!isset($data['accountId'])){
                        $Account->setAttribute('trackingID', Yii::createTrackingID($Account->id, $Account->mobile));
                        $Account->save();
                    }

                    //Send confirmation email
                    $data['to'] = $Account->email;
                    $data['subject'] = 'LuckyBuys Email Confirmation';
                    $data['body'] = $this->renderFile(ROOT_THEME . '/views/emails/confirmationEmail.php', array(
                        'appName' => 'LuckyBuys',
                        'firstname' => $Account->firstname,
                        'emailToken' => $Account->email_token,
                        'domainURL' => Yii::app()->getBaseUrl(true)
                    ), true);

                    //Send mail
                    Yii::sendEmail($data);
                    return $this->render('join_success', array('email_token' => $Account->email_token));
                }
                else{
                    $error = $Account->getErrors();
                    $this->render('index', array('message' => $error[0], 'data' => $data));
                }
            }
            else $this->render('index', array('message' => $checkRecord['message'], 'data' => $data));
        }
        return $this->render('index', array('data' => $data));
    }

    /*
     * Resend confirmation email
     * @Will be accessed via Ajax, allow user to resend system email confirmation
     * @Return: Json with result format
     * */
    function actionResendConfirmationEmail(){
        $result = array('status' => 'error', 'message' => 'No action performed');
        if (Yii::app()->request->isPostRequest){
            $token = Yii::app()->request->getPost('token');

            $account = Account::model()->find("email_token = '{$token}'");

            //If there is an account related to this token
            if (!empty($account)){
                //Send confirmation email
                $data['to'] = $account->email;
                $data['subject'] = 'LuckyBuys Email Confirmation';
                $data['body'] = $this->renderFile(ROOT_THEME . '/views/emails/confirmationEmail.php', array(
                    'appName' => 'LuckyBuys',
                    'firstname' => $account->firstname,
                    'emailToken' => $account->email_token,
                    'domainURL' => Yii::app()->getBaseUrl(true)
                ), true);

                //Send mail
                Yii::sendEmail($data);
                $result = array('status' => 'success', 'message' => 'Confirmation email has been resent');
            }
            else $result['message'] = 'There is no account related to this token';
        }
        header("Content-type: application/json");
        echo json_encode($result);
    }

    /*
     * Account confirmation from email
     * @User click on confirmation link at email
     * */
    public function actionConfirmation(){
        $token = Yii::app()->request->getParam('token');

        //Check if token is provided
        if (!empty($token)){

            //Check account token
            $account = Account::model()->find("email_token = '{$token}'");
            if (!empty($account)){
                $account->setAttribute('confirmationStatus', 2);

                //Fetching available barcode for this account
                $barcode = Barcodes::model()->find("status = 0 AND program_id = " . PROGRAM_ID, array("ORDER BY" => "id ASC"));
                if (!empty($barcode)){
                    $account->barcode = $barcode->barcode;
                    $barcode->setAttribute('status', 1); //Barcode has been set
                    $barcode->save();
                }
                if ($account->save()){

                    //Send welcome email
                    $data['to'] = $account->email;
                    $data['subject'] = 'Lucky Buys - Your account has been active successfully';
                    $data['body'] = $this->renderFile(ROOT_THEME . '/views/emails/welcomeEmail.php', array(
                        'appName' => 'LuckyBuys',
                        'username'      => $account->username,
                        'password'      => $account->password,
                        'domainURL' => Yii::app()->getBaseUrl(true)
                    ), true);
                    Yii::sendEmail($data);

                    return $this->render('confirm_email');
                }
                else{
                    $error = $account->getErrors();
                    $error = $error[0];
                }
            }
            else $error = 'Invalid token request';
        }
        else $error = 'Invalid token request';
        return $this->render('confirm_email', array('error' => $error));
    }

    /*
     * Forgot password
     * @User can access forgot password page to reset their password
     * */
    public function actionForgotPassword(){
        return $this->render('forgot_password');
    }

    /*
     *Reset password page
     * */
    public function actionResetPassword(){
        if (Yii::app()->request->isPostRequest){
            $emailToken = Yii::app()->request->getPost('emailToken');
            $timeToken = Yii::app()->request->getPost('timeToken');

            $email = Yii::doDecrypt($emailToken);
            $time = Yii::doDecrypt($timeToken);

            $account = Account::model()->find("email = '{$email}'");

            if ($account){
                $accountPassword = Yii::app()->request->getPost('password');
                $account->setAttribute('password', $accountPassword);
                $account->save();
                $result = array('status' => 'success', 'message' => 'Your password has been reset! You can use it in next time log in');
            }
            else $result = array('status' => 'error', 'message' => 'Account is not found');
            header("Content-type: application/json");
            echo json_encode($result);exit();
        }
        return $this->render('reset_password');
    }

    /*
     * Ajax reset password from client
     * @Will get request from client email and send password reset email
     * */
    public function actionResetPasswordAjax(){
        $result = array('status' => 'error', 'message' => 'No action performed');
        if (Yii::app()->request->isPostRequest){
            $email = Yii::app()->request->getPost('email');

            if (empty($email) || Yii::invalidEmail($email))
                $result['message'] = 'That does not appear to be a valid email address!';
            else{
                $account = Account::model()->find("email = '{$email}'");
                if ($account){
                    $timestamp = time();
                    $hash = sha1(uniqid().$timestamp);

                    //Begin email
                    $data['to'] = $email;
                    $data['subject'] = 'LuckyBuys BonusCash Password Reset';

                    $data['body'] = $this->renderFile(ROOT_THEME . '/views/emails/forgotPasswordEmail.php', array(
                        'appName' => 'LuckyBuys',
                        'email_token'   => Yii::doEncrypt($email),
                        'time_token'    => Yii::doEncrypt($hash),
                        'domainURL' => Yii::app()->getBaseUrl(true)
                    ), true);

                    Yii::sendEmail($data);

                    $result = array('status' => 'success', 'message' => "Password reset instructions have been emailed to you");
                }
                else $result = array('status' => 'error', 'message' => "That email address doesn't exist in our system!");
            }
        }
        header("Content-type: application/json");
        echo json_encode($result);
    }

}