<?php

$this->widget(
    'booster.widgets.TbExtendedGridView',
    array(
        'id' => 'instructor_list',
        'type' => 'striped bordered condensed',
        'dataProvider' => $vm->user->instructor(),
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
              'imagePathExpression'=>'($data->profile_pic != "") ? $data->profile_pic : "./images/user.png"',
              'imageOptions'=>array('width'=>'34px', 'height' => '34px','class'=> 'circle'),
              'usePlaceKitten'=>false,
              'htmlOptions'=>array('style'=>'width: 45px'),
            ),
            array(
                'name' => 'Name', 
                'header' => 'Name',
                'value' => 'ucfirst($data->surname) . ", " . ucfirst($data->firstname) . " " . strtoupper(substr($data->middlename, 0, 1)) . "."',
                'sortable'=> false,
            ),
            array(
                'name' => 'Action',
                'header' => 'Action',
                'htmlOptions'=>array('style'=>'width: 120px'),
                // 'type' => 'raw',
                'value' =>  function($data){
                                $this->widget(
                                    'booster.widgets.TbButton',
                                    array(
                                        'label' => '',
                                        'size' => 'small',
                                        'icon' => 'fa fa-eye',
                                        'htmlOptions' => array(
                                            'class'=>'view_btn',
                                            'ref'=>$data->id,
                                        ),
                                    )
                                ); echo ' ';
                                $this->widget(
                                    'booster.widgets.TbButton',
                                    array(
                                        'label' => '',
                                        'size' => 'small',
                                        'icon' => 'fa fa-pencil',
                                        'htmlOptions' => array(
                                            'class'=>'edit_btn',
                                            'ref'=>$data->id,
                                        ),
                                    )
                                ); echo ' ';
                                $this->widget(
                                    'booster.widgets.TbButton',
                                    array(
                                        'label' => '',
                                        'size' => 'small',
                                        'icon' => 'fa fa-trash',
                                        'htmlOptions' => array(
                                            'class'=>'delete_btn',
                                            'ref'=>$data->id,
                                        ),
                                    )
                                );
                            },
            ),
        )
    )
);

?>