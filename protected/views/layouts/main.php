<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="language" content="en" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/classmanagementstyle.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.min.css" />

</head>

<body id="page-top">

<?php
$this->widget(
    'booster.widgets.TbNavbar',
    array(
        'type' => 'navbar', // null or 'inverse'
        'brand' => 'Computer Studies',
        'brandUrl' => '#',
        'collapse' => true, // requires bootstrap-responsive.css
        'fixed' => false,
        'fluid' => true,
        'items' => array(
            array(
                'class' => 'booster.widgets.TbMenu',
                'type' => 'navbar',
                'htmlOptions' => array('class' => 'navbar-right'),
                'items' => array(
                    array(
                        'label' => 'Announcements',
                        'icon'=>'fa fa-bullhorn',
                        'url' => array('/announcement/announcement'),
                        'visible'=>Yii::app()->user->checkAccess('Instructor'),
                    ),
                     array(
                        'label' => 'Announcements',
                        'icon'=>'fa fa-bullhorn',
                        'url' => array('/announcement/viewannouncement'),
                        'visible'=>Yii::app()->user->checkAccess('Student'),
                    ),
                    array(
                        'label' => '',
                        'icon'=>'fa fa-book',
                        'url' => array('/lecture/lecture'),
                        'visible'=>Yii::app()->user->checkAccess('Instructor'),
                    ),
                    array(
                        'label' => '',
                        'icon'=>'fa fa-building-o',
                        'url' => '#',
                        'visible'=>!Yii::app()->user->isGuest,
                        'items' => array(
                            array('label' => "Todays Classes", 'url' => array('/class/class'), 'visible'=>!Yii::app()->user->isGuest),
                            array('label' => 'Manage Class', 'url' => array('/class/manage'), 'visible'=>!Yii::app()->user->isGuest),
                        ),
                    ),
                    array(
                        'label' => '',
                        'icon'=>'fa fa-users',
                        'url' => '#',
                        'visible'=>Yii::app()->user->checkAccess('Admin'),
                        'items' => array(
                            array('label' => 'Student', 'url' => array('/user/student'), 'visible'=>Yii::app()->user->checkAccess('Admin')),
                            array('label' => 'Instructor', 'url' => array('/user/instructor'), 'visible'=>Yii::app()->user->checkAccess('Admin')),
                        ),
                    ),
					array(
                        'label' => '',
                        'icon'=>'fa fa-cog',
                        'url' => '#',
                        'visible'=>Yii::app()->user->checkAccess('Admin'),
                        'items' => array(
                            array('label' => 'Course', 'url' => array('/maintenance/course'), 'visible'=>Yii::app()->user->checkAccess('Admin')),                            
							array('label' => 'Subject', 'url' => array('/maintenance/subject'), 'visible'=>Yii::app()->user->checkAccess('Admin')),                            
							array('label' => 'School Year', 'url' => array('/maintenance/Schoolyear'), 'visible'=>Yii::app()->user->checkAccess('Admin')),	
							array('label' => 'Rooms', 'url' => array('/maintenance/rooms'), 'visible'=>Yii::app()->user->checkAccess('Admin')),
                        ),
                    ),
                    array(
                        'label' => Yii::app()->user->name,  'visible'=>!Yii::app()->user->isGuest,
                        'url' => '#',
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



    <?php echo $content; ?>

    <!-- <div id="footer">
        Copyright &copy; <?php //echo date('Y'); ?> by <a href="www.rxsi.net/">Rx Solutions Inc.</a><br/>
        All Rights Reserved.<br/>
    </div>  -->


</body>
</html>
