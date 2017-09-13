<div id="videochat" class="modal fade videochat-modal-sm">
   <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                       <h4 class="modal-title">Add Patient Detail</h4>
            </div>
            <div class="modal-body p-l-20 p-r-20 ">
                
               <?php $this->load->language('patients/my_doctors', $this->m->user_value('language')); ?>
<?php $this->load->language('global/general_text', $this->m->user_value('language')); ?>
<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('akte/access/insertpatient'); ?>" >
   <div class="form-group">
    <label for="firstname" class="col-sm-3 control-label text-white">
      <span class="icomoon  i-vcard"></span> First Name
    </label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="first_name" id="first_name" value="" placeholder="Enter firstname" required/>
    </div>
  </div>
    <div class="form-group">
    <label for="lastname" class="col-sm-3 control-label text-white">
      <span class="icomoon  i-vcard"></span> Last Name
    </label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="last_name" id="last_name" value="" placeholder="Enter lastname" required/>
    </div>
  </div>
  <div class="form-group">
    <label for="emailaddress" class="col-sm-3 control-label text-white">
      <span class="icomoon  i-vcard"></span> Email Address
    </label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="email" id="email" value="" placeholder="Email Address" required/>
    </div>
  </div>
    <div class="form-group">
    <label for="mobilenumber" class="col-sm-3 control-label text-white">
      <span class="icomoon  i-vcard"></span> Mobile Number
    </label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="mobile" id="mobile" value="" placeholder="Mobile Number" />
    </div>
  </div>
    <div class="form-group">
    <label for="telephone" class="col-sm-3 control-label text-white">
      <span class="icomoon  i-vcard"></span> Telephone No.
    </label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="telephone" id="telephone" value="" placeholder="Telephone No." />
    </div>
  </div>
    
  <div class="form-group">
    <label for="gender" class="col-sm-3 control-label text-white">
      <span class="icomoon  i-vcard"></span> Gender
    </label>
    <div class="col-sm-9"> 
        <select class="form-control" name="gender" id="gender" >
            <option value="2">Male</option>
            <option value="1">Female</option>
        </select>
      
    </div>
  </div>
  <!--<div class="form-group">
    <label for="inputMyDoctorAccess" class="col-sm-3 control-label text-white">Option für den Notfall</label>
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
        Bei einem Notfall bitte diese Option wählen, um Zugriff auf die Notfalldatensätze des Nutzers zu erhalten.
      </p>
    </div>
  </div>-->
  <div class="form-group">
    <div class="col-sm-12 text-right">
      <button class="btn btn-alt btn-lg" type="submit">
        <span class="icomoon i-enter"></span> 
        <?php echo $this->lang->line('general_text_button_add_patient');?>
      </button>
    </div>
  </div>
</form>
          </div>
      </div> 
  </div>
</div>
