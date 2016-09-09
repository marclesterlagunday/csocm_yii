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
            		            'data-target' => '#courseModal',
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
                array('id' => 'courseModal')
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
                Loading . . . .
            </div>

            <div class="modal-footer">
                <?php $this->widget(
                    'booster.widgets.TbButton',
                    array(
                        'context' => 'primary',
                        'label' => 'Save',
                        'htmlOptions' => array('id' => 'save_edit_btn'),
                        'url' => '#',
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
                array('id' => 'deletecourseModal')
            ); ?>
			
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h4>Delete Course</h4>
            </div>

            <div class="modal-body">
                Loading..
            </div>

            <div class="modal-footer">
                <?php $this->widget(
                    'booster.widgets.TbButton',
                    array(
                        'context' => 'primary',
                        'label' => 'Yes',
                        'htmlOptions' => array('id' => 'delete_btn'),
                        'url' => '#',
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
	$edit_course = Yii::app()->createUrl( "Maintenance/EditCourse" );
	$view_course = Yii::app()->createUrl( "Maintenance/viewcourse" );
	$viewd_course = Yii::app()->createUrl( "Maintenance/viewdcourse" );
	$delete_course = Yii::app()->createUrl( "Maintenance/deletecourse" );
	$success = 'success';
	$error = 'error';

	Yii::app()->clientScript->registerScript('course', "

		$(document).ready( function() {
	        $('#course_form').submit( function( e ) {
	            e.preventDefault();
			});
	    });

	    $('#courseModal').on('shown.bs.modal', function(){
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
				        $('#courseModal').modal('hide');
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
              'course' : $(this).attr('ref'),
            }  
			$.ajax({
                type        : 'POST', 
                url         : '{$view_course}',
                data        : values,
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $('#editcourseModal .modal-body').html(json.retMessage);
                        $('#editcourseModal').modal();
                    }
                    else if(json.retVal == '{$error}')
                    {
                        $.notify(json.retMessage, json.retVal);
                    }
                }
            })
            
		})
		
		$(document).on('click', '#save_edit_btn', function(){
            $.ajax({
                type        : 'POST', 
                url         : '{$edit_course}',
                data        : $('#course_form_edit').serialize(),
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $.notify(json.retMessage, json.retVal);
                        $('#course_list').yiiGridView('update', {
				        	data: $(this).serialize()
				        });
				        $( '#course_form_edit' ).each(function(){
						    this.reset();
						});
				        $('#courseModal').modal('hide');
                    }
                    else if(json.retVal == '{$error}')
                    {
                        $.notify(json.retMessage, json.retVal);
                    }
                }
            })
        });
		
		$(document).on('click', '.delete_btn', function(){
		var values = {
			'course' : $(this).attr('ref'),
		}
		
			$.ajax({
                type        : 'POST', 
                url         : '{$viewd_course}',
                data        : values,
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $('#deletecourseModal .modal-body').html(json.retMessage);
                        $('#deletecourseModal').modal();
                    }
                    else if(json.retVal == '{$error}')
                    {
                        $.notify(json.retMessage, json.retVal);
                    }
                }
            })
		
		})
		
		
		$(document).on('click', '#delete_btn', function(){
            $.ajax({
                type        : 'POST', 
                url         : '{$delete_course}',
                data        : $('#course_form_delete').serialize(),
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $.notify(json.retMessage, json.retVal);
                        $('#course_list').yiiGridView('update', {
				        	data: $(this).serialize()
				        });
				        $( '#course_form_delete' ).each(function(){
						    this.reset();
						});
				        $('#deletecourseModal').modal('hide');
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