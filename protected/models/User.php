<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $profile_pic
 * @property string $firstname
 * @property string $middlename
 * @property string $surname
 * @property string $age
 * @property string $gender
 * @property string $contact_no
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email, firstname, middlename, surname, age, gender, contact_no', 'required'),
			array('', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>36),
			array('username, password, email', 'length', 'max'=>128),
			array('firstname, surname', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email, profile_pic, firstname, surname', 'safe', 'on'=>'search'),
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
			'Authassignment'=>array(self::HAS_ONE, 'Authassignment', array( 'userid' => 'id' )),
			'Gender'=>array(self::HAS_ONE, 'Gender', array( 'gender_id' => 'gender' )),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'User',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'profile_pic' => 'Profile Pic',
			'firstname' => 'First Name',
			'middlename' => 'Middle Name',
			'surname' => 'Last Name',
			'age' => 'Age',
			'gender' => 'Gender',
			'contact_no' => 'Contact No',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('profile_pic',$this->profile_pic,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('surname',$this->surname,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function student()
	{
		$criteria=new CDbCriteria;

		$criteria->alias = 'User';
		$criteria->with[] = 'Authassignment';
		$criteria->together = true;

		$criteria->addCondition( "Authassignment.itemname = 'Student'" );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function instructor()
	{
		$criteria=new CDbCriteria;

		$criteria->alias = 'User';
		$criteria->with[] = 'Authassignment';
		$criteria->together = true;

		$criteria->addCondition( "Authassignment.itemname = 'Instructor'" );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function validatePassword($password) {
        return CPasswordHelper::verifyPassword($password,$this->password);
    }
    
    public function hashPassword($password) {
        return CPasswordHelper::hashPassword($password);
    }
    
    public function beforeSave() {
        if(parent::beforeSave()) {
            if(($this->isNewRecord) || isset($this->password)) {
                $newPassword = $this->hashPassword( $this->password );
                $this->password = $newPassword;
            }
            return true;
        } else 
            return false;
    }  
}