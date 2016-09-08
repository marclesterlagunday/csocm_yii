<?php
	$form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
			'id' => 'class_form',
			'type' => 'horizontal',
		)
	);
?>

<?php $data = CHtml::listData( Subject::model()->findAll(), 'id', 'description'); ?>
<?php echo $form->select2Group(
	$vm->class,
	'subject',
	array(
		'wrapperHtmlOptions' => array(
			'class' => 'col-sm-5',
		),
		'widgetOptions' => array(
			'asDropDownList' => true,
			'data' => $data,
			'options' => array(
				// 'tags' => $data,
				'placeholder' => 'Subject',
				 // 'width' => '40%', 
				'tokenSeparators' => array(',', ' ')
			)
		)
	)
);?>

<?php $data = CHtml::listData( SchoolYear::model()->findAll(), 'sy_id', 'description'); ?>
<?php echo $form->select2Group(
	$vm->class,
	'sy',
	array(
		'wrapperHtmlOptions' => array(
			'class' => 'col-sm-5',
		),
		'widgetOptions' => array(
			'asDropDownList' => true,
			'data' => $data,
			'options' => array(
				// 'tags' => $data,
				'placeholder' => 'School Year',
				 // 'width' => '40%', 
				'tokenSeparators' => array(',', ' ')
			)
		)
	)
);?>

<?php $data = CHtml::listData( User::model()->with(array(
  'Authassignment' => array(
    'join' => 'JOIN users ON users.id = Authassignment.userid', 
    'condition' => "Authassignment.itemname = 'Instructor'",
  )
))->together()->findAll() , 'id', 'surname'); ?>

<?php echo $form->select2Group(
	$vm->class,
	'instructor',
	array(
		'wrapperHtmlOptions' => array(
			'class' => 'col-sm-5',
		),
		'widgetOptions' => array(
			'asDropDownList' => true,
			'data' => $data,
			'options' => array(
				// 'tags' => $data,
				'placeholder' => 'Instructor',
				 // 'width' => '40%', 
				'tokenSeparators' => array(',', ' ')
			)
		)
	)
);?>

<?php echo $form->timePickerGroup(
	$vm->class,
	'time_start',
	array(
		'widgetOptions' => array(
			'wrapperHtmlOptions' => array(
				'class' => 'col-sm-1'
			),
		),
	)
); ?>

<?php echo $form->timePickerGroup(
	$vm->class,
	'time_end',
	array(
		'widgetOptions' => array(
			'wrapperHtmlOptions' => array(
				'class' => 'col-sm-1'
			),
		),
	)
); ?>

<?php $data = CHtml::listData( Day::model()->findAll(), 'day_id', 'description'); ?>
<?php echo $form->dropDownListGroup(
	$vm->class_day,
	'day',
	array(
		'wrapperHtmlOptions' => array(
			'class' => 'col-sm-6',
		),
			'widgetOptions' => array(
				'data' => $data,
			'htmlOptions' => array('multiple' => true),
		)
	)
); ?>

<?php $this->endWidget(); ?>