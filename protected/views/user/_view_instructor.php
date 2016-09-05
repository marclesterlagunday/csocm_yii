<?php

$this->widget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Personal Information',
    	'context' => 'default',
        'headerIcon' => 'fa fa-user',
        'content' => 
        	'<b>Name : </b>' . ucfirst($vm->user->firstname) . ' ' . ucfirst($vm->user->middlename) . ' ' . ucfirst($vm->user->surname) . '<br/>' .
        	'<b>Gender : </b>' . $vm->user->Gender->description . '<br/>' .
        	'<b>Email : </b>' . $vm->user->email . '<br/>' .
        	'<b>Contact No : </b>' . $vm->user->contact_no
        
    )
);

?>