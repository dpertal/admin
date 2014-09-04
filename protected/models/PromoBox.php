<?php

/**
 * This is the model class for table "colourbox".
 *
 * The followings are the available columns in table 'colourbox':
 * @property string $id
 * @property integer $retailer_id
 * @property string $title
 * @property string $content
 * @property string $footer
 * @property string $url
 * @property string $deleted
 * @property string $created
 * @property integer $created_by
 * @property string $modified
 * @property integer $modified_by
 *
 * The followings are the available model relations:
 * @property Retailer $retailer
 */
class PromoBox extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'colourbox';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('retailer_id, created_by, modified_by', 'numerical', 'integerOnly' => true),
            array('title, footer', 'length', 'max' => 64),
            array('content', 'length', 'max' => 128),
            array('url', 'length', 'max' => 256),
            array('deleted, created, modified', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, retailer_id, title, content, footer, url, deleted, created, created_by, modified, modified_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'retailer' => array(self::BELONGS_TO, 'Retailer', 'retailer_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'retailer_id' => 'Retailer',
            'title' => 'Title',
            'content' => 'Content',
            'footer' => 'Footer',
            'url' => 'Url',
            'deleted' => 'Deleted',
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('retailer_id', $this->retailer_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('footer', $this->footer, true);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('deleted', $this->deleted, true);
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
     * @return PromoBox the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function behaviors() {
        return array(
            'AuditBehavior' => array(
                'class' => 'AuditBehavior'
            )
        );
    }

}
