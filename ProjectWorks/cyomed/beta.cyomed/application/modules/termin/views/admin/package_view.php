
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
  <!-- <div class="col-md-6">
    <div class="thumbnail">
      <a href="//placehold.it/432x324" class="thumbnail">
        <img data-src="//placehold.it/432x324" src="//placehold.it/432x324" alt="Profilbild" />
      </a>
      <div class="caption">
        <h3>Basis <small>Ohne Grundgebühr</small></h3>
        <p>&nbsp;<span class="icomoon i-checkbox"></span> Lorem ipsum Nisi nostrud ut est do mollit labore dolor aliqua nisi id ut dolore occaecat.</p>
        <p class="bg-muted">&nbsp;<span class="icomoon i-checkbox"></span> Lorem ipsum Nisi nostrud ut est do mollit labore dolor aliqua nisi id ut dolore occaecat.</p>
        <p class="bg-success">&nbsp;<span class="icomoon i-checkbox"></span> Lorem ipsum Nisi nostrud ut est do mollit labore dolor aliqua nisi id ut dolore occaecat.</p>
        <p class="bg-info">&nbsp;<span class="icomoon i-checkbox"></span> Lorem ipsum Nisi nostrud ut est do mollit labore dolor aliqua nisi id ut dolore occaecat.</p>
        <p class="bg-warning">&nbsp;<span class="icomoon i-checkbox"></span> Lorem ipsum Nisi nostrud ut est do mollit labore dolor aliqua nisi id ut dolore occaecat.</p>
        <p class="bg-danger">&nbsp;<span class="icomoon i-checkbox"></span> Lorem ipsum Nisi nostrud ut est do mollit labore dolor aliqua nisi id ut dolore occaecat.</p>
        <p><a href="#" class="btn btn-success" role="button">Wählen</a> <a href="#" class="btn btn-default" role="button">Mehr</a></p>
      </div>
    </div>
  </div> -->

  <?php $this->lang->load('package', 'german'); ?>

  <?php $packages = $this->mopack->get_list(); ?>
  <?php foreach ($packages as $package_index => $this_package) : if ($this_package->for == 2) : ?>
    <div class="col-md-4">
      <?php $this_is_default = ($this_package->name == 'free'); ?>
      <div class="panel panel-<?php echo $this_is_default && !$this->mod->user_value('package') || $this->mod->user_value('package') == $this_package->name ? 'danger' : 'primary'; ?>">
        <div class="panel-heading">
          <h3 class="panel-title">
            <strong><?php echo $this->lang->line('package_'.$this_package->name) ? $this->lang->line('package_'.$this_package->name) : ''; ?></strong>
            <span class="pull-right"><?php echo $this_package->intro_top_right; ?></span>
          </h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-offset-2 col-md-8">
              <?php echo $this_package->intro; ?>
            </div>
          </div>
          <div class="row">
            <?php if (isset($this_package->running_time) && isset($this_package->running_time_quant) && isset($this_package->running_time_type)) : ?>
              <div class="col-md-12">
                <p class="text-primary text-center">
                  <?php if ($this_package->running_time_type == 'static' && $this_package->running_time > 0) : ?>
                    <?php $this->lang->load('date', 'german'); ?>
                    Laufzeit: <strong><?php echo $this_package->running_time; ?> <?php echo $this->lang->line('date_'.$this_package->running_time_quant.($this_package->running_time != 1 ? 's' : '')); ?></strong>
                  <?php else : ?>
                    Kein Laufzeit
                  <?php endif; ?>
                </p>
                <p class="text-primary text-center">
                  <?php if ($this_package->cancel_buffer_type == 'static' && $this_package->cancel_buffer > 0) : ?>
                    <?php $this->lang->load('date', 'german'); ?>
                    Stornierung Puffer: <strong><?php echo $this_package->cancel_buffer; ?> <?php echo $this->lang->line('date_'.$this_package->cancel_buffer_quant.($this_package->cancel_buffer != 1 ? 's' : '')); ?></strong>
                  <?php else : ?>
                    Kann jederzeit gekündigt werden
                  <?php endif; ?>
                </p>
                <p class="help-block text-center">
                  <?php if (($this_is_default && !$this->mod->user_value('package') || $this->mod->user_value('package') == $this_package->name) && count($invoices) > 0 && count($invoices[0]) > 0) : ?>
                    Letzten Fälligkeitszeiten: <strong class="text-success"><?php echo date('d.m.Y H:i:s', strtotime($invoices[0][0]->cdate)); ?></strong>
                  <?php endif; ?>
                </p>
                <p class="help-block text-center">
                  <?php if (($this_is_default && !$this->mod->user_value('package') || $this->mod->user_value('package') == $this_package->name) && count($invoices) > 0 && count($invoices[0]) > 0) : ?>
                    <?php if ($this_package->running_time_type == 'static' && $this_package->running_time > 0) : ?>
                      <?php
                        switch ($this_package->running_time_quant) {
                          case 'second'  : $expire_time = strtotime($invoices[0][0]->cdate) + $this_package->running_time * 1 - 1; break;
                          case 'minute'  : $expire_time = strtotime($invoices[0][0]->cdate) + $this_package->running_time * 60 - 1; break;
                          case 'hour'    : $expire_time = strtotime($invoices[0][0]->cdate) + $this_package->running_time * 3600 - 1; break;
                          case 'day'     : $expire_time = strtotime($invoices[0][0]->cdate) + $this_package->running_time * 86400 - 1; break;
                          case 'week'    : $expire_time = strtotime($invoices[0][0]->cdate) + $this_package->running_time * 604800 - 1; break;
                          case 'month'   : $expire_time = strtotime(date('Y-m-d H:i:s', strtotime($invoices[0][0]->cdate))." +1 month") - 1; break;
                          case 'quarter' : $expire_time = strtotime(date('Y-m-d H:i:s', strtotime($invoices[0][0]->cdate))." +3 month") - 1; break;
                          case 'year'    : $expire_time = strtotime(date('Y-m-d H:i:s', strtotime($invoices[0][0]->cdate))." +1 year") - 1; break;
                        }
                      ?>
                      Laufzeit bis: <strong class="text-danger"><?php echo date('d.m.Y H:i:s', $expire_time); ?></strong>
                    <?php endif; ?>                    
                  <?php endif; ?>
                </p>
                <p class="help-block text-center">
                  <?php if (($this->mod->user_value('package') != $this_package->name) && count($invoices) > 0 && count($invoices[0]) > 0) : ?>
                    <?php
                      if (in_array($this_package->name, $current->no_buffers)) 
                      {
                        $possible_next_time = time();
                      }
                      else
                      {
                        $possible_next_time = $this->mopack->possible_next_time($current, strtotime($invoices[0][0]->cdate));
                      }
                    ?>
                    Nächstmöglichen Zeitpunkt: <strong class="text-warning"><?php echo date('d.m.Y H:i:s', $possible_next_time); ?></strong>
                  <?php endif; ?>
                </p>
              </div>
            <?php endif; ?>
            <div class="col-md-offset-2 col-md-5">
              <?php if (TRUE) : ?>
                <a href="<?php echo $this_is_default && !$this->mod->user_value('package') || $this->mod->user_value('package') == $this_package->name ? '#' : site_url('admin/package/change/'.$this_package->name); ?>" class="btn btn-<?php echo $this_is_default && !$this->mod->user_value('package') || $this->mod->user_value('package') == $this_package->name ? 'danger' : 'primary'; ?> btn-block col-md-8" role="button" <?php echo $this_is_default && !$this->mod->user_value('package') || $this->mod->user_value('package') == $this_package->name ? 'disabled="disabled"' : ''; ?> name="package" value="<?php echo $this_package->name; ?>" >
                  <?php echo $this_is_default && !$this->mod->user_value('package') || $this->mod->user_value('package') == $this_package->name ? 'gewählt' : 'Wählen'; ?>
                </a>
              <?php else : ?>
                <button class="btn btn-<?php echo $this_is_default && !$this->mod->user_value('package') || $this->mod->user_value('package') == $this_package->name ? 'danger' : 'primary'; ?> btn-block col-md-8 doctor-package" role="button" <?php echo $this_is_default && !$this->mod->user_value('package') || $this->mod->user_value('package') == $this_package->name ? 'disabled="disabled"' : ''; ?> name="package" value="<?php echo $this_package->name; ?>" >
                  <?php echo $this_is_default && !$this->mod->user_value('package') || $this->mod->user_value('package') == $this_package->name ? 'gewählt' : 'Wählen'; ?>
                </button>
              <?php endif; ?>
            </div>
            <div class="col-md-3">
              <a href="#" class="btn btn-default btn-block col-md-4" role="button">Mehr</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endif; endforeach; ?>
<!--
  <div class="col-md-4">
    <div class="panel panel-danger">
      <div class="panel-heading">
        <h3 class="panel-title">Nutzen</h3>
      </div>
      <div class="panel-body">
        <!-- <table class="table table-condensed table-hover table-striped">
          <thead>
            <tr>
              <th>Leadmodell</th>
              <th>Basis</th>
              <th>Premium</th>
              <th>Enterprise</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="4"><h4>Gesetzlich versichert (G)</h4></td>
            </tr>
            <tr>
              <td>Neupatient</td>
              <td>0.3€</td>
              <td>inklusive</td>
              <td>inklusive</td>
            </tr>
            <tr>
              <td>Bestandspatient**</td>
              <td>0.5€</td>
              <td>0.2€</td>
              <td>inklusive</td>
            </tr>
            <tr>
              <td colspan="4"></td>
            </tr>
            <tr>
              <td colspan="4"><h4>Privat versichert / Selbstzahler (P)</h4></td>
            </tr>
            <tr>
              <td>Neupatient</td>
              <td>0.5€</td>
              <td>inklusive</td>
              <td>inklusive</td>
            </tr>
            <tr>
              <td>Bestandspatient**</td>
              <td>0.7€</td>
              <td>0.5€</td>
              <td>inklusive</td>
            </tr>
          </tbody>
        </table>
     
	   <table class="table table-condensed table-hover table-striped">
          <thead>
            <tr>
              <th>Leadmodell</th>
              <th>Basis</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="2"><h4>Gesetzlich versichert (G)</h4></td>
            </tr>
            <tr>
              <td>Neupatient</td>
              <td>0.3€</td>
            </tr>
            <tr>
              <td>Bestandspatient**</td>
              <td>0.5€</td>
            </tr>
            <tr>
              <td colspan="2"></td>
            </tr>
          </tbody>
        </table>
        <small class="text-muted">
          ** Die Terminbuchungskosten pro Bestandspatient fallen nur bei der ersten Buchung im Quartal an. Alle weiteren Onlinebuchungen im selben Quartal sind kostenfrei.
        </small>
      </div>
    </div>
  </div>
</div>
-->
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
              <button type="submit" class="btn btn-primary btn-block">Gewählt-Modell buchen</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>