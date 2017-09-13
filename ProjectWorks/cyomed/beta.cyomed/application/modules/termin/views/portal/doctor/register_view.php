
<div class="already-registered pull-right">Sind Sie bereits registriert? <a href="<?php echo site_url('portal/doctor/login'); ?>">Hier einloggen.</a></div>
<h1>Registrierung</h1>

<section id="form" class="col-md-6 col-sm-12">
  <form id="booking-form" class="" action="<?php echo site_url('portal/doctor/register/post'); ?>" method="post" enctype="application/x-www-form-urlencoded">
      <div class="form-element form-group" data-error-message="Bitte wählen Sie Ihre Anrede aus.">
        <div id="gender" class="radio-group">
          <h4>Anrede</h4>
          <label for="gender-1" class="radio-inline"><input name="gender" type="radio" id="gender-1" value="1" <?php echo set_radio('gender', '1'); ?> > Frau</label>
          <label for="gender-2" class="radio-inline"><input name="gender" type="radio" id="gender-2" value="2" <?php echo set_radio('gender', '2'); ?> > Herr</label>
        </div>
      </div>
      <div class="form-element form-group" data-error-message="Bitte geben Sie Ihre E-Mail Adresse ein.">
        <label>E-Mail</label>
        <input type="email" name="email" value="<?php echo set_value('email'); ?>" class="form-control input-lg" placeholder="E-Mail" />
      </div>
      <div class="form-element form-group" data-error-message="Bitte geben Sie Ihre E-Mail Adresse ein.">
        <label>Passwort</label>
        <input type="password" name="password" value="" class="form-control input-lg" placeholder="Passwort" />
      </div>
      <div class="form-element form-group" data-error-message="Bitte geben Sie Ihre E-Mail Adresse ein.">
        <label>Passwort wiederholen</label>
        <input type="password" name="password2" value="" class="form-control input-lg" placeholder="Passwort wiederholen" />
      </div>
      <div class="form-element form-group" data-error-message="Bitte geben Sie Ihren Vornamen ein.">
        <label>Titel</label>
        <select class="form-control" name="full_title">
          <option value="Dr." <?php echo set_select('full_title', 'Dr.'); ?> >Dr.</option>
          <option value="Prof." <?php echo set_select('full_title', 'Prof.'); ?> >Prof.</option>
          <option value="Prof. Dr." <?php echo set_select('full_title', 'Prof. Dr.'); ?> >Prof. Dr.</option>
        </select>
      </div>
      <div class="form-element form-group" data-error-message="Bitte geben Sie Ihren Vornamen ein.">
        <label>Vorname</label>
        <input type="text" name="first_name" value="<?php echo set_value('first_name'); ?>" class="form-control input-lg" placeholder="Vorname" />
      </div>
      <div class="form-element form-group" data-error-message="Bitte geben Sie Ihren Nachnamen ein.">
        <label>Nachname</label>
        <input type="text" name="last_name" value="<?php echo set_value('last_name'); ?>" class="form-control input-lg" placeholder="Nachname" />
      </div>
      <div class="form-element form-group" data-error-message="Bitte geben Sie eine gültige Telefonnummer ein.">
        <label>Telefon</label>
        <input type="tel" name="phone" value="<?php echo set_value('phone'); ?>" class="form-control input-lg" placeholder="Telefon" />
      </div>
      <div class="button-wrapper"><button type="submit" class="btn btn-warning">Registrieren</button></div>
  </form>   
</section>

<section id="info-block" class="col-md-6 col-sm-12">
  <div class="orange-bar">
    <div class="datetime"><span class="light">Erstellen Sie Ihr</span> kostenfreies Profil!</div>
  </div>
  <div class="infobox advantages">
    <h4><em>Gute Gründe</em> für Ihre <em>risikofreie Registrierung:</em></h4>
    <ul>
      <li>Lorem ipsum Sed eu deserunt nostrud proident qui laboris dolore tempor labore reprehenderit est laborum Duis.</li>
      <li>Lorem ipsum Ex Duis Ut exercitation culpa laboris commodo cupidatat consequat aliquip ea non commodo pariatur est enim dolor laboris et do.</li>
      <li>Lorem ipsum Nulla incididunt laboris ut proident fugiat in laborum Ut dolore dolore officia sit amet veniam amet.</li>
      <li>Lorem ipsum Deserunt laborum cupidatat cillum in proident incididunt veniam veniam ut sint laboris aliqua amet magna est.</li>
      <li>Lorem ipsum Deserunt Duis sed Duis in aliquip officia commodo est ex ex cillum eiusmod pariatur aute.</li>
    </ul>
  </div>
  <section class="infobox infobox-grey-light cta-phone">
    <h4><em>Haben Sie noch Fragen?</em></h4>
    <p>Wir sind 24 Stunden kostenfrei für Sie erreichbar:</p>
    <a href="tel:012010203012">xxx / xxx xxx xxx</a>
  </section>
</section>