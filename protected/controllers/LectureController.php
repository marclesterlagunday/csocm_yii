<?php

class LectureController extends Controller
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
					'lecture',
                ),
				'roles'=>array('Instructor'),
			),
			
			array('deny',  // deny all other users
				'users'=>array('*'),
			),
		);
	}

	public function actionLecture()
	{
		$vm = (object) array();

		$this->render('lecture',array(
			'vm'=>$vm,
		));
	}
}