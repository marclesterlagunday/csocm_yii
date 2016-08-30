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
                'name' => 'Name', 
                'header' => 'Name',
                'value' => 'ucfirst($data->surname) . ", " . ucfirst($data->firstname) . " " . strtoupper(substr($data->middlename, 0, 1)) . "."',
                'sortable'=> false,
            ),
        )
    )
);

?>