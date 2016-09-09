<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2>Subject Maintenance</h2>
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
            		            'data-target' => '#subjectModal',
            		        ),
            		    )
            		); ?>
            	</div>
            </div>
            <div class="row">
            	<div class="col-sm-12">
            		<?php
            			$this->renderPartial('_subject_list', array(
            				'vm'=>$vm,
            			));
            		?>
            	</div>
            </div>

<?php $this->beginWidget(
                'booster.widgets.TbModal',
                array('id' => 'subjectModal')
            ); ?>
			
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h4>Create New</h4>
            </div>

            <div class="modal-body">
                <?php
                	$this->renderPartial('_subject_form', array(
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
                array('id' => 'editsubjectModal')
            ); ?>
			
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h4>Edit Subject</h4>
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
                array('id' => 'deletesubjectModal')
            ); ?>
			
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h4>Delete Subject</h4>
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
	$save_newsubject = Yii::app()->createUrl( "Maintenance/savesubject" );
	$edit_subject = Yii::app()->createUrl( "Maintenance/Editsubject" );
	$view_subject = Yii::app()->createUrl( "Maintenance/viewsubject" );
	$viewd_subject = Yii::app()->createUrl( "Maintenance/viewdsubject" );
	$delete_subject = Yii::app()->createUrl( "Maintenance/deletesubject" );
	$success = 'success';
	$error = 'error';

	Yii::app()->clientScript->registerScript('subject', "

		$(document).ready( function() {
	        $('#subject_form').submit( function( e ) {
	            e.preventDefault();
			});
	    });

	    $('#subjectModal').on('shown.bs.modal', function(){
	    	$('#subject_description').focus();
	    });

		$(document).on('click', '#save_btn', function(){
            $.ajax({
                type        : 'POST', 
                url         : '{$save_newsubject}',
                data        : $('#subject_form').serialize(),
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $.notify(json.retMessage, json.retVal);
                        $('#subject_list').yiiGridView('update', {
				        	data: $(this).serialize()
				        });
				        $( '#subject_form' ).each(function(){
						    this.reset();
						});
				        $('#subjectModal').modal('hide');
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
              'subject' : $(this).attr('ref'),
            }  
			$.ajax({
                type        : 'POST', 
                url         : '{$view_subject}',
                data        : values,
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $('#editsubjectModal .modal-body').html(json.retMessage);
                        $('#editsubjectModal').modal();
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
                url         : '{$edit_subject}',
                data        : $('#subject_form_edit').serialize(),
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $.notify(json.retMessage, json.retVal);
                        $('#subject_list').yiiGridView('update', {
				        	data: $(this).serialize()
				        });
				        $( '#subject_form_edit' ).each(function(){
						    this.reset();
						});
				        $('#subjectModal').modal('hide');
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
			'subject' : $(this).attr('ref'),
		}
		
			$.ajax({
                type        : 'POST', 
                url         : '{$viewd_subject}',
                data        : values,
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $('#deletesubjectModal .modal-body').html(json.retMessage);
                        $('#deletesubjectModal').modal();
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
                url         : '{$delete_subject}',
                data        : $('#subject_form_delete').serialize(),
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $.notify(json.retMessage, json.retVal);
                        $('#subject_list').yiiGridView('update', {
				        	data: $(this).serialize()
				        });
				        $( '#subject_form_delete' ).each(function(){
						    this.reset();
						});
				        $('#deletesubjectModal').modal('hide');
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