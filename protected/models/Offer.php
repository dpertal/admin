<?php

/**
 * This is the model class for table "offer".
 *
 * The followings are the available columns in table 'offer':
 * @property integer $id
 * @property integer $retailer_id
 * @property integer $offer_type_id
 * @property string $title
 * @property string $summary
 * @property string $body
 * @property integer $current
 * @property string $start_date
 * @property string $end_date
 * @property string $modified
 * @property integer $modify_by
 * @property integer $is_featured
 * @property integer $is_home_page
 * @property string $created
 * @property integer $created_by
 *
 * The followings are the available model relations:
 * @property OfferType $offerType
 * @property Retailer $retailer
 */
class Offer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'offer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('retailer_id, offer_type_id, current, modify_by, is_featured, is_home_page, created_by', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>140),
			array('summary', 'length', 'max'=>255),
			array('body, start_date, end_date, modified, created', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, retailer_id, offer_type_id, title, summary, body, current, start_date, end_date, modified, modify_by, is_featured, is_home_page, created, created_by', 'safe', 'on'=>'search'),
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
			'offerType' => array(self::BELONGS_TO, 'OfferType', 'offer_type_id'),
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
			'offer_type_id' => 'Offer Type',
			'title' => 'Title',
			'summary' => 'Summary',
			'body' => 'Body',
			'current' => 'Current',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'modified' => 'Modified',
			'modify_by' => 'Modify By',
			'is_featured' => 'Is Featured',
			'is_home_page' => 'Is Home Page',
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
	public function search_2()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('retailer_id',$this->retailer_id);
		$criteria->compare('offer_type_id',$this->offer_type_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('summary',$this->summary,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('current',$this->current);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('modify_by',$this->modify_by);
		$criteria->compare('is_featured',$this->is_featured);
		$criteria->compare('is_home_page',$this->is_home_page);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_by',$this->created_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
                $criteria->distinct=true;
                $criteria->select = 'retailer_id';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Offer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
