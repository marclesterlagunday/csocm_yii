<?php

class MaintenanceController extends Controller
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
					'Course',
					'SaveCourse',
					'Subject',
					'SaveSubject',
					'SchoolYear',
					'SaveSchoolYear',
                ),
				'roles'=>array('Admin'),
			),
			
			array('deny',  // deny all other users
				'users'=>array('*'),
			),
		);
	}

	public function actionCourse()
	{
		$vm = (object) array();
		$vm->course = new Course('search');
		// $vm->user_course = new UserCourse('search');

		$this->render('course',array(
			'vm'=>$vm,
		));
	}	
	
	public function actionSaveCourse()
	{
		$vm = (object) array();
		$vm->course = new Course('search');
		
		$retVal = "error";
		$retMessage = "Error";
		
		if(isset($_POST['Course']))
		{
			$vm->course->attributes = $_POST['Course'];
			
			if(trim($vm->course->description) != '')
			{
				$findCourse = Course::model()->findByAttributes(array('description' => $vm->course->description));
				if(!isset($findCourse))
				{
					if($vm->course->save())
					{
						$retVal = "success";
						$retMessage = "Course Saved";	
					}
					else
					{
						$retMessage = "Unable To Save Course";
					}
				}
				else
				{
					$retMessage = "Course Already Exist";
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
	
	public function actionSubject()
	{
		$vm = (object) array();
		$vm->subject = new Subject('search');
		// $vm->user_course = new UserCourse('search');

		$this->render('subject',array(
			'vm'=>$vm,
		));
	}
	
	public function actionSaveSubject()
	{
		$vm = (object) array();
		$vm->subject = new subject('search');
		
		$retVal = "error";
		$retMessage = "Error";
		
		if(isset($_POST['Subject']))
		{
			$vm->subject->attributes = $_POST['Subject'];
			
			if(trim($vm->subject->description) != '')
			{
				$findSubject = Subject::model()->findByAttributes(array('description' => $vm->subject->description));
				if(!isset($findSubject))
				{
					if($vm->subject->save())
					{
						$retVal = "success";
						$retMessage = "subject Saved";	
					}
					else
					{
						$retMessage = "Unable To Save subject";
					}
				}
				else
				{
					$retMessage = "subject Already Exist";
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
	
	public function actionSchoolYear()
	{
		$vm = (object) array();
		$vm->schoolyear = new SchoolYear('search');
		// $vm->user_course = new UserCourse('search');

		$this->render('schoolyear',array(
			'vm'=>$vm,
		));
	}
	
	public function actionSaveSchoolYear()
	{
		$vm = (object) array();
		$vm->schoolyear = new schoolyear('search');
		
		$retVal = "error";
		$retMessage = "Error";
		
		if(isset($_POST['SchoolYear']))
		{
			$vm->schoolyear->attributes = $_POST['SchoolYear'];
			
			if(trim($vm->schoolyear->description) != '')
			{
				$findSubject = SchoolYear::model()->findByAttributes(array('description' => $vm->schoolyear->description));
				if(!isset($findSubject))
				{
					if($vm->schoolyear->save())
					{
						$retVal = "success";
						$retMessage = "School Year Saved";	
					}
					else
					{
						$retMessage = "Unable To Save School Year";
					}
				}
				else
				{
					$retMessage = "School Year Already Exist";
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