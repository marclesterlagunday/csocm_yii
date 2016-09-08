<?php

/**
 * This is the model class for table "class_days".
 *
 * The followings are the available columns in table 'class_days':
 * @property integer $class_day_id
 * @property integer $class
 * @property integer $day
 */
class ClassDay extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ClassDay the static model class
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
		return 'class_days';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('class, day', 'required'),
			array('class, day', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('class_day_id, class, day', 'safe', 'on'=>'search'),
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
			'Classes'=>array(self::HAS_ONE, 'Classes', array( 'class_id' => 'class' )),
			'Day'=>array(self::HAS_ONE, 'Day', array( 'day_id' => 'day' )),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'class_day_id' => 'Class Day',
			'class' => 'Class',
			'day' => 'Day',
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

		$today = date('D');
		$getDay = Day::model()->findByAttributes(array('description' => $today));
		$this->day = $getDay->day_id;

		// $criteria->compare('class_day_id',$this->class_day_id);
		// $criteria->compare('class',$this->class);
		$criteria->compare('day',$this->day);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}