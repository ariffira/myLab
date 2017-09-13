<form class="form-horizontal" role="form" method="post"  action="<?php echo site_url('termin/doctor/settings/update_followup'); ?>" id="formAdmin" enctype="multipart/form-data" >
  <div class="form-group">
    <label for="followupTime" class="col-sm-2 control-label">Send at:</label>
    <div class="col-sm-3">
      <input class="form-control" name="followup_time" id="followupTime" value="<?php echo $followup_time ? $followup_time : '2'; ?>" />
    </div>
    <div class="col-sm-4">
      <select class="form-control" name="followup_time_wrapper" id="inputGender">
        <option value="1" <?php echo $this->m->user_select('followup_time_wrapper', '1'); ?> ><?php echo $this->lang->line('date_days');?></option>
        <option value="2" <?php echo $this->m->user_select('followup_time_wrapper', '2'); ?> ><?php echo $this->lang->line('date_hours');?></option>
        <option value="3" <?php echo $this->m->user_select('followup_time_wrapper', '3'); ?> ><?php echo $this->lang->line('date_minutes');?></option>
      </select>
    </div>
    <label class="col-sm-3 control-label">after the booking.</label>
  </div>

  <div class="form-group">
    <label for="followupemailSubject" class="col-sm-2 control-label"><?php echo $this->lang->line('afterward_email-sub');?></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="followup_email_subject" value="<?php echo $followup_email_subject ? $followup_email_subject : 'Booking followup'; ?>" id="followupemailSubject" placeholder="Email Subject">
    </div>
  </div>

  <div class="form-group">
    <label for="followupemailBody" class="col-sm-2 control-label"><?php echo $this->lang->line('afterward_email-body');?></label>        
    <div class="col-sm-10">
     <textarea class="form-control" rows="10" name="followup_email_body" id="followupemailBody" placeholder="Just a quick followup!" ><?php echo $followup_email_body ? $followup_email_body : 'Just a quick followup!'; ?>
     </textarea>
   </div>
 </div>

 <div class="form-group">
  <label for="followupemailClosing" class="col-sm-2 control-label"><?php echo $this->lang->line('afterward_email-footer');?></label>        
  <div class="col-sm-10">
   <textarea class="form-control" rows="2" name="followup_email_closing" id="followupemailClosing" placeholder="Notes: Here comes the closing notes" ><?php echo $followup_email_closing ? $followup_email_closing : 'Notes: Here comes the closing notes'; ?>
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

<?php $this->load->view('termin/settings/liveView/followup_email_live_view',
  array()); 
?>


</form>

