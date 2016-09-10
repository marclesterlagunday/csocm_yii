<?php

$this->widget(
    'booster.widgets.TbExtendedGridView',
    array(
        'id' => 'class_lecture_list',
        'type' => 'striped bordered condensed',
        'dataProvider' => $vm->class_lecture->search(),
        // 'template' => "{items}",
        'columns' => array(
            array(
                'name' => '#',
                'header' => '#',
                'value' => '$row + 1',
                'htmlOptions'=>array('style'=>'width: 60px'),
            ),
            array(
                'name' => 'Lecture', 
                'header' => 'Lecture',
                'value' => 'ucfirst($data->Lecture->title)',
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
                                        'label' => '',
                                        'size' => 'small',
                                        'icon' => 'fa fa-download',
                                        'buttonType' =>'link',
                                        'url'=>'lectures/' . $data->Lecture->filename,
                                        'htmlOptions' => array(
                                            'class'=>'view_btn',
                                            'ref'=>$data->class_lecture_id,
                                            'target'=>'_blank',
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
                                            'ref'=>$data->class_lecture_id,
                                        ),
                                    )
                                );
                            },
            ),
        )
    )
);

?>