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

		$this->render('student',array(
			'vm'=>$vm,
		));
	}
}