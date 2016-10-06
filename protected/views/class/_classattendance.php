<?php

$this->widget(
    'booster.widgets.TbExtendedGridView',
    array(
        'id' => 'class_attendance_grid',
        'type' => 'striped bordered condensed',
        'dataProvider' => $vm->attendance->search(),
        // 'template' => "{items}",
        'columns' => array(
            array(
                'name' => '#',
                'header' => '#',
                'value' => '$row + 1',
                'htmlOptions'=>array('style'=>'width: 25px'),
            ),
            array(
                'name' => 'date', 
                'header' => 'Date',
                'value' => 'date("M d, Y", strtotime($data->date))',
                'sortable'=> false,
            ),
            array(
                'name' => 'Action',
                'header' => 'Action',
                'htmlOptions'=>array('style'=>'width: 85px'),
                // 'type' => 'raw',
                'value' =>  function($data){
                                $this->widget(
                                    'booster.widgets.TbButton',
                                    array(
                                        'label' => 'View',
                                        'size' => 'small',
                                        'context' => 'primary',
                                        'icon' => 'fa fa-eye',
                                        'buttonType' =>'link',
                                        'url'=>array('class/viewattendance', 'id' => $data->attendance_id),
                                        'htmlOptions' => array(
                                            'class'=>'view_attendance_btn',
                                            'ref'=>$data->attendance_id,
                                        ),
                                    )
                                );
                            },
            ),
        )
    )
);

?>