<?php
	$form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
			'id' => 'course_form',
			'type' => 'horizontal',
		)
	);
?>

<?php echo $form->textFieldGroup($vm->course, 'description', array(
	'widgetOptions' => array(
		'htmlOptions' => array('autocomplete'=>"off")
	)
)); ?>
<?php $this->endWidget(); ?>