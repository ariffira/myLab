<?php $this->load->language('patients/my_doctors', $this->m->user_value('language')); ?>
<?php $this->load->language('global/general_text', $this->m->user_value('language')); ?>

<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('akte/access/insert'); ?>" >

  <input type="hidden" name="doctor_inserted_id" id="doctor_inserted_id" value="<?php echo set_value('doctor_inserted_id'); ?>" />
  
  <div class="form-group">
    <label for="inputDoctorId" class="col-sm-3 control-label text-white" ><?php echo $this->lang->line('patients_my_doctors_id'); ?></label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="doctor_id" id="inputDoctorId" value="<?php echo set_value('doctor_id'); ?>" placeholder="<?php echo $this->lang->line('patients_my_doctors_id'); ?>" />
    </div>
  </div>

  <div class="form-group">
    <label for="inputDoctorName" class="col-sm-3 control-label text-white"><?php echo $this->lang->line('patients_my_doctors_name'); ?></label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="doctor_name" id="inputDoctorName" value="<?php echo set_value('doctor_name'); ?>" placeholder="<?php echo $this->lang->line('patients_my_doctors_name'); ?>" />
    </div>
  </div>

  <div class="form-group">
    <label for="inputMyDoctorAccess" class="col-sm-3 control-label text-white"><?php echo $this->lang->line('patients_my_doctors_access_permission'); ?></label>
    <div class="col-sm-9">
      <div class="checkbox">
        <label>
          <div class="checkbox_box">
            <input type="checkbox" value="1" id="inputMyDoctorAccess" name="my_doctor_access" />
            <label for="inputMyDoctorAccess"></label>
            <div></div>
          </div>
        </label>
      </div>
      <p class="help-block">
        <span style="color:red;">*</span>
         <?php echo $this->lang->line('general_text_access_selection_info'); ?>
      </p>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-12 text-right">
      <button class="btn btn-alt btn-lg"><span class="icomoon i-user-plus"></span>
        <?php echo $this->lang->line('general_text_button_add'); ?>
      </button>
    </div>
  </div>

</form>