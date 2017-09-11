<form class="form-horizontal" role="form" method="post"  action="<?php echo site_url('termin/doctor/settings/update_afterwards'); ?>" id="formAdmin" enctype="multipart/form-data" >
  
  <ul id="myTab1" class="nav nav-tabs">
    
    <li class="active">
      <a href="#email" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('afterward_email2user');?></a>
    </li>

    <li class="">
      <a href="#messages" data-toggle="tab" aria-expanded="false"><?php echo $this->lang->line('afterward_msg');?></a>
    </li>
    
  </ul>

  
  <div id="myTab1Content" class="tab-content">

    <div class="tab-pane fade active in" id="email">

      

      <div class="form-group">
        <label for="logo" class="col-sm-2 control-label"><?php echo $this->lang->line('afterward_logo');?></label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-2">
              <a href="<?=(isset($logo) ? $logo : base_url().'/assets/img/logo/logo.png'); ?>" class="thumbnail">
                <img data-src="<?=(isset($logo) ? $logo : base_url().'/assets/img/logo/logo.png'); ?>" src="<?=(isset($logo) ? $logo : base_url().'/assets/img/logo/logo.png'); ?>" alt="logo" />
              </a>
            </div>
            <div class="col-sm-2">
              <input type="file" name="logo" id="logo"> 
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="emailSubject" class="col-sm-2 control-label"><?php echo $this->lang->line('afterward_email_sub');?></label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="email_subject" value="<?php echo $email_subject ? $email_subject : 'Buchung @cyomed / IhrArzt24'; ?>" id="emailSubject" placeholder="Email Subject">
        </div>
      </div>

      <div class="form-group">
        <label for="emailBody" class="col-sm-2 control-label"><?php echo $this->lang->line('afterward_email_body');?></label>        
        <div class="col-sm-10">
         <textarea class="form-control" rows="10" name="email_body" id="emailBody" placeholder="Thank you. Your booking has successfully made." ><?php echo $email_body ? $email_body : 'Thanks for your booking!'; ?>
         </textarea>
       </div>
     </div>

     <div class="form-group">
      <label for="emailClosing" class="col-sm-2 control-label"><?php echo $this->lang->line('afterward_email_footer');?>  </label>        
      <div class="col-sm-10">
       <textarea class="form-control" rows="2" name="email_closing" id="emailClosing"  placeholder="Thank you. Your booking has successfully made." ><?php echo $email_closing ? $email_closing : 'Notes: Here comes the closing notes'; ?>
       </textarea>
     </div>
   </div>

   <!--
    <div class="form-group">
        <label for="emailSignature" class="col-sm-2 control-label">Email Signature</label>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-2">
              <a href="<?php echo $email_signature ? $email_signature : '//placehold.it/379x512'; ?>" class="thumbnail">
                <img data-src="<?php echo $email_signature ? $email_signature : '//placehold.it/379x512'; ?>" src="<?php echo $email_signature ? $email_signature : '//placehold.it/379x512'; ?>" alt="signaturebild" />
              </a>
            </div>
            <div class="col-sm-2">
              <input type="file" name="email_signature" id="emailSignature"> 
            </div>
          </div>
        </div>
      </div>
    -->
      <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('save_btn');?></button>
        </div>
      </div>
      <hr/>

<?php $this->load->view('termin/settings/liveView/afterwards_email_live_view',
          array()); 
?>

</div> <!-- /.tab-pane -->

<div class="tab-pane fade" id="messages">
  <div class="form-group">
    <label for="afterwards-messages" class="col-sm-4 control-label">
      <?php echo $this->lang->line('afterward_reservation_msg');?>
    </label>        
    <div class="col-sm-8">
     <textarea class="form-control" rows="4" name="afterwards_message" id="afterwards-message" value="<?php echo $afterwards_message ? $afterwards_message : 'Thanks for your booking!'; ?>" placeholder="Thank you for booking."><?php echo $afterwards_message ? $afterwards_message : 'Thanks for your booking!'; ?></textarea>
   </div>
 </div>
 <?php $this->load->view('termin/settings/liveView/afterwards_messages_live_view',
          array()); ?>
</div> <!-- /.tab-pane -->

</div>

</form>




