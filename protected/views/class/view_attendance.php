<div class="container">
	<div class="page-header">
		<h2><b>View Attendance</b> - <?php echo ($vm->attendance->date != '') ? date("M d, Y", strtotime($vm->attendance->date)) . " (" . date("D", strtotime($vm->attendance->date)) . ")" : null ; ?></h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="alert">
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						<div class="alert alert-info">
							<b>Class : </b><?php echo $vm->attendance->Classes->title; ?><br/>
							<b>Instructor : </b>Mr. / Mrs. <?php echo $vm->attendance->Classes->Instructor->surname; ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						<?php
							$this->renderPartial('_class_students_grid', array(
								'vm' => $vm,
							));
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
    $togglestudentattendance  = Yii::app()->createUrl( "class/togglestudentattendance" );
    $success = 'success';
    $error = 'error';

    Yii::app()->clientScript->registerScript('viewattendance', "

    	$(document).on('click', '.status_student_btn', function(){
    		var id = $(this).attr('ref');

            $.ajax({
                type: 'POST',
                url: '{$togglestudentattendance}',
                data: {'id':id},
                dataType:'json',
                success: function(data){
                    var json = data;

                    if(json.retVal == '{$success}')
                    {
                        $('#class_student_attendance_list').yiiGridView('update', {
                            data: $(this).serialize()
                        });
                    }
                    else if(json.retVal == '{$error}')
                    {
                        $.notify(json.retMessage, json.retVal);
                    }
                }
            });
    	});

	", CClientScript::POS_HEAD);
?>