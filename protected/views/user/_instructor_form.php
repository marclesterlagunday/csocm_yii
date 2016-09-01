<?php
	$form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
			'id' => 'instructor_form',
			'type' => 'horizontal',
		)
	);
?>
<?php echo $form->textFieldGroup($vm->user, 'username', array(
	'widgetOptions' => array(
		'htmlOptions' => array('autocomplete'=>"off")
	)
)); ?>
<?php echo $form->passwordFieldGroup($vm->user, 'password', array(
	'widgetOptions' => array(
		'htmlOptions' => array('autocomplete'=>"off")
	)
)); ?>
<hr/>
<?php echo $form->textFieldGroup($vm->user, 'firstname', array(
	'widgetOptions' => array(
		'htmlOptions' => array('autocomplete'=>"off")
	)
)); ?>
<?php echo $form->textFieldGroup($vm->user, 'middlename', array(
	'widgetOptions' => array(
		'htmlOptions' => array('autocomplete'=>"off")
	)
)); ?>
<?php echo $form->textFieldGroup($vm->user, 'surname', array(
	'widgetOptions' => array(
		'htmlOptions' => array('autocomplete'=>"off")
	)
)); ?>
<?php echo $form->numberFieldGroup($vm->user, 'age', array(
	'widgetOptions' => array(
		'htmlOptions' => array('autocomplete'=>"off")
	),
	'wrapperHtmlOptions' => array(
		'class' => 'col-sm-3'
	),
)); ?>
<?php echo $form->dropDownListGroup(
	$vm->user,
	'gender',
	array(
		'wrapperHtmlOptions' => array(
			'class' => 'col-sm-5',
		),
		'widgetOptions' => array(
			'data' => array('1'=>'Male', '2'=>'Female'),
			'htmlOptions' => array('prompt'=>'Gender'),
		)
	)
); ?>
<hr/>
<?php echo $form->textFieldGroup($vm->user, 'email', array(
	'widgetOptions' => array(
		'htmlOptions' => array('autocomplete'=>"off")
	),
)); ?>
<?php echo $form->textFieldGroup($vm->user, 'contact_no', array(
	'widgetOptions' => array(
		'htmlOptions' => array('autocomplete'=>"off")
	),
	'wrapperHtmlOptions' => array(
		'class' => 'col-sm-7'
	),
)); ?>
<?php $this->endWidget(); ?>