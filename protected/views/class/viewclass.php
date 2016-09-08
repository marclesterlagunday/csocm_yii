<div class="container">
    <div class="row">
        <div class="col-sm-12">
      		<h4 class="alert alert-info"><b>CLASS : </b><?php echo (isset($vm->class)) ? $vm->class->Subject->description : "Null" ; ?> - ( <?php echo (isset($vm->class)) ? date("h:i A", strtotime($vm->class->time_start)) : "Null"; ?> - <?php echo (isset($vm->class)) ? date("h:i A", strtotime($vm->class->time_end)) : "Null"; ?> ) <b> BY : </b>
      		<?php echo (isset($vm->class)) ? ucfirst($vm->class->Instructor->firstname) . " " . ucfirst($vm->class->Instructor->surname) : "Null"; ?> - 
            <?php
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
    <h4>Create New</h4>
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