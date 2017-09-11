
<div class="col-lg-4 col-xs-8">
  <!-- small box -->
  <div class="small-box bg-green">
    <div class="inner">
      <h3>Chat-care</h3>
      <p>Module</p>
    </div>
    <div class="icon">
      <i class="ion ion-chatbubble-working"></i>
    </div>
    <a href="#" class="small-box-footer">Access <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div><!-- ./col -->


<div class="col-lg-4 col-xs-8">
  <!-- small box -->

  <div class="small-box bg-red">
    <div class="inner">
      <h3>Change</h3>
      <p>Password</p>
    </div>
    <div class="icon">
      <i class="ion ion-locked"></i>
    </div>
    <?php 
        $url= $this->uri->segment(1);
                        //echo $url;
    ?>
    <a href="#?url=<?php echo $url;?>" class="small-box-footer">Change <i class="fa fa-arrow-circle-right"></i></a>
  </div>

</div><!-- ./col -->

