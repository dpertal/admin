<?php

/**
 * This is the model class for table "code".
 *
 * The followings are the available columns in table 'code':
 * @property integer $id
 * @property integer $codeTypeId
 * @property string $name
 *
 * The followings are the available model relations:
 * @property User[] $users
 */
class Code extends CActiveRecord
{
	private static $codes=array();
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'code';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codeTypeId', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, codeTypeId, name', 'safe', 'on'=>'search'),
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
				'users' => array(self::HAS_MANY, 'User', 'trad_category'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'codeTypeId' => 'Code Type',
			'name' => 'Name',
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
		$criteria->compare('codeTypeId',$this->codeTypeId);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Code the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function loadCodes($role=array())
	{
		self::$codes=array();
		$models=self::model()->findAll($role, array('orderby'=>'name'));
		self::$codes[""]="Please Select";
		foreach($models as $model)
			self::$codes[$model->id]=$model->name;
	
		return self::$codes;
	}
	
	public static function getStatusName($role=array())
	{
		
		$models=self::model()->findAll($role);
		
		foreach($models as $model)
			return $model->name;
	
		
	}
}
