<div class="container">
    <div class="row">
        <div class="col-sm-12">
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
            	<div class="col-sm-12">
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

<?php
	$save_student = Yii::app()->createUrl( "user/savestudent" );
	$success = 'success';
	$error = 'error';

	Yii::app()->clientScript->registerScript('student', "

		$(document).ready( function() {
	        $('#student_form').submit( function( e ) {
	            e.preventDefault();
			});
	    });

	    $('#studentModal').on('shown.bs.modal', function(){
	    	$('#User_username').focus();
	    });

		$(document).on('click', '#save_btn', function(){
            $.ajax({
                type        : 'POST', 
                url         : '{$save_student}',
                data        : $('#student_form').serialize(),
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $.notify(json.retMessage, json.retVal);
                        $('#student_list').yiiGridView('update', {
				        	data: $(this).serialize()
				        });
				        $( '#student_form' ).each(function(){
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
	");
?>