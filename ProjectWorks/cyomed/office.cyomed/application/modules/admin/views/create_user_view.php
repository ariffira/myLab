<div class="register-box">
<div class="register-logo">
    <img class="" src="<?php echo base_url('/assets/chat/images/favicon.ico');?>" alt="Cyomed">
  </div><!-- /.login-logo -->
      <div class="register-box-body">
        <p class="login-box-msg">Register a new membership</p>
        <?php if (isset($error)) : ?>
          <div  id="infoMessage"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="<?php echo site_url('admin/create_user')?>" method="post">
          <div class="form-group has-feedback">
            <input name="first_name" id="first_name" type="text" class="form-control" placeholder="First name"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input name="last_name" id="last_name" type="text" class="form-control" placeholder="Last name"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input name="email" id="email" type="email" class="form-control" placeholder="Email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password2" id="password2" class="form-control" placeholder="Retype password"/>
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <select name="role" id="role" class="form-control" title="select Role">
              <option value='0'>Select Admin Role</option>
              <option value='9'>Superadmin</option>
              <option value='2'>Chat Care Service</option>
            </select>
            
          </div>
          <div class="row">
            <div class="col-xs-8">    
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> I agree to the <a href="#">terms</a>
                </label>
              </div>                        
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Create User</button>
            </div><!-- /.col -->
          </div>
        </form>        
      </div><!-- /.form-box -->
    </div><!-- /.register-box -->