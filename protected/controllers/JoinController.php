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

            $Account = new Account();
            $checkRecord = $Account->checkExistRecord($data['email'], $data['username']);

            if (!$checkRecord['status']){
                $day = str_pad($data['dobD'], 2, '0', STR_PAD_LEFT) ;
                $month = str_pad($data['dobM'], 2, '0', STR_PAD_LEFT);
                $year = $data['dobY'];

                unset($data['dobD']);
                unset($data['dobM']);
                unset($data['dobY']);

                foreach ($data as $key => $value)
                    $Account->setAttribute($key, $value);

                $Account->setAttribute('created', date("Y-m-d H:i:s"));
                $Account->setAttribute('updated', date("Y-m-d H:i:s"));
                $Account->setAttribute('partnerProgramID', PROGRAM_ID);
                $Account->setAttribute('payRef', 'FREE');
                $Account->setAttribute('dob', "$month/$day/$year");
                $Account->setAttribute('trackingID', '');
                $Account->setAttribute('confirmationStatus', 0);
                $Account->setAttribute('synced', '');
                $Account->setAttribute('deleted', '');
                $Account->setAttribute('cardNumber', '');
                $Account->setAttribute('barcode', 0);
                $Account->setAttribute('email_token', md5(uniqid() . $data['email']));

                $save = $Account->save();

                if ($save){
                    $Account->setAttribute('trackingID', Yii::createTrackingID($Account->id, $Account->mobile));
                    $Account->save();

                    $data['from'] = 'info@bonuscash.com.au';
                    $data['to'] = $Account->email;
                    $data['subject'] = 'LuckyBuys Email Confirmation';
                    $data['body'] = $this->renderFile(ROOT_THEME . '/views/emails/confirmationEmail.php', array(
                        'appName' => 'LuckyBuys',
                        'firstname' => $Account->firstname,
                        'emailToken' => $Account->email_token,
                        'domainURL' => Yii::app()->getBaseUrl(true)
                    ), true);
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