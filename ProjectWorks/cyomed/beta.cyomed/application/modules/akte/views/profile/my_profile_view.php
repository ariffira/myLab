
<?php
  $this->load->language('global/general_text','de');
  $this->load->language('pwidgets/my_account', 'de');
  $this->load->language('pwidgets/profile', 'de');
?>
<form class="form-horizontal" method="post" action="<?php echo site_url('akte/profile/update_profile'); ?>" enctype="multipart/form-data">
  <div class="form-group">
    <label class="control-label col-sm-4"><?php echo $this->lang->line('pwidgets_my_account_id'); ?> <span class="icomoon i-vcard"></span></label>
    <div class="col-sm-8">
      <p class="form-control-static"><strong><?php echo $this->m->user_value('regid'); ?></strong></p>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4"><?php echo $this->lang->line('pwidgets_my_account_pin'); ?> <span class="icomoon i-keyhole"></span></label>
    <div class="col-sm-8">
      <p class="form-control-static"><strong><?php echo $this->m->user_value('pin'); ?></strong></p>
    </div>
  </div>

  <div class="form-group">
    <label for="document_upload" class="col-sm-4 control-label text-white">
      Profil-Bild
    </label>
    <div class="col-sm-8">
      
      <div class="m-5">
        <img class="profile-pic img-responsive" src="<?php $this->load->model('document/mdoc'); echo ($img_path = $this->mdoc->get_profile_image_path()) ? base_url($img_path) : '//placehold.it/120x120'; ?>" />
      </div>

      <div class="fileupload fileupload-new m-b-0" data-provides="fileupload">
        <span class="btn btn-file btn-sm btn-alt">
          <span class="fileupload-new">Select file</span>
          <span class="fileupload-exists">Change</span>
          <input type="file" name="document_upload" id="document_upload" />
        </span>
        <span class="fileupload-preview"></span>
        <a href="#" class="close close-pic fileupload-exists" data-dismiss="fileupload">
          <i class="fa fa-times"></i>
        </a>
      </div>

    </div>
  </div>        

  <div class="form-group">
    <label for="language" class="col-sm-4 control-label text-white"> 
      <?php echo $this->lang->line('general_text_lang_title'); ?> 
      <span class="icomoon i-earth"></span>
    </label>

    <div class="col-sm-8">
      <select class="select" name="language" id="language">
        <option value="de" <?php echo $this->m->user_value('language') == 'de' ? 'selected="selected"' : ''; ?> ><?php echo $this->lang->line('general_text_lang_option_1'); ?></option>
        <option value="en" <?php echo $this->m->user_value('language') == 'en' ? 'selected="selected"' : ''; ?> ><?php echo $this->lang->line('general_text_lang_option_2'); ?></option>
      </select>
    </div> 
  </div>

  <div class="form-group">
    <label for="name" class="col-sm-4 control-label text-white"> 
      <?php echo $this->lang->line('pwidgets_my_account_first_name'); ?>      
    </label>
    <div class="col-sm-8">
      <input type="text" class="form-control input-sm" name="name" id="name" value="<?php echo $this->m->user_value('name'); ?>" placeholder="<?php echo $this->lang->line('pwidgets_my_account_first_name'); ?>" />
    </div>
  </div>

  <div class="form-group">
    <label for="surname" class="col-sm-4 control-label text-white"> 
      <?php echo $this->lang->line('pwidgets_my_account_last_name'); ?>
    </label>
    <div class="col-sm-8">
      <input type="text" class="form-control input-sm" name="surname" id="surname" value="<?php echo $this->m->user_value('surname'); ?>" placeholder="" />
    </div>
  </div>

    

  <?php if ($this->m->user_role() == M::ROLE_DOCTOR): ?>

    <div class="form-group">
      <label for="academic_grade" class="col-sm-4 control-label text-white"> 
        <?php echo $this->lang->line('pwidget_profile_academic_grade'); ?>
      </label>
      <div class="col-sm-8">
        <input type="text" class="form-control input-sm" name="academic_grade" id="academic_grade" value="<?php echo $this->m->user_value('academic_grade'); ?>" placeholder="<?php echo $this->lang->line('pwidget_profile_academic_grade'); ?>" />
      </div>
    </div>  

    <div class="form-group">
      <label for="address" class="col-sm-4 control-label text-white"> 
        <?php echo $this->lang->line('pwidgets_my_account_doctor_address'); ?>              
      </label>
      <div class="col-sm-8">
        <input type="text" class="form-control input-sm" name="address" id="address" value="<?php echo $this->m->user_value('address'); ?>" />
      </div>
    </div>  
    
  <?php endif ?>

  <?php if ($this->m->user_role() == M::ROLE_PATIENT): ?>

    <div class="form-group">
      <label for="birthname" class="col-sm-4 control-label text-white"> 
        <?php echo $this->lang->line('pwidgets_my_account_birth_name'); ?>
      </label>
      <div class="col-sm-8">
        <input type="text" class="form-control input-sm" name="birthname" id="birthname" value="<?php echo $this->m->user_value('birthname'); ?>" placeholder="" />
      </div>
    </div>

    <div class="form-group">
      <label for="dob" class="col-sm-4 control-label text-white">
        <?php echo $this->lang->line('pwidgets_my_account_birth_date'); ?>
      </label>
      <div class="col-sm-8">
        <div class="input-icon datetime-pick date-only">
          <input type="text" class="form-control input-sm input-sm" name="dob" data-format="dd.MM.yyyy" id="dob" value="<?php echo date('d.m.Y', strtotime($this->m->user_value('dob'))); ?>" placeholder="" />
          <span class="add-on">
            <i class="fa fa-calendar"></i>
          </span>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-4 control-label text-white">
        <?php echo $this->lang->line('pwidgets_my_account_sex'); ?>
      </label>
      <div class="col-sm-8">
        <div class="radio-inline">
          <label>
            <input type="radio" value="Female" id="gender_1" name="gender" <?php echo $this->m->user_value('gender') == 'Female' ? 'checked="checked"' : ''; ?> />
            <?php echo $this->lang->line('pwidgets_my_account_sex_female'); ?>
          </label>
        </div>

        <div class="radio-inline">
          <label>
            <input type="radio" value="Male" id="gender_2" name="gender" <?php echo $this->m->user_value('gender') == 'Male' ? 'checked="checked"' : ''; ?> />
            <?php echo $this->lang->line('pwidgets_my_account_sex_male'); ?>  
          </label>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="address" class="col-sm-4 control-label text-white"> 
        <?php echo $this->lang->line('pwidgets_my_account_street_house_number'); ?>              
      </label>
      <div class="col-sm-8">
        <input type="text" class="form-control input-sm" name="address" id="address" value="<?php echo $this->m->user_value('address'); ?>" placeholder="" />
      </div>
    </div>

  <?php endif ?>

  <div class="form-group">
    <label for="zip" class="col-sm-4 control-label text-white"> 
      <?php echo $this->lang->line('pwidgets_my_account_zip_code'); ?>  
    </label>
    <div class="col-sm-8">
      <input type="text" class="form-control input-sm" name="zip" id="zip" value="<?php echo $this->m->user_value('zip'); ?>" placeholder="" />
    </div>
  </div>

  <div class="form-group">
    <label for="city" class="col-sm-4 control-label text-white"> 
      <?php echo $this->lang->line('pwidgets_my_account_city'); ?>  
    </label>
    <div class="col-sm-8">
      <input type="text" class="form-control input-sm" name="city" id="city" value="<?php echo $this->m->user_value('city'); ?>" placeholder="" />
    </div>
  </div>

  <div class="form-group">
    <label for="region" class="col-sm-4 control-label text-white"> 
      <?php echo $this->lang->line('pwidgets_my_account_region'); ?>
    </label>
    <div class="col-sm-8">
      <input type="text" class="form-control input-sm" name="region" id="region" value="<?php echo $this->m->user_value('region'); ?>" placeholder="" />
    </div>
  </div>

  <div class="form-group">
    <label for="country" class="col-sm-4 control-label text-white"> 
      <?php echo $this->lang->line('pwidgets_my_account_country'); ?>
    </label>
    <div class="col-sm-8">
      <select type="text" name="country" id="country" class="select" >
        <?php foreach ($this->country->get()->result() as $c) : ?>
          <option value="<?php echo $c->id; ?>" <?php echo $this->m->user_value('country') && $c->id == $this->m->user_value('country') ? 'selected="selected"' : '' ?> > <?php echo $c->country_name; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="telephone" class="col-sm-4 control-label text-white"> 
      <?php echo $this->lang->line('pwidgets_my_account_telephone_number'); ?>
    </label>
    <div class="col-sm-8">
      <input type="text" class="form-control input-sm" name="telephone" id="telephone" value="<?php echo $this->m->user_value('telephone'); ?>" placeholder="" />
    </div>
  </div>

  <div class="form-group">
    <label for="mobile" class="col-sm-4 control-label text-white"> 
      <?php echo $this->lang->line('pwidgets_my_account_mobile_number'); ?>
    </label>
    <div class="col-sm-8">
      <input type="text" class="form-control input-sm" name="mobile" id="mobile" value="<?php echo $this->m->user_value('mobile'); ?>" placeholder="" />
    </div>
  </div>

  <div class="form-group">
    <label for="fax" class="col-sm-4 control-label text-white"> 
      <?php echo $this->lang->line('pwidgets_my_account_fax_number'); ?>
    </label>
    <div class="col-sm-8">
      <input type="text" class="form-control input-sm" name="fax" id="fax" value="<?php echo $this->m->user_value('fax'); ?>" placeholder="" />
    </div>
  </div>
    
   

  <?php if ($this->m->user_role() == M::ROLE_PATIENT): ?>

    <hr class="whiter m-t-20" />

    <label class="text-white">
      <h4>
        <?php echo $this->lang->line('pwidgets_my_account_emergency_contact_title'); ?>
      </h4>
    </label>

    <div class="form-group">
      <label for="emergency_name" class="col-sm-4 control-label text-white"> 
        <?php echo $this->lang->line('pwidgets_my_account_person_name'); ?>
      </label>
      <div class="col-sm-8">
        <input type="text" class="form-control input-sm" name="emergency_name" id="emergency_name" value="<?php echo $this->m->user_value('emergency_name'); ?>" placeholder="" />
      </div>
    </div>

    <div class="form-group">
      <label for="emergency_doctor_id" class="col-sm-4 control-label text-white"> 
        <?php echo $this->lang->line('pwidgets_my_account_doctor_id'); ?>
      </label>
      <div class="col-sm-8">
        <input type="text" class="form-control input-sm" name="emergency_doctor_id" id="emergency_doctor_id" value="<?php echo $this->m->user_value('emergency_doctor_id'); ?>" placeholder="" />
      </div>
    </div>

    <div class="form-group">
      <label for="emergency_telephone" class="col-sm-4 control-label text-white"> 
        <?php echo $this->lang->line('pwidgets_my_account_emergency_contact_telephone'); ?>
      </label>
      <div class="col-sm-8">
        <input type="text" class="form-control input-sm" name="emergency_telephone" id="emergency_telephone" value="<?php echo $this->m->user_value('emergency_telephone'); ?>" placeholder="" />
      </div>
    </div>

    <div class="row">
      <label for="family_doctor" class="col-sm-4 control-label text-white"> 
        <?php echo $this->lang->line('pwidgets_my_account_family_doctor_title'); ?>
      </label>
    </div>

    <div class="form-group">
      <label for="family_doctor_name" class="col-sm-4 control-label text-white"> 
        <?php echo $this->lang->line('pwidgets_my_account_person_name'); ?>
      </label>
      <div class="col-sm-8">
        <input type="text" class="form-control input-sm" name="family_doctor_name" id="family_doctor_name" value="<?php echo $this->m->user_value('family_doctor_name'); ?>" placeholder="" />
      </div>
    </div>

    <div class="form-group">
      <label for="family_doctor_telephone" class="col-sm-4 control-label text-white"> 
        <?php echo $this->lang->line('pwidgets_my_account_telephone_number'); ?>
      </label>
      <div class="col-sm-8">
        <input type="text" class="form-control input-sm" name="family_doctor_telephone" id="family_doctor_telephone" value="<?php echo $this->m->user_value('family_doctor_telephone'); ?>" placeholder="" />
      </div>
    </div>

    <div class="form-group">
      <label for="family_doctor_id" class="col-sm-4 control-label text-white"> 
        <?php echo $this->lang->line('pwidgets_my_account_doctor_id'); ?>
      </label>
      <div class="col-sm-8">
        <input type="text" class="form-control input-sm" name="family_doctor_id" id="family_doctor_id" value="<?php echo $this->m->user_value('family_doctor_id'); ?>" placeholder="" />
      </div>
    </div>
        
  <?php endif ?>


  <?php if ($this->m->user_role() == M::ROLE_DOCTOR): ?>

    <div class="form-group">
      <label for="website" class="col-sm-4 control-label text-white"> 
        <?php echo $this->lang->line('pwidgets_my_account_website'); ?>
      </label>
      <div class="col-sm-8">
        <input type="text" class="form-control input-sm" name="website" id="website" value="<?php echo $this->m->user_value('website'); ?>" placeholder="" />
      </div>
    </div>

    <div class="form-group">
      <label for="emergency_number" class="col-sm-4 control-label text-white"> 
        <?php echo $this->lang->line('pwidgets_my_account_emergency_number'); ?>
      </label>
      <div class="col-sm-8">
        <input type="text" class="form-control input-sm" name="emergency_number" id="emergency_number" value="<?php echo $this->m->user_value('emergency_number'); ?>" placeholder="" />
      </div>
    </div>
    
    <div class="form-group">
      <label for="specialization" class="col-sm-4 control-label text-white"> 
        <?php echo $this->lang->line('pwidgets_my_account_specialization'); ?>
      </label>
      <div class="col-sm-8">
        <select type="text" name="specialization[]" id="specialization" class="tag-select-limited"  multiple="multiple" >
          <?php foreach ($this->speciality->get_assoc() as $code => $spec) : ?>
            <option value="<?php echo $spec->id; ?>" <?php echo $this->m->user_value('specialization1') && ($spec->id == $this->m->user_value('specialization1') || is_array($this->m->user_value('specialization1')) && in_array($spec->code, $this->m->user_value('specialization1')) ) ? 'selected="selected"' : '' ?> > <?php echo $spec->name; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>


  <?php endif ?>

  <div class="form-group">
    <div class="col-sm-12 text-right">
      <button class="btn btn-alt btn-lg" type="submit"><span class="icomoon i-loop-4"></span> <?php echo $this->lang->line('general_text_button_update'); ?></button>                  
    </div>
  </div>

                        
</form>