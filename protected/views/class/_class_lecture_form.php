<?php
	$form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
			'id' => 'class_lecture_form',
			'type' => 'horizontal',
		)
	);
?>

<?php echo $form->hiddenField(
	$vm->lecture,
	'class'
); ?>

<?php echo $form->textFieldGroup(
	$vm->lecture,
	'title',
	array(
		'wrapperHtmlOptions' => array(
			'class' => 'col-sm-8',
		),
	)
); ?>

<?php echo $form->textAreaGroup(
	$vm->lecture,
	'description',
	array(
		'wrapperHtmlOptions' => array(
			'class' => 'col-sm-8',
		),
		'widgetOptions' => array(
			'htmlOptions' => array('rows' => 5),
		)
	)
); ?>
<?php echo $form->fileFieldGroup($vm->lecture, 'filename',
	array(
		'wrapperHtmlOptions' => array(
			'class' => 'col-sm-5',
		),
	)
); ?>

<?php $this->endWidget(); ?>