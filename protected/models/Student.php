<?php

/**
 * This is the model class for table "students".
 *
 * The followings are the available columns in table 'students':
 * @property string $student_id
 * @property string $id_no
 * @property string $first_name
 * @property string $last_name
 * @property integer $course
 * @property integer $year
 * @property integer $cellphone
 */
class Student extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Student the static model class
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
		return 'students';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('student_id, id_no, first_name, last_name, course, year, cellphone', 'required'),
			array('course, year, cellphone', 'numerical', 'integerOnly'=>true),
			array('student_id', 'length', 'max'=>16),
			array('id_no, first_name, last_name', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('student_id, id_no, first_name, last_name, course, year, cellphone', 'safe', 'on'=>'search'),
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
			'student_id' => 'Student',
			'id_no' => 'Id No',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'course' => 'Course',
			'year' => 'Year',
			'cellphone' => 'Cellphone',
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

		$criteria->compare('student_id',$this->student_id,true);
		$criteria->compare('id_no',$this->id_no,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('course',$this->course);
		$criteria->compare('year',$this->year);
		$criteria->compare('cellphone',$this->cellphone);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}