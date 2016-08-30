<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'CSOCM',

	// preloading 'log' component
	'preload'=>array(
		'log',
		'booster',
		'bootstrap',
	),

	'aliases' => array(
		'bootstrap' => realpath(__DIR__ . '/../extensions/booster'),
        'booster' => realpath(__DIR__ . '/../extensions/booster'),       
    ),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'gii',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		

		'rbam'=>array(
			'applicationLayout'=>'application.views.layouts.main',
			'authAssignmentsManagerRole'=>' Auth Assignments Manager',
			'authenticatedRole'=>'Authenticated',
			'authItemsManagerRole'=>'Auth Items Manager',
			'baseScriptUrl'=>null,
			'baseUrl'=>null,
			'cssFile'=>null,
			'development'=>false,
			'exclude'=>'rbam',
			'guestRole'=>'Guest',
			'initialise'=>false,
			'layout'=>'rbam.views.layouts.main',
			'juiCssFile'=>'jquery-ui.css',
			'juiHide'=>'puff',
			'juiScriptFile'=>'jquery-ui.min.js',
			'juiScriptUrl'=>null,
			'juiShow'=>'fade',
			'juiTheme'=>'base',
			'juiThemeUrl'=>null,
			'pageSize'=>5,
			'rbacManagerRole'=>'RBAC Manager',
			'relationshipsPageSize'=>5,
			'showConfirmation'=>3000,
			'showMenu'=>true,
			'userClass'=>'User',
			'userCriteria'=>array(),
			'userIdAttribute'=>'id',
			'userNameAttribute'=>'username',
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'bootstrap' => array(
        	'class' => 'booster.components.Booster',
        ),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		// 'db'=>array(
		// 	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		// ),

		'authManager'=>array(
			'class'=>'CDbAuthManager',
			'connectionID'=>'db',
		),
		
		// uncomment the following to use a MySQL database

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=classmanager_v3',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'it@dkgb.com',
	),
);