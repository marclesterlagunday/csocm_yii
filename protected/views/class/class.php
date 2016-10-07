<div class="container">
    <div class="row">
        <div class="col-sm-12">
      		<h2>Class Management</h2>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-info">Today's Class - ( <?php echo date("M d, Y"); ?> ) </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?php $this->widget(
                    'booster.widgets.TbButton',
                    array(
                        'label' => 'Add New',
                        'context' => 'primary',
                        'icon' => 'fa fa-plus',
                        'visible' => $vm->visible,
                        'htmlOptions' => array(
                            'data-toggle' => 'modal',
                            'data-target' => '#classModal',
                        ),
                    )
                ); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
            	<?php
            		$this->renderPartial('_class_thumbgroup', array(
            			'vm' => $vm,
            		));
            	?>
            </div>
        </div>
    </div>
</div>

<?php $this->beginWidget(
    'booster.widgets.TbModal',
    array('id' => 'classModal')
); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Create New</h4>
</div>

<div class="modal-body">
    <?php
        $this->renderPartial('_class_form', array(
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

<?php
    $save_class = Yii::app()->createUrl( "class/saveclass" );
    $success = 'success';
    $error = 'error';

    Yii::app()->clientScript->registerScript('class', "

        $(document).on('click', '#save_btn', function(){
            $.ajax({
                type        : 'POST', 
                url         : '{$save_class}',
                data        : $('#class_form').serialize(),
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $.notify(json.retMessage, json.retVal);

                        location.reload();

                        $( '#class_form' ).each(function(){
                            this.reset();
                        });
                        $('#classModal').modal('hide');
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