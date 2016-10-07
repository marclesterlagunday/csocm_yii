<?php
	$form = $this->beginWidget(
		'booster.widgets.TbActiveForm',
		array(
			'id' => 'student_form_profile',
			'type' => 'horizontal',
		)
	);
?>

<div class="row">

	<div class="col-sm-offset-4">
	
		<div class="img-container">
		    <img src=<?php echo ($vm->user->profile_pic != '') ? $vm->user->profile_pic : "./images/user.png" ?> alt="" height="90" width="90" class="" id="profile_pic">
		    <?php echo $form->hiddenField($vm->user,'profile_pic',array('class'=>'input-style', 'id'=>'img_uri')); ?>
		    <label class="btn btn-primary">
	            Browse&hellip; <input type="file" id="file" style="display: none;">
	        </label>
		</div>
	</div>
</div>
<br />
 <?php echo $form->hiddenField($vm->user,'id'); // hidden target?>
<?php echo $form->textFieldGroup($vm->user, 'username', array(
	'widgetOptions' => array(
		'htmlOptions' => array('autocomplete'=>"off")
	)
)); ?>
<?php echo $form->passwordFieldGroup($vm->user, 'password', array(
	'widgetOptions' => array(
		'htmlOptions' => array('autocomplete'=>"off")
	)
)); ?>
<hr/>
<?php echo $form->textFieldGroup($vm->user, 'firstname', array(
	'widgetOptions' => array(
		'htmlOptions' => array('autocomplete'=>"off")
	)
)); ?>
<?php echo $form->textFieldGroup($vm->user, 'middlename', array(
	'widgetOptions' => array(
		'htmlOptions' => array('autocomplete'=>"off")
	)
)); ?>
<?php echo $form->textFieldGroup($vm->user, 'surname', array(
	'widgetOptions' => array(
		'htmlOptions' => array('autocomplete'=>"off")
	)
)); ?>
<?php echo $form->numberFieldGroup($vm->user, 'age', array(
	'widgetOptions' => array(
		'htmlOptions' => array('autocomplete'=>"off")
	),
	'wrapperHtmlOptions' => array(
		'class' => 'col-sm-3'
	),
)); ?>
<?php echo $form->dropDownListGroup(
	$vm->user,
	'gender',
	array(
		'wrapperHtmlOptions' => array(
			'class' => 'col-sm-5',
		),
		'widgetOptions' => array(
			'data' => array('1'=>'Male', '2'=>'Female'),
			'htmlOptions' => array('prompt'=>'Gender'),
		)
	)
); ?>
<hr/>
<?php echo $form->textFieldGroup($vm->user, 'email', array(
	'widgetOptions' => array(
		'htmlOptions' => array('autocomplete'=>"off")
	),
)); ?>
<?php echo $form->textFieldGroup($vm->user, 'contact_no', array(
	'widgetOptions' => array(
		'htmlOptions' => array('autocomplete'=>"off")
	),
	'wrapperHtmlOptions' => array(
		'class' => 'col-sm-7'
	),
)); ?>            	
<div class="row">
<div class="col-sm-12">

                <?php $this->widget(
                    'booster.widgets.TbButton',
                    array(
                        'context' => 'primary',
                        'label' => 'Save Details',
                        'url' => '#',
                        'htmlOptions' => array('id' => 'save_btn'),
                    )
                ); ?>
				</div>
				</div>
<?php $this->endWidget(); ?>
<?php
	$save_student = Yii::app()->createUrl( "user/savestudent" );
	$edit_student = Yii::app()->createUrl( "user/EditStudent" );
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

		$(document).on('click', '#save_btn', function(){
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