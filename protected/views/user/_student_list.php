<?php

$this->widget(
    'booster.widgets.TbExtendedGridView',
    array(
        'id' => 'student_list',
        'type' => 'striped bordered condensed',
        'dataProvider' => $vm->user->student(),
        // 'template' => "{items}",
        'columns' => array(
            array(
                'name' => '#',
                'header' => '#',
                'value' => '$row + 1',
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
                // 'type' => 'raw',
                'value' =>  function($data){
                                $this->widget('bootstrap.widgets.TbButtonGroup', array(
                                        'size'=>'mini',
                                        'buttons'=>array(
                                            array('icon'=>'fa fa-bars', 'type'=>'', 'items'=>array
                                            (
                                                array('label'=>'View', 'url'=>array('/user/view&id=' . $data->id)),
                                                array('label'=>'Edit', 'url'=>array('/user/edit&id=' . $data->id)),
                                                array('label'=>'Delete', 'url'=>array('/user/delete&id=' . $data->id)),
                                            ),
                                        ),
                                    ),
                                ));
                            },
            ),
            // array(
            //     'htmlOptions' => array('nowrap' => 'nowrap'),
            //     'class' => 'booster.widgets.TbButtonColumn',
            //     'viewButtonUrl' => null,
            //     'updateButtonUrl' => null,
            //     'deleteButtonUrl' => null,
            // )
        )
    )
);

?>