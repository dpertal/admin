<?php

    /**
     * This is the model class for table "Account".
     *
     * The followings are the available columns in table 'news':
     * @property integer $id
     * @property integer $partnerProgramID
     * @property string $username
     * @property string $salutation
     * @property string $firstname
     * @property string $lastname
     * @property string $email
     * @property string $password
     * @property string $cardNumber
     * @property string $mobile
     * @property string $dob
     * @property string $street1
     * @property string $street2
     * @property string $suburb
     * @property string $state
     * @property integer $postcode
     * @property string $country
     * @property string $trackingID
     * @property string $payRef
     * @property string $created
     * @property string $updated
     * @property string $deleted
     * @property string $synced
     * @property string $email_token
     * @property integer $confirmationStatus
     * @property string $barcode
     *
     * The followings are the available model relations:
     * @property Program $program
     */
    class Account extends CActiveRecord
    {
        /**
         * @return string the associated database table name
         */
        public function tableName()
        {
            return 'account';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('partnerProgramID, username, salutation, firstname, lastname, email, password,
                    dob, street1, suburb, state, postcode, country', 'required'),
                array('partnerProgramID, barcode', 'numerical', 'integerOnly'=>true),
                array('username, password', 'length', 'min'=>6),
                array('created, updated, deleted, synced, email_token, confirmationStatus, barcode', 'safe'),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array('cardNumber, mobile, street2, trackingID', 'safe', 'on'=>'search'),
            );
        }

        /**
         * @return array relational rules.
         */
        public function relations()
        {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(

            );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels()
        {
            return array(

            );
        }

        /**
         * Retrieves a list of models based on the current search/filter conditions.
         *
         * Typical usecase:
         * - Initialize the model fields with values from filter form.
         * - Execute this method to get CActiveDataProvider instance which will filter
         * models according to data in model fields.
         * - Pass data provider to CGridView, CListView or any similar widget.
         *
         * @return CActiveDataProvider the data provider that can return the models
         * based on the search/filter conditions.
         */
        public function search()
        {
            // @todo Please modify the following code to remove attributes that should not be searched.

            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id);
            $criteria->compare('partnerProgramID',$this->partnerProgramID);
            $criteria->compare('username',$this->username);
            $criteria->compare('firstname',$this->firstname);
            $criteria->compare('lastname',$this->lastname);
            $criteria->compare('email',$this->email);
            $criteria->compare('cardNumber',$this->cardNumber);
            $criteria->compare('country',$this->country);
            $criteria->compare('trackingID',$this->trackingID);
            $criteria->compare('payRef',$this->payRef);
            $criteria->compare('created',$this->created);
            $criteria->compare('updated',$this->updated);
            $criteria->compare('deleted',$this->deleted);
            $criteria->compare('synced',$this->synced);
            $criteria->compare('email_token',$this->email_token);
            $criteria->compare('confirmationStatus',$this->confirmationStatus);
            $criteria->compare('barcode',$this->barcode);

            return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * Please note that you should have this exact method in all your CActiveRecord descendants!
         * @param string $className active record class name.
         * @return News the static model class
         */
        public static function model($className=__CLASS__)
        {
            return parent::model($className);
        }

        public function checkExistRecord($email, $username = null){
            $account = $this->model()->findAll("email = '{$email}'");
            if (!empty ($account)) return array('status' => true, 'message' => 'Email has already exist');
            if (!empty($username)){
                $account = $this->model()->findAll("username = '{$username}'");
                if (!empty ($account)) return array('status' => true, 'message' => 'Username has already exist');
            }
            return array('status' => false);
        }
    }
