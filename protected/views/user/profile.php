<?php
	$form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
			'id' => 'student_form_profile',
			'type' => 'horizontal',
		)
	);
?>
<?php $this->beginWidget(
                'booster.widgets.TbModal',
                array('id' => 'changepass')
            ); ?>
			
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h4>Change Password</h4>
            </div>

            <div class="modal-body">
                <?php
                	$this->renderPartial('_change_pass', array(
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
                        'htmlOptions' => array('id' => 'changepassword'),
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
<?php $this->endWidget(); ?>
<div class="row col-md-offset-5">

	<div class="well col-md-2">
		<center>
		<b>User Profile</b>
		</center>
		<hr>
		<div class="img-container">
		    <img src=<?php echo ($vm->user->profile_pic != '') ? $vm->user->profile_pic : "./images/user.png" ?> alt="" height="90" width="90" class="" id="profile_pic">
		    <?php echo $form->hiddenField($vm->user,'profile_pic',array('class'=>'input-style', 'id'=>'img_uri')); ?>
		    <label class="btn btn-primary btn-lg btn-block">
	            Browse&hellip; <input type="file" id="file" style="display: none;">
	        </label>
		</div>
	</div>
</div>
<br />
<div class="row col-sm-offset-2 well col-sm-8">>

	<div class="col-sm-offset-2 col-sm-3">
			<?php
			Echo 'UserName:     ';	
			$this->widget(
				'booster.widgets.TbEditableField',
				array(
					'type' => 'text',
					'model' => $vm->user,
					'attribute' => 'username', // $model->name will be editable
					'url' => Yii::app()->createUrl( "maintenance/saveusername" ),
				)
			);
			echo '</br>';
			Echo 'Email:     ';	
			$this->widget(
				'booster.widgets.TbEditableField',
				array(
					'type' => 'text',
					'model' => $vm->user,
					'attribute' => 'email', // $model->name will be editable
					'url' => Yii::app()->createUrl( "maintenance/saveusername" ),
				)
			);	
			echo '</br>';
			Echo 'Contact No:     ';	
			$this->widget(
				'booster.widgets.TbEditableField',
				array(
					'type' => 'text',
					'model' => $vm->user,
					'attribute' => 'contact_no', // $model->name will be editable
					'url' => Yii::app()->createUrl( "maintenance/saveusername" ),
				)
			);
			?>
	</div>
		<div class="col-sm-offset-1 col-sm-3">
			<?php
			Echo 'First Name:     ';	
			$this->widget(
				'booster.widgets.TbEditableField',
				array(
					'type' => 'text',
					'model' => $vm->user,
					'attribute' => 'firstname', // $model->name will be editable
					'url' => Yii::app()->createUrl( "maintenance/saveusername" ),
				)
			);
			Echo '</br>';
			Echo 'Middle Name:     ';	
			$this->widget(
				'booster.widgets.TbEditableField',
				array(
					'type' => 'text',
					'model' => $vm->user,
					'attribute' => 'middlename', // $model->name will be editable
					'url' => Yii::app()->createUrl( "maintenance/saveusername" ),
				)
			);
			Echo '</br>';
			Echo 'Last Name:     ';	
			$this->widget(
				'booster.widgets.TbEditableField',
				array(
					'type' => 'text',
					'model' => $vm->user,
					'attribute' => 'surname', // $model->name will be editable
					'url' => Yii::app()->createUrl( "maintenance/saveusername" ),
				)
			);
			?>
	</div>
	
	<div class="col-sm-offset-2 col-sm-6">
	</br>

	<div class="col-sm-12">
            		<?php $this->widget(
            		    'booster.widgets.TbButton',
            		    array(
            		        'label' => 'Change Password',
            		        'context' => 'primary',
            		        'icon' => 'fa fa-lock',
							
            		        'htmlOptions' => array(
            		            'class'=> 'btn btn-primary btn-lg btn-block',
								'data-toggle' => 'modal',
            		            'data-target' => '#changepass',
            		        ),
            		    )
            		); ?>
            	</div>
	</div>
</div>
<?php $this->endWidget(); ?>
 <?php
	$save_student = Yii::app()->createUrl( "user/savestudent" );
	$edit_student = Yii::app()->createUrl( "maintenance/ChangePassword" );
    $view_student = Yii::app()->createUrl( "user/viewstudent" );
	$success = 'success';
	$error = 'error';

	Yii::app()->clientScript->registerScript('student', "

		$(document).ready( function() {
	        $('#student_form').submit( function( e ) {
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

	    $('#studentModal').on('shown.bs.modal', function(){
	    	$('#User_username').focus();
	    });

		$(document).on('click', '#changepassword', function(){
            $.ajax({
                type        : 'POST', 
                url         : '{$edit_student}',
                data        : $('#student_form_profile').serialize(),
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $.notify(json.retMessage, json.retVal);
				        $('#changepass').modal('hide');
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
              'student' : $(this).attr('ref'),
            }

            $.ajax({
                type        : 'POST', 
                url         : '{$view_student}',
                data        : values,
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $('#viewStudentModal .modal-body').html(json.retMessage);
                        $('#viewStudentModal').modal();
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