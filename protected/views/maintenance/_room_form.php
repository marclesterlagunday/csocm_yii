<?php
	$form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
			'id' => 'room_form',
			'type' => 'horizontal',
		)
	);
?>

<?php echo $form->textFieldGroup($vm->room, 'description', array(
	'widgetOptions' => array(
		'htmlOptions' => array('autocomplete'=>"off")
	)
)); ?>
<?php $this->endWidget(); ?>