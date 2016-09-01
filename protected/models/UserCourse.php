<?php

/**
 * This is the model class for table "user_courses".
 *
 * The followings are the available columns in table 'user_courses':
 * @property integer $user_course_id
 * @property integer $user
 * @property integer $course
 * @property integer $sy
 */
class UserCourse extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserCourse the static model class
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
		return 'user_courses';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user, course, sy', 'required'),
			array('user, course, sy', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_course_id, user, course, sy', 'safe', 'on'=>'search'),
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
			'user_course_id' => 'User Course',
			'user' => 'User',
			'course' => 'Course',
			'sy' => 'SY',
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

		$criteria->compare('user_course_id',$this->user_course_id);
		$criteria->compare('user',$this->user);
		$criteria->compare('course',$this->course);
		$criteria->compare('sy',$this->sy);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}