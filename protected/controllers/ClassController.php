<?php

class ClassController extends Controller
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
					'class',
					'saveclass',
					'viewclass',
					'savestudentsclass',
					'uploadlectureclass',
					'viewstudent',
                ),
				'roles'=>array('Admin'),
			),

			array('allow', 
				'actions'=>array(
					'class',
					// 'saveclass',
					'viewclass',
					'savestudentsclass',
					'uploadlectureclass',
					'removestudenttoclass',
					'saveattendance',
					'viewattendance',
					'togglestudentattendance',
					'viewstudent',
					'saveeditgrades',
					'saveclassstanding',
                ),
				'roles'=>array('Instructor'),
			),

			array('allow', 
				'actions'=>array(
					'class',
					// 'saveclass',
					'viewclass',
					// 'savestudentsclass',
					// 'uploadlectureclass',
					'viewstudent',
					'viewattendance',
                ),
				'roles'=>array('Student'),
			),
			
			array('deny',  // deny all other users
				'users'=>array('*'),
			),
		);
	}

	public function actionClass()
	{
		$vm = (object) array();

		$vm->class_day = new ClassDay('search');
		$vm->class = new Classes('search');
		$vm->user = new User('search');
		$vm->visible = true;

		$user = Yii::app()->user->id;

		$checkuser = AuthAssignment::model()->findByAttributes(array('userid'=>$user));

		if(isset($checkuser))
		{
			if($checkuser->itemname == 'Student')
			{
				$vm->visible = false;
			}
		}
		
		$this->render('class',array(
			'vm'=>$vm,
		));
	}

	public function actionSaveClass()
	{
		$retVal = "error";
		$retMessage = "Error";

		$vm = (object) array();
		$vm->class = new Classes('search');
		$vm->class_day = new ClassDay('search');

		if(isset($_POST['Classes']) && isset($_POST['ClassDay']))
		{
			$vm->class->attributes = $_POST['Classes'];
			$vm->class_day->attributes = $_POST['ClassDay'];

			if($vm->class->subject != '' && $vm->class->sy != '' && $vm->class->instructor != '' && $vm->class->subject )
			{
				if(date("H:i", strtotime($vm->class->time_start)) < date("H:i", strtotime($vm->class->time_end)))
				{
					if($vm->class->save())
					{
						if(count($vm->class_day->day) > 0)
						{
							foreach($vm->class_day->day as $day)
							{
								$new_class_day = new ClassDay();
								$new_class_day->day = $day;
								$new_class_day->class = $vm->class->class_id;
								
								if($new_class_day->save())
								{
									$retVal = "success";
									$retMessage = "Class Successfully Saved";
								}
							}
						}
						else
						{
							$retMessage = "Please Select Day Of Schedule";
						}
					}
					else
					{
						$retMessage = "Error Saving Class";
					}
				}
				else
				{
					$retMessage = "Start Time And End Time Invalid";
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

	public function actionViewClass($id)
	{
		$vm = (object) array();
		$vm->class_student = new ClassStudent('search');
		$vm->user = new User('search');
		$vm->class_lecture = new ClassLecture('search');
		$vm->lecture = new Lecture('search');
		$vm->attendance = new Attendance('search');
		$vm->visible = true;

		$user = Yii::app()->user->id;

		$checkuser = AuthAssignment::model()->findByAttributes(array('userid'=>$user));

		if(isset($checkuser))
		{
			if($checkuser->itemname == 'Student')
			{
				$vm->visible = false;
				$vm->class_student->student = $user;
			}
		}

		if(trim($id) != '')
		{
			$findClass = Classes::model()->findByPk($id);

			if(isset($findClass))
			{
				$vm->class = $findClass;
				$vm->class_student->class = $findClass->class_id;
				$vm->class_lecture->class = $findClass->class_id;
				$vm->attendance->class = $findClass->class_id;

				$findClassDays = ClassDay::model()->findAll(array("condition"=>"class = {$findClass->class_id}"));

				if($findClassDays > 0)
				{
					$vm->class_day = $findClassDays;
				}
			}
			else
			{
				$vm->class_student->class = 0;
			}
		}

		$this->render('viewclass', array(
			'vm' => $vm,
		));
	}

	public function actionSaveStudentsClass()
	{
		$retVal = "error";
		$retMessage = "Error";

		$vm = (object) array();

		if(count($_POST['students']) > 0 && trim($_POST['id']) != '')
        {
        	$class_id = $_POST['id'];
        	$students_list = $_POST['students'];

        	$retMessage = "Already Exist : ";

        	$counter = -1;

        	foreach($students_list as $student)
        	{
        		$counter++;

        		if($counter != count($students_list))
        		{
        			$findStudent = ClassStudent::model()->findByAttributes(array('student'=>$student, 'class'=>$class_id));
	        		$findUser = User::model()->findByPk($student);

	        		if(!isset($findStudent))
	        		{
	        			$vm->class_students = new ClassStudent();
			            $vm->class_students->class = $class_id;
			            $vm->class_students->student = $student;
			            $vm->class_students->save();
			            $retVal = "success";
	        		}
	        		else
	        		{
	        			$retMessage .= ucfirst($findUser->surname) . ", ";
	        		}
        		}
        	}
        }

		$this->renderPartial('/json/json_ret', 
        array(
            'retVal' => $retVal,
            'retMessage' => $retMessage,
        ));
	}

	public function actionUploadLectureClass()
	{
		$retVal = "error";
		$retMessage = "Error";

		$vm = (object) array();
		$vm->lecture = new Lecture;

		if(isset($_POST['Lecture']))
		{
			$vm->lecture->attributes = $_POST['Lecture'];
			$vm->lecture->class = $_POST['Lecture']['class'];

			$file = CUploadedFile::getInstance($vm->lecture,'filename');

			if($file != '')
			{
				$extName = $file->getExtensionName();
				$vm->lecture->filename = $vm->lecture->title . "." . $extName ;

				$findLecture = Lecture::model()->findByAttributes(array('title'=>$vm->lecture->title));

				if(!isset($findLecture))
				{
					if($vm->lecture->save())
					{
						$file->saveAs( "lectures/" . $vm->lecture->filename);

						$vm->class_lecture = new ClassLecture();
						$vm->class_lecture->class = $vm->lecture->class;
						$vm->class_lecture->lecture = $vm->lecture->lecture_id;

						if($vm->class_lecture->save())
						{
							$retVal = 'success';
							$retMessage = 'Successfully Saved';
						}
					}
				}
				else
				{
					$retMessage = 'Someone Already Used "' . $vm->lecture->title . '" As Title';
				}
			}
			else
			{
				$retMessage = 'Please Select File To Upload';
			}
		}

		$this->renderPartial('/json/json_ret', 
        array(
            'retVal' => $retVal,
            'retMessage' => $retMessage,
        ));
	}

	public function actionRemoveStudentToClass()
	{
		$retVal = "error";
		$retMessage = "Error";

		if(isset($_POST['student']))
		{
			$class_student = $_POST['student'];
			$findStudentInClass = ClassStudent::model()->findByPk($class_student);

			if(isset($findStudentInClass))
			{
				$findUser = User::model()->findByPk($findStudentInClass->student);

				if(isset($findUser))
				{
					if($findStudentInClass->delete())
					{
						$retVal = 'success';
						$retMessage = $findUser->firstname . ' Removed In Class';
					}
					else
					{
						$retMessage = 'Unable to Remove ' . $findUser->firstname;
					}
				}
			}
		}

		$this->renderPartial('/json/json_ret', 
        array(
            'retVal' => $retVal,
            'retMessage' => $retMessage,
        ));
	}

	public function actionSaveAttendance()
	{
		$retVal = 'error';
		$retMessage = 'Error';

		$vm = (object) array();
		$vm->attendance = new Attendance('search');

		if(isset($_POST['Attendance']))
		{
			$vm->attendance->attributes = $_POST['Attendance'];

			if(trim($vm->attendance->date) != '')
			{
				$vm->attendance->date = date("Y-m-d", strtotime($vm->attendance->date));

				$findAttendance = Attendance::model()->findByAttributes(array('date'=>$vm->attendance->date, 'class'=>$vm->attendance->class));

				if(!isset($findAttendance))
				{
					$findAllClassStudents = ClassStudent::model()->findAllByAttributes(array('class' => $vm->attendance->class));

					if(count($findAllClassStudents) > 0)
					{
						if($vm->attendance->save())
						{
							foreach($findAllClassStudents as $students)
							{
								$newAttendanceStudent = new AttendanceStudent();
								$newAttendanceStudent->student = $students->student;
								$newAttendanceStudent->attendance = $vm->attendance->attendance_id;

								if($newAttendanceStudent->save())
								{
									$retVal = 'success';
									$retMessage = $vm->attendance->attendance_id;
								}
							}
						}
					}
					else
					{
						$retMessage = 'Class must have a student to create attendance';
					}
				}
				else
				{
					$retMessage = 'Attendance on ' . $vm->attendance->date . ' already exist.';
				}
			}
			else
			{
				$retMessage = 'Please select date.';
			}
		}

		$this->renderPartial('/json/json_ret', array(
			'retVal' => $retVal,
			'retMessage' => $retMessage,
		));
	}

	public function actionViewAttendance($id)
	{
		$vm = (object) array();
		$vm->attendance = new Attendance('search');
		$vm->attendance_student = new AttendanceStudent('search');

		if($id != '')
		{
			$findAttendance = Attendance::model()->findByPk($id);

			if(isset($findAttendance))
			{
				$vm->attendance = $findAttendance;
			}
		}

		$this->render('view_attendance', array(
			'vm' => $vm,
		));
	}

	public function actionToggleStudentAttendance()
	{
		$retVal = 'error';
		$retMessage = 'Error';

		if(isset($_POST['id']))
		{
			$id = $_POST['id'];

			$findAttendanceStudent = AttendanceStudent::model()->findByPk($id);

			if(isset($findAttendanceStudent))
			{
				if($findAttendanceStudent->present == 0)
				{
					$findAttendanceStudent->present = 1;
				}
				else
				{
					$findAttendanceStudent->present = 0;
				}

				if($findAttendanceStudent->save())
				{
					$retVal = 'success';
					$retMessage = 'Success';
				}
				else
				{
					$retMessage = 'Unable Saved';
				}
			}
		}

		$this->renderPartial('/json/json_ret',
		array(
			'retVal' => $retVal,
			'retMessage' => $retMessage,
		));
	}

	public function actionViewStudent($id)
	{
		$vm = (object) array();
		$vm->class_student = new ClassStudent('search');
		$vm->class_standings = new ClassStandings('search');
		$vm->visible = true;

		$user = Yii::app()->user->id;

		$checkuser = AuthAssignment::model()->findByAttributes(array('userid'=>$user));

		if(isset($checkuser))
		{
			if($checkuser->itemname == 'Student')
			{
				$vm->visible = false;
			}
		}

		$findClassStudent = ClassStudent::model()->findByPk($id);

		if(isset($findClassStudent))
		{
			$vm->class_student = $findClassStudent;
			$vm->class_standings->class = $findClassStudent->class;
			$vm->class_standings->student = $findClassStudent->student;
		}

		$this->render('view_student',array(
			'vm' => $vm,
		));
	}

	public function actionSaveEditGrades()
	{
		if(isset($_POST['value']) && isset($_POST['pk']))
		{
			$ClassStandings = ClassStandings::model()->findByPk($_POST['pk']);

			if(isset($ClassStandings))
			{
				$ClassStandings->Grade = $_POST['value'];
				$ClassStandings->save();
			}
		}
	}

	public function actionSaveClassStanding()
	{
		$retVal = 'error';
		$retMessage = 'Error';

		$class_standings = new ClassStandings();

		if(isset($_POST['ClassStandings']))
		{
			$class_standings->attributes = $_POST['ClassStandings'];

			if(trim($class_standings->Grade) != '' && $class_standings->type != '')
			{
				$findClassStanding = ClassStandings::model()->findByAttributes(array('class' => $class_standings->class, 'student' => $class_standings->student, 'type' => $class_standings->type));

				if(!isset($findClassStanding))
				{
					if($class_standings->save())
					{
						$retVal = 'success';
						$retMessage = 'Grade Added';
					}
					else
					{
						$retMessage = 'Unable to save.';
					}
				}
				else
				{
					$retMessage = $findClassStanding->ClassStandingType->description . ' has already grade.';
				}
			}
			else
			{
				$retMessage = 'Please complete up the form.';
			}
		}

		$this->renderPartial('/json/json_ret', array(
			'retVal' => $retVal,
			'retMessage' => $retMessage,
		));
	}

}