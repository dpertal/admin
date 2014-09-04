<?php

/**
 * This is the model class for table "page_content".
 *
 * The followings are the available columns in table 'page_content':
 * @property integer $id
 * @property integer $page_id
 * @property integer $program_id
 * @property string $headline
 * @property string $tag_line
 * @property string $link_text
 * @property string $link_url
 * @property string $image_url
 * @property string $created
 * @property integer $created_by
 * @property string $modified
 * @property integer $modified_by
 * @property string $meta_title
 * @property string $meta_keyword
 * @property string $meta_description
 *
 * The followings are the available model relations:
 * @property Page $page
 * @property Program $program
 */
class PageContent extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'page_content';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('page_id, program_id', 'ECompositeUniqueValidator'),
			array('page_id, program_id, headline', 'required'),
			array('page_id, program_id, created_by, modified_by', 'numerical', 'integerOnly'=>true),
			array('headline, link_text, link_url', 'length', 'max'=>128),
			array('tag_line', 'length', 'max'=>256),
			array('image_url', 'length', 'max'=>255),
			array('created, modified, meta_title, meta_keyword, meta_description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, page_id, program_id, headline, tag_line, link_text, link_url, image_url, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
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
			'page' => array(self::BELONGS_TO, 'Page', 'page_id'),
			'program' => array(self::BELONGS_TO, 'Program', 'program_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'page_id' => 'Page',
			'program_id' => 'Program',
			'headline' => 'Headline',
			'tag_line' => 'Tag Line',
			'link_text' => 'Link Text',
			'link_url' => 'Link Url',
			'image_url' => 'Image Url',
			'created' => 'Created',
			'created_by' => 'Created By',
			'modified' => 'Modified',
			'modified_by' => 'Modified By',
            'meta_title'    => 'Meta title',
            'meta_keyword'  => 'Meta keywork',
            'meta_description'  => 'Meta description'
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
		$criteria->compare('page_id',$this->page_id);
		$criteria->compare('program_id',$this->program_id);
		$criteria->compare('headline',$this->headline,true);
		$criteria->compare('tag_line',$this->tag_line,true);
		$criteria->compare('link_text',$this->link_text,true);
		$criteria->compare('link_url',$this->link_url,true);
		$criteria->compare('image_url',$this->image_url,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('modified_by',$this->modified_by);
		$criteria->compare('meta_title',$this->meta_title);
		$criteria->compare('meta_keyword',$this->meta_keyword);
		$criteria->compare('meta_description',$this->meta_description);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PageContent the static model class
	 */
	public static function model($className=__CLASS__)
	{
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
