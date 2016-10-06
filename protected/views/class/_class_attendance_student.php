<?php

$this->widget('booster.widgets.TbExtendedGridView', array(
    'type' => 'striped bordered',
    'dataProvider' => $vm->class_student->search(),
    // 'template' => "{items}",
    'selectableRows' => 2000,
    'bulkActions' => array(
        'actionButtons' => array(
            array(
            'id'=>'addBtn',
            'buttonType' => 'button',
            'context' => 'primary',
            'size' => 'small',
            'icon' => 'fa fa-chevron-circle-right',
            'label' => 'Add Selected Students',
            'click' => 'js:saveStudentsClass'
            )
        ),
        // if grid doesn't have a checkbox column type, it will attach
        // one and this configuration will be part of it
        'checkBoxColumnConfig' => array(
            'name' => 'id'
        ),
    ),
    'columns' => array(
        array(
            'name' => 'Name',
            'header' => 'Name',
            'value' => 'ucfirst($data->Student->surname) . ", " . ucfirst($data->Student->firstname) . " " . strtoupper(substr($data->Student->middlename, 0, 1)) . "."',
            'sortable'=> false,
        ),
    ),
));

?>