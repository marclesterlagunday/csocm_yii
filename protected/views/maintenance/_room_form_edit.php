<?php
	$form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
			'id' => 'room_form_edit',
			'type' => 'horizontal',
		)
	);
?>

<?php echo $form->textFieldGroup($vm->room, 'description', array(
	'widgetOptions' => array(
		'htmlOptions' => array('autocomplete'=>"off")
	)
)); ?>
 <?php echo $form->hiddenField($vm->room,'id'); // hidden target?>
<?php $this->endWidget(); ?>