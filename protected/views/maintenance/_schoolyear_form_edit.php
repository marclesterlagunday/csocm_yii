<?php
	$form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
			'id' => 'schoolyear_form_edit',
			'type' => 'horizontal',
		)
	);
?>

<?php echo $form->textFieldGroup($vm->SchoolYear, 'description', array(
	'widgetOptions' => array(
		'htmlOptions' => array('autocomplete'=>"off")
	)
)); ?>
 <?php echo $form->hiddenField($vm->SchoolYear,'sy_id'); // hidden target?>
<?php $this->endWidget(); ?>