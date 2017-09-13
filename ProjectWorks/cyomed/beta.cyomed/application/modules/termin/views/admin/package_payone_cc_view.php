
<div class="row">
  <div class="col-md-12">
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
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Rechnungen</h3>
      </div>
      <div class="panel-body">
        <form class="form-horizontal" id="rechnungForm" role="form" method="post" enctype="application/x-www-form-urlencoded">

          <fieldset>
            <div class="row">
              <div class="col-md-12">
                <h3>Einzelheiten zur Bezahlung</h3>
                <div class="form-group">
                  <label for="inputCardholder" class="col-sm-2 control-label">Cardholder <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputCardholder" name="cardholder" value="<?php echo $this->mod->user_value('abc'); ?>" placeholder="Cardholder" required />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputCardPAN" class="col-sm-2 control-label">Card PAN <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputCardPAN" name="cardpan" value="<?php echo $this->mod->user_value('abc'); ?>" placeholder="Card PAN" required />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputCardType" class="col-sm-2 control-label">Card Type <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputCardType" name="cardtype" value="<?php echo $this->mod->user_value('abc'); ?>" placeholder="Card Type" required />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputExpireMonth" class="col-sm-2 control-label">Expire Month <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputExpireMonth" name="expiremonth" value="<?php echo $this->mod->user_value('abc'); ?>" placeholder="Expire Month" required />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputExpireYear" class="col-sm-2 control-label">Expire Year <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputExpireYear" name="expireyear" value="<?php echo $this->mod->user_value('abc'); ?>" placeholder="Expire Year" required />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputCardCVC2" class="col-sm-2 control-label">Card CVC2 <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputCardCVC2" name="cardcvc2" value="<?php echo $this->mod->user_value('abc'); ?>" placeholder="Card CVC2" required />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputAgreeDirectDebit" class="col-sm-2 control-label">Einzugsermächtigung</label>
                  <div class="col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="1" id="inputAgreeDirectDebit" name="agree_direct_debit" required />
                        Mit der Buchung eines kostenpflichtigen Services ermächtigen ich die IhrArzt24 GmbH widerruflich, die von mir geschuldeten Zahlungen bei Fälligkeit zu Lasten meines Kontos durch Lastschrift einzuziehen. SEPA-Lastschriftmandat:IhrArzt24 GmbH , Luisenstrasse 114, 40215 Düsseldorf Gläubiger-Identifikationsnummer DE69ZZZ00000895492 Mandatsreferenz (Ihre ID)Ich ermächtige die IhrArzt24 GmbH, Zahlungen von meinem Konto mittels Lastschrift einzuziehen. Zugleich weise ich mein Kreditinstitut an, die von der Muster GmbH auf mein Konto gezogenen Lastschriften einzulösen.Hinweis: Ich kann innerhalb von acht Wochen, beginnend mit dem Belastungsdatum, die Erstattung des belasteten Betrages verlangen. Es gelten dabei die mit meinem Kreditinstitut vereinbarten Bedingungen.
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputAgreeCancellation" class="col-sm-2 control-label">Wiederrufsbelehrung</label>
                  <div class="col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="1" id="inputAgreeCancellation" name="agree_cancellation" required />
                        <strong> Widerrufsrecht </strong><br/>
                        Sie können Ihre Vertragserklärung innerhalb von 14 Tagen ohne Angabe von Gründen in Textform (z.B. E-Mail, Brief, FAX) widerrufen.Die frist beginnt bei Erhalt dieser Belehrung in Textform. Zur Wahrung der Frist genügt die rechtzeitige Absendung des Widerrufs. Der Widerruf ist zu richten an: IhrArzt24 GmbH, Rheindorfer Weg 4, 40591 Düsseldorf oder an Kundenservice@ihrarzt24.de.<br>
                        <strong>Besondere Hinweise</strong><br/>
                        Ihr Widerrufsrecht erlischt vorzeitig, wenn der Vertrag von beiden Seiten auf ihren ausdrücklichen Wunsch vollständig erfüllt ist, bevor Sie Ihr Widerrufsrecht ausgeübt haben.<br>Ihre IhrArzt24 GmbH.
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputAgreeRunningTime" class="col-sm-2 control-label">Mindestvetragslaufzeit</label>
                  <div class="col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="1" id="inputAgreeRunningTime" name="agree_running_time" required />
                        Zahlungspflichtigen Vertrag schließen. Mindestvetragslaufzeit 1 Monat
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <h3>Rechnungsadresse</h3>
                <div class="form-group">
                  <label for="inputTitle" class="col-sm-2 control-label">Titel</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="inputTitle" name="title" value="<?php echo $this->mod->user_value('payment_title'); ?>" placeholder="Titel" />
                  </div>
                  <label for="inputGender" class="col-sm-1 control-label">Geschlecht</label>
                  <div class="col-sm-5">
                    <select class="form-control" id="inputGender" name="gender">
                      <option value="1" <?php echo $this->mod->user_select('payment_gender', '1'); ?> >Weiblich</option>
                      <option value="2" <?php echo $this->mod->user_select('payment_gender', '2'); ?> >Männlich</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputFirstName" class="col-sm-2 control-label">Vorname <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputFirstName" name="first_name" value="<?php echo $this->mod->user_value('payment_first_name'); ?>" placeholder="Vorname" required />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputLastName" class="col-sm-2 control-label">Nachname <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputLastName" name="last_name" value="<?php echo $this->mod->user_value('payment_last_name'); ?>" placeholder="Nachname" required />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputStreet" class="col-sm-2 control-label">Straße <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputStreet" name="street" value="<?php echo $this->mod->user_value('payment_street'); ?>" placeholder="Straße" required />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputStreetAdditional" class="col-sm-2 control-label">Adresszusatz</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputStreetAdditional" name="street_additional" value="<?php echo $this->mod->user_value('payment_street_additional'); ?>" placeholder="Adresszusatz">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPostalCode" class="col-sm-2 control-label">PLZ <span class="text-danger">*</span></label>
                  <div class="col-sm-4">
                    <input type="number" class="form-control" id="inputPostalCode" name="postal_code" value="<?php echo $this->mod->user_value('payment_postal_code'); ?>" placeholder="PLZ" required />
                  </div>
                  <label for="inputLocality" class="col-sm-1 control-label">Stadt <span class="text-danger">*</span></label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="inputLocality" name="locality" value="<?php echo $this->mod->user_value('payment_locality'); ?>" placeholder="Stadt" required />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail" name="email" value="<?php echo $this->mod->user_value('payment_email'); ?>" placeholder="Email" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputTelephone" class="col-sm-2 control-label">Telefon</label>
                  <div class="col-sm-10">
                    <input type="tel" class="form-control" id="inputTelephone" name="telephone" value="<?php echo $this->mod->user_value('payment_telephone'); ?>" placeholder="Telefon" />
                  </div>
                </div>
              </div>
            </div>
          </fieldset>

          <hr/>

          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <button type="button" class="btn btn-primary btn-block payone-submit">Gewählt-Modell buchen</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  <?php if (isset($hash)) : ?>
    var payoneHash = "<?php echo $hash; ?>";
  <?php endif; ?>
</script>