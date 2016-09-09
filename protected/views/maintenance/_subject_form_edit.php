<?php
	$form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
			'id' => 'subject_form_edit',
			'type' => 'horizontal',
		)
	);
?>

<?php echo $form->textFieldGroup($vm->subject, 'description', array(
	'widgetOptions' => array(
		'htmlOptions' => array('autocomplete'=>"off")
	)
)); ?>
 <?php echo $form->hiddenField($vm->subject,'id'); // hidden target?>
<?php $this->endWidget(); ?>