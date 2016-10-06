<div class="container">
	<div class="page-header">
		<h2>
			<img src="<?php echo $vm->class_student->Student->profile_pic ; ?>" width="100px" class="img-circle">&nbsp;
			<b>
				<?php echo ucfirst($vm->class_student->Student->surname) . ", " . ucfirst($vm->class_student->Student->firstname) . " " . strtoupper(substr($vm->class_student->Student->middlename, 0, 1)) . "."; ?>
			</b>
		</h2>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="alert">
				<legend>Class Standing</legend>
				<?php
					$this->widget(
                        'booster.widgets.TbButton',
                        array(
                            'label' => 'Add',
                            'context' => 'primary',
                            'size' => 'normal',
                            'icon' => 'fa fa-plus',
                            'htmlOptions' => array(
                                'class'=>'add_class_standings_btn',
                                'data-toggle' => 'modal',
                            	'data-target' => '#classStandingsModal',
                            ),
                        )
                    );
				?>
				<?php
					$this->renderPartial('_class_student_standing', array(
						'vm' => $vm,
					));
				?>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="alert">
				<legend>Class Info</legend>
				<?php
					$this->widget(
					    'booster.widgets.TbDetailView',
					    array(
					        'data' => array(
					            'subject' => $vm->class_student->Classes->Subject->description,
                                'instructor' => ucfirst($vm->class_student->Classes->Instructor->surname) . ", " . $vm->class_student->Classes->Instructor->firstname,
					            'time' => date("H:i A", strtotime($vm->class_student->Classes->time_start)) . " - " . date("H:i A", strtotime($vm->class_student->Classes->time_end)),
					        ),
					        'attributes' => array(
					            array('name' => 'subject', 'label' => 'Subject'),
                                array('name' => 'instructor', 'label' => 'Instructor'),
					            array('name' => 'time', 'label' => 'Time'),
					        ),
					    )
					);
				?>
			</div>
		</div>
	</div>
</div>

<!-- Modals -->

<?php $this->beginWidget(
    'booster.widgets.TbModal',
    array('id' => 'classStandingsModal')
); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Upload File</h4>
</div>

<div class="modal-body">
    <?php
    	$this->renderPartial('_class_standing_form', array(
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
            'icon' => 'fa fa-save',
            'url' => '#',
            'htmlOptions' => array('id' => 'save_class_standing_btn'),
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

<?php
	$saveclassstanding = Yii::app()->createUrl( "class/saveclassstanding" );
	$success = 'success';
	$error = 'error';

	Yii::app()->clientScript->registerScript('classstanding', "

		$(document).on('click', '#save_class_standing_btn', function(){
        	$.ajax({
                type        : 'POST', 
                url         : '{$saveclassstanding}',
                data        : $('#class_standing_form').serialize(),
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                    	$('#class_attendance_student_grid').yiiGridView('update', {
                            data: $(this).serialize()
                        });
                        $('#classStandingsModal').modal('hide');
                        $.notify(json.retMessage, json.retVal);
                        $( '#class_standing_form' ).each(function(){
						    this.reset();
						});
                    }
                    else if(json.retVal == '{$error}')
                    {
                        $.notify(json.retMessage, json.retVal);
                    }
                }
            })
        });

	");
?>