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
					'studentform',
					'savestudent',
					'viewstudent',
					'instructor',
					'saveinstructor',
					'viewinstructor',
					'view',
					'profile',
					'EditStudent',
					'ViewEditStudent',
                ),
				'roles'=>array('Admin'),
			),		
			array('allow', 
				'actions'=>array(

					'view',
					'profile',
					'EditStudent',
                ),
				'roles'=>array('Student'),
			),	
			array('allow', 
				'actions'=>array(

					'view',
					'profile',
					'EditStudent',
                ),
				'roles'=>array('Instructor'),
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
		
		
		$datetime2 = new DateTime();
		$user = new User('search');
		$user_course = new UserCourse('search');

		if(isset($_POST['User']))
		{
			$user->attributes = $_POST['User'];
			$user_course->attributes = $_POST['UserCourse'];

			if(trim($user->username) != '' && trim($user->password) != '' && trim($user->firstname) != '' && trim($user->middlename) != '' && trim($user->surname) != '' && trim($user->birthday) >= 0 && trim($user->gender) != '' && trim($user->contact_no) != '' && trim($user_course->course) != '')
			{
				$findUser = User::model()->findByAttributes(array('username' => $user->username));

				if(!isset($findUser))
				{
					if($user->password == $user->checkpassword)
					{	$datetime1 = new DateTime($user->birthday);
						$diff = $datetime1->diff($datetime2);
						$user->age = $diff->y;
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
						$retMessage = "Password does not match";
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
	public function actionEditStudent()
	{
		$retVal = "error";
		$retMessage = "Error";

		$user = new User('search');
		$user_course = new UserCourse('search');

		if(isset($_POST['User']))
		{
			$user->attributes = $_POST['User'];
			// $user_course->attributes = $_POST['UserCourse'];

			if(trim($user->username) != '' && trim($user->password) != '' && trim($user->firstname) != '' && trim($user->middlename) != '' && trim($user->surname) != '' && trim($user->age) >= 0 && trim($user->gender) != '' && trim($user->contact_no) != '' )
			{
				$findUser = User::model()->findByAttributes(array('username' => $user->username));
				
				$findUser->attributes =$user->attributes;

					if($findUser->save())
					{
								$retVal = "success";
								$retMessage = "User Saved";	
							
			

					}
					else
					{
						$retMessage = "Unable To Save User";
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

	public function actionSaveinstructor()
	{
		$retVal = "error";
		$retMessage = "Error";

		$datetime2 = new DateTime();
		$user = new User('search');

		if(isset($_POST['User']))
		{
			$user->attributes = $_POST['User'];

			if(trim($user->username) != '' && trim($user->password) != '' && trim($user->password) != '' && trim($user->firstname) != '' && trim($user->middlename) != '' && trim($user->surname) != '' && trim($user->birthday) >= 0 && trim($user->gender) != '' && trim($user->contact_no) != '')
			{
				$findUser = User::model()->findByAttributes(array('username' => $user->username));

				if(!isset($findUser))
				{
					if($user->password == $user->checkpassword)
					{
						$datetime1 = new DateTime($user->birthday);
						$diff = $datetime1->diff($datetime2);
						$user->age = $diff->y;
						
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
						$retMessage = "Password does not match";
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

	public function actionViewStudent()
	{
		$retVal = "error";
		$retMessage = "Error";

		$vm = (object) array();
		$vm->user = new User('search');
		$vm->user_course = new UserCourse('search');

		if(isset($_POST['student']))
		{
			$id = $_POST['student'];
			$findUser = User::model()->findByPk($id);

			if(isset($findUser))
			{
				$vm->user = $findUser;

				$findCourse = UserCourse::model()->findByAttributes(array('user'=>$vm->user->id));

				if(isset($findCourse))
				{
					$vm->user_course = $findCourse;
				}

				$view = $this->renderPartial('_view_student', array(
							'vm'=>$vm,
						), true, true);

				$retVal = "success";
				$retMessage = $view;
			}
		}

		$this->renderPartial('/json/json_ret', 
        array(
            'retVal' => $retVal,
            'retMessage' => $retMessage,
        ));
	}

	public function actionViewEditStudent()
	{
		$retVal = "error";
		$retMessage = "Error";

		$vm = (object) array();
		$vm->user = new User('search');
		$vm->user_course = new UserCourse('search');

		if(isset($_POST['student']))
		{
			$id = $_POST['student'];
			$findUser = User::model()->findByPk($id);

			if(isset($findUser))
			{
				$vm->user = $findUser;

				$findCourse = UserCourse::model()->findByAttributes(array('user'=>$vm->user->id));

				if(isset($findCourse))
				{
					$vm->user_course = $findCourse;
				}

				$view = $this->renderPartial('_student_form_edit', array(
							'vm'=>$vm,
						), true, true);

				$retVal = "success";
				$retMessage = $view;
			}
		}

		$this->renderPartial('/json/json_ret', 
        array(
            'retVal' => $retVal,
            'retMessage' => $retMessage,
        ));
	}

	public function actionViewInstructor()
	{
		$retVal = "error";
		$retMessage = "Error";

		$vm = (object) array();
		$vm->user = new User('search');

		if(isset($_POST['instructor']))
		{
			$id = $_POST['instructor'];
			$findUser = User::model()->findByPk($id);

			if(isset($findUser))
			{
				$vm->user = $findUser;

				$view = $this->renderPartial('_view_instructor', array(
							'vm'=>$vm,
						), true, true);

				$retVal = "success";
				$retMessage = $view;
			}
		}

		$this->renderPartial('/json/json_ret', 
        array(
            'retVal' => $retVal,
            'retMessage' => $retMessage,
        ));
	}
	
	public function actionView($id)  //kevin edit
	{
		$retVal = "error";
		$retMessage = "Error";

		$vm = (object) array();
		$vm->user = new User('search');
		$vm->user_course = new UserCourse('search');

		if(isset($id))
		{

			$findUser = User::model()->findByPk($id);

			if(isset($findUser))
			{
				$vm->user = $findUser;

				$findCourse = UserCourse::model()->findByAttributes(array('user'=>$vm->user->id));

				if(isset($findCourse))
				{
					$vm->user_course = $findCourse;
				}
				$vm->user->password="";
				$this->render('profile', array(
							'vm'=>$vm,
						));

				// $retVal = "success";
				// $retMessage = $view;
			}
		}

		// $this->renderPartial('/json/json_ret', 
        // array(
            // 'retVal' => $retVal,
            // 'retMessage' => $retMessage,
        // ));
	}
	public function actionProfile(){          		//kevin edit
        $this->actionView(Yii::app()->user->id);
    }
	
	
}