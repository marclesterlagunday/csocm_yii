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

		if(trim($id) != '')
		{
			$findClass = Classes::model()->findByPk($id);

			if(isset($findClass))
			{
				$vm->class = $findClass;
				$vm->class_student->class = $findClass->class_id;

				$findClassDays = ClassDay::model()->findAll(array("condition"=>"class = {$findClass->class_id}"));

				if($findClassDays > 0)
				{
					$vm->class_day = $findClassDays;
				}
			}
		}

		$this->render('viewclass', array(
			'vm' => $vm,
		));
	}


}