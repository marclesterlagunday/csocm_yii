<?php

class UserController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
		return array(
			array('allow', 
				'actions'=>array(
					'student',
					'savestudent',
					'instructor',
					'saveinstructor',
                ),
				'roles'=>array('Admin'),
			),
			
			array('deny',  // deny all other users
				'users'=>array('*'),
			),
		);
	}

	public function actionStudent()
	{
		$vm = (object) array();
		$vm->user = new User('search');
		$vm->user_course = new UserCourse('search');

		$this->render('student',array(
			'vm'=>$vm,
		));
	}

	public function actionSaveStudent()
	{
		$retVal = "error";
		$retMessage = "Error";

		$user = new User('search');
		$user_course = new UserCourse('search');

		if(isset($_POST['User']) && isset($_POST['UserCourse']))
		{
			$user->attributes = $_POST['User'];
			$user_course->attributes = $_POST['UserCourse'];

			if(trim($user->username) != '' && trim($user->password) != '' && trim($user->firstname) != '' && trim($user->middlename) != '' && trim($user->surname) != '' && trim($user->age) >= 0 && trim($user->gender) != '' && trim($user->contact_no) != '' && trim($user_course->course) != '' && trim($user_course->sy) != '')
			{
				$findUser = User::model()->findByAttributes(array('username' => $user->username));

				if(!isset($findUser))
				{
					if($user->save())
					{
						$user_course->user = $user->id;

						if($user_course->save())
						{
							$authassignment = new Authassignment();
							$authassignment->userid = $user->id;
							$authassignment->itemname = "Student";

							if($authassignment->save())
							{
								$retVal = "success";
								$retMessage = "Student Saved";	
							}
							else
							{
								$retMessage = "Unable To Save Authassignment";
							}
							
						}
						else
						{
							$retMessage = "Unable To Save User Course";
						}
					}
					else
					{
						$retMessage = "Unable To Save User";
					}
				}
				else
				{
					$retMessage = "Username Already Exist";
				}
			}
			else
			{
				$retMessage = "Please Fill Up Required Fields";
			}
		}

		$this->renderPartial('/json/json_ret', 
        array(
            'retVal' => $retVal,
            'retMessage' => $retMessage,
        ));
	}

	public function actionInstructor()
	{
		$vm = (object) array();
		$vm->user = new User('search');

		$this->render('instructor',array(
			'vm'=>$vm,
		));
	}

	public function actionSaveInstructor()
	{
		$retVal = "error";
		$retMessage = "Error";

		$user = new User('search');

		if(isset($_POST['User']))
		{
			$user->attributes = $_POST['User'];

			if(trim($user->username) != '' && trim($user->password) != '' && trim($user->firstname) != '' && trim($user->middlename) != '' && trim($user->surname) != '' && trim($user->age) >= 0 && trim($user->gender) != '' && trim($user->contact_no) != '')
			{
				$findUser = User::model()->findByAttributes(array('username' => $user->username));

				if(!isset($findUser))
				{
					if($user->save())
					{
						$authassignment = new Authassignment();
						$authassignment->userid = $user->id;
						$authassignment->itemname = "Instructor";

						if($authassignment->save())
						{
							$retVal = "success";
							$retMessage = "Instructor Saved";	
						}
						else
						{
							$retMessage = "Unable To Save Authassignment";
						}
					}
					else
					{
						$retMessage = "Unable To Save User";
					}
				}
				else
				{
					$retMessage = "Username Already Exist";
				}
			}
			else
			{
				$retMessage = "Please Fill Up Required Fields";
			}
		}

		$this->renderPartial('/json/json_ret', 
        array(
            'retVal' => $retVal,
            'retMessage' => $retMessage,
        ));
	}
}