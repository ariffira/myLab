
<div class="row">
  <div class="col-sm-12 col-xs-12">

    <!-- <div class="page-header">
      <h1 class="text-center"><span class="icomoon i-profile"></span> Patienten-Login</h1>
    </div> -->

    <div class="row">
      <div class="col-md-offset-4 col-md-4 alert alert-info text-center">
        Noch nicht registriert? <a href="<?php echo site_url('portal/both/register/page?p'); ?>" style="margin-left:15px;"><strong>Hier registrieren.</strong></a>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        &nbsp;
      </div>
    </div>

    <form class="form-horizontal" action="<?php echo site_url('portal/patient/login/page/post'.(isset($r) && isset($c) && $r && $c ? ('?r='.rawurlencode($r).'&c='.rawurlencode($c)) : '')); ?>" method="post" enctype="application/x-www-form-urlencoded">

      <div class="form-group">
        <label for="inputEmail" class="col-sm-4 control-label">
           <span  class="icomoon i-envelop"></span>
           E-Mail-Adresse</label>
        <div class="col-sm-4">
          <input type="email" class="form-control" name="email" id="inputEmail" value="<?php echo set_value('email'); ?>" placeholder="E-Mail-Adresse" required/>
          <p class="help-block">Ich habe meinen Login-Namen / E-Mail-Adresse <a href="<?php echo site_url('portal/patient/forgot/email_reset'); ?>">vergessen</a></p>
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword" class="col-sm-4 control-label">
          <span  class="icomoon  i-lock-3"></span>
          Passwort
        </label>
        <div class="col-sm-4">
          <input type="password" class="form-control" name="password" id="inputPassword" value="<?php echo set_value('password'); ?>" placeholder="Passwort" required/>
          <p class="help-block">Ich habe mein Passwort <a href="<?php echo site_url('portal/patient/forgot/pass_reset'); ?>">vergessen</a></p>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-4">
          <div class="checkbox">
           <label>
            <input type="checkbox"> Angemeldet bleiben
           </label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-2">
          <button role="button" class="btn btn-success btn-block" type="submit" style="margin-bottom:15px;">Anmelden</button>
        </div>
        <div class="col-sm-2">
          <button role="button" class="btn btn-danger btn-block" type="reset" style="margin-bottom:15px;">Zurücksetzen</button>
        </div>
      </div>
    </form>
  </div>
  <!-- <div class="col-sm-6 col-xs-12">
    <h4><em>Haben Sie noch Fragen?</em></h4>
    <p>Wir sind 24 Stunden kostenfrei für Sie erreichbar:</p>
    <a href="tel:012010203012"><span class="icomoon i-phone-4"></span> xxx / xxx xxx xxx</a>
  </div> -->
</div>