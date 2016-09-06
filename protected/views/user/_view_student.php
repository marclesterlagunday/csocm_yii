<?php

$this->widget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Personal Information',
    	'context' => 'default',
        'headerIcon' => 'fa fa-user',
        'content' => 
        	'<b>Name : </b>' . ucfirst($vm->user->firstname) . ' ' . ucfirst($vm->user->middlename) . ' ' . ucfirst($vm->user->surname) . '<br/>' .
        	// '<b>Gender : </b>' . $vm->user->Gender->description . '<br/>' .
        	'<b>Email : </b>' . $vm->user->email . '<br/>' .
        	'<b>Contact No : </b>' . $vm->user->contact_no
        
    )
);

?>
<?php

$this->widget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'School Information',
    	'context' => 'primary',
        'headerIcon' => 'fa fa-graduation-cap',
        'content' => 
        	'<b>Course : </b>' . $vm->user_course->Course->description . '<br/>' .
        	'<b>SY : </b>' . $vm->user_course->SchoolYear->description . '<br/>'
        
    )
);

?>