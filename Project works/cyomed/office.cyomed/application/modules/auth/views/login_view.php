
<div class="login-box">
  <div class="login-logo">
    <img class="" src="<?php echo base_url('/assets/chat/images/favicon.ico');?>" alt="Cyomed">
  </div><!-- /.login-logo -->
  <div class="login-box-body">
  <p class="login-box-msg">Sign in to start your session</p>
    <?php if (isset($error)) : ?>
      <div  id="infoMessage"><?php echo $error; ?></div>
    <?php endif; ?>
    <form class="" method="post" >
      <div class="form-group has-feedback">
        <input class="contact__field form-control" name="email" id="email" type="email" value="<?php echo set_value('email'); ?>" placeholder="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input class="contact__field form-control" id="password" name="password" type="password" value="<?php echo set_value('password'); ?>" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">                           
        </div><!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
        </div><!-- /.col -->
      </div>
    </form>
  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
