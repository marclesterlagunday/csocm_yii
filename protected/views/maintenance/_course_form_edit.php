<?php
	$form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
			'id' => 'course_form_edit',
			'type' => 'horizontal',
		)
	);
?>

<?php echo $form->textFieldGroup($vm->course, 'description', array(
	'widgetOptions' => array(
		'htmlOptions' => array('autocomplete'=>"off")
	)
)); ?>
 <?php echo $form->hiddenField($vm->course,'course_id'); // hidden target?>
<?php $this->endWidget(); ?>