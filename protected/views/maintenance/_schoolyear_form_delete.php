<?php
	$form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
			'id' => 'schoolyear_form_delete',
			'type' => 'horizontal',
		)
	);
?>

Do you want to Delete this item.
 <?php echo $form->hiddenField($vm->SchoolYear,'sy_id'); // hidden target?>
<?php $this->endWidget(); ?>