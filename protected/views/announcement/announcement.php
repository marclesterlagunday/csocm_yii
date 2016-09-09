<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2>Post Announcement</h2>
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
                                'data-target' => '#announcementModal',
                            ),
                        )
                    ); ?>
            	</div>
            </div>
            <div class="row">
            	<div class="col-sm-12">
            		<?php
                        $this->renderPartial('_announcement_thumbgroup', array(
                            'vm' => $vm,
                    ));
                ?>
            	</div>
            </div>

            <?php $this->beginWidget(
                'booster.widgets.TbModal',
                array('id' => 'announcementModal')
            ); ?>

            <div class="modal-header">
                <a class="close" dafta-dismiss="modal">&times;</a>
                <h4>Post Announcement</h4>
            </div>

            <div class="modal-body">
                <?php
                    $this->renderPartial('_announcement_form', array(
                        'vm' => $vm,
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

<?php
    $save_announcement = Yii::app()->createUrl( "announcement/store" );
    $success = 'success';
    $error = 'error';

    Yii::app()->clientScript->registerScript('announcement', "

        $(document).on('click', '#save_btn', function(){
            $.ajax({
                type        : 'POST', 
                url         : '{$save_announcement}',
                data        : $('#announcement_form').serialize(),
                cache       : false,
                success     : function( data ) {
                    var json = $.parseJSON( data );

                    if(json.retVal == '{$success}')
                    {
                        $.notify(json.retMessage, json.retVal);

                        location.reload();

                        $( '#announcement_form' ).each(function(){
                            this.reset();
                        });
                        $('#announcementModal').modal('hide');
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