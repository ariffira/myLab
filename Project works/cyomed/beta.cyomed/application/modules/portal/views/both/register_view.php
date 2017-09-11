<?php (!isset($p) || !$p) && (!isset($d) || !$d) ? ($p = TRUE) : NULL; ?>
<?php isset($r) && isset($c) && $r && $c ? ($pass_data = array('r' => $r, 'c' => $c, )) : ($pass_data = array()); ?>
<?php $this->moterm->reset_modals(); $this->moterm->get_list(); ?>
                        <div class="logo">
				<a href="<?php echo site_url('portal/both/login/page?p'); ?>">
					<img src="<?php echo base_url('assets/img/logo/logo.png'); ?>" alt="Cyomed"/>
				</a>
			</div>
<div class="row"><div class="col-sm-10 col-sm-offset-1"><div class="account-body">
    
<div id="register_view">
	<div class="row">
  		<div class="col-md-12">
			
	    	<!-- Nav tabs -->
	    	<ul class="nav nav-tabs" role="tablist">
	      		<li class="<?php echo isset($p) && $p ? 'active' : ''; ?> col-md-offset-4"><a href="#patientRegister" role="tab" data-toggle="tab"><?php echo $this->lang->line('reg_lang_user_pat');?></span> <?php echo $this->lang->line('reg_lang_not_reg_text');?> <span class="icomoon i-inject"></span></a></li>
	      		<li class="<?php echo isset($d) && $d ? 'active' : ''; ?>"><a href="#doctorRegister" role="tab" data-toggle="tab"><?php echo $this->lang->line('reg_lang_user_doc');?></span> <?php echo $this->lang->line('reg_lang_not_reg_text');?> <span class="icomoon i-profile"></span></a></li>
	    	</ul>
		</div>
	</div>
	<div class="tab-content text-left">
		<div class="tab-pane fade <?php echo isset($p) && $p ? 'in active' : ''; ?>" id="patientRegister">
    		<?php $this->load->view('patient/register_view', $pass_data); ?>
  		</div>
		<div class="tab-pane fade <?php echo isset($d) && $d ? 'in active' : ''; ?>" id="doctorRegister">
    		<?php $this->load->view('doctor/register_view', $pass_data); ?>
  		</div>
	</div>
</div>
</div></div></div>
<!-- generate modals -->
<?php echo $this->moterm->modal_output(false,true); ?>
<!-- end generate modals -->
