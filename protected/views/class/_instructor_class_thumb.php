<div class="item  col-xs-2 col-lg-2">
    <div class="thumbnail">
        <div class="row">
            <div class="col-xs-12">
                <div class="caption">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <h4 class="group inner list-group-item-heading"><b>
                                <?php echo $data->Subject->description ; ?>
                                <br/>
                                <?php echo "( " . $data->Room->description . " )"; ?>
                            </b></h4>
                            <?php echo date("h:i A", strtotime($data->time_start)); ?> - <?php echo date("h:i A", strtotime($data->time_end)); ?><br/>
                            <?php echo ucfirst($data->Instructor->firstname) . " " . ucfirst($data->Instructor->surname) ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <a class="btn btn-success btn-block" ref=<?php echo $data->class_id; ?> href="<?php echo Yii::app()->createUrl( "class/viewclass&id=" ) . $data->class_id; ?>" >View</a>
            </div>
        </div>
    </div>
</div>