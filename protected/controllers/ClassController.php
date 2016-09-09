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
                ),
				'roles'=>array('Admin'),
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

		if(trim($id) != '')
		{
			$findClass = Classes::model()->findByPk($id);

			if(isset($findClass))
			{
				$vm->class = $findClass;
				$vm->class_student->class = $findClass->class_id;
				$vm->class_lecture->class = $findClass->class_id;

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
						$$vm->lecture->saveAs( $setting->description . $vm->lecture->filename);

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

}