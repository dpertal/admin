<?php

/**
 * This is the model class for table "resource_permission".
 *
 * The followings are the available columns in table 'resource_permission':
 * @property integer $role_id
 * @property integer $resource_id
 * @property integer $permission
 * @property string $created
 * @property integer $created_by
 * @property string $modified
 * @property integer $modified_by
 * @property integer $active
 */
class ResourcePermission extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'resource_permission';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('role_id, resource_id', 'required'),
            array('role_id, resource_id, permission, created_by, modified_by, active', 'numerical', 'integerOnly' => true),
            array('created, modified', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('role_id, resource_id, permission, created, created_by, modified, modified_by, active', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'role_id' => 'Role',
            'resource_id' => 'Resource',
            'permission' => 'Permission',
            'created' => 'Created',
            'created_by' => 'Created By',
            'modified' => 'Modified',
            'modified_by' => 'Modified By',
            'active' => 'Active',
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

        $criteria->compare('role_id', $this->role_id);
        $criteria->compare('resource_id', $this->resource_id);
        $criteria->compare('permission', $this->permission);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('modified_by', $this->modified_by);
        $criteria->compare('active', $this->active);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ResourcePermission the static model class
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
