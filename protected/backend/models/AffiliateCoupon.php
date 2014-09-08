<?php

/**
 * This is the model class for table "affiliate_coupon".
 *
 * The followings are the available columns in table 'affiliate_coupon':
 * @property string $id
 * @property integer $retailer_id
 * @property string $target_url
 * @property string $code
 * @property string $description
 * @property string $start_date
 * @property string $end_date
 * @property integer $enabled
 * @property string $external_id
 * @property integer $affiliate_network_id
 * @property string $created
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property Retailer $retailer
 */
class AffiliateCoupon extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'affiliate_coupon';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('retailer_id, enabled, affiliate_network_id', 'numerical', 'integerOnly'=>true),
			array('target_url', 'length', 'max'=>256),
			array('code, external_id', 'length', 'max'=>64),
			array('description', 'length', 'max'=>512),
			array('start_date, end_date, created, updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, retailer_id, target_url, code, description, start_date, end_date, enabled, external_id, affiliate_network_id, created, updated', 'safe', 'on'=>'search'),
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
			'retailer' => array(self::BELONGS_TO, 'Retailer', 'retailer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'retailer_id' => 'Retailer',
			'target_url' => 'Target Url',
			'code' => 'Code',
			'description' => 'Description',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'enabled' => 'Enabled',
			'external_id' => 'External',
			'affiliate_network_id' => 'Affiliate Network',
			'created' => 'Created',
			'updated' => 'Updated',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('retailer_id',$this->retailer_id);
		$criteria->compare('target_url',$this->target_url,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('enabled',$this->enabled);
		$criteria->compare('external_id',$this->external_id,true);
		$criteria->compare('affiliate_network_id',$this->affiliate_network_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AffiliateCoupon the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
