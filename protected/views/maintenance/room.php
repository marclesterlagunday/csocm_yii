<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2>Room Maintenance</h2>
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
            		            'data-target' => '#roomModal',
            		        ),
            		    )
            		); ?>
            	</div>
            </div>
            <div class="row">
            	<div class="col-sm-12">
            		<?php
            			$this->renderPartial('_room_list', array(
            				'vm'=>$vm,
            			));
            		?>
            	</div>
            </div>

<?php $this->beginWidget(
                'booster.widgets.TbModal',
                array('id' => 'roomModal')
            ); ?>
			
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h4>Create New</h4>
            </div>

            <div class="modal-body">
                <?php
                	$this->renderPartial('_room_form', array(
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
                array('id' => 'editroomModal')
            ); ?>
			
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h4>Edit room</h4>
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
                array('id' => 'deleteroomModal')
            ); ?>
			
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h4>Delete room</h4>
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
	$save_newroom = Yii::app()->createUrl( "Maintenance/saveroom" );
	$edit_room = Yii::app()->createUrl( "Maintenance/Editroom" );
	$view_room = Yii::app()->createUrl( "Maintenance/viewroom" );
	$viewd_room = Yii::app()->createUrl( "Maintenance/viewdroom" );
	$delete_room = Yii::app()->createUrl( "Maintenance/deleteroom" );
	$success = 'success';
	$error = 'error';

	Yii::app()->clientScript->registerScript('room', "

		$(document).ready( function() {
	        $('#room_form').submit( function( e ) {
	            e.preventDefault();
			});
	    });

	    $('#roomModal').on('shown.bs.modal', function(){
	    	$('#room_description').focus();
	    });

		$(document).on('click', '#save_btn', function(){
            $.ajax({
                type        : 'POST', 
                url         : '{$save_newroom}',
                data        : $('#room_form').serialize(),
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $.notify(json.retMessage, json.retVal);
                        $('#room_list').yiiGridView('update', {
				        	data: $(this).serialize()
				        });
				        $( '#room_form' ).each(function(){
						    this.reset();
						});
				        $('#roomModal').modal('hide');
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
              'room' : $(this).attr('ref'),
            }  
			$.ajax({
                type        : 'POST', 
                url         : '{$view_room}',
                data        : values,
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $('#editroomModal .modal-body').html(json.retMessage);
                        $('#editroomModal').modal();
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
                url         : '{$edit_room}',
                data        : $('#room_form_edit').serialize(),
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $.notify(json.retMessage, json.retVal);
                        $('#room_list').yiiGridView('update', {
				        	data: $(this).serialize()
				        });
				        $( '#room_form_edit' ).each(function(){
						    this.reset();
						});
				        $('#roomModal').modal('hide');
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
			'room' : $(this).attr('ref'),
		}
		
			$.ajax({
                type        : 'POST', 
                url         : '{$viewd_room}',
                data        : values,
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $('#deleteroomModal .modal-body').html(json.retMessage);
                        $('#deleteroomModal').modal();
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
                url         : '{$delete_room}',
                data        : $('#room_form_delete').serialize(),
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $.notify(json.retMessage, json.retVal);
                        $('#room_list').yiiGridView('update', {
				        	data: $(this).serialize()
				        });
				        $( '#room_form_delete' ).each(function(){
						    this.reset();
						});
				        $('#deleteroomModal').modal('hide');
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