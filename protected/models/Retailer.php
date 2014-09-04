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
 * @property string $updated
 * @property integer $updated_by
 * @property integer $offer_type_id
 * @property integer $has_hot_deal
 * @property integer $active
 * @property string $created
 * @property integer $created_by
 *
 * The followings are the available model relations:
 * @property Colourbox[] $colourboxes
 * @property Offer[] $offers
 * @property OfferType $offerType
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
			array('commission_type_id, updated_by, offer_type_id, has_hot_deal, active, created_by', 'numerical', 'integerOnly'=>true),
			array('name, logo_url', 'length', 'max'=>256),
			array('summary, external_id', 'length', 'max'=>64),
			array('commission, bonus_cash, coupon_commission, coupon_bonus_cash', 'length', 'max'=>32),
			array('url', 'length', 'max'=>128),
			array('logo', 'length', 'max'=>1000),
			array('description, updated, created', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description, logo_url, summary, commission, bonus_cash, coupon_commission, coupon_bonus_cash, url, external_id, commission_type_id, logo, updated, updated_by, offer_type_id, has_hot_deal, active, created, created_by', 'safe', 'on'=>'search'),
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
			'colourboxes' => array(self::HAS_MANY, 'Colourbox', 'retailer_id'),
			'offers' => array(self::HAS_MANY, 'Offer', 'retailer_id'),
			'offerType' => array(self::BELONGS_TO, 'OfferType', 'offer_type_id'),
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
			'updated' => 'Updated',
			'updated_by' => 'Updated By',
			'offer_type_id' => 'Offer Type',
			'has_hot_deal' => 'Has Hot Deal',
			'active' => 'Active',
			'created' => 'Created',
			'created_by' => 'Created By',
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
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('offer_type_id',$this->offer_type_id);
		$criteria->compare('has_hot_deal',$this->has_hot_deal);
		$criteria->compare('active',$this->active);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_by',$this->created_by);

		return new CActiveDataProvider($this, array('criteria'=>$criteria,));
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
}
