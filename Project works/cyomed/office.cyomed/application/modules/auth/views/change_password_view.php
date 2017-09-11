
<div class="login-box">
  <div class="login-logo">
    <img class="" src="<?php echo base_url('/assets/chat/images/favicon.ico');?>" alt="Cyomed">
  </div><!-- /.login-logo -->
  <div class="login-box-body">
  <p class="login-box-msg">Change password</p>
    <?php if (isset($error)) : ?>
      <div  id="infoMessage"><?php echo $error; ?></div>
    <?php endif; ?>
    <form class="" method="post" action="<?php echo site_url('auth/change_password'); ?>" >

      <div class="form-group has-feedback">
        <input class="contact__field form-control" id="password_old" name="password_old" type="password" value="<?php echo set_value('password_old'); ?>" placeholder="Old Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input class="contact__field form-control" id="password" name="password" type="password" value="<?php echo set_value('password'); ?>" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input class="contact__field form-control" id="password2" name="password2" type="password" value="<?php echo set_value('password2'); ?>" placeholder="Repeat Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
        <div class="col-xs-8">                           
        </div><!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Apply</button>
        </div><!-- /.col -->
      </div>
    </form>
  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
