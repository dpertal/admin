<?php

/**
 * This is the model class for table "retailer_category".
 *
 * The followings are the available columns in table 'retailer_category':
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property string $keywords
 * @property integer $active
 * @property string $created
 * @property integer $created_by
 * @property string $modified
 * @property integer $modified_by
 *
 * The followings are the available model relations:
 * @property RetailerCategory $parent
 * @property RetailerCategory[] $retailerCategories
 */
class RetailerCategory extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'retailer_category';
    }

    public function behaviors() {
        return array(
            'AuditBehavior' => array(
                'class' => 'AuditBehavior'
            )
        );
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'required'),
            array('parent_id, active, created_by, modified_by', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 64),
            array('created, modified', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, parent_id,keywords, active, created, created_by, modified, modified_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'parent' => array(self::BELONGS_TO, 'RetailerCategory', 'parent_id'),
            'retailerCategories' => array(self::HAS_MANY, 'RetailerCategory', 'parent_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'parent_id' => 'Parent',
            'keywords' => 'Keywords',
            'active' => 'Active',
            'created' => 'Created',
            'created_by' => 'Created By',
            'modified' => 'Modified',
            'modified_by' => 'Modified By',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('keywords', $this->keywords, true);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('active', $this->active);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('modified_by', $this->modified_by);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return RetailerCategory the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
