<!--  -->
<!-- Dialog Area -->
<!--  -->

<div id="dialogBearbeiten"class="form-horizontal">
  <div class="row first-row">
    <div class="col-md-12">
      <p class="pull-left text-left"></p>
      <p class="pull-right text-right"></p>
    </div>
  </div>
  <div class="row second-row hidden">
    <div class="col-md-12">
      <p class="pull-left text-left"></p>
      <p class="pull-right text-right"></p>
    </div>
  </div>
 
      <div class="form-group ">
        <label class="form-control-static control-label col-md-4" for="inputStart"><?php echo $this->lang->line('apntmnt_from');?></label>
        <div class="col-md-8">
             <input type="text" name="start" id="startDate" class="form-control " style="width:45%;float:left;margin-right:10px;" value="" readonly="readonly" /> 
             <input type="text" name="start_time" id="start_time" class="form-control " style="width:35%;" value="" readonly="readonly" />
   
<!--       <div class="input-group " onclick="displayCalendar(document.getElementById('inputStart'),'mm/dd/yyyy',this)" >
        <input type="text" name="start" id="inputStart" class="form-control " />
        <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
        </div>-->
        </div>
      </div>
      
      <div class="form-group" >
        <label class="form-control-static control-label col-md-4" for="inputEnd"><?php echo $this->lang->line('apntmnt_until');?></label>
        <div class="col-md-8">
             <input type="text" name="end" id="endDate" class="form-control  " style="width:45%;float:left;margin-right:10px;" value=""  readonly="readonly"/> 
             <input type="text" name="end_time" id="end_time" class="form-control " style="width:35%;" value=""  readonly="readonly"/>

<!--       <div class="input-group "onclick="displayCalendar(document.getElementById('inputEnd'),'mm/dd/yyyy',this)">
        <input type="text" name="end" id="inputEnd" class="form-control " />
        <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
        </div>-->
        </div>
      </div>
   

  
      <div class="form-group" id="labelPatient">
        <label class="col-md-4 control-label">Patient</label>
       <div class="col-md-8"> <span class="form-control-static"></span></div>
      </div>
      <div class="form-group" id="labelGender">
        <label class="col-md-4 control-label"><?php echo $this->lang->line('apntmnt_pat_title');?></label>
        <div class="col-md-8"> <span  class="form-control-static"></span></div>
      </div>
  
  
      <div class="form-group" id="labelEmail">
        <label class="col-md-4 control-label">Email</label>
       <div class="col-md-8"> <span class="form-control-static"></span></div>
      </div>
      <div class="form-group" id="labelTelephone">
        <label class="col-md-4 control-label"><?php echo $this->lang->line('apntmnt_pat_mobile');?></label>
       <div class="col-md-8"> <span class="form-control-static"></span></div>
      </div>
   
 
      <div class="form-group" id="labelInsurance">
        <label class="col-md-4 control-label"><?php echo $this->lang->line('pat_insurance_type');?></label>
       <div class="col-md-8"> <span class="form-control-static"></span></div>
      </div>
      <div class="form-group" id="labelInsuranceProvider">
        <label class="col-md-4 control-label"><?php echo $this->lang->line('pat_insurance_name');?></label>
       <div class="col-md-8"> <span class="form-control-static"></span></div>
      </div>
  
 
      <div class="form-group" id="labelTreatment">
        <label class="col-md-4 control-label"><?php echo $this->lang->line('apntmnt_treatment');?></label>
       <div class="col-md-8"> <p class="form-control-static"></p></div>
      </div>
   
  
    <div class="form-group">
      <label class="col-md-4 control-label" for="inputPatientNotes"><?php echo $this->lang->line('apntmnt_new_cmnts');?></label>
    <div class="col-md-8">  <textarea class="form-control" id="inputPatientNotes" name="text_patient_notes" placeholder="Notizen" rows="3" disabled="disabled"></textarea></div>
    </div>
  

    <div class="form-group">
   <label class="col-md-4 control-label"  for="inputDoctorAnswer"><?php echo $this->lang->line('apntmnt_new_answer');?></label>
       <div class="col-md-8">  <textarea class="form-control" id="inputDoctorAnswer" name="text_patient_notes" placeholder="Antwort" rows="3"></textarea></div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label"  for="inputNotes"><?php echo $this->lang->line('apntmnt_new_remark');?></label>
       <div class="col-md-8">  <textarea class="form-control" id="inputNotes" name="text_notes" placeholder="Anmerkung" rows="3"></textarea></div>
    </div>

  <!-- <div class="row">
    <div class="col-md-12">
      <p class="text-right">
        <button class="btn btn-primary">Speichern</button>
        <button class="btn btn-default">Abbrechen</button>
      </p>
    </div>
  </div> -->
</div>

<style>
.ui-dialog.ui-widget{
    padding:0px;
    top:20px !important;  
    font-family: 'Avenir Next LT Pro Regular', Arial, Helvetica, sans-serif;
    box-shadow: 1px 1px 12px rgba(0,0,0,0.3);
}
.ui-dialog.ui-widget .ui-dialog-titlebar {
    background: #FFF;
    border: 0px;
    border-bottom: 1px solid #CCC;
    border-radius: 0px;
    padding: 10px 20px;
}
.ui-dialog .ui-dialog-title{
    font-size: 16px;
}
.ui-dialog .ui-dialog-titlebar .ui-button{
  background: transparent;
  border: 0px;
  right: 15px;
}
.ui-dialog .ui-dialog-titlebar .ui-button .ui-button-icon-primary{
  top: 0px;
  left: 0px;
}
.ui-dialog .ui-dialog-content.ui-widget-content{
  background: #FFF;
  padding: 0 15px 15px;
}
.ui-dialog .ui-dialog-buttonpane{
  background: #FFF;
  margin-top: 0px;
  padding: 10px 15px;
}
.ui-dialog .ui-dialog-buttonpane button{
  background: #093a80;
  border-color: #093a80;
  color: #FFF;
  border-radius: 5px;
  font: 14px 'Avenir Next LT Pro Regular', Arial, Helvetica, sans-serif;
  margin: 0 0 0 5px;
}
.checkbox.bg-danger{
    background: transparent;
}
.checkbox,
.radio{
    margin-left: 20px;
}
.checkbox input[type=checkbox],
.radio input[type=radio]{
    opacity:1;
}
.form-group {
  margin-bottom: 10px;
  font-size: 13px;
}
#calendarDiv *
{
-webkit-box-sizing: content-box;
     -moz-box-sizing: content-box;
      box-sizing: content-box;
} 
</style>
<!--<link rel="stylesheet" type="text/css" href="<?php // echo base_url("assets/css/dhtmlgoodies_calendar.css"); ?>" />    
<script type="text/javascript">
    pathToImages="<?php // echo base_url("assets/img/").'/'; ?>";
</script>
<script src="<?php // echo base_url('assets/js/dhtmlgoodies_calendar.js'); ?>"></script>-->
