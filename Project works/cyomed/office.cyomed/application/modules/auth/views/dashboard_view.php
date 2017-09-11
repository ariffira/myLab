<?php if ($this->mod->user_role() >= 9) : ?>
  <div class="col-lg-4 col-xs-8">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>Super-admin</h3>
        <p>Module</p>
      </div>
      <div class="icon">
        <i class="ion ion-home"></i>
      </div>
      <a href="#admin" class="small-box-footer">Access <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div><!-- ./col -->
<?php endif; ?>

<?php if ($this->mod->user_role() >= 2) : ?>
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
      <a href="#chatservice" class="small-box-footer">Access <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div><!-- ./col -->
<?php endif; ?>

<?php if ($this->mod->user_role() >= 2) : ?>
  <div class="col-lg-4 col-xs-8">
    <!-- small box -->
    <div class="small-box bg-maroon">
      <div class="inner">
        <h3>Translate</h3>
        <p>Module</p>
      </div>
      <div class="icon">
        <i class="ion ion-chatbubble-working"></i>
      </div>
      <a href="#translate" class="small-box-footer">Access <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div><!-- ./col -->
<?php endif; ?>

<div class="col-lg-4 col-xs-8">
  <!-- small box -->

  <div class="small-box bg-yellow">
    <div class="inner">
      <h3>Profile</h3>
      <p>Profile settings</p>
    </div>
    <div class="icon">
      <i class="ion ion-person"></i>
    </div>
    <a href="#auth/profile" class="small-box-footer">Change <i class="fa fa-arrow-circle-right"></i></a>
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
    <a href="#auth/change_password" class="small-box-footer">Change <i class="fa fa-arrow-circle-right"></i></a>
  </div>

</div><!-- ./col -->

