<?php

/**
 * This is the model class for table "class_student".
 *
 * The followings are the available columns in table 'class_student':
 * @property integer $class_student_id
 * @property integer $class
 * @property integer $student
 */
class ClassStudent extends CActiveRecord
{
	public $instructor;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ClassStudent the static model class
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
		return 'class_student';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('class, student', 'required'),
			array('class, student', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('class_student_id, class, student, instructor', 'safe', 'on'=>'search'),
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
			'Classes'=>array(self::HAS_ONE, 'Classes', array( 'class_id' => 'class' )),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'class_student_id' => 'Class Student',
			'class' => 'Class',
			'student' => 'Student',
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

		$criteria->compare('class_student_id',$this->class_student_id);
		$criteria->compare('class',$this->class);
		$criteria->compare('student',$this->student);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function myClass()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->alias = 'ClassStudent';
		$criteria->with[] = 'Classes';
	        $criteria->together = true;

		if($this->student != '')
		{
			$criteria->addCondition('ClassStudent.student = "' . $this->student . '"');
		}
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}