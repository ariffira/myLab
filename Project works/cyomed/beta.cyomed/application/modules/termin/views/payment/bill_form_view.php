<fieldset class="form-horizontal">

  <div class="form-group">
    <div class="col-sm-12 text-left">
      <button type="button" class="btn btn-default" data-target="#tablistChangePackage" data-toggle="tabPrev" ><span class="icomoon i-arrow-left"></span> Prev</button>
    </div>
  </div>

  <div class="form-group">
    <label for="inputTitle" class="col-sm-3 control-label">Titel</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="inputTitle" name="title" value="<?php echo $this->mod->user_value('payment_title'); ?>" placeholder="Titel" />
    </div>
    <label for="inputGender" class="col-sm-2 control-label">Geschlecht</label>
    <div class="col-sm-4">
      <select class="form-control" id="inputGender" name="gender">
        <option value="1" <?php echo $this->mod->user_select('payment_gender', '1'); ?> >Weiblich</option>
        <option value="2" <?php echo $this->mod->user_select('payment_gender', '2'); ?> >Männlich</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputFirstName" class="col-sm-3 control-label">Vorname <span class="text-danger">*</span></label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputFirstName" name="first_name" value="<?php echo $this->mod->user_value('payment_first_name'); ?>" placeholder="Vorname" required />
    </div>
  </div>
  <div class="form-group">
    <label for="inputLastName" class="col-sm-3 control-label">Nachname <span class="text-danger">*</span></label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputLastName" name="last_name" value="<?php echo $this->mod->user_value('payment_last_name'); ?>" placeholder="Nachname" required />
    </div>
  </div>
  <div class="form-group">
    <label for="inputStreet" class="col-sm-3 control-label">Straße <span class="text-danger">*</span></label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputStreet" name="street" value="<?php echo $this->mod->user_value('payment_street'); ?>" placeholder="Straße" required />
    </div>
  </div>
  <div class="form-group">
    <label for="inputStreetAdditional" class="col-sm-3 control-label">Adresszusatz</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputStreetAdditional" name="street_additional" value="<?php echo $this->mod->user_value('payment_street_additional'); ?>" placeholder="Adresszusatz">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPostalCode" class="col-sm-3 control-label">PLZ <span class="text-danger">*</span></label>
    <div class="col-sm-3">
      <input type="number" class="form-control" id="inputPostalCode" name="postal_code" value="<?php echo $this->mod->user_value('payment_postal_code'); ?>" placeholder="PLZ" required />
    </div>
    <label for="inputLocality" class="col-sm-2 control-label">Stadt <span class="text-danger">*</span></label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="inputLocality" name="locality" value="<?php echo $this->mod->user_value('payment_locality'); ?>" placeholder="Stadt" required />
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail" class="col-sm-3 control-label">Email</label>
    <div class="col-sm-9">
      <input type="email" class="form-control" id="inputEmail" name="email" value="<?php echo $this->mod->user_value('payment_email'); ?>" placeholder="Email" />
    </div>
  </div>
  <div class="form-group">
    <label for="inputTelephone" class="col-sm-3 control-label">Telefon</label>
    <div class="col-sm-9">
      <input type="tel" class="form-control" id="inputTelephone" name="telephone" value="<?php echo $this->mod->user_value('payment_telephone'); ?>" placeholder="Telefon" />
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-6 text-left">
      
    </div>
    <div class="col-sm-6 text-right">
      <button type="button" class="btn btn-primary" data-target="#tablistChangePackage" data-toggle="tabNext" >Weiter <span class="icomoon i-arrow-right-2"></span></button>
    </div>
  </div>

</fieldset>