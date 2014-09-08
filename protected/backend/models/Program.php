<?php

/**
 * This is the model class for table "program".
 *
 * The followings are the available columns in table 'program':
 * @property integer $id
 * @property string $name
 * @property integer $colourbox_id_1
 * @property string $bgcolor_1
 * @property integer $colourbox_id_2
 * @property string $bgcolor_2
 * @property integer $colourbox_id_3
 * @property string $bgcolor_3
 * @property integer $colourbox_id_4
 * @property string $bgcolor_4
 * @property string $contact_email
 * @property double $card_cost
 * @property string $deleted
 * @property string $created
 * @property integer $created_by
 * @property string $modified
 * @property integer $modified_by
 *
 * The followings are the available model relations:
 * @property Colourbox $colourboxId1
 * @property Colourbox $colourboxId2
 * @property Colourbox $colourboxId3
 * @property Colourbox $colourboxId4
 */
class Program extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'program';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, contact_email, card_cost', 'required'),
            array('colourbox_id_1, colourbox_id_2, colourbox_id_3, colourbox_id_4, created_by, modified_by', 'numerical', 'integerOnly' => true),
            array('card_cost', 'numerical'),
            array('contact_email', 'email'),
            array('name', 'length', 'max' => 64),
            array('bgcolor_1, bgcolor_2, bgcolor_3, bgcolor_4', 'length', 'max' => 10),
            array('contact_email', 'length', 'max' => 128),
            array('deleted, created, modified', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, colourbox_id_1, bgcolor_1, colourbox_id_2, bgcolor_2, colourbox_id_3, bgcolor_3, colourbox_id_4, bgcolor_4, contact_email, card_cost, deleted, created, created_by, modified, modified_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'colourboxId1' => array(self::BELONGS_TO, 'PromoBox', 'colourbox_id_1'),
            'colourboxId2' => array(self::BELONGS_TO, 'PromoBox', 'colourbox_id_2'),
            'colourboxId3' => array(self::BELONGS_TO, 'PromoBox', 'colourbox_id_3'),
            'colourboxId4' => array(self::BELONGS_TO, 'PromoBox', 'colourbox_id_4'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'colourbox_id_1' => 'Colourbox Id 1',
            'bgcolor_1' => 'Bgcolor 1',
            'colourbox_id_2' => 'Colourbox Id 2',
            'bgcolor_2' => 'Bgcolor 2',
            'colourbox_id_3' => 'Colourbox Id 3',
            'bgcolor_3' => 'Bgcolor 3',
            'colourbox_id_4' => 'Colourbox Id 4',
            'bgcolor_4' => 'Bgcolor 4',
            'contact_email' => 'Contact Email',
            'card_cost' => 'Card Cost',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('colourbox_id_1', $this->colourbox_id_1);
        $criteria->compare('bgcolor_1', $this->bgcolor_1, true);
        $criteria->compare('colourbox_id_2', $this->colourbox_id_2);
        $criteria->compare('bgcolor_2', $this->bgcolor_2, true);
        $criteria->compare('colourbox_id_3', $this->colourbox_id_3);
        $criteria->compare('bgcolor_3', $this->bgcolor_3, true);
        $criteria->compare('colourbox_id_4', $this->colourbox_id_4);
        $criteria->compare('bgcolor_4', $this->bgcolor_4, true);
        $criteria->compare('contact_email', $this->contact_email, true);
        $criteria->compare('card_cost', $this->card_cost);
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
     * @return Program the static model class
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
