<?php

/**
 * This is the model class for table "class_standings".
 *
 * The followings are the available columns in table 'class_standings':
 * @property integer $id
 * @property integer $class
 * @property integer $student
 * @property integer $type
 * @property integer $Grade
 */
class ClassStandings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ClassStandings the static model class
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
		return 'class_standings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('class, student, type, Grade', 'required'),
			array('class, student, type, Grade', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, class, student, type, Grade', 'safe', 'on'=>'search'),
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
			'ClassStandingType'=>array(self::HAS_ONE, 'ClassStandingType', array( 'id' => 'type' )),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'class' => 'Class',
			'student' => 'Student',
			'type' => 'Type',
			'Grade' => 'Grade',
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

		// $criteria->compare('id',$this->id);
		$criteria->compare('class',$this->class);
		$criteria->compare('student',$this->student);
		// $criteria->compare('type',$this->type);
		// $criteria->compare('Grade',$this->Grade);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}