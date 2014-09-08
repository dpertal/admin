<?php
/**
 * This is the model class for table "banner".
 *
 * The followings are the available columns in table 'banner':
 * @property integer $id
 * @property integer $retailer_id
 * @property string $target_url
 * @property string $image_url
 * @property integer $banner_size_id
 * @property integer $external_id
 * @property integer $affiliate_network_id
 * @property integer $active
 * @property string $created
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property BannerSize $bannerSize
 * @property Retailer $retailer
 */
class Banner extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'banner';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('retailer_id, banner_size_id, external_id, affiliate_network_id, active', 'numerical', 'integerOnly'=>true),
			array('target_url, image_url', 'length', 'max'=>256),
			array('created, updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, retailer_id, target_url, image_url, banner_size_id, external_id, affiliate_network_id, active, created, updated', 'safe', 'on'=>'search'),
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
			'bannerSize' => array(self::BELONGS_TO, 'BannerSize', 'banner_size_id'),
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
			'image_url' => 'Image Url',
			'banner_size_id' => 'Banner Size',
			'external_id' => 'External',
			'affiliate_network_id' => 'Affiliate Network',
			'active' => 'Active',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('retailer_id',$this->retailer_id);
		$criteria->compare('target_url',$this->target_url,true);
		$criteria->compare('image_url',$this->image_url,true);
		$criteria->compare('banner_size_id',$this->banner_size_id);
		$criteria->compare('external_id',$this->external_id);
		$criteria->compare('affiliate_network_id',$this->affiliate_network_id);
		$criteria->compare('active',$this->active);
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
	 * @return Banner the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
