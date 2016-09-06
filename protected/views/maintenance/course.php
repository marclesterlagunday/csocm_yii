<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2>Course Maintenance</h2>
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
            	<div class="col-sm-12">
            		<?php
            			$this->renderPartial('_course_list', array(
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
                	$this->renderPartial('_course_form', array(
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
                        'htmlOptions' => array('id' => 'save_btn'),
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
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>


<?php $this->beginWidget(
                'booster.widgets.TbModal',
                array('id' => 'editcourseModal')
            ); ?>
			
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h4>Edit Course</h4>
            </div>

            <div class="modal-body">
                <?php
                	$this->renderPartial('_course_form', array(
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
                        'htmlOptions' => array('id' => 'save_edit_btn'),
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
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>



<?php
	$save_newcourse = Yii::app()->createUrl( "Maintenance/savecourse" );
	$success = 'success';
	$error = 'error';

	Yii::app()->clientScript->registerScript('student', "

		$(document).ready( function() {
	        $('#course_form').submit( function( e ) {
	            e.preventDefault();
			});
	    });

	    $('#studentModal').on('shown.bs.modal', function(){
	    	$('#Course_description').focus();
	    });

		$(document).on('click', '#save_btn', function(){
            $.ajax({
                type        : 'POST', 
                url         : '{$save_newcourse}',
                data        : $('#course_form').serialize(),
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $.notify(json.retMessage, json.retVal);
                        $('#course_list').yiiGridView('update', {
				        	data: $(this).serialize()
				        });
				        $( '#course_form' ).each(function(){
						    this.reset();
						});
				        $('#studentModal').modal('hide');
                    }
                    else if(json.retVal == '{$error}')
                    {
                        $.notify(json.retMessage, json.retVal);
                    }
                }
            })
        });
		$(document).on('click', '.edit_btn', function(){
            var values = {
              'student' : $(this).attr('ref'),
            }
                        $('#editcourseModal.modal-body');
                        $('#editcourseModal').modal();
            
		})
	");
?>