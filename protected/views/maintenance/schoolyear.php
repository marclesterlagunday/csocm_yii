<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2>School Year Maintenance</h2>
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
            		            'data-target' => '#schoolyearModal',
            		        ),
            		    )
            		); ?>
            	</div>
            </div>
            <div class="row">
            	<div class="col-sm-12">
            		<?php
            			$this->renderPartial('_schoolyear_list', array(
            				'vm'=>$vm,
            			));
            		?>
            	</div>
            </div>

<?php $this->beginWidget(
                'booster.widgets.TbModal',
                array('id' => 'schoolyearModal')
            ); ?>
			
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h4>Create New</h4>
            </div>

            <div class="modal-body">
                <?php
                	$this->renderPartial('_schoolyear_form', array(
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
                array('id' => 'editschoolyearModal')
            ); ?>
			
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h4>Edit School Year</h4>
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
                array('id' => 'deleteschoolyearModal')
            ); ?>
			
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h4>Delete School Year</h4>
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
	$save_newschoolyear = Yii::app()->createUrl( "Maintenance/saveschoolyear" );
	$edit_schoolyear = Yii::app()->createUrl( "Maintenance/Editschoolyear" );
	$view_schoolyear = Yii::app()->createUrl( "Maintenance/viewschoolyear" );
	$viewd_schoolyear = Yii::app()->createUrl( "Maintenance/viewdschoolyear" );
	$delete_schoolyear = Yii::app()->createUrl( "Maintenance/deleteschoolyear" );
	$success = 'success';
	$error = 'error';

	Yii::app()->clientScript->registerScript('schoolyear', "

		$(document).ready( function() {
	        $('#schoolyear_form').submit( function( e ) {
	            e.preventDefault();
			});
	    });

	    $('#schoolyearModal').on('shown.bs.modal', function(){
	    	$('#schoolyear_description').focus();
	    });

		$(document).on('click', '#save_btn', function(){
            $.ajax({
                type        : 'POST', 
                url         : '{$save_newschoolyear}',
                data        : $('#schoolyear_form').serialize(),
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $.notify(json.retMessage, json.retVal);
                        $('#schoolyear_list').yiiGridView('update', {
				        	data: $(this).serialize()
				        });
				        $( '#schoolyear_form' ).each(function(){
						    this.reset();
						});
				        $('#schoolyearModal').modal('hide');
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
              'schoolyear' : $(this).attr('ref'),
            }  
			$.ajax({
                type        : 'POST', 
                url         : '{$view_schoolyear}',
                data        : values,
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $('#editschoolyearModal .modal-body').html(json.retMessage);
                        $('#editschoolyearModal').modal();
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
                url         : '{$edit_schoolyear}',
                data        : $('#schoolyear_form_edit').serialize(),
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $.notify(json.retMessage, json.retVal);
                        $('#schoolyear_list').yiiGridView('update', {
				        	data: $(this).serialize()
				        });
				        $( '#schoolyear_form_edit' ).each(function(){
						    this.reset();
						});
				        $('#schoolyearModal').modal('hide');
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
			'schoolyear' : $(this).attr('ref'),
		}
		
			$.ajax({
                type        : 'POST', 
                url         : '{$viewd_schoolyear}',
                data        : values,
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $('#deleteschoolyearModal .modal-body').html(json.retMessage);
                        $('#deleteschoolyearModal').modal();
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
                url         : '{$delete_schoolyear}',
                data        : $('#schoolyear_form_delete').serialize(),
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $.notify(json.retMessage, json.retVal);
                        $('#schoolyear_list').yiiGridView('update', {
				        	data: $(this).serialize()
				        });
				        $( '#schoolyear_form_delete' ).each(function(){
						    this.reset();
						});
				        $('#deleteschoolyearModal').modal('hide');
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