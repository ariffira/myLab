
<form class="form-horizontal" action="<?php echo site_url('portal/patient/forgot/pass_reset_validation'); ?>" method="post" >
  <div class="form-group">
    <label for="inputemail" class="col-sm-4 control-label">
      Please Give Your Email Id
    </label>
    <div class="col-sm-4">
      <input type="email" class="form-control" name="email" id="email" value="" placeholder="email" required/>
      <p class="help-block">If you forgot email click here 
        <a href="<?php echo site_url('portal/patient/forgot/email_reset'); ?>">
          Forgot email
        </a>
      </p>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-2">
      <button role="button" class="btn btn-success btn-block" type="submit" style="margin-bottom:15px;">Bestätigen</button>
    </div>
    <div class="col-sm-2">
      <button role="button" class="btn btn-danger btn-block" type="reset" style="margin-bottom:15px;">Zurücksetzen</button>
    </div>
  </div>

</form>

