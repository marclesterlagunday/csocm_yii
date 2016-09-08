<?php

/**
 * This is the model class for table "classes".
 *
 * The followings are the available columns in table 'classes':
 * @property integer $class_id
 * @property integer $subject
 * @property integer $room
 * @property integer $sy
 * @property integer $semester
 * @property integer $instructor
 * @property string $time_start
 * @property string $time_end
 * @property string $date_created
 * @property string $date_ended
 * @property integer $created_by
 */
class Classes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Classes the static model class
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
		return 'classes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subject, room, sy, instructor, time_start, time_end', 'required'),
			array('subject, room, sy, semester, instructor, created_by', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('class_id, subject, room, sy, semester, instructor, time_start, time_end, date_created, date_ended, created_by', 'safe', 'on'=>'search'),
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
			'Subject'=>array(self::HAS_ONE, 'Subject', array( 'id' => 'subject' )),
			'Room'=>array(self::HAS_ONE, 'Room', array( 'id' => 'room' )),
			'Instructor'=>array(self::HAS_ONE, 'User', array( 'id' => 'instructor' )),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'class_id' => 'Class',
			'subject' => 'Subject',
			'room' => 'Room',
			'sy' => 'Sy',
			'semester' => 'Semester',
			'instructor' => 'Instructor',
			'time_start' => 'Time Start',
			'time_end' => 'Time End',
			'date_created' => 'Date Created',
			'date_ended' => 'Date Ended',
			'created_by' => 'Created By',
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

		$criteria->compare('class_id',$this->class_id);
		$criteria->compare('subject',$this->subject);
		$criteria->compare('room',$this->room);
		$criteria->compare('sy',$this->sy);
		$criteria->compare('semester',$this->semester);
		$criteria->compare('instructor',$this->instructor);
		$criteria->compare('time_start',$this->time_start,true);
		$criteria->compare('time_end',$this->time_end,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_ended',$this->date_ended,true);
		$criteria->compare('created_by',$this->created_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave() {
        if(parent::beforeSave()) {
            if(($this->isNewRecord)) {
            	$this->created_by = Yii::app()->user->id;
                $this->date_created = date('Y-m-d H:i:s');
            }
            return true;
        } else 
            return false;
    }
}
