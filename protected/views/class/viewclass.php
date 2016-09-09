<div class="container">
    <div class="row">
        <div class="col-sm-12">
      		<h4 class="alert alert-info"><b>CLASS : </b><?php echo (isset($vm->class)) ? $vm->class->Subject->description : "Null" ; ?> - ( <?php echo (isset($vm->class)) ? date("h:i A", strtotime($vm->class->time_start)) : "Null"; ?> - <?php echo (isset($vm->class)) ? date("h:i A", strtotime($vm->class->time_end)) : "Null"; ?> ) <b> BY : </b>
      		<?php echo (isset($vm->class)) ? ucfirst($vm->class->Instructor->firstname) . " " . ucfirst($vm->class->Instructor->surname) : "Null"; ?> - 
            <?php
                if(isset($vm->class_day))
                {
                    if(count($vm->class_day) > 0)
                    {
                        $counter = 0;
                        foreach($vm->class_day as $class_day)
                        {
                            $counter++;

                            echo $class_day->Day->description;

                            if(count($vm->class_day) != $counter)
                            {
                                echo " / ";
                            }
                        }
                    }
                }
            ?>
            </h4>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-8">
    		<h2>Student List</h2>
    	</div>
    	<div class="col-sm-4">
    		<h2>Lectures</h2>
    	</div>
    </div>
    <div class="row">
    	<div class="col-sm-8">
    		<div class="well">
                <?php $this->widget(
                    'booster.widgets.TbButton',
                    array(
                        'label' => 'Add Student',
                        'context' => 'primary',
                        'icon' => 'fa fa-plus',
                        'htmlOptions' => array(
                            'data-toggle' => 'modal',
                            'data-target' => '#classStudentModal',
                        ),
                    )
                ); ?>
                <br/>
    			<?php
	    			$this->renderPartial('_class_student', array(
	    				'vm' => $vm,
	    			));
	    		?>
    		</div>
    	</div>
    	<div class="col-sm-4">
    		<div class="well">
	    		
    		</div>
    	</div>
    </div>
</div>

<?php $this->beginWidget(
    'booster.widgets.TbModal',
    array('id' => 'classStudentModal')
); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Add Students</h4>
</div>

<div class="modal-body">
    <?php
        $this->renderPartial('_class_student_form', array(
            'vm'=>$vm,
        ));
    ?>
</div>

<div class="modal-footer">
    <?php $this->widget(
        'booster.widgets.TbButton',
        array(
            'label' => 'Cancel',
            'url' => '#',
            'htmlOptions' => array('data-dismiss' => 'modal', 'class' => 'close_btn'),
        )
    ); ?>
</div>
<?php $this->endWidget(); ?>

<?php
    $savestudentsclass  = Yii::app()->createUrl( "class/savestudentsclass" );
    $success = 'success';
    $error = 'error';
    $id = $_GET["id"];

    Yii::app()->clientScript->registerScript('classstudent', " 

        function saveStudentsClass(values)
        {
            $.ajax({
                type: 'POST',
                url: '{$savestudentsclass}',
                data: {'students':values, 'id': {$id}},
                dataType:'json',
                success: function(data){
                    var json = data;

                    if(json.retVal == '{$success}')
                    {
                        $('#class_student_list').yiiGridView('update', {
                            data: $(this).serialize()
                        });
                        $('#classStudentModal').modal('hide');
                        $.notify('Successfully Added', json.retVal);
                    }
                    else if(json.retVal == '{$error}')
                    {
                        $('#class_student_list').yiiGridView('update', {
                            data: $(this).serialize()
                        });
                        $.notify(json.retMessage, json.retVal);
                        $('#classStudentModal').modal('hide');
                    }
                }
            });
        }

    ", CClientScript::POS_HEAD);
?>