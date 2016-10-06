<?php
    $form = $this->beginWidget(
        'booster.widgets.TbActiveForm',
        array(
            'id' => 'class_attendance_form',
            // 'type' => 'horizontal',
        )
    );
?>
<?php echo $form->hiddenField($vm->attendance,'class'); ?>
<div>
<?php echo $form->datePickerGroup(
    $vm->attendance,
    'date',
    array(
        'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
    )
); ?>
</div>

<?php $this->endWidget(); ?>

