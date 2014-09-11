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

        return $this->render('join_success');

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
                $Account->setAttribute('synced', '');
                $Account->setAttribute('deleted', '');
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
}