<?php

/**
 * This is the model class for table "class_lecture".
 *
 * The followings are the available columns in table 'class_lecture':
 * @property integer $class_lecture_id
 * @property integer $class
 * @property integer $lecture
 */
class ClassLecture extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ClassLecture the static model class
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
		return 'class_lecture';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('class, lecture', 'required'),
			array('class, lecture', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('class_lecture_id, class, lecture', 'safe', 'on'=>'search'),
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
			'Lecture'=>array(self::HAS_ONE, 'Lecture', array( 'lecture_id' => 'lecture' )),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'class_lecture_id' => 'Class Lecture',
			'class' => 'Class',
			'lecture' => 'Lecture',
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

		$criteria->compare('class_lecture_id',$this->class_lecture_id);
		$criteria->compare('class',$this->class);
		$criteria->compare('lecture',$this->lecture);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}