<?php if (isset($alert)) : ?>
  <div class="row">
    <div class="col-md-12">
      <div class="<?php echo is_object($alert) && isset($alert->base) ? $alert->base : 'alert'; ?> <?php echo is_object($alert) && isset($alert->base) ? $alert->base : 'alert'; ?>-<?php echo is_object($alert) && isset($alert->type) ? $alert->type : 'warning'; ?> <?php echo is_object($alert) && isset($alert->class) ? $alert->class : 'warning'; ?>">
        <?php echo is_object($alert) && isset($alert->text) ? $alert->text : (is_string($alert) ? $alert : ''); ?>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php $this->lang->load('package', 'german'); ?>

<?php $this_is_default = ($package->name == 'free'); ?>

<div class="row">

  <div class="col-md-6" id="info-block">
    <div class="bs-callout bs-callout-danger">
      <h4 class="h2">Ihre Tarifwahl</h4>
      <div class="alert alert-danger termin-timebar" role="alert">
        <div class="h4">
          <span class="light pull-right"><?php echo $package->intro_top_right; ?></span>
          <strong><?php echo $this->lang->line('package_'.$package->name) ? $this->lang->line('package_'.$package->name) : ''; ?></strong>          
        </div>
      </div>
      <ul class="media-list">
        <li class="media">
          <?php if (isset($package->avatar) && $package->avatar) : ?>
            <a class="pull-left thumbnail col-md-4" href="#">
              <img src="<?php echo $package->avatar; ?>" alt="<?php echo $this->lang->line('package_'.$package->name) ? $this->lang->line('package_'.$package->name) : ''; ?>">
            </a>
          <?php endif; ?>          
          <div class="media-body">
            <h5 class="media-heading">
              <div class="conjunction">Tarif</div>
              <div class="name h3" style="margin-top:0;"><?php echo $this->lang->line('package_'.$package->name) ? $this->lang->line('package_'.$package->name) : ''; ?></div>
            </h5>
            <p></p>
            <div class="bs-callout bs-callout-info">
              <div class="media">
                <div class="media-body">
                  <h4 class="media-heading">INTRO</h4>
                  <div class="name">
                    <div class="row">
                      <div class="col-md-offset-2 col-md-8">
                        <?php echo $package->intro; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>
      <ul class="comfort-elements">
        <li class="cancelation">Sollten sich Ihre Pläne ändern, können Sie den Termin jederzeit stornieren.</li>
        <li class="contact">Unser Supportteam erreichen Sie kostenfrei unter <a href="tel:0211 / 972 64 094">0211 / 972 64 094</a></li>
      </ul>
    </div>
  </div>

  <div class="col-md-6" id="form">
    <div class="bs-callout bs-callout-<?php echo isset($type_right) ? $type_right: 'info'; ?>">
      <h4><?php echo isset($title_right) ? $title_right: 'Ihre Angaben'; ?></h4>
      
      <form id="choose-package-form" class="" action="<?php echo site_url('admin/package/post/'.(isset($package->name) ? $package->name : '').'/'.(isset($method) ? $method : '')); ?>" method="post" enctype="application/x-www-form-urlencoded" >

        <input type="hidden" name="package" value="<?php echo $package->name; ?>" />

        <div class="row" style="margin-bottom:10px;">
          <div class="col-md-12">
            <ul class="nav nav-pills" role="tablist" id="tablistChangePackage">
              <li class="active">
                <a href="#tabPayment" role="tab" data-toggle="tab">Bezahlung</a>
              </li>
              <li class="">
                <a href="#tabBillingAddress" role="tab" data-toggle="tab">Rechnung</a>
              </li>
              <li class="">
                <a href="#tabFinalStep" role="tab" data-toggle="tab">Buchung</a>
              </li>
            </ul>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="tab-content">

              <div class="tab-pane fade in active" id="tabPayment">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Einzelheiten zur Bezahlung</h3>
                  </div>
                  <div class="panel-body">

                    <div id="step-1" class="step">
                      <?php $this->load->view('payment/'.(isset($method) ? $method : 'elv').'_form_view'); ?>
                    </div>

                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="tabBillingAddress">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Rechnungsadresse</h3>
                  </div>
                  <div class="panel-body">

                    <div id="step-2" class="step">
                      <?php $this->load->view('payment/bill_form_view'); ?>
                    </div>

                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="tabFinalStep">
                <div class="panel panel-info">
                  <div class="panel-heading">
                    <h3 class="panel-title">Gewählt-Modell buchen</h3>
                  </div>
                  <div class="panel-body">

                    <div id="step-3" class="step">
                      <fieldset class="form-horizontal">

                        <div class="form-group">
                          <div class="col-sm-12 text-left">
                            <button type="button" class="btn btn-default" data-target="#tablistChangePackage" data-toggle="tabPrev" ><span class="icomoon i-arrow-left"></span> Prev</button>
                          </div>
                        </div>

                        <div class="bs-callout bs-callout-warning">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" value="1" id="inputAgreeDirectDebit" name="agree_direct_debit" required />
                              <strong>Einzugsermächtigung</strong>
                              <p>
                                Mit der Buchung eines kostenpflichtigen Services ermächtigen ich die IhrArzt24 GmbH widerruflich, die von mir geschuldeten Zahlungen bei Fälligkeit zu Lasten meines Kontos durch Lastschrift einzuziehen. SEPA-Lastschriftmandat:IhrArzt24 GmbH , Luisenstrasse 114, 40215 Düsseldorf Gläubiger-Identifikationsnummer DE69ZZZ00000895492 Mandatsreferenz (Ihre ID)Ich ermächtige die IhrArzt24 GmbH, Zahlungen von meinem Konto mittels Lastschrift einzuziehen. Zugleich weise ich mein Kreditinstitut an, die von der Muster GmbH auf mein Konto gezogenen Lastschriften einzulösen.Hinweis: Ich kann innerhalb von acht Wochen, beginnend mit dem Belastungsdatum, die Erstattung des belasteten Betrages verlangen. Es gelten dabei die mit meinem Kreditinstitut vereinbarten Bedingungen.
                              </p>
                            </label>
                          </div>
                        </div>
                        
                        <div class="bs-callout bs-callout-warning">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" value="1" id="inputAgreeCancellation" name="agree_cancellation" required />
                              <strong>Wiederrufsbelehrung</strong>
                              <p>
                                <strong> Widerrufsrecht </strong><br/>
                                Sie können Ihre Vertragserklärung innerhalb von 14 Tagen ohne Angabe von Gründen in Textform (z.B. E-Mail, Brief, FAX) widerrufen.Die frist beginnt bei Erhalt dieser Belehrung in Textform. Zur Wahrung der Frist genügt die rechtzeitige Absendung des Widerrufs. Der Widerruf ist zu richten an: IhrArzt24 GmbH, Rheindorfer Weg 4, 40591 Düsseldorf oder an Kundenservice@ihrarzt24.de.<br>
                                <strong>Besondere Hinweise</strong><br/>
                                Ihr Widerrufsrecht erlischt vorzeitig, wenn der Vertrag von beiden Seiten auf ihren ausdrücklichen Wunsch vollständig erfüllt ist, bevor Sie Ihr Widerrufsrecht ausgeübt haben.<br>Ihre IhrArzt24 GmbH.
                              </p>
                            </label>
                          </div>
                        </div>
                        
                        <div class="bs-callout bs-callout-warning">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" value="1" id="inputAgreeRunningTime" name="agree_running_time" required />
                              <strong>Mindestvetragslaufzeit</strong>
                              <p>
                                Zahlungspflichtigen Vertrag schließen. Mindestvetragslaufzeit 1 Monat
                              </p>
                            </label>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label for="change_package_notes" class="control-label col-sm-12">Notizen <span class="optional-field">(freiwillig)</span></label>
                          <div class="col-sm-12">
                            <textarea name="change_package_notes" id="change_package_notes" class="form-control" placeholder="Notizen" ></textarea>
                          </div>
                        </div>
                        
                        <div class="form-group" data-error-message="Bitte bestätigen Sie die Einwilligung.">
                          <div class="col-sm-12">
                            <label class="radio-inline">
                              <input type="checkbox" id="checkbox-tos" name="agb" value="1" required >
                              Ich stimme der Verwendung meiner Daten zur Vermittlung meines Termins unter den in der
                              <a href="#" data-toggle="modal" data-target="#modalServiceContractPatient" >Servicevertrag</a> und
                              <a href="#" data-toggle="modal" data-target="#modalPrivacyPatient" >Datenschutz Einwilligungserklärung</a> genannten Bedingungen zu. IhrArzt24.de darf insbesondere meine Daten an den Arzt weiterleiten und dieser rückübermitteln, ob ich den Termin wahrgenommen habe.
                            </label>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-success">Tarif buchen!</button>
                          </div>
                        </div>

                      </fieldset>
                    </div>

                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

      </form>

    </div>
  </div>

</div>

<?php $this->load->view('modals/service_contract_view'); ?>
<?php $this->load->view('modals/privacy_patient_view'); ?>