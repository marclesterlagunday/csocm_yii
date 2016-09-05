<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2>Instructor Maintenance</h2>
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
            		            'data-target' => '#instructorModal',
            		        ),
            		    )
            		); ?>
            	</div>
            </div>
            <div class="row">
            	<div class="col-sm-12">
            		<?php
            			$this->renderPartial('_instructor_list', array(
            				'vm'=>$vm,
            			));
            		?>
            	</div>
            </div>

            <?php $this->beginWidget(
                'booster.widgets.TbModal',
                array('id' => 'instructorModal')
            ); ?>

            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h4>Create New</h4>
            </div>

            <div class="modal-body">
                <?php
                	$this->renderPartial('_instructor_form', array(
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
            <?php $this->endWidget(); ?>

            <?php $this->beginWidget(
                'booster.widgets.TbModal',
                array('id' => 'viewInstructorModal')
            ); ?>

            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h4>View Instructor</h4>
            </div>

            <div class="modal-body">
                Loading . . . .
            </div>

            <div class="modal-footer">
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
        </div>
    </div>
</div>


<?php
	$save_instructor = Yii::app()->createUrl( "user/saveinstructor" );
    $view_instructor = Yii::app()->createUrl( "user/viewinstructor" );
	$success = 'success';
	$error = 'error';

	Yii::app()->clientScript->registerScript('instructor', "

		$(document).ready( function() {
	        $('#instructor_form').submit( function( e ) {
	            e.preventDefault();
			});
	    });

        $(document).on('change','#file',function() {
          var preview = document.querySelector('#profile_pic');
          var file    = document.querySelector('#file').files[0];
          var reader  = new FileReader();

          reader.addEventListener('load', function () {
            preview.src = reader.result;
            $('#img_uri').val(preview.src);
          }, false);

          if (file) {
            reader.readAsDataURL(file);
          }
        });

	    $('#instructorModal').on('shown.bs.modal', function(){
	    	$('#User_username').focus();
	    });

		$(document).on('click', '#save_btn', function(){
            $.ajax({
                type        : 'POST', 
                url         : '{$save_instructor}',
                data        : $('#instructor_form').serialize(),
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $.notify(json.retMessage, json.retVal);
                        $('#instructor_list').yiiGridView('update', {
				        	data: $(this).serialize()
				        });
				        $( '#instructor_form' ).each(function(){
						    this.reset();
						});
				        $('#instructorModal').modal('hide');
                    }
                    else if(json.retVal == '{$error}')
                    {
                        $.notify(json.retMessage, json.retVal);
                    }
                }
            })
        });

        $(document).on('click', '.view_btn', function(){
            var values = {
              'instructor' : $(this).attr('ref'),
            }

            $.ajax({
                type        : 'POST', 
                url         : '{$view_instructor}',
                data        : values,
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $('#viewInstructorModal .modal-body').html(json.retMessage);
                        $('#viewInstructorModal').modal();
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