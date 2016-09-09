<?php
	$form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
			'id' => 'course_form_delete',
			'type' => 'horizontal',
		)
	);
?>

Do you want to Delete this item.
 <?php echo $form->hiddenField($vm->course,'course_id'); // hidden target?>
<?php $this->endWidget(); ?>