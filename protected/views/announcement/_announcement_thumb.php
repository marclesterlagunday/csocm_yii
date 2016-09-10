<div class="container">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4><i class="fa fa-calendar"></i> <?php echo date('M j, Y h:i a', strtotime($data->posted_date_time)); ?> - <?php echo $data->Classes->title; ?></h4>
      </div>
      <div class="panel-body">
        <h3><strong><?php echo $data->title ; ?></strong></h3>
        <br/>
        <p><?php echo $data->message ; ?></p>
      </div>
      <div class="panel-footer">
            <div class="text-right"><strong>Posted by: <?php echo $data->User->username; ?> </strong> </div> 
      </div>
    </div>
</div>

