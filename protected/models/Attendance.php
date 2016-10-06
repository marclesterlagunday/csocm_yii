<?php

/**
 * This is the model class for table "attendance".
 *
 * The followings are the available columns in table 'attendance':
 * @property integer $attendance_id
 * @property string $date
 * @property integer $class
 * @property integer $saved_by
 * @property string $saved_date
 * @property integer $status
 */
class Attendance extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Attendance the static model class
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
		return 'attendance';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date, class', 'required'),
			array('class, saved_by, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('attendance_id, date, class, saved_by, saved_date, status', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'attendance_id' => 'Attendance',
			'date' => 'Date',
			'class' => 'Class',
			'saved_by' => 'Saved By',
			'saved_date' => 'Saved Date',
			'status' => 'Status',
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

		$criteria->compare('attendance_id',$this->attendance_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('class',$this->class);
		$criteria->compare('saved_by',$this->saved_by);
		$criteria->compare('saved_date',$this->saved_date,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave() {

        if(parent::beforeSave()) {
            if(($this->isNewRecord)) {
            	$this->saved_by = Yii::app()->user->id;
                $this->saved_date = date('Y-m-d H:i:s');
            }
            return true;
        } else 
            return false;
    }
}