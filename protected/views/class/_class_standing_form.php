<?php
	$form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
			'id' => 'class_standing_form',
			'type' => 'horizontal',
		)
	);
?>

<?php echo $form->hiddenField(
	$vm->class_standings,
	'class'
); ?>
<?php echo $form->hiddenField(
	$vm->class_standings,
	'student'
); ?>


<?php $data = CHtml::listData( ClassStandingType::model()->findAll(), 'id', 'description'); ?>
<?php echo $form->select2Group(
	$vm->class_standings,
	'type',
	array(
		'wrapperHtmlOptions' => array(
			'class' => 'col-sm-5',
		),
		'widgetOptions' => array(
			'asDropDownList' => true,
			'data' => $data,
			'options' => array(
				'placeholder' => 'Select Type',
				'tokenSeparators' => array(',', ' ')
			)
		)
	)
);?>

<?php echo $form->numberFieldGroup(
	$vm->class_standings,
	'Grade',
	array(
		'wrapperHtmlOptions' => array(
			'class' => 'col-sm-8',
		),
	)
); ?>

<?php $this->endWidget(); ?>