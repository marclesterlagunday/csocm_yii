<?php 

echo CHtml::openTag('div', array('class' => 'row-fluid'));
$this->widget(
    'booster.widgets.TbThumbnails',
    array(
    	'id' => 'class_thumb_group',
        'dataProvider' => $vm->class_day->search(),
        'template' => "{items}\n{pager}",
        'itemView' => '_class_thumb',
    )
);
echo CHtml::closeTag('div');

?>