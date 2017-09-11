<form class="form-horizontal" role="form" id="registrationForm" action="<?php echo site_url('portal/doctor/forgot/new_password'); ?>" method="post">

  <!-- Email -->
  <div class="form-group">
    <label for="inputEmail" class="col-sm-4 control-label">E-Mail-Adresse <span class="text-danger">*</span></label>
    <div class="col-sm-4">
      <input type="email" class="form-control" name="email" id="inputEmail" value="<?php echo set_value('email',$email); ?>" readonly="true" placeholder="E-Mail-Adresse" required />
    </div>
  </div>

<!-- Password Temporary -->
<div class="form-group">
  <label for="inputPassword3" class="col-sm-4 control-label">Passwort Vorübergehend <span class="text-danger">*</span></label>
  <div class="col-sm-4">
    <input type="password" class="form-control" name="password3" id="inputPassword3" title="Please enter the temporary password which sent to your email."  placeholder="Passwort Vorübergehend" required />
  </div>
</div>

<!-- Password New -->
<div class="form-group">
  <label for="inputPassword" class="col-sm-4 control-label">Passwort Neu<span class="text-danger">*</span></label>
  <div class="col-sm-4">
    <input type="password" class="form-control" name="password" id="inputPassword" value="<?php echo set_value('password'); ?>" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers." required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Passwort" required />
  </div>
</div>

<!-- Password repeat -->
<div class="form-group">
  <label for="inputPassword2" class="col-sm-4 control-label">Passwort wiederholen <span class="text-danger">*</span></label>
  <div class="col-sm-4">
    <input type="password" class="form-control" name="password2" id="inputPassword2" title="Please enter the same Password as above." required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Passwort wiederholen" required />
  </div>
</div>


<div class="form-group">
  <div class="col-sm-offset-4 col-sm-2">
  <button role="button" class="btn btn-success btn-block" type="submit" style="margin-bottom:15px;" data-loading-text="Changing Password...">
    Bestätigen
  </button>
  </div>
  <div class="col-sm-2">
  <button role="button" class="btn btn-danger btn-block" type="reset" style="margin-bottom:15px;">
    Zurücksetzen
  </button>
  </div>
</div>

</form>
