<?php
  $this->load->language('global/general_text',$this->m->user_value('language'));
  $this->load->language('patients/smoking', $this->m->user_value('language'));
?>
<div class="block-theme1">
<div class="col-md-6 col-md-offset-3">
<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('akte/smokingstatus/update/'.$entries->id); ?>" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $entries->id ?>" />
 
    <div class=" <?php echo empty($static) ? '' : 'm-b-5'; ?> m-b-5">
      <h3 class="">
      <?php echo $this->lang->line('smoking_heading'); ?>
      </h3>
    </div>
  <div style="clear:both;"></div>

        
  <div class="form-group <?php echo empty($static) ? 'p-r-20' : 'm-b-5'; ?>">
    <label for="smoking<?php $entries->id; ?>" class="col-sm-3 text-white"> 
      <?php echo $this->lang->line('smoking_heading_title'); ?>
    </label>
    <div class="col-sm-9">
        <select size="1" class="tag-select form-control" name="smokingstatus" id="smokingstatus" >	
	<option value="">
    <?php echo $this->lang->line('smoking_select'); ?>
  </option>

	<option value="1" <?php echo ($entries->smoking_status == 1) ? 'selected="selected"' : ''; ?> ><?php echo $this->lang->line('chews_tobacco');?></option>
	<option value="3" <?php echo ($entries->smoking_status == 3) ? 'selected="selected"' : ''; ?> ><?php echo $this->lang->line('cigar_smoker');?></option>
	<option value="6" <?php echo ($entries->smoking_status == 6) ? 'selected="selected"' : ''; ?> ><?php echo $this->lang->line('former_smoker');?></option>
	<option value="7" <?php echo ($entries->smoking_status == 7) ? 'selected="selected"' : ''; ?> ><?php echo $this->lang->line('never_smoked');?></option>
	<option value="4" <?php echo ($entries->smoking_status == 4) ? 'selected="selected"' : ''; ?> ><?php echo $this->lang->line('passive_smoker');?></option>
	<option value="8" <?php echo ($entries->smoking_status == 8) ? 'selected="selected"' : ''; ?> ><?php echo $this->lang->line('smoker_current_status_unknown');?></option>
	<option value="5" <?php echo ($entries->smoking_status == 5) ? 'selected="selected"' : ''; ?> ><?php echo $this->lang->line('smoking_daily');?></option>
	<option value="2" <?php echo ($entries->smoking_status == 2) ? 'selected="selected"' : ''; ?> ><?php echo $this->lang->line('snuff_user');?></option>
	<option value="9" <?php echo ($entries->smoking_status == 9) ? 'selected="selected"' : ''; ?> ><?php echo $this->lang->line('unknown_if_ever_smoked');?></option>
</select>
 </div>
    </div> 
    <div class="<?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <div class="col-sm-9 col-md-offset-3">
    <button class="btn btn-alt btn-purple" type="submit"><span class="icomoon i-loop-4"></span> <?php echo $this->lang->line('general_text_button_update'); ?></button>
    </div>
  </div>
 
  
</form>
</div>

<div class="clear"></div>
</div>
