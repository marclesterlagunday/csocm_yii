<?php

/**
 * This is the model class for table "announcement".
 *
 * The followings are the available columns in table 'announcement':
 * @property integer $announcement_id
 * @property string $title
 * @property string $message
 * @property integer $posted_by
 * @property integer $defined_class
 * @property string $posted_date_time
 */
class Announcement extends CActiveRecord
{
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
			array('title, message', 'required'),
			array('posted_by, defined_class', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('announcement_id, title, message, posted_by, defined_class, posted_date_time', 'safe', 'on'=>'search'),
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
			'User'=>array(self::HAS_ONE, 'User', array( 'id' => 'posted_by' )),
			'Classes'=>array(self::HAS_ONE, 'Classes', array( 'class_id' => 'defined_class' )),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'announcement_id' => 'Announcement',
			'title' => 'Title',
			'message' => 'Message',
			'posted_by' => 'Posted By',
			'defined_class' => 'Defined Class',
			'posted_date_time' => 'Posted Date Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('announcement_id',$this->announcement_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('posted_by',$this->posted_by);
		$criteria->compare('defined_class',$this->defined_class);
		$criteria->compare('posted_date_time',$this->posted_date_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Announcement the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeSave() {
        if(parent::beforeSave()) {
            if(($this->isNewRecord)) {
            	$this->posted_by = Yii::app()->user->id;
                $this->posted_date_time = date('Y-m-d H:i:s');
            }
            return true;
        } else 
            return false;
    }
}
