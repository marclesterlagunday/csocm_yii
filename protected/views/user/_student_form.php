<?php
	$form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
			'id' => 'student_form',
			'type' => 'horizontal',
		)
	);
?>
<div class="strike">
   <span>Kringle</span>
</div>
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
<?php $this->endWidget(); ?>