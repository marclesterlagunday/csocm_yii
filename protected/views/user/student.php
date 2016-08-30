<h2>Student Maintenance</h2>
<div class="row">
	<div class="col-sm-12">
		<?php $this->widget(
		    'booster.widgets.TbButton',
		    array(
		        'label' => 'Add New',
		        'context' => 'primary',
		        'icon' => 'fa fa-plus',
		        'htmlOptions' => array(
		            'data-toggle' => 'modal',
		            'data-target' => '#studentModal',
		        ),
		    )
		); ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<?php
			$this->renderPartial('_student_list', array(
				'vm'=>$vm,
			));
		?>
	</div>
</div>

<?php $this->beginWidget(
    'booster.widgets.TbModal',
    array('id' => 'studentModal')
); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Create New</h4>
</div>

<div class="modal-body">
    <?php
    	$this->renderPartial('_student_form', array(
    		'vm'=>$vm,
    	));
    ?>
</div>

<div class="modal-footer">
    <?php $this->widget(
        'booster.widgets.TbButton',
        array(
            'context' => 'primary',
            'label' => 'Save',
            'url' => '#',
            'htmlOptions' => array('data-dismiss' => 'modal', 'id' => 'save_btn'),
        )
    ); ?>
    <?php $this->widget(
        'booster.widgets.TbButton',
        array(
            'label' => 'Close',
            'url' => '#',
            'htmlOptions' => array('data-dismiss' => 'modal'),
        )
    ); ?>
</div>

<?php $this->endWidget(); ?>