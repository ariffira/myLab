<form class="form-horizontal" role="form" method="post" onclick="return formvalidation();" action="<?php echo site_url('termin/doctor/settings/update_profile'); ?>" id="formAdminProfile" enctype="multipart/form-data" >
  <fieldset>
    <div class="row">
      <div class="col-md-8">
        <div class="form-group">
          <label for="inputTitle" class="col-sm-2 control-label">
              <?php echo $this->lang->line('user_title');?>
          </label>
          <div class="col-sm-4">
            <input class="form-control" name="title" id="inputTitle" value="<?php echo $this->m->user_value('academic_grade'); ?>" />
          </div>
          <label for="inputGender" class="col-sm-2 control-label">
              <?php echo $this->lang->line('user_sex_type');?>
          </label>
          <div class="col-sm-4">
            <select class="form-control" name="gender" id="inputGender">
              <option value="1" <?php echo $this->m->user_select('gender', '1'); ?> >
              <?php echo $this->lang->line('user_sex_f');?>
              </option>
              <option value="2" <?php echo $this->m->user_select('gender', '2'); ?> >
              <?php echo $this->lang->line('user_sex_m');?>
              </option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="inputFirstName" class="col-sm-2 control-label">
              <?php echo $this->lang->line('user_firstname');?>
          </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="first_name" value="<?php echo $this->m->user_value('name'); ?>" id="inputFirstName" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label for="inputLastName" class="col-sm-2 control-label">
              <?php echo $this->lang->line('user_lastname');?>
          </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="last_name" value="<?php echo $this->m->user_value('surname'); ?>" id="inputLastName" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail" class="col-sm-2 control-label">
              <?php echo $this->lang->line('user_email');?>
          </label>
          <div class="col-sm-10">
            <input type="email" class="form-control" name="email" value="<?php echo $this->m->user_value('email'); ?>" id="inputEmail" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label for="inputPostalCode" class="col-sm-2 control-label">
              <?php echo $this->lang->line('user_zip');?>
          </label>
          <div class="col-sm-10">
            <input type="number" class="form-control" name="postal_code" value="<?php echo $this->m->user_value('zip'); ?>" id="inputPostalCode" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label for="inputLocality" class="col-sm-2 control-label">
              <?php echo $this->lang->line('user_state');?>
          </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="locality" value="<?php echo $this->m->user_value('city'); ?>" id="inputLocality" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label for="inputStreet" class="col-sm-2 control-label">
              <?php echo $this->lang->line('user_street');?>
          </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="street" value="<?php echo $this->m->user_value('address'); ?>" id="inputStreet" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label for="inputStreetAdditional" class="col-sm-2 control-label">
              <?php echo $this->lang->line('user_adres_line');?>
          </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="street_additional" value="<?php echo $this->m->user_value('street_additional'); ?>" id="inputStreetAdditional" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label for="inputCoordinate" class="col-sm-2 control-label">
              <?php echo $this->lang->line('user_coordinate');?>
          </label>
          <div class="col-sm-3">
            <label for="inputCoordinateLat" class="col-sm-2 sr-only">Breite</label>
            <input type="text" class="form-control" name="coordinate_lat" id="inputCoordinateLat" value="<?php echo $this->m->user_value('coordinate_lat'); ?>" placeholder="" disabled>
          </div>
          <div class="col-sm-3">
            <label for="inputCoordinateLng" class="col-sm-2 sr-only">Länge</label>
            <input type="text" class="form-control" name="coordinate_lng" id="inputCoordinateLng"value="<?php echo $this->m->user_value('coordinate_lng'); ?>" placeholder="" disabled>
          </div>
          <div class="col-sm-4">
            <button type="button" id="inputCoordinate" class="btn btn-default btn-block">
              <?php echo $this->lang->line('user_coordnt_retrieve');?>
            </button>
          </div>
        </div>
        <div class="form-group">
          <label for="inputTelephone" class="col-sm-2 control-label">
              <?php echo $this->lang->line('user_phone');?>
          </label>
          <div class="col-sm-10">
            <input type="tel" class="form-control" name="telephone" value="<?php echo $this->m->user_value('telephone'); ?>" id="inputTelephone" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label for="inputWebsite" class="col-sm-2 control-label">
              <?php echo $this->lang->line('user_website');?>
          </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="website" value="<?php echo $this->m->user_value('website'); ?>" id="inputWebsite" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">
              <?php echo $this->lang->line('save_btn');?>
            </button>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <h3>
          <?php echo $this->lang->line('user_picture');?>
        </h3>
        <div class="row">
          <div class="col-xs-8">
            <a href="<?php echo $this->m->user_value('avatar') ? $this->m->user_value('avatar') : '//placehold.it/768x1024'; ?>" class="thumbnail">
              <img data-src="<?php echo $this->m->user_value('avatar') ? $this->m->user_value('avatar') : '//placehold.it/768x1024'; ?>" src="<?php echo $this->m->user_value('avatar') ? $this->m->user_value('avatar') : '//placehold.it/768x1024'; ?>" alt="Profilbild" />
            </a>
          </div>
          <div class="col-xs-4">
            <a href="<?php echo $this->m->user_value('avatar') ? $this->m->user_value('avatar') : '//placehold.it/379x512'; ?>" class="thumbnail">
              <img data-src="<?php echo $this->m->user_value('avatar') ? $this->m->user_value('avatar') : '//placehold.it/379x512'; ?>" src="<?php echo $this->m->user_value('avatar') ? $this->m->user_value('avatar') : '//placehold.it/379x512'; ?>" alt="Profilbild" />
            </a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label for="avatar">
              <?php echo $this->lang->line('accept_btn');?>
            </label>
            <input type="file" name="avatar" id="avatar">
            <p class="help-block"></p>
            <button type="submit" class="btn btn-success">
              <?php echo $this->lang->line('accept_btn');?>
            </button>
          </div>
        </div>
      </div>
    </div>
    <hr />
  </fieldset>

  <fieldset>
    <h3>
      <?php echo $this->lang->line('user_speciality');?>
    </h3>
    <div class="row">
      <div class="col-md-6">
        <label for="inputSpecialitySelector" class="control-label">
          <?php echo $this->lang->line('speciality_choose_multiple');?>
        </label>
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
        <button type="button" id="inputSpecialityMoveUp" class="btn btn-default">
          <?php echo $this->lang->line('speciality_choose_up');?>
        </button>
        <button type="button" id="inputSpecialityMoveDown" class="btn btn-default">
          <?php echo $this->lang->line('speciality_choose_down');?>
        </button>
        <button type="button" id="inputSpecialityDelete" class="btn btn-danger">
          <?php echo $this->lang->line('delete_btn');?>
        </button>
        <button type="submit" class="btn btn-primary">
          <?php echo $this->lang->line('save_btn');?>
        </button>
      </div>
    </div>
    <hr />
  </fieldset>

  <fieldset>
    <h3>
      <?php echo $this->lang->line('choose_language');?>
    </h3>
    <div class="row">
      <div class="col-md-6">
        <label for="inputLanguagesSelector" class="control-label">
          <?php echo $this->lang->line('speciality_choose_multiple');?>
        </label>
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
        <button type="button" id="inputLanguagesMoveUp" class="btn btn-default">
          <?php echo $this->lang->line('speciality_choose_up');?>
        </button>
        <button type="button" id="inputLanguagesMoveDown" class="btn btn-default">
          <?php echo $this->lang->line('speciality_choose_down');?>
        </button>
        <button type="button" id="inputLanguagesDelete" class="btn btn-danger">
          <?php echo $this->lang->line('delete_btn');?>
        </button>
        <button type="submit" class="btn btn-primary">
          <?php echo $this->lang->line('save_btn');?>
        </button>
      </div>
    </div>
    <hr />
  </fieldset>

  <fieldset>
    <h3>
          <?php echo $this->lang->line('user_more_info');?>
    </h3>
    <div class="row">
      <div class="col-md-6">
        <label for="inputClinic" class="control-label">
          <?php echo $this->lang->line('user_more_description');?>
        </label>
        <textarea class="form-control" rows="5" name="text_description" id="inputClinic" placeholder=""><?php echo $this->m->user_value('text_description'); ?></textarea>
      </div>
      <div class="col-md-6">
        <label for="inputVET" class="control-label">
          <?php echo $this->lang->line('user_advanced_info');?>
        </label>
        <textarea class="form-control" rows="5" name="text_vet" id="inputVET" placeholder=""><?php echo $this->m->user_value('text_vet'); ?></textarea>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <label for="inputMoreForPatient" class="control-label">
          <?php echo $this->lang->line('user_more_info_4_pat');?>
        </label>
        <textarea class="form-control" rows="5" name="text_more_for_patient" id="inputMoreForPatient" placeholder=""><?php echo $this->m->user_value('text_more_for_patient'); ?></textarea>
      </div>
      <div class="col-md-6">
        <label for="inputMembership" class="control-label">
          <?php echo $this->lang->line('user_more_membership');?>
        </label>
        <textarea class="form-control" rows="5" name="text_membership" id="inputMembership" placeholder=""><?php echo $this->m->user_value('text_membership'); ?></textarea>
      </div>
    </div>
    <div class="form-group"></div>
    <div class="row">
      <div class="col-md-12">
        <button type="submit" class="btn btn-primary">
          <?php echo $this->lang->line('save_btn');?>
        </button>
      </div>
    </div>
  </fieldset>
</form>