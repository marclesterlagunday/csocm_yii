<?php

$this->widget(
    'booster.widgets.TbExtendedGridView',
    array(
        'id' => 'subject_list',
        'type' => 'striped bordered condensed',
        'dataProvider' => $vm->subject->search(),
        // 'template' => "{items}",
        'columns' => array(
            array(
                'name' => '#',
                'header' => '#',
                'value' => '$row + 1',
                'htmlOptions'=>array('style'=>'width: 60px'),
            ),
            array(
                'name' => 'description', 
                'header' => 'Subject',
                'value' => '$data->description',
                'sortable'=> false,
            ),
            array(
                'name' => 'description', 
                'header' => 'Code',
                'value' => '$data->subjec_code',
                'sortable'=> false,
            ),   
			array(
                'name' => 'description', 
                'header' => 'Description',
                'value' => '$data->subject_dec',
                'sortable'=> false,
            ),
            array(
                'name' => 'Action',
                'header' => 'Action',
                'htmlOptions'=>array('style'=>'width: 120px'),
                // 'type' => 'raw',
                'value' =>  function($data){
                                // $this->widget(
                                    // 'booster.widgets.TbButton',
                                    // array(
                                        // 'label' => '',
                                        // 'size' => 'small',
                                        // 'icon' => 'fa fa-eye',
                                        // 'htmlOptions' => array('class'=>'view_btn',),
                                    // )
                                // ); echo ' ';
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
                                        'htmlOptions' => array('class'=>'delete_btn','ref'=>$data->id,),
                                    )
                                );
                            },
            ),
        )
    )
);

?>