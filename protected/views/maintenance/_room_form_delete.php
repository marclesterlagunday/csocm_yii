<?php
	$form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
			'id' => 'room_form_delete',
			'type' => 'horizontal',
		)
	);
?>

Do you want to Delete this item.
 <?php echo $form->hiddenField($vm->room,'id'); // hidden target?>
<?php $this->endWidget(); ?>