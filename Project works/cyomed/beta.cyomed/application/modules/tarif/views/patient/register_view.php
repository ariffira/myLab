
<div class="row" style="padding-top:10px;">
  <div class="col-md-8 col-md-offset-2">
    <!-- <h1 class="pull-left">Patienten registrieren sich hier <span class="icomoon i-profile"></span></h1> -->
    <div class="alert alert-info pull-right">Sind Sie bereits registriert? <a href="<?php echo site_url('portal/both/login/page?p'); ?>"><strong>Hier einloggen.</strong></a></div>
  </div>
</div>

<?php $alert = isset($alert) && $alert ? $alert : $this->session->flashdata('page_alert'); ?>

<?php if (is_string($alert) && $alert) : $alert = array('text' => $alert, ); endif; ?>

<?php if (is_array($alert)) : ?>
  <?php foreach ($alert as $key => $value) : ?>
    <?php if (!is_numeric($key)) : $value = $alert; endif; ?>
    <div class="<?php echo isset($value['class']) && $value['class'] ? $value['class'] : 'alert alert-danger'; ?>">
      <?php echo isset($value['text']) && $value['text'] ? $value['text'] : 'Fehler aufgetreten.'; ?>
    </div>
    <?php if (!is_numeric($key)) : break; endif; ?>
  <?php endforeach; ?>
<?php endif; ?>

<form class="form-horizontal" role="form" id="registrationForm" action="<?php echo site_url('portal/patient/register/page/post'.(isset($r) && isset($c) && $r && $c ? ('?r='.rawurlencode($r).'&c='.rawurlencode($c)) : '')); ?>" method="post" enctype="application/x-www-form-urlencoded">

  <div class="row m-b-20">
    <div class="col-md-4 col-md-offset-2">

      <!-- Email -->
      <div class="form-group">
        <label for="inputEmail" class="col-sm-4 control-label">E-Mail-Adresse <span class="text-danger">*</span></label>
        <div class="col-sm-8">
          <input type="email" class="form-control" name="email" id="inputEmail" value="<?php echo set_value('email'); ?>" placeholder="E-Mail-Adresse" required />
        </div>
      </div>

      <!-- First Name -->
      <div class="form-group">
        <label for="inputFirstName" class="col-sm-4 control-label">Vorname <span class="text-danger">*</span></label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name="first_name" id="inputFirstName" value="<?php echo set_value('first_name'); ?>" placeholder="Vorname" required />
        </div>
      </div>

      <!-- Last Name -->
      <div class="form-group">
        <label for="inputLastName" class="col-sm-4 control-label">Nachname <span class="text-danger">*</span></label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name="last_name" id="inputLastName" value="<?php echo set_value('last_name'); ?>" placeholder="Nachname" required />
        </div>
      </div>

      <!-- Gender -->
      <div class="form-group">
        <label for="inputGender" class="col-sm-4 control-label">Geschlecht <span class="text-danger">*</span></label>
        <div class="col-sm-8">
          <select class="select" name="gender" id="inputGender">
            <option value="1" <?php echo set_select('gender', '1'); ?> >Weiblich</option>
            <option value="2" <?php echo set_select('gender', '2'); ?> >Männlich</option>
          </select>
        </div>
      </div>

      <!-- Birthday -->
      <div class="form-group">
        <label for="inputBirthday" class="col-sm-4 control-label">Geburtstag <span class="text-danger">*</span></label>
        <div class="col-sm-8">
          <input type="text" class="form-control date-picker" name="birthday" id="inputBirthday" value="<?php echo set_value('birthday'); ?>" placeholder="Geburtstag" required />
        </div>
      </div>

      <!-- Password -->
      <div class="form-group">
        <label for="inputPassword" class="col-sm-4 control-label">Passwort <span class="text-danger">*</span></label>
        <div class="col-sm-8">
          <input type="password" class="form-control" name="password" id="inputPassword" value="<?php echo set_value('password'); ?>" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers." required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Passwort" required />
        </div>
      </div>

      <!-- Password repeat -->
      <div class="form-group">
        <label for="inputPassword2" class="col-sm-4 control-label">Passwort wiederholen <span class="text-danger">*</span></label>
        <div class="col-sm-8">
          <input type="password" class="form-control" name="password2" id="inputPassword2" title="Please enter the same Password as above." required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Passwort wiederholen" required />
        </div>
      </div>

    </div>
    <div class="col-md-4">
      <!-- Mobile -->
      <div class="form-group">
        <label for="inputMobile" class="col-sm-4 control-label">Handynummer</label>
        <div class="col-sm-8">
          <input type="tel" class="form-control" name="mobile" value="<?php echo set_value('mobile'); ?>" id="inputMobile" placeholder="Handynummer">
        </div>
      </div>

      <!-- Telephone -->
      <div class="form-group">
        <label for="inputTelephone" class="col-sm-4 control-label">Telefonnummer</label>
        <div class="col-sm-8">
          <input type="tel" class="form-control" name="telephone" value="<?php echo set_value('telephone'); ?>" id="inputTelephone" placeholder="Telefonnummer">
        </div>
      </div>

      <!-- Fax -->
      <div class="form-group">
        <label for="inputFax" class="col-sm-4 control-label">Faxnummer</label>
        <div class="col-sm-8">
          <input type="tel" class="form-control" name="fax" value="<?php echo set_value('fax'); ?>" id="inputFax" placeholder="Faxnummer">
        </div>
      </div>

      <!-- Street -->
      <div class="form-group">
        <label for="inputStreet" class="col-sm-4 control-label">Straße und Hausnummer</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name="street" value="<?php echo set_value('street'); ?>" id="inputStreet" placeholder="Straße und Hausnummer">
        </div>
      </div>
      <div class="form-group">
        <label for="inputStreetAdditional" class="col-sm-4 control-label">Adresszusatz</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name="street_additional" value="<?php echo set_value('street_additional'); ?>" id="inputStreetAdditional" placeholder="Adresszusatz">
        </div>
      </div>

      <!-- Postal code -->
      <div class="form-group">
        <label for="inputPostalCode" class="col-sm-4 control-label">PLZ</label>
        <div class="col-sm-8">
          <input type="number" class="form-control" name="postal_code" value="<?php echo set_value('postal_code'); ?>" id="inputPostalCode" placeholder="PLZ">
        </div>
      </div>

      <!-- Locality -->
      <div class="form-group">
        <label for="inputLocality" class="col-sm-4 control-label">Stadt</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name="locality" value="<?php echo set_value('locality'); ?>" id="inputLocality" placeholder="Stadt">
        </div>
      </div>

      <!-- Region -->
      <div class="form-group">
        <label for="inputRegion" class="col-sm-4 control-label">Region</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name="region" value="<?php echo set_value('region'); ?>" id="inputRegion" placeholder="Region">
        </div>
      </div>

      <!-- Country -->
      <div class="form-group">
        <label for="inputCountry" class="col-sm-4 control-label">Land</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name="country" value="<?php echo set_value('country'); ?>" id="inputCountry" placeholder="Land">
        </div>
      </div>

    </div>
  </div>

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="tile">
        <div class="tile-title">
          Kostenlose Registrierung für das IhrArzt24 / Cyomed Gesundheitsportal
        </div>
        <div class="p-10">
          <div class="row">
            <div class="col-md-6">
              <h5>IhrArzt24 / Cyomed - Servicevertrag</h5>
              <div class="help-block">
                <!-- Button trigger modal -->
                <button type="button" role="button" class="btn btn-danger" <?php echo $this->moterm->modal_attr('serviceContractPatient'); ?> >
                  Klicken Sie hier
                </button>
              </div>
            </div>
            <div class="col-md-6">
              <h5>IhrArzt24 / Cyomed - Datenschutz Einwilligungserklärung</h5>
              <div class="help-block">
                <!-- Button trigger modal -->
                <button type="button" role="button" class="btn btn-danger" <?php echo $this->moterm->modal_attr('privacyPatient'); ?> >
                  Klicken Sie hier
                </button>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="checkbox">
                <label>
                  <span class="text-danger">*</span>
                  <input type="checkbox" name="terms" value="1" <?php echo set_checkbox('terms', '1'); ?> > Ich stimme den Regelungen des IhrArzt24 / Cyomed-Servicevertrages zu und willige in die Erhebung, Verarbeitung und Nutzung meiner personenbezogenen Daten einschließlich der von mir bestimmten Gesundheitsdaten, also auch besonderer Arten personenbezogener Daten gemäß § 3 Abs. 9 BDSG, gemäß der Einwilligungserklärung ein.
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="form-group">
        <p class="help-block col-sm-12 p-l-20"><span class="text-danger">* notwendige Angabe</span></p>
        <div class="col-sm-offset-4 col-sm-2">
          <button role="button" class="btn btn-success btn-block" type="submit" style="margin-bottom:15px;">Anmelden</button>
        </div>
        <div class="col-sm-2">
          <button role="button" class="btn btn-danger btn-block" type="reset" style="margin-bottom:15px;">Zurücksetzen</button>
        </div>
      </div>
    </div>
  </div>

</form>