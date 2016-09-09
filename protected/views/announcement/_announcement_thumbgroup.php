<?php 

echo CHtml::openTag('div', array('class' => 'row-fluid'));
$this->widget(
    'booster.widgets.TbThumbnails',
    array(
    	'id' => 'announcement_thumb_group',
        'dataProvider' => $vm->announcement->search(),
        'template' => "{items}\n{pager}",
        'itemView' => '_announcement_thumb',
    )
);
echo CHtml::closeTag('div');

?>