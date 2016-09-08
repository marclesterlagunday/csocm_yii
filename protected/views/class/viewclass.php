<div class="container">
    <div class="row">
        <div class="col-sm-12">
      		<h4 class="alert alert-info"><b>CLASS : </b><?php echo (isset($vm->class)) ? $vm->class->Subject->description : "Null" ; ?> - ( <?php echo (isset($vm->class)) ? date("h:i A", strtotime($vm->class->time_start)) : "Null"; ?> - <?php echo (isset($vm->class)) ? date("h:i A", strtotime($vm->class->time_end)) : "Null"; ?> ) <b> BY : </b>
      		<?php echo (isset($vm->class)) ? ucfirst($vm->class->Instructor->firstname) . " " . ucfirst($vm->class->Instructor->surname) : "Null"; ?></h4>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-8">
    		<h2>Student List</h2>
    	</div>
    	<div class="col-sm-4">
    		<h2>Day Schedule</h2>
    	</div>
    </div>
    <div class="row">
    	<div class="col-sm-8">
    		<div class="well">
    			<?php
	    			$this->renderPartial('_class_student', array(
	    				'vm' => $vm,
	    			));
	    		?>
    		</div>
    	</div>
    	<div class="col-sm-4">
    		<div class="well">
	    		<?php
	    			$this->renderPartial('_class_day', array(
	    				'vm' => $vm,
	    			));
	    		?>
    		</div>
    	</div>
    </div>
</div>