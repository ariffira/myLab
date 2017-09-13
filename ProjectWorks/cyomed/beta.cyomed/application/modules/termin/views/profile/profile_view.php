<script src="<?php echo base_url('assets/js/termin.js'); ?>"></script>

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
    <form class="form-horizontal" role="form" method="post" onclick="return formvalidation();" action="<?php echo site_url('termin/doctor_profile/update_profile'); ?>" id="formAdminProfile" enctype="multipart/form-data" >
      

      <fieldset>
        <div class="row">
          <div class="col-md-8">
            <h3>Allgemeine Informationen</h3>
            <div class="form-group">
              <label for="inputTitle" class="col-sm-2 control-label">Titel</label>
              <div class="col-sm-4">
                <input class="form-control" name="title" id="inputTitle" value="<?php echo $this->m->user_value('academic_grade'); ?>" />
              </div>
              <label for="inputGender" class="col-sm-2 control-label">Geschlecht</label>
              <div class="col-sm-4">
                <select class="form-control" name="gender" id="inputGender">
                  <option value="1" <?php echo $this->m->user_select('gender', '1'); ?> >Weiblich</option>
                  <option value="2" <?php echo $this->m->user_select('gender', '2'); ?> >Männlich</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputFirstName" class="col-sm-2 control-label">Vorname</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="first_name" value="<?php echo $this->m->user_value('name'); ?>" id="inputFirstName" placeholder="Vorname">
              </div>
            </div>
            <div class="form-group">
              <label for="inputLastName" class="col-sm-2 control-label">Nachname</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="last_name" value="<?php echo $this->m->user_value('surname'); ?>" id="inputLastName" placeholder="Nachname">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="email" value="<?php echo $this->m->user_value('email'); ?>" id="inputEmail" placeholder="Email">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPostalCode" class="col-sm-2 control-label">PLZ</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" name="postal_code" value="<?php echo $this->m->user_value('zip'); ?>" id="inputPostalCode" placeholder="PLZ">
              </div>
            </div>
            <div class="form-group">
              <label for="inputLocality" class="col-sm-2 control-label">Stadt</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="locality" value="<?php echo $this->m->user_value('city'); ?>" id="inputLocality" placeholder="Stadt">
              </div>
            </div>
            <div class="form-group">
              <label for="inputStreet" class="col-sm-2 control-label">Straße</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="street" value="<?php echo $this->m->user_value('address'); ?>" id="inputStreet" placeholder="Straße">
              </div>
            </div>
            <div class="form-group">
              <label for="inputStreetAdditional" class="col-sm-2 control-label">Adresszusatz</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="street_additional" value="<?php echo $this->m->user_value('street_additional'); ?>" id="inputStreetAdditional" placeholder="Adresszusatz">
              </div>
            </div>
            <div class="form-group">
              <label for="inputCoordinate" class="col-sm-2 control-label">Koordinaten</label>
              <div class="col-sm-3">
                <label for="inputCoordinateLat" class="col-sm-2 sr-only">Breite</label>
                <input type="text" class="form-control" name="coordinate_lat" id="inputCoordinateLat" value="<?php echo $this->m->user_value('coordinate_lat'); ?>" placeholder="Breite" disabled>
              </div>
              <div class="col-sm-3">
                <label for="inputCoordinateLng" class="col-sm-2 sr-only">Länge</label>
                <input type="text" class="form-control" name="coordinate_lng" id="inputCoordinateLng"value="<?php echo $this->m->user_value('coordinate_lng'); ?>" placeholder="Länge" disabled>
              </div>
              <div class="col-sm-4">
                <button type="button" id="inputCoordinate" class="btn btn-default btn-block">Apportieren</button>
              </div>
            </div>
            <div class="form-group">
              <label for="inputTelephone" class="col-sm-2 control-label">Telefon</label>
              <div class="col-sm-10">
                <input type="tel" class="form-control" name="telephone" value="<?php echo $this->m->user_value('telephone'); ?>" id="inputTelephone" placeholder="Telefon">
              </div>
            </div>
            <div class="form-group">
              <label for="inputWebsite" class="col-sm-2 control-label">Webseite</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="website" value="<?php echo $this->m->user_value('website'); ?>" id="inputWebsite" placeholder="Webseite">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Speichern</button>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <h3>Profilbild</h3>
            <div class="row">
              <div class="col-xs-8">
                <span class="thumbnail">
                  <img data-src="<?php echo $this->m->user_value('avatar') ? $this->m->user_value('avatar') : '//placehold.it/768x1024'; ?>" src="<?php echo $this->m->user_value('avatar') ? $this->m->user_value('avatar') : '//placehold.it/768x1024'; ?>" alt="Profilbild" />
                </span>
              </div>
              <div class="col-xs-4">
                <span class="thumbnail">
                  <img data-src="<?php echo $this->m->user_value('avatar') ? $this->m->user_value('avatar') : '//placehold.it/379x512'; ?>" src="<?php echo $this->m->user_value('avatar') ? $this->m->user_value('avatar') : '//placehold.it/379x512'; ?>" alt="Profilbild" />
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
              <?php foreach ($this->m->user()->native->specs_assoc as $code => $row) : ?>
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
              <?php foreach ($this->m->user()->native->langs_assoc as $code => $row) : ?>
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

      <!-- <fieldset>
        <h3>Andere</h3>
        <div class="row">
          <div class="col-md-12">
            <label class="control-label">Akzeptierte Versicherungen</label>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <label class="checkbox-inline">
              <input type="checkbox" name="insurance[]" value="1" <?php echo $this->m->user_radio('insurance_private'); ?> > Privat versichert / Selbstzahler
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" name="insurance[]" value="2" <?php echo $this->m->user_radio('insurance_public'); ?> > Gesetzlich versichert
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
      </fieldset> -->

      <fieldset>
        <h3>Textfelder</h3>
        <div class="row">
          <div class="col-md-6">
            <label for="inputClinic" class="control-label">Beschreibung</label>
            <textarea class="form-control" rows="5" name="text_description" id="inputClinic" placeholder="Beschreibung"><?php echo $this->m->user_value('text_description'); ?></textarea>
          </div>
          <div class="col-md-6">
            <label for="inputVET" class="control-label">Aus- und Weiterbildung</label>
            <textarea class="form-control" rows="5" name="text_vet" id="inputVET" placeholder="Aus- und Weiterbildung"><?php echo $this->m->user_value('text_vet'); ?></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="inputMoreForPatient" class="control-label">Weitere Informationen für Patienten</label>
            <textarea class="form-control" rows="5" name="text_more_for_patient" id="inputMoreForPatient" placeholder="Weitere Informationen für Patienten"><?php echo $this->m->user_value('text_more_for_patient'); ?></textarea>
          </div>
          <div class="col-md-6">
            <label for="inputMembership" class="control-label">Mitgliedschaften</label>
            <textarea class="form-control" rows="5" name="text_membership" id="inputMembership" placeholder="Mitgliedschaften"><?php echo $this->m->user_value('text_membership'); ?></textarea>
          </div>
        </div>
        <!-- <div class="row">
          <div class="col-md-6">
            <label for="inputHospitalOccupancy" class="control-label">Krankenhausbelegung</label>
            <textarea class="form-control" rows="5" name="text_hospital_occupancy" id="inputHospitalOccupancy" placeholder="Krankenhausbelegung"><?php echo $this->m->user_value('text_hospital_occupancy'); ?></textarea>
          </div>
          <div class="col-md-6">
            &nbsp;
          </div>
        </div> -->
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