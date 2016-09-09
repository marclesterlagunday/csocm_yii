<?php

/**
 * This is the model class for table "lectures".
 *
 * The followings are the available columns in table 'lectures':
 * @property integer $lecture_id
 * @property string $title
 * @property string $description
 * @property string $filename
 * @property string $saved_date
 * @property integer $saved_by
 */
class Lecture extends CActiveRecord
{
	public $class;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Lecture the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lectures';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, description, filename', 'required'),
			array('saved_by', 'numerical', 'integerOnly'=>true),
			array('title, description, filename', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('lecture_id, title, description, filename, saved_date, saved_by', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'lecture_id' => 'Lecture',
			'title' => 'Title',
			'description' => 'Description',
			'filename' => 'File',
			'saved_date' => 'Saved Date',
			'saved_by' => 'Saved By',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('lecture_id',$this->lecture_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('saved_date',$this->saved_date,true);
		$criteria->compare('saved_by',$this->saved_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}