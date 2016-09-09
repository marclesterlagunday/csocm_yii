<?php
	$form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
			'id' => 'subject_form_delete',
			'type' => 'horizontal',
		)
	);
?>

Do you want to Delete this item.
 <?php echo $form->hiddenField($vm->subject,'id'); // hidden target?>
<?php $this->endWidget(); ?>