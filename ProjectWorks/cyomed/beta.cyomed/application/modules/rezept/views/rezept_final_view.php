<?php
  // $userdata = !empty($userdata) ? $userdata : array(
  //   'id' => 0,
  // );

  // $userdata = (object)$userdata;

  // $insert = empty($userdata->id);

?>

<div class="row">
  <div class="col-md-12"><h3>
   <?php if($this->m->user_value('id') != null) { 
      echo $this->lang->line('epres_user_check_info');
      //echo $userdata->id;
       }
    else {
      echo $this->lang->line('epres_user_not_found');
     }
   ?>
  </h3></div>
</div>


<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('rezept/rezept/final_submission/'.$epres_id); ?>" >
  <input type="hidden" name="batch" value="<?php echo random_string('alnum', 32); ?>" />
<div class="row">
 <div class="col-md-6">
 <!-- name -->
  <div class="form-group">
    <label for="inputname" class="col-sm-4 control-label">
        <?php echo $this->lang->line('epres_user_name');?>
      <span class="text-danger">*</span>
    </label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="name" id="inputname" value="<?php echo $this->m->user_value('name'); ?>" placeholder="name" disabled/>
    </div>
  </div>

  <!-- surname -->
  <div class="form-group">
    <label for="inputsurname" class="col-sm-4 control-label">
        <?php echo $this->lang->line('epres_user_firstname');?>
      <span class="text-danger">*</span></label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="surname" id="inputsurname" value="<?php echo $this->m->user_value('surname'); ?>" placeholder="surname" disabled/>
    </div>
  </div>

  <!-- email -->
  <div class="form-group">
    <label for="inputemail" class="col-sm-4 control-label"><span class="fa fa-envelope"></span>
        <?php echo $this->lang->line('epres_user_email');?>
      <span class="text-danger">*</span></label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="email" id="inputemail" value="<?php echo $this->m->user_value('email'); ?>" placeholder="email" readonly="readonly" disabled="disabled"/>
    </div>
  </div>

  <!-- birthdate -->
  <div class="form-group finaloption">
    <label for="dob" class="col-sm-4 control-label">
        <?php echo $this->lang->line('epres_user_birthdate');?>
    </label>
    <div class="col-sm-8">
      <div class="input-icon datetime-pick date-only">
        <input type="text" class="form-control input-sm" name="dob" id="dob" data-format="dd.MM.yyyy" value="<?php echo date("d.m.Y",  strtotime($this->m->user_value('dob'))); ?>" disabled/>
        <span class="add-on">
          <i class="sa-plus fa fa-calendar"></i>
        </span>
      </div>
    </div>
  </div>

  <!-- insurance -->
  <div class="form-group">
    <label for="inputinsurance" class="col-sm-4 control-label">
        <?php echo $this->lang->line('epres_user_insurance_name');?>
      <span class="text-danger">*</span></label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="insurance" id="inputinsurance" value="<?php echo $this->m->user_value('insurance'); ?>" placeholder="insurance"/>
    </div>
  </div>

  <!-- insurance_no -->
  <div class="form-group">
    <label for="inputinsurance_no" class="col-sm-4 control-label">
        <?php echo $this->lang->line('epres_user_insurance_no');?>
      <span class="text-danger">*</span></label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="insurance_no" id="inputinsurance_no" value="<?php echo $this->m->user_value('insurance_no'); ?>" placeholder="insurance_no"/>
    </div>
  </div>

  <!-- Familiy_doctor -->
  <div class="form-group">
    <label for="inputfamily_doctor_name" class="col-sm-4 control-label">
        <?php echo $this->lang->line('epres_user_house_doc');?>
    </label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="family_doctor_name" id="inputfamily_doctor_name" value="<?php echo $this->m->user_value('family_doctor_name'); ?>" placeholder="family_doctor_name" disabled/>
    </div>
  </div>

  <div class="col-md-12">
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-4">
                <button role="button" class="btn btn-success btn-block" type="submit" style="margin-bottom:15px;"><span class="fa fa-mail-forward"></span>
        <?php echo $this->lang->line('epres_btn_sent_2_sys');?>
               </button>
        </div>
        <!--
        <div class="col-sm-4">
          <a href="<?php echo site_url('akte/rezept/go_back'); ?>" class="btn btn-danger" role="button"><span class="fa fa-mail-reply"></span> Go back</a>
        </div>
        -->
      </div>
  </div>



 </div>
</div>  


</form>