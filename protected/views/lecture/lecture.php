<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2>Lecture</h2>
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
                                'data-target' => '#lectureModal',
                            ),
                        )
                    ); ?>
            	</div>
            </div>
            <div class="row">
            	<div class="col-sm-12">
            		<?php
            			$this->renderPartial('_lecture_list', array(
            				'vm'=>$vm,
            			));
            		?>
            	</div>
            </div>

            <?php $this->beginWidget(
                'booster.widgets.TbModal',
                array('id' => 'studentModal')
            ); ?>

            <div class="modal-header">
                <a class="close" dafta-dismiss="modal">&times;</a>
                <h4>Create New</h4>
            </div>

            <div class="modal-body">
                <?php
                    $this->renderPartial('_lecture_form', array(
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
        </div>
    </div>
</div>