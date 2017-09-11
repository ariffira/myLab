<?php $this->load->language('patients/my_doctors', $this->m->user_value('language')); ?>
<?php $this->load->language('global/general_text', $this->m->user_value('language')); ?>
<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('akte/access/insert'); ?>" id="frminsert">
  <div class="form-group">
    <label for="regid" class="col-sm-3 control-label text-white">
      <span class="icomoon  i-vcard"></span>  
          <?php echo $this->lang->line('patients_my_pat_id');?>
    </label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="regid" id="regid" value="" placeholder="Patient-ID" />
    </div>
  </div>

  <div class="form-group">
    <label for="inputMyDoctorAccess" class="col-sm-3 control-label text-white">
      <?php echo $this->lang->line('general_text_lang_emergency_contact');?>
    </label>
    <div class="col-sm-9">
      <div class="checkbox">
        <label>
          <div class="checkbox_box">
            <input type="checkbox" value="1" id="inputMyDoctorAccess" name="emergency" />
            <label for="inputMyDoctorAccess"></label>
            <div></div>
          </div>
        </label>
      </div>
      <p class="help-block">
        <span style="color:red;">*</span>
        <?php echo $this->lang->line('general_emergency_select_info');?>
      </p>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12 text-right">
      <button class="btn btn-alt btn-lg" type="submit">
        <span class="icomoon i-enter"></span> 
        <?php echo $this->lang->line('general_text_button_choose_patient');?>
      </button>
    </div>
  </div>
</form>
<script>
	$("#frminsert").submit(function(){
		if($("#regid").val()=="")
		{
			alert("Please enter patient id");
			return false;
		}
		return true;
	});
</script>