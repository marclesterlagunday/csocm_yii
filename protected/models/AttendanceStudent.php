<?php

/**
 * This is the model class for table "attendance_student".
 *
 * The followings are the available columns in table 'attendance_student':
 * @property integer $attendance_student_id
 * @property integer $attendance
 * @property integer $student
 * @property integer $present
 */
class AttendanceStudent extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AttendanceStudent the static model class
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
		return 'attendance_student';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('', 'required'),
			array('attendance, student, present', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('attendance_student_id, attendance, student, present', 'safe', 'on'=>'search'),
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
			'Student'=>array(self::HAS_ONE, 'User', array( 'id' => 'student' )),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'attendance_student_id' => 'Attendance Student',
			'attendance' => 'Attendance',
			'student' => 'Student',
			'present' => 'Present',
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

		$criteria->compare('attendance_student_id',$this->attendance_student_id);
		$criteria->compare('attendance',$this->attendance);
		$criteria->compare('student',$this->student);
		$criteria->compare('present',$this->present);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}