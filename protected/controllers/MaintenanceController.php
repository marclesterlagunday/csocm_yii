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
					'Rooms',
					'SaveRoom',
					'ViewCourse',
					'EditCourse',
					'ViewDCourse',
					'deletecourse',		
					'ViewRoom',
					'Editroom',
					'ViewDroom',
					'deleteroom',
					'ViewSchoolYear',
					'EditSchoolYear',
					'ViewDSchoolYear',
					'deleteSchoolYear',
					'Viewsubject',
					'Editsubject',
					'ViewDsubject',
					'deletesubject',
                ),
				'roles'=>array('Admin'),
			),
			
			array('deny',  // deny all other users
				'users'=>array('*'),
			),
		);
	}
	//course controller
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
	
	public function actionViewCourse()
	{
		$retVal = "error";
		$retMessage = "Error";

		$vm = (object) array();
		$vm->course = new Course('search');

		if(isset($_POST['course']))
		{
			$id = $_POST['course'];
			$findCourse = Course::model()->findByPk($id);

			if(isset($findCourse))
			{
				$vm->course = $findCourse;

				$view = $this->renderPartial('_course_form_edit', array(
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
	
	
	public function actionViewDCourse()
	{
		$retVal = "error";
		$retMessage = "Error";

		$vm = (object) array();
		$vm->course = new Course('search');

		if(isset($_POST['course']))
		{
			$id = $_POST['course'];
			$findCourse = Course::model()->findByPk($id);

			if(isset($findCourse))
			{
				$vm->course = $findCourse;

				$view = $this->renderPartial('_course_form_delete', array(
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
	
	public function actionEditCourse()
	{
		$vm = (object) array();
		
		$vm->course = new Course('search');
		
		$retVal = "error";
		$retMessage = "Error";
		
		if(isset($_POST['Course']))
		{
			$vm->course->attributes = $_POST['Course'];
			$vm->editcourse =  Course::model()->findByAttributes(array('course_id' => $vm->course->course_id));
			
			
			
			
			if(trim($vm->course->description) != '')
			{
				$findCourse = Course::model()->findByAttributes(array('description' => $vm->course->description));
				if(!isset($findCourse))
				{
					$vm->editcourse->description = $vm->course->description;
					
					if($vm->editcourse->save())
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
	
		public function actiondeleteCourse()
	{
		$vm = (object) array();
		
		$vm->course = new Course('search');
		
		$retVal = "error";
		$retMessage = "Error";
		
		if(isset($_POST['Course']))
		{
			$vm->course->attributes = $_POST['Course'];
			$vm->editcourse =  Course::model()->findByAttributes(array('course_id' => $vm->course->course_id));
			
				if($vm->editcourse->delete())
				{
					$retVal = "success";
					$retMessage = "Course Deleted";	
				}
				else
				{
					$retMessage = "Unable To Delete Course";
				}

		}
		$this->renderPartial('/json/json_ret', 
			array(
				'retVal' => $retVal,
				'retMessage' => $retMessage,
			));
	}
	
	
	// subject controller
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
	
	
	public function actionViewSubject()
	{
		$retVal = "error";
		$retMessage = "Error";

		$vm = (object) array();
		$vm->subject = new Subject('search');

		if(isset($_POST['subject']))
		{
			$id = $_POST['subject'];
			$findsubject = Subject::model()->findByPk($id);

			if(isset($findsubject))
			{
				$vm->subject = $findsubject;

				$view = $this->renderPartial('_subject_form_edit', array(
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
	
	public function actionViewDSubject()
	{
		$retVal = "error";
		$retMessage = "Error";

		$vm = (object) array();
		$vm->subject = new Subject('search');

		if(isset($_POST['subject']))
		{
			$id = $_POST['subject'];
			$findsubject = Subject::model()->findByPk($id);

			if(isset($findsubject))
			{
				$vm->subject = $findsubject;

				$view = $this->renderPartial('_subject_form_delete', array(
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
	
	public function actionEditSubject()
	{
		$vm = (object) array();
		
		$vm->subject = new Subject('search');
		
		$retVal = "error";
		$retMessage = "Error";
		
		if(isset($_POST['Subject']))
		{
			$vm->subject->attributes = $_POST['Subject'];
			$vm->editsubject =  Subject::model()->findByAttributes(array('id' => $vm->subject->id));
			
			
			
			
			if(trim($vm->subject->description) != '')
			{
				$findsubject = Subject::model()->findByAttributes(array('description' => $vm->subject->description));
				if(!isset($findsubject))
				{
					$vm->editsubject->description = $vm->subject->description;
					
					if($vm->editsubject->save())
					{
						$retVal = "success";
						$retMessage = "Subject Saved";	
					}
					else
					{
						$retMessage = "Unable To Save Subject";
					}
				}
				else
				{
					$retMessage = "Subject Already Exist";
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
	
	public function actionDeleteSubject()
	{
		$vm = (object) array();
		
		$vm->subject = new Subject('search');
		
		$retVal = "error";
		$retMessage = "Error";
		
		if(isset($_POST['Subject']))
		{
			$vm->subject->attributes = $_POST['Subject'];
			$vm->editsubject = Subject::model()->findByAttributes(array('id' => $vm->subject->id));
			
				if($vm->editsubject->delete())
				{
					$retVal = "success";
					$retMessage = "Subject Deleted";	
				}
				else
				{
					$retMessage = "Unable To Delete subject";
				}

		}
		$this->renderPartial('/json/json_ret', 
			array(
				'retVal' => $retVal,
				'retMessage' => $retMessage,
			));
	}
	
	
	
	// school year controller
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
	
	public function actionViewSchoolYear()
	{
		$retVal = "error";
		$retMessage = "Error";

		$vm = (object) array();
		$vm->SchoolYear = new SchoolYear('search');

		if(isset($_POST['schoolyear']))
		{
			$id = $_POST['schoolyear'];
			$findSchoolYear = SchoolYear::model()->findByPk($id);

			if(isset($findSchoolYear))
			{
				$vm->SchoolYear = $findSchoolYear;

				$view = $this->renderPartial('_schoolyear_form_edit', array(
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
	
	public function actionViewDSchoolYear()
	{
		$retVal = "error";
		$retMessage = "Error";

		$vm = (object) array();
		$vm->SchoolYear = new SchoolYear('search');

		if(isset($_POST['schoolyear']))
		{
			$id = $_POST['schoolyear'];
			$findSchoolYear = SchoolYear::model()->findByPk($id);

			if(isset($findSchoolYear))
			{
				$vm->SchoolYear = $findSchoolYear;

				$view = $this->renderPartial('_schoolyear_form_delete', array(
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
	
	public function actionEditSchoolYear()
	{
		$vm = (object) array();
		
		$vm->SchoolYear = new SchoolYear('search');
		
		$retVal = "error";
		$retMessage = "Error";
		
		if(isset($_POST['SchoolYear']))
		{
			$vm->SchoolYear->attributes = $_POST['SchoolYear'];
			$vm->editSchoolYear =  SchoolYear::model()->findByAttributes(array('sy_id' => $vm->SchoolYear->sy_id));
			
			
			
			
			if(trim($vm->SchoolYear->description) != '')
			{
				$findSchoolYear = SchoolYear::model()->findByAttributes(array('description' => $vm->SchoolYear->description));
				if(!isset($findSchoolYear))
				{
					$vm->editSchoolYear->description = $vm->SchoolYear->description;
					
					if($vm->editSchoolYear->save())
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
					$retMessage = "SchoolYear Already Exist";
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
	
	public function actionDeleteSchoolYear()
	{
		$vm = (object) array();
		
		$vm->SchoolYear = new SchoolYear('search');
		
		$retVal = "error";
		$retMessage = "Error";
		
		if(isset($_POST['SchoolYear']))
		{
			$vm->SchoolYear->attributes = $_POST['SchoolYear'];
			$vm->editSchoolYear = SchoolYear::model()->findByAttributes(array('sy_id' => $vm->SchoolYear->sy_id));
			
				if($vm->editSchoolYear->delete())
				{
					$retVal = "success";
					$retMessage = "SchoolYear Deleted";	
				}
				else
				{
					$retMessage = "Unable To Delete SchoolYear";
				}

		}
		$this->renderPartial('/json/json_ret', 
			array(
				'retVal' => $retVal,
				'retMessage' => $retMessage,
			));
	}
	
	//room controller
	public function actionRooms()
	{
		$vm = (object) array();
		$vm->room = new Room('search');
		// $vm->user_course = new UserCourse('search');
		
		$this->render('room',array(
			'vm'=>$vm,
		));
	}
	
	public function actionSaveRoom()
	{
		$vm = (object) array();
		$vm->room = new Room('search');
		
		$retVal = "error";
		$retMessage = "Error";
		
		if(isset($_POST['Room']))
		{
			$vm->room->attributes = $_POST['Room'];
			
			if(trim($vm->room->description) != '')
			{
				$findSubject = Room::model()->findByAttributes(array('description' => $vm->room->description));
				if(!isset($findSubject))
				{
					if($vm->room->save())
					{
						$retVal = "success";
						$retMessage = "Room Saved";	
					}
					else
					{
						$retMessage = "Unable To Save Room";
					}
				}
				else
				{
					$retMessage = "Room Already Exist";
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
	
	public function actionViewRoom()
	{
		$retVal = "error";
		$retMessage = "Error";

		$vm = (object) array();
		$vm->room = new Room('search');

		if(isset($_POST['room']))
		{
			$id = $_POST['room'];
			$findroom = Room::model()->findByPk($id);

			if(isset($findroom))
			{
				$vm->room = $findroom;

				$view = $this->renderPartial('_room_form_edit', array(
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
	
	public function actionViewDRoom()
	{
		$retVal = "error";
		$retMessage = "Error";

		$vm = (object) array();
		$vm->room = new Room('search');

		if(isset($_POST['room']))
		{
			$id = $_POST['room'];
			$findroom = Room::model()->findByPk($id);

			if(isset($findroom))
			{
				$vm->room = $findroom;

				$view = $this->renderPartial('_room_form_delete', array(
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
	
	public function actionEditRoom()
	{
		$vm = (object) array();
		
		$vm->room = new Room('search');
		
		$retVal = "error";
		$retMessage = "Error";
		
		if(isset($_POST['Room']))
		{
			$vm->room->attributes = $_POST['Room'];
			$vm->editroom =  room::model()->findByAttributes(array('id' => $vm->room->id));
			
			
			
			
			if(trim($vm->room->description) != '')
			{
				$findroom = Room::model()->findByAttributes(array('description' => $vm->room->description));
				if(!isset($findroom))
				{
					$vm->editroom->description = $vm->room->description;
					
					if($vm->editroom->save())
					{
						$retVal = "success";
						$retMessage = "room Saved";	
					}
					else
					{
						$retMessage = "Unable To Save room";
					}
				}
				else
				{
					$retMessage = "room Already Exist";
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
	
	public function actionDeleteRoom()
	{
		$vm = (object) array();
		
		$vm->room = new Room('search');
		
		$retVal = "error";
		$retMessage = "Error";
		
		if(isset($_POST['Room']))
		{
			$vm->room->attributes = $_POST['Room'];
			$vm->editroom = Room::model()->findByAttributes(array('id' => $vm->room->id));
			
				if($vm->editroom->delete())
				{
					$retVal = "success";
					$retMessage = "Room Deleted";	
				}
				else
				{
					$retMessage = "Unable To Delete Room";
				}

		}
		$this->renderPartial('/json/json_ret', 
			array(
				'retVal' => $retVal,
				'retMessage' => $retMessage,
			));
	}


}