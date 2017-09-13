
<form class="form-horizontal" action="<?php echo site_url('portal/patient/forgot/pass_reset_validation'); ?>" method="post" id="frm_patient_forgot_pass" >
  <div class="form-group">
  <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="logo">
      <img src="<?php echo base_url('assets/img/logo/logo.png'); ?>" alt="Cyomed"/>
    </div>
  </div>
  </div>

  <div class="form-group">
    <label for="inputemail" class="col-sm-4 control-label">
      <?php echo $this->lang->line('email_id_request');?>
    </label>
    <div class="col-md-4 col-sm-7">
      <input type="email" class="form-control" name="email" id="email" value="" placeholder="email" required/>
		<p class="help-block text-left"> 
      		<!--Wenn Sie vergessen haben, klicken Sie hier E-Mail 
        		<a href="<?php //echo site_url('portal/patient/forgot/email_reset'); ?>">
          			vergessen email
        		</a>-->
        	<?php echo $this->lang->line('reg_lang_login_info');?>
        	<a href="<?php echo site_url('portal/both/login/page?p'); ?>">
	        	<strong><?php echo $this->lang->line('reg_lang_login_link');?></strong>
      		</a>
      	</p>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-2">
      <button role="button" class="btn btn-success btn-block" type="submit" style="margin-bottom:15px;">
        <?php echo $this->lang->line('submit_email');?>
      </button>
    </div>
    <div class="col-sm-2">
      <button role="button" class="btn btn-danger btn-block" type="reset" style="margin-bottom:15px;">
        <?php echo $this->lang->line('reset_input');?>
      </button>
    </div>
  </div>

</form>