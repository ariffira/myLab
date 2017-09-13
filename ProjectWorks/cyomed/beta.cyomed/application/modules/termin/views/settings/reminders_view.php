<form class="form-horizontal" role="form" method="post"  action="<?php echo site_url('termin/doctor/settings/update_reminders'); ?>" id="formAdmin" enctype="multipart/form-data" >
	<div class="form-group">
		<label for="reminderTime" class="col-sm-2 control-label">Send at:</label>
		<div class="col-sm-3">
			<input class="form-control" name="reminder_time" id="reminderTime" value="<?php echo $reminder_time ? $reminder_time : '2'; ?>" />
		</div>
		<div class="col-sm-4">
			<select class="form-control" name="reminder_time_wrapper" id="inputGender">
				<option value="1" <?php echo $this->m->user_select('followup_time_wrapper', '1'); ?> ><?php echo $this->lang->line('date_days');?></option>
      		  	<option value="2" <?php echo $this->m->user_select('followup_time_wrapper', '2'); ?> ><?php echo $this->lang->line('date_hours');?></option>
      		  	<option value="3" <?php echo $this->m->user_select('followup_time_wrapper', '3'); ?> ><?php echo $this->lang->line('date_minutes');?></option>
      		</select>
		</div>
		<label class="col-sm-3 control-label">before the booking.</label>
	</div>

	<div class="form-group">
		<label for="reminderemailSubject" class="col-sm-2 control-label"><?php echo $this->lang->line('afterward_email-sub');?></label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="reminder_email_subject" value="<?php echo $reminder_email_subject ? $reminder_email_subject : 'Booking Reminder'; ?>" id="reminderemailSubject" placeholder="Email Subject">
		</div>
	</div>

	<div class="form-group">
		<label for="reminderemailBody" class="col-sm-2 control-label"><?php echo $this->lang->line('afterward_email-body');?></label>        
		<div class="col-sm-10">
			<textarea class="form-control" rows="10" name="reminder_email_body" id="reminderemailBody"  placeholder="Just a quick reminder!" ><?php echo $reminder_email_body ? $reminder_email_body : 'Just a quick reminder!'; ?></textarea>
		</div>
	</div>

	<div class="form-group">
		<label for="reminderemailClosing" class="col-sm-2 control-label"><?php echo $this->lang->line('afterward_email-footer');?></label>        
		<div class="col-sm-10">
			<textarea class="form-control" rows="2" name="reminder_email_closing" id="reminderemailClosing" placeholder="Notes: Here comes the closing notes" ><?php echo $reminder_email_closing ? $reminder_email_closing : 'Notes: Here comes the closing notes'; ?>
			</textarea>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-2">
		</div>
		<div class="col-sm-10">
			<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('save_btn');?></button>
		</div>
	</div>

	<hr/>

	<?php $this->load->view('termin/settings/liveView/reminders_email_live_view',
		array()); 
			?>

		</form>

