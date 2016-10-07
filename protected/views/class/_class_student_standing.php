<?php

$this->widget(
    'booster.widgets.TbExtendedGridView',
    array(
        'id' => 'class_attendance_student_grid',
        'type' => 'striped bordered condensed',
        'dataProvider' => $vm->class_standings->search(),
        // 'template' => "{items}",
        'columns' => array(
            array(
                'name' => 'Type', 
                'header' => 'Type',
                'value' => '($data->type != 0) ? $data->ClassStandingType->description : " " ',
                'sortable'=> false,
                'class' => 'booster.widgets.TbEditableColumn',
                'editable' => array(
                    'type' => 'text',
                    //'apply' => '($data->product == 0) ? false : false',
                    'value' => null,
                    //'url' => Yii::app()->createUrl( "warehouse/savenewnproduct" )
                )
            ),
            array(
                'name' => 'Grade',
                'header' => 'Grade',
                'visible' => $vm->visible,
                'value' => '($data->Grade != 0) ? $data->Grade : " " ',
                'sortable'=> false,
                'class' => 'booster.widgets.TbEditableColumn',
                'editable' => array(
                    'type' => 'number',
                    'apply' => '($data->Grade == 0) ? false : true',
                    'url' => Yii::app()->createUrl( "class/SaveEditGrades" )
                )
            ),
            array(
                'name' => 'Grade', 
                'header' => 'Grade',
                'visible' => ($vm->visible == false) ? true : false,
                'value' => '($data->Grade != 0) ? $data->Grade : " " ',
                'sortable'=> false,
            ),
        )
    )
);

?>