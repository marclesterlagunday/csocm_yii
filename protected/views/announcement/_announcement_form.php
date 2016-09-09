<?php
	$form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
			'id' => 'announcement_form',
			'type' => 'horizontal',
		)
	);
?>

<?php echo $form->textFieldGroup($vm->announcement, 'title') ?>

<?php $data = CHtml::listData( Classes::model()->findAll(), 'class_id', 'subject'); ?>
<?php echo $form->select2Group(
	$vm->announcement,
	'defined_class',
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

<?php echo $form->textAreaGroup(
			$vm->announcement,
			'message',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-12',
				),
				'widgetOptions' => array(
					'htmlOptions' => array('rows' => 8),
				)
			)
		); ?>



<?php $this->endWidget(); ?>