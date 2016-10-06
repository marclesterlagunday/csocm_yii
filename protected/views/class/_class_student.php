<?php

$this->widget(
    'booster.widgets.TbExtendedGridView',
    array(
        'id' => 'class_student_list',
        'type' => 'striped bordered condensed',
        'dataProvider' => $vm->class_student->search(),
        // 'template' => "{items}",
        'columns' => array(
            array(
                'name' => '#',
                'header' => '#',
                'value' => '$row + 1',
                'htmlOptions'=>array('style'=>'width: 30px'),
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
                'htmlOptions'=>array('style'=>'width: 115px'),
                // 'type' => 'raw',
                'value' =>  function($data){
                                $this->widget(
                                    'booster.widgets.TbButton',
                                    array(
                                        'label' => 'View',
                                        'size' => 'small',
                                        'context' => 'info',
                                        'icon' => 'fa fa-eye',
                                        'buttonType' =>'link',
                                        'url'=>array('class/viewstudent', 'id'=>$data->class_student_id,),
                                        'htmlOptions' => array(
                                            'class'=>'view_student_btn',
                                            'ref'=>$data->class_student_id,
                                        ),
                                    )
                                );echo ' ';
                                $this->widget(
                                    'booster.widgets.TbButton',
                                    array(
                                        'label' => '',
                                        'size' => 'small',
                                        'icon' => 'fa fa-times',
                                        'htmlOptions' => array(
                                            'class'=>'remove_student_btn',
                                            'ref'=>$data->class_student_id,
                                        ),
                                    )
                                );
                            },
            ),
        )
    )
);

?>