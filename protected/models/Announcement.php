<?php

/**
 * This is the model class for table "announcement".
 *
 * The followings are the available columns in table 'announcement':
 * @property string $announcement_id
 * @property string $message
 * @property string $posted_by
 * @property string $defined_class
 * @property string $posted_date_time
 */
class Announcement extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Announcement the static model class
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
		return 'announcement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('announcement_id, message, posted_by, defined_class, posted_date_time', 'required'),
			array('announcement_id, posted_by, defined_class', 'length', 'max'=>16),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('announcement_id, message, posted_by, defined_class, posted_date_time', 'safe', 'on'=>'search'),
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
			'announcement_id' => 'Announcement',
			'message' => 'Message',
			'posted_by' => 'Posted By',
			'defined_class' => 'Defined Class',
			'posted_date_time' => 'Posted Date Time',
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

		$criteria->compare('announcement_id',$this->announcement_id,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('posted_by',$this->posted_by,true);
		$criteria->compare('defined_class',$this->defined_class,true);
		$criteria->compare('posted_date_time',$this->posted_date_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}