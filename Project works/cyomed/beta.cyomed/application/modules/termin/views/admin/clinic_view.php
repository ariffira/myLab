
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
    <form class="form-horizontal" role="form" method="post" action="<?php echo site_url('admin/clinic'); ?>" id="formAdminProfile" enctype="multipart/form-data" >

      <fieldset>
        <div class="row">
          <div class="col-md-8">
            <h3>Allgemeine Informationen</h3>
            <div class="form-group">
              <label for="inputClinicName" class="col-sm-3 control-label">Name&nbsp;der&nbsp;Praxis</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="first_name" value="<?php echo $this->mod->user_value('first_name'); ?>" id="inputClinicName" placeholder="Name der Praxis">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail" class="col-sm-3 control-label">Email</label>
              <div class="col-sm-9">
                <input type="email" class="form-control" name="email" value="<?php echo $this->mod->user_value('email'); ?>" id="inputEmail" placeholder="Email">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPostalCode" class="col-sm-3 control-label">PLZ</label>
              <div class="col-sm-9">
                <input type="number" class="form-control" name="postal_code" value="<?php echo $this->mod->user_value('postal_code'); ?>" id="inputPostalCode" placeholder="PLZ">
              </div>
            </div>
            <div class="form-group">
              <label for="inputLocality" class="col-sm-3 control-label">Stadt</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="locality" value="<?php echo $this->mod->user_value('locality'); ?>" id="inputLocality" placeholder="Stadt">
              </div>
            </div>
            <div class="form-group">
              <label for="inputStreet" class="col-sm-3 control-label">Straße</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="street" value="<?php echo $this->mod->user_value('street'); ?>" id="inputStreet" placeholder="Straße">
              </div>
            </div>
            <div class="form-group">
              <label for="inputStreetAdditional" class="col-sm-3 control-label">Adresszusatz</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="street_additional" value="<?php echo $this->mod->user_value('street_additional'); ?>" id="inputStreetAdditional" placeholder="Adresszusatz">
              </div>
            </div>
            <div class="form-group">
              <label for="inputCoordinate" class="col-sm-3 control-label">Koordinaten</label>
              <div class="col-sm-3">
                <label for="inputCoordinateLat" class="sr-only">Breite</label>
                <input type="text" class="form-control" name="coordinate_lat" id="inputCoordinateLat" value="<?php echo $this->mod->user_value('coordinate_lat'); ?>" placeholder="Breite" disabled>
              </div>
              <div class="col-sm-3">
                <label for="inputCoordinateLng" class="sr-only">Länge</label>
                <input type="text" class="form-control" name="coordinate_lng" id="inputCoordinateLng"value="<?php echo $this->mod->user_value('coordinate_lng'); ?>" placeholder="Länge" disabled>
              </div>
              <div class="col-sm-3">
                <button type="button" id="inputCoordinate" class="btn btn-default btn-block">Apportieren</button>
              </div>
            </div>
            <div class="form-group">
              <label for="inputTelephone" class="col-sm-3 control-label">Telefon</label>
              <div class="col-sm-9">
                <input type="tel" class="form-control" name="telephone" value="<?php echo $this->mod->user_value('telephone'); ?>" id="inputTelephone" placeholder="Telefon">
              </div>
            </div>
            <div class="form-group">
              <label for="inputWebsite" class="col-sm-3 control-label">Webseite</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="website" value="<?php echo $this->mod->user_value('website'); ?>" id="inputWebsite" placeholder="Webseite">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-primary">Speichern</button>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <h3>Profilbild</h3>
            <div class="row">
              <div class="col-xs-8">
                <a href="<?php echo $this->mod->user_value('avatar') ? $this->mod->user_value('avatar') : '//placehold.it/768x1024'; ?>" class="thumbnail">
                  <img data-src="<?php echo $this->mod->user_value('avatar') ? $this->mod->user_value('avatar') : '//placehold.it/768x1024'; ?>" src="<?php echo $this->mod->user_value('avatar') ? $this->mod->user_value('avatar') : '//placehold.it/768x1024'; ?>" alt="Profilbild" />
                </a>
              </div>
              <div class="col-xs-4">
                <a href="<?php echo $this->mod->user_value('avatar') ? $this->mod->user_value('avatar') : '//placehold.it/379x512'; ?>" class="thumbnail">
                  <img data-src="<?php echo $this->mod->user_value('avatar') ? $this->mod->user_value('avatar') : '//placehold.it/379x512'; ?>" src="<?php echo $this->mod->user_value('avatar') ? $this->mod->user_value('avatar') : '//placehold.it/379x512'; ?>" alt="Profilbild" />
                </a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label for="avatar">Aktualisieren</label>
                <input type="file" name="avatar" id="avatar">
                <p class="help-block">Example block-level help text here.</p>
                <button type="submit" class="btn btn-success">Aktualisieren</button>
              </div>
            </div>
          </div>
        </div>
        <hr />
      </fieldset>
      
      <fieldset>
        <h3>Fachgebiet(e)</h3>
        <div class="row">
          <div class="col-md-6">
            <label for="inputSpecialitySelector" class="control-label">Zur Auswahl bitte anklicken</label>
            <select multiple size="8" class="form-control" id="inputSpecialitySelector">
              <?php foreach($this->speciality->get_assoc() as $row) : ?>
                <option value="<?php echo $row->code; ?>"><?php echo $row->name; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-6">
            <label for="inputSpeciality" class="control-label">&nbsp;</label>
            <select size="8" class="form-control" name="speciality[]" id="inputSpeciality" data-toggle="mSelector" data-selector="#inputSpecialitySelector" data-control-up="#inputSpecialityMoveUp" data-control-down="#inputSpecialityMoveDown" data-control-delete="#inputSpecialityDelete" >
              <?php foreach ($this->mod->user()->specs_assoc as $code => $row) : ?>
                <option value="<?php echo $code; ?>"><?php echo $row->name; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="form-group"></div>
        <div class="row">
          <div class="col-md-12 text-right">
            <button type="button" id="inputSpecialityMoveUp" class="btn btn-default">Nach oben</button>
            <button type="button" id="inputSpecialityMoveDown" class="btn btn-default">Nach unten</button>
            <button type="button" id="inputSpecialityDelete" class="btn btn-danger">Löschen</button>
            <button type="submit" class="btn btn-primary">Speichern</button>
          </div>
        </div>
        <hr />
      </fieldset>
      
      <fieldset>
        <h3>Sprache(n)</h3>
        <div class="row">
          <div class="col-md-6">
            <label for="inputLanguagesSelector" class="control-label">Zur Auswahl bitte anklicken</label>
            <select multiple size="8" class="form-control" id="inputLanguagesSelector">
              <?php foreach($this->language->get_assoc() as $row) : ?>
                <option value="<?php echo $row->code; ?>"><?php echo $row->name; ?> / <?php echo $row->native; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-6">
            <label for="inputLanguages" class="control-label">&nbsp;</label>
            <select size="8" class="form-control" name="languages[]" id="inputLanguages" data-toggle="mSelector" data-selector="#inputLanguagesSelector" data-control-up="#inputLanguagesMoveUp" data-control-down="#inputLanguagesMoveDown" data-control-delete="#inputLanguagesDelete" >
              <?php foreach ($this->mod->user()->langs_assoc as $code => $row) : ?>
                <option value="<?php echo $code; ?>"><?php echo $row->name; ?> / <?php echo $row->native; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="form-group"></div>
        <div class="row">
          <div class="col-md-12 text-right">
            <button type="button" id="inputLanguagesMoveUp" class="btn btn-default">Nach oben</button>
            <button type="button" id="inputLanguagesMoveDown" class="btn btn-default">Nach unten</button>
            <button type="button" id="inputLanguagesDelete" class="btn btn-danger">Löschen</button>
            <button type="submit" class="btn btn-primary">Speichern</button>
          </div>
        </div>
        <hr />
      </fieldset>

      <?php if (!empty($display_others)) : ?>
        <fieldset>
          <h3>Andere</h3>
          <div class="row">
            <div class="col-md-12">
              <label class="control-label">Akzeptierte Versicherungen</label>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-12">
              <label class="checkbox-inline">
                <input type="checkbox" name="insurance[]" value="1" <?php echo $this->mod->user_radio('insurance_private'); ?> > Privat versichert / Selbstzahler
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" name="insurance[]" value="2" <?php echo $this->mod->user_radio('insurance_public'); ?> > Gesetzlich versichert
              </label>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <label class="control-label">Patienten dürfen mich und meine Praxis bewerten</label>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-12">
              <label class="radio-inline">
                <input type="radio" name="must_feedback" value="1" <?php echo set_radio('must_feedback', '1'); ?> > Ja
              </label>
              <label class="radio-inline">
                <input type="radio" name="must_feedback" value="0" <?php echo set_radio('must_feedback', '0'); ?> > Nein
              </label>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <button type="submit" class="btn btn-primary">Speichern</button>
            </div>
          </div>
          <hr />
        </fieldset>
      <?php endif; ?>

      <fieldset>
        <h3>Textfelder</h3>
        <div class="row">
          <div class="col-md-6">
            <label for="inputClinic" class="control-label">Beschreibung</label>
            <textarea class="form-control" rows="5" name="text_description" id="inputClinic" placeholder="Beschreibung"><?php echo $this->mod->user_value('text_description'); ?></textarea>
          </div>
          <div class="col-md-6">
            <label for="inputMoreForPatient" class="control-label">Weitere Informationen für Patienten</label>
            <textarea class="form-control" rows="5" name="text_more_for_patient" id="inputMoreForPatient" placeholder="Weitere Informationen für Patienten"><?php echo $this->mod->user_value('text_more_for_patient'); ?></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="inputHospitalOccupancy" class="control-label">Krankenhausbelegung</label>
            <textarea class="form-control" rows="5" name="text_hospital_occupancy" id="inputHospitalOccupancy" placeholder="Krankenhausbelegung"><?php echo $this->mod->user_value('text_hospital_occupancy'); ?></textarea>
          </div>
          <div class="col-md-6">
            &nbsp;
          </div>
        </div>
        <div class="form-group"></div>
        <div class="row">
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Speichern</button>
          </div>
        </div>
      </fieldset>
    </form>
  </div>

</div>