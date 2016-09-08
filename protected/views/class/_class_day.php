<?php

$this->widget(
    'booster.widgets.TbExtendedGridView',
    array(
        'id' => 'class_day_list',
        'type' => 'striped bordered condensed',
        'dataProvider' => $vm->class_day->search(),
        // 'template' => "{items}",
        'columns' => array(
            array(
                'name' => '#',
                'header' => '#',
                'value' => '$row + 1',
                'htmlOptions'=>array('style'=>'width: 60px'),
            ),
            array(
                'name' => 'Day', 
                'header' => 'Day',
                'value' => '$data->day',
                'sortable'=> false,
            ),
        )
    )
);

?>