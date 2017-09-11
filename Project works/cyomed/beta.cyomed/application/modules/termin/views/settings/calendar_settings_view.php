<?php 
$days = array('','mon','tue','wed','thu','fri','sat','sun');
$working_hours = array();
$private_hours = array();
foreach ($calendar_setting->working_hours_start as $key => $value) {
	$working_hours[$key] = array_merge($calendar_setting->working_hours_start[$key],$calendar_setting->working_hours_end[$key]);
}
foreach ($calendar_setting->private_hours_start as $key => $value) {
	$private_hours[$key] = array_merge($calendar_setting->private_hours_start[$key],$calendar_setting->private_hours_end[$key]);
}
?>

<style>

 .checkbox{
    margin:0;
}
input[type=checkbox],
input[type=radio]{
   opacity:1;
}

</style>


<div class="row">

	<div class="col-md-12">
		<form role="form" id="formCalendarSettings" method="post" action="<?php echo site_url('termin/doctor/settings/update_doctor_settings'); ?>" enctype="multipart/form-data">
			<p class="help-block text-muted">
				<?php echo $this->lang->line('times_slot_details');?>
			</p>
			<fieldset>
				<div class="col-sm-6">
					<div align="center">	
						<label>
							<h4><?php echo $this->lang->line('cal_opening_time')?:'Opening Times';?></h4>
						</label>
					</div>
					<hr/>
					<?php foreach($working_hours as $day): ?>
						<div class="form-group row">
							<div class="col-sm-3 form-inline day-check">
							 	<label for="opening_time[<?php echo $day['day']?>]">
							 		<?php echo $this->lang->line('cal_'.$days[$day['day']]);?>
							 	 	<input type="checkbox" name="day[<?php echo $day['day']?>]" value="<?php echo $day['day']?>" <?php echo $day['start_time']!='-'? "checked='checked'":"";?>/>
							 	</label>
							</div>
							<div class="col-sm-9 form-inline input-time" id="opening_time[<?php echo $day['day'];?>]" <?php echo $day['start_time']=='-'?'style="opacity:0;pointer-events:none"':'';?>>		
								<input type="text" style="width:90px;float:left;" name="start_time[<?php echo $day['day']?>]" class="form-control time-picker" value="<?php echo $day['start_time']!='-'?$day['start_time']:'08:00';?>" />
								&nbsp;-&nbsp;
								<input type="text" style="width:90px;"  name="end_time[<?php echo $day['day']?>]" class="form-control time-picker" value="<?php echo $day['end_time']!='-'?$day['end_time']:'17:00';?>"/>
							</div>
						 </div>
					<?php endforeach;?>
				</div>
				
				<div class="col-sm-6">
					<div align="center">
						<label for="break_time[<?php echo $i?>]">
							<h4><?php echo $this->lang->line('calendar_extra_setting');?></h4>
						</label>
					</div>
					<hr/>
					<div class="form-group row">
						<div class="col-sm-4">
							<label for="duration">
								<?php echo $this->lang->line('apntmnt_duration');?>
							</label>
						</div>
						<div class="col-sm-8">
							<input type="number" class="form-control" max="60" min="15"  style="display:inline;width:50%;" name="duration" id="duration" value="<?php echo isset($calendar_setting->termin_default_length)?$calendar_setting->termin_default_length:'';?>">&nbsp;minutes
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-4">
							<label for="lunch_start">
								<?php echo $this->lang->line('cal_lunch_start')?$this->lang->line('cal_lunch_start'):'Lunch Start';?>
							</label>
						</div>
						<div class="col-sm-8">
							<input type="text" class="form-control time-picker" name="lunch_start" id="lunch_start" value="<?php echo isset($calendar_setting->lunch_start)?$calendar_setting->lunch_start:'';?>">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-4">
							<label for="lunch_end">
								<?php echo $this->lang->line('cal_lunch_end')?$this->lang->line('cal_lunch_end'):'Lunch end';?>
							</label>
						</div>
						<div class="col-sm-8">
							<input type="text" class="form-control time-picker" name="lunch_end" id="lunch_end" value="<?php echo isset($calendar_setting->lunch_end)?$calendar_setting->lunch_end:'';?>">
						</div>
					</div>
				</div>
			</fieldset>
			<hr/>

			<fieldset>
				<div class="col-sm-6">
					<div align="center">
						<h5><?php echo $this->lang->line('cal_appointment_private')?$this->lang->line('cal_appointment_private'):'Appointment times for private patient';?></h5>
					</div>
					<?php foreach($private_hours as $day): ?>
						<div class="form-group row">
							<div class="col-sm-3 form-inline day-check">
							 	<label for="private_time[<?php echo $day['day']?>]">
							 		<?php echo $this->lang->line('cal_'.$days[$day['day']]);?>
							 		<input type="checkbox" name="pr_day[<?php echo $day['day'];?>]" value="<?php echo $day['day'];?>" <?php echo $day['start_time']!='-'? "checked='checked'":"";?>/>
							 	</label>
							</div>
							<div class="col-sm-9 form-inline input-time" id="private_time[<?php echo $day['day']?>]" <?php echo $day['start_time']=='-'?'style="opacity:0;pointer-events:none"':'';?>>
								<input type="text" style="width:90px;float:left;" name="pr_start_time[<?php echo $day['day'];?>]" class="form-control time-picker" value="<?php echo $day['start_time']!='-'?$day['start_time']:'';?>" />
								&nbsp;-&nbsp;
								<input type="text" style="width:90px;"  name="pr_end_time[<?php echo $day['day'];?>]" class="form-control time-picker" value="<?php echo $day['end_time']!='-'?$day['end_time']:'';?>"/>
							</div>
						 </div>
					<?php endforeach;?>
				</div>
			</fieldset>
			<div class="col-sm-12" align="center">
          		<button type="submit" class="btn btn-alt btn-lg">
          			<span class='icomoon i-loop-4'></span>
          			<?php echo $this->lang->line('general_text_button_update');?>
          		</button>
        	</div>
		</form>
	</div>

	<h6>*<?php echo $this->lang->line('calendar_setting_note');?></h6>
</div>
