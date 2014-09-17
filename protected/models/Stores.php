<?php

    /**
     * This is the model class for table "retailer".
     *
     * The followings are the available columns in table 'retailer':
     * @property integer $id
     * @property string $name
     * @property string $image_url
     * @property string $phone
     * @property string $business_type
     * @property string $lice
     * @property string $price
     * @property string $summary
     * @property string $timmings
     * @property string $hours
     * @property string $description
     * @property string $address
     * @property string $postcode
     * @property string $lat
     * @property string $lng
     *
     */
    class Stores extends CActiveRecord
    {
        /**
         * @return string the associated database table name
         */
        public function tableName()
        {
            return 'stores';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('name', 'required'),
                array('description', 'safe'),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array('id, name, image_url, phone, business_type, lice, price, summary, timmings, description, address, postcode, lat, lng', 'safe', 'on'=>'search'),
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
                'id' => 'ID',
                'name' => 'Name',
                'image_url' => 'Image URL',
                'phone' => 'Phone',
                'business_type' => 'Business Type',
                'lice' => 'Lice',
                'price' => 'Price',
                'summary' => 'Summary',
                'timmings' => 'Timmings',
                'description' => 'Description',
                'address' => 'Address',
                'postcode' => 'Postcode',
                'lat' => 'Latitude',
                'lng' => 'Longitude'
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
            $criteria->compare('name',$this->name,true);
            $criteria->compare('image_url',$this->image_url,true);
            $criteria->compare('phone',$this->phone,true);
            $criteria->compare('business_type',$this->business_type,true);
            $criteria->compare('lice',$this->lice,true);
            $criteria->compare('price',$this->price,true);
            $criteria->compare('summary',$this->summary,true);
            $criteria->compare('timmings',$this->timmings,true);
            $criteria->compare('description',$this->description,true);
            $criteria->compare('address',$this->address,true);
            $criteria->compare('postcode',$this->postcode);
            $criteria->compare('lat',$this->lat,true);
            $criteria->compare('lng',$this->lng);

            return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * Please note that you should have this exact method in all your CActiveRecord descendants!
         * @param string $className active record class name.
         * @return Retailer the static model class
         */
        public static function model($className=__CLASS__)
        {
            return parent::model($className);
        }
        public function updateAllLatLng(){
            $data = $this->model()->findAll();
            foreach ($data as $value){
                $location = self::get_lat_long($value->postcode);
                if ($location){
                    $value->setAttribute('lat', $location['lat']);
                    $value->setAttribute('lng', $location['lng']);
                    $value->save();
                }
            }
        }

        public static function get_lat_long($postcode) {

            $url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($postcode);
            $json = Curl::get_page(array("url"=>$url));
            $store_data = json_decode($json, true);
            $store_data = $store_data['results'][0];
            $lng = $store_data['geometry']['location']['lng'];
            $lat = $store_data['geometry']['location']['lat'];

            //Return
            if($lng && $lat) {
                return array('lat'=>$lat,
                             'lng'=>$lng
                );
            } else {
                return false;
            }
        }
    }

    class Curl {
        function curl() {}

        public static function init_curl($ch,$url,$postfields=null,$follow=null,$cookie=null,$referer=null) {

            // Set url
            curl_setopt($ch, CURLOPT_URL, $url);

            // Enable Post
            if($postfields) {
                curl_setopt ($ch, CURLOPT_POST, 1);
                curl_setopt ($ch, CURLOPT_POSTFIELDS, $postfields);
            }

            if($follow) {
                curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1 );
            }

            if($referer) {
                curl_setopt($ch, CURLOPT_REFERER, $referer);
            }

            //Enable SSL
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');

            //Return results as string
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

            return $ch;
        }

        /*
        Grabs a page
        */
        public static function get_page($options) {

            //Set options
            foreach($options AS $key=>$value) {
                $$key = $value;
            }

            $ch = curl_init();

            $postfields = isset($postfields) ? $postfields : null;
            $follow = isset($follow) ? $follow : null;
            $cookie = isset($cookie) ? $cookie : null;

            $ch = self::init_curl($ch,$url,$postfields,$follow,$cookie);
            $page = curl_exec($ch);
            curl_close($ch);
            return $page;
        }
    }

