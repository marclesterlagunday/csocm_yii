<div class="container">
	<div class="page-header">
		<h2><b>My Class</b></h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="alert">
				<?php
					$this->renderPartial('_instructorclass_thumbgroup', array(
						'vm' => $vm,
					));
				?>
			</div>
		</div>
	</div>
</div>