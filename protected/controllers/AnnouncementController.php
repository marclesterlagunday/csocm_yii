<?php

class AnnouncementController extends Controller
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
					'announcement',
					'store',
					'viewannouncement',
                ),
				'roles'=>array('Instructor','Student'),
			),
			
			array('deny',  // deny all other users
				'users'=>array('*'),
			),
		);
	}

	public function actionAnnouncement()
	{
		$vm = (object) array();
		$vm->announcement = new Announcement('search');
		//$vm->announcement = Announcement::model()->findByPk(1);

		$this->render('announcement',array(
			'vm'=>$vm,
		));
	}

	public function actionViewAnnouncement()
	{
		$vm = (object) array();
		$vm->announcement = new Announcement('search');
		//$vm->announcement = Announcement::model()->findByPk(1);

		$this->render('view_announcement',array(
			'vm'=>$vm,
		));
	}

	public function actionStore()
	{
		$retVal = "error";
		$retMessage = "Error";

		$vm = (object) array();
		$vm->announcement = new Announcement('search');
		//$vm->announcement = Announcement::model()->findByPk(1);
		
		if(isset($_POST['Announcement'])){
			$vm->announcement->attributes = $_POST['Announcement'];

			if($vm->announcement->save())
			{
				$retVal = 'success';
				$retMessage = 'Successfully Saved';
			}
		}

		$this->renderPartial('/json/json_ret', 
        array(
            'retVal' => $retVal,
            'retMessage' => $retMessage,
        ));
	}
}