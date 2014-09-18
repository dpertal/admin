<?php

/**
 * This is the model class for table "retailer".
 *
 * The followings are the available columns in table 'retailer':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $logo_url
 * @property string $summary
 * @property string $commission
 * @property string $bonus_cash
 * @property string $coupon_commission
 * @property string $coupon_bonus_cash
 * @property string $url
 * @property string $external_id
 * @property integer $commission_type_id
 * @property string $logo
 * @property integer $offer_type_id
 * @property integer $has_hot_deal
 * @property integer $affiliate_network_id
 * @property string $checksum
 * @property integer $active
 * @property string $created
 * @property integer $created_by
 * @property string $updated
 * @property integer $updated_by
 * @property string $phone
 * @property string $business_type
 * @property string $lice
 * @property string $price
 * @property string $timmings
 * @property string $hours
 * @property string $address
 * @property string $postcode
 * @property string $lat
 * @property string $lng
 *
 * The followings are the available model relations:
 * @property AffiliateCoupon[] $affiliateCoupons
 * @property Banner[] $banners
 * @property Colourbox[] $colourboxes
 * @property Offer[] $offers
 * @property OfferType $offerType
 * @property RetailerCategoryAssociation[] $retailerCategoryAssociations
 */
class Retailer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'retailer';
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
			array('commission_type_id, offer_type_id, has_hot_deal, affiliate_network_id, active, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('name, logo_url', 'length', 'max'=>256),
			array('summary, external_id', 'length', 'max'=>64),
			array('commission, bonus_cash, coupon_commission, coupon_bonus_cash, checksum', 'length', 'max'=>32),
			array('url', 'length', 'max'=>128),
			array('logo', 'length', 'max'=>1000),
			array('description, created, updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description, logo_url, summary, commission, bonus_cash, coupon_commission, coupon_bonus_cash, url, external_id, commission_type_id, logo, offer_type_id, has_hot_deal, affiliate_network_id, checksum, active, created, created_by, updated, updated_by,phone, business_type, lice, price, timmings, address, postcode, lat, lng', 'safe', 'on'=>'search'),
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
			'affiliateCoupons' => array(self::HAS_MANY, 'AffiliateCoupon', 'retailer_id'),
			'banners' => array(self::HAS_MANY, 'Banner', 'retailer_id'),
			'colourboxes' => array(self::HAS_MANY, 'Colourbox', 'retailer_id'),
			'offers' => array(self::HAS_MANY, 'Offer', 'retailer_id'),
			'offerType' => array(self::BELONGS_TO, 'OfferType', 'offer_type_id'),
			'retailerCategoryAssociations' => array(self::HAS_MANY, 'RetailerCategoryAssociation', 'retailer_id'),
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
			'description' => 'Description',
			'logo_url' => 'Logo Url',
			'summary' => 'Summary',
			'commission' => 'Commission',
			'bonus_cash' => 'Bonus Cash',
			'coupon_commission' => 'Coupon Commission',
			'coupon_bonus_cash' => 'Coupon Bonus Cash',
			'url' => 'Url',
			'external_id' => 'External',
			'commission_type_id' => 'Commission Type',
			'logo' => 'Logo',
			'offer_type_id' => 'Offer Type',
			'has_hot_deal' => 'Has Hot Deal',
			'affiliate_network_id' => 'Affiliate Network',
			'checksum' => 'Checksum',
			'active' => 'Active',
			'created' => 'Created',
			'created_by' => 'Created By',
			'updated' => 'Updated',
			'updated_by' => 'Updated By',
            'phone' => 'Phone',
            'business_type' => 'Business Type',
            'lice' => 'Lice',
            'price' => 'Price',
            'timmings' => 'Timmings',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('logo_url',$this->logo_url,true);
		$criteria->compare('summary',$this->summary,true);
		$criteria->compare('commission',$this->commission,true);
		$criteria->compare('bonus_cash',$this->bonus_cash,true);
		$criteria->compare('coupon_commission',$this->coupon_commission,true);
		$criteria->compare('coupon_bonus_cash',$this->coupon_bonus_cash,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('external_id',$this->external_id,true);
		$criteria->compare('commission_type_id',$this->commission_type_id);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('offer_type_id',$this->offer_type_id);
		$criteria->compare('has_hot_deal',$this->has_hot_deal);
		$criteria->compare('affiliate_network_id',$this->affiliate_network_id);
		$criteria->compare('checksum',$this->checksum,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('updated_by',$this->updated_by);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('business_type',$this->business_type,true);
        $criteria->compare('lice',$this->lice,true);
        $criteria->compare('price',$this->price,true);
        $criteria->compare('timmings',$this->timmings,true);
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
            if (!empty($value->address)){
                $location = self::get_lat_long($value->address, true);
                if ($location){
                    $value->setAttribute('lat', $location['lat']);
                    $value->setAttribute('lng', $location['lng']);
                    $value->save();
                }
            }
        }
    }

    public static function get_lat_long($postcode, $address = false) {
        if ($address)
            $url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($postcode);
        else $url = "http://maps.googleapis.com/maps/api/geocode/json?components=postal_code:" . urlencode($postcode) . "&sensor=false";
        $json = Curl::get_page(array("url"=>$url));
        $store_data = json_decode($json, true);
        if (isset($store_data['results'][0])){
            $store_data = $store_data['results'][0];
            $lng = $store_data['geometry']['location']['lng'];
            $lat = $store_data['geometry']['location']['lat'];
            return array('lat'=>$lat,
                         'lng'=>$lng
            );
        }
        return false;
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
