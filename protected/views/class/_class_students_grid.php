<?php

$this->widget(
    'booster.widgets.TbExtendedGridView',
    array(
        'id' => 'class_student_attendance_list',
        'type' => 'striped bordered condensed',
        'dataProvider' => $vm->attendance_student->search(),
        // 'template' => "{items}",
        'columns' => array(
            array(
                'name' => '#',
                'header' => '#',
                'value' => '$row + 1',
                'htmlOptions'=>array('style'=>'width: 60px'),
            ),
            array(
              'class'=>'bootstrap.widgets.TbImageColumn',
              'imagePathExpression'=>'($data->Student->profile_pic != "") ? $data->Student->profile_pic : "./images/user.png"',
              'imageOptions'=>array('width'=>'34px', 'height' => '34px','class'=> 'circle'),
              'usePlaceKitten'=>false,
              'htmlOptions'=>array('style'=>'width: 45px'),
            ),
            array(
                'name' => 'Name', 
                'header' => 'Name',
                'value' => 'ucfirst($data->Student->surname) . ", " . ucfirst($data->Student->firstname) . " " . strtoupper(substr($data->Student->middlename, 0, 1)) . "."',
                'sortable'=> false,
            ),
            array(
                'name' => 'Action',
                'header' => 'Action',
                'htmlOptions'=>array('style'=>'width: 100px'),
                // 'type' => 'raw',
                'value' =>  function($data){
                                $this->widget(
                                    'booster.widgets.TbButton',
                                    array(
                                        'label' => ($data->present == 1) ? 'PRESENT' : 'ABSENT',
                                        'context' => ($data->present == 1) ? 'success' : 'danger',
                                        'size' => 'small',
                                        'icon' => 'fa fa-circle-o',
                                        'htmlOptions' => array(
                                            'class'=>'status_student_btn',
                                            'ref'=>$data->attendance_student_id,
                                        ),
                                    )
                                );
                            },
            ),
        )
    )
);

?>