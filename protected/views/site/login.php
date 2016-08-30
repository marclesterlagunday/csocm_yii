
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

<header>
	<!-- <div class="header-content"> -->
		<div class="container">
			<div class="row">
				<div class="col-sm-8">
					<div class="left-content">
						<h1>HOME OF THE EXPERTS!</h1>
						<h2>"The whole idea is not about the choice between using or not using technology. 
						The challenge is to use it right."</h2>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="panel panel-primary">
						<div class="panel-heading">
						    <h3 class="panel-title">Login</h3>
						</div>
						<div class="panel-body">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
								<?php echo $form->textField($model,'username', array('tabindex'=>'1', 'class'=>'form-control', 'placeholder'=>'Username', 'value'=>'')); ?>
								<?php //echo $form->error($model,'username'); ?>
							</div>
						<br>
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock"></i></span>
								<?php echo $form->passwordField($model,'password', array('tabindex'=>'2', 'class'=>'form-control', 'placeholder'=>'Password', 'value'=>'')); ?>
								<?php //echo $form->error($model,'password'); ?>
							</div>
						<br>

						<?php echo $form->checkBox($model,'rememberMe', array('tabindex'=>'3')); ?> Remember me
						<br>
						<br>

						<?php echo CHtml::submitButton('Login', array('tabindex'=>'4', 'class'=>'form-control btn btn-primary', 'value'=>'Log In')); ?>
						</div>
						<div class="panel-footer text-right">Sign up?</div>
					</div>
				</div>
				

			</div>
		</div>
	<!-- </div> -->
</header>
<?php $this->endWidget(); ?>






