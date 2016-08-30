<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" /> -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" /> -->
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" /> -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" /> -->

	<!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" /> -->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.min.css" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/others.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<?php

$this->widget(
    'booster.widgets.TbNavbar',
    array(
    	// 'type' => 'inverse',
        'brand' => 'Computer Studies',
        'collapse' => true,
        'fixed' => true,
    	'fluid' => true,
        'items' => array(
        	array(
                'class' => 'booster.widgets.TbMenu',
                'type' => 'navbar',
                'items' => array(
                    array(
                        'label' => '',
                        'icon'=>'fa fa-users',
                        'url' => '#',
                        'visible'=>!Yii::app()->user->isGuest,
                        'items' => array(
                            array('label' => 'Student', 'url' => array('/user/student'), 'visible'=>Yii::app()->user->checkAccess('Admin')),
                            array('label' => 'Instructor', 'url' => array('/user/instructor'), 'visible'=>Yii::app()->user->checkAccess('Admin')),
                        )
                    ),
                    array(
                        'label' => Yii::app()->user->name,
                        'url' => '#',
                        'icon'=>'fa fa-lock',
                        'items' => array(
                            array('label' => 'Profile', 'url' => '#', 'visible'=>!Yii::app()->user->isGuest),
                            array('label'=>'Register', 'url'=>'', 'visible'=>Yii::app()->user->isGuest),
                            '---',
                            array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                            array('label'=>'Logout', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                        )
                    ),
                ),
            ),
        ),
    )
);

?>

<div class="container" id="page">

	<?php echo $content; ?>

	<!-- <div id="footer">
		Copyright &copy; <?php //echo date('Y'); ?> by <a href="www.rxsi.net/">Rx Solutions Inc.</a><br/>
		All Rights Reserved.<br/>
	</div>  -->

</div>

</body>
</html>
