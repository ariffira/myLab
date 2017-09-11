
<div class="already-registered pull-right">Sie haben noch keinen Patienten-Zugang? <a href="<?php echo site_url('portal/patient/register'); ?>">Hier registrieren.</a></div>
<h1>Patienten-Anmelden</h1>

<section id="form" class="col-md-6 col-sm-12">
  <form id="booking-form" class="" action="<?php echo site_url('portal/patient/login/post'); ?>" method="post" enctype="application/x-www-form-urlencoded">
    <div class="form-element">
      <label>E-Mail-Adresse</label>
      <input type="email" name="email" tabindex="1" value="<?php echo set_value('email'); ?>" autocomplete="off" />
      <a role="button" tabindex="4" href="#">Ich habe meinen Login-Namen / E-Mail-Adresse vergessen</a>
    </div>
    <div class="form-element">
      <label>Passwort</label>
      <input type="password" tabindex="2" name="password" autocomplete="off" />
      <a role="button" tabindex="5" href="#">Ich habe mein Passwort vergessen</a>
    </div>
    <div class="button-wrapper"><input type="submit" tabindex="3" value="Anmelden"></div>
  </form>  

  <form id="forgot-email" class="hidden" action="//www.ihrarzt24.de/aerzte/do_anmelden_vergessen" method="post">
    <div class="form-element">
      <label>Vorname<label>
      <input type="text" name="doctor_name">
    </label></label></div>
    <div class="form-element">
      <label>Nachname<label>
      <input type="text" name="doctor_lname">
    </label></label></div>
    <div class="form-element">
      <label>Praxisname<label>
      <input type="text" name="practice_name">
    </label></label></div>
    <div class="button-wrapper"><input type="submit" value="Login anfordern"></div>
  </form>

  <form id="forgot-password" class="hidden" action="//www.ihrarzt24.de/aerzte/do_passwort_vergessen" method="post">
    <div class="form-element">
      <label>E-Mail-Adresse<label>
      <input type="email" name="email">
    </label></label></div>
    <div class="button-wrapper"><input class="btn_green button large center" id="btn-pw_submit" type="submit" value="Passwort anfordern"></div>
  </form>

</section>

<section id="info-block" class="infobox infobox-grey-light cta-phone col-md-6 col-sm-12">
  <h4><em>Haben Sie noch Fragen?</em></h4>
  <p>Wir sind 24 Stunden kostenfrei für Sie erreichbar:</p>
  <a href="tel:012010203012">xxx / xxx xxx xxx</a>
</section>
