<?php

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

    public function actionIndex(){

        $data = null;

        if (Yii::app()->request->isPostRequest){
            $data = Yii::app()->request->getPost('data');

            //Check if this is update or create new
            if (isset($data['accountId'])){
                $Account = Account::model()->findAllByPk($data['accountId'])[0];
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
                    $data['from'] = 'info@bonuscash.com.au';
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
}