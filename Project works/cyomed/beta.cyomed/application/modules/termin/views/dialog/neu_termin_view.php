<script>
	/* $('.time-picker').datetimepicker().blur(function(ev){
    $(this).datetimepicker('hide'); 
}); */
function customAlphaNum(event,regx,chars,showCode){
	var eCharCode = event.which;
	var allChars = [];
	for(var i in chars){
		allChars[i] = chars[i].charCodeAt(0);
	}
	if(showCode)console.log(eCharCode);
	return (String.fromCharCode(eCharCode).match('^['+regx+']*$') || allChars.indexOf(eCharCode) >= 0 || eCharCode == 8 || eCharCode == 0 || eCharCode == 13 )?true:false;
}

$('input.numeric').on('keypress',function(e){
	return customAlphaNum(e,'0-9');
});
$('input.charonly').on('keypress',function(e){
	return customAlphaNum(e,'A-Za-z ');
});
$('.date-picker').datetimepicker().on('changeDate',function(ev){
	$(this).datetimepicker('hide'); 
});
</script>    
<!--  -->
<!-- Dialog Area -->
<!--  -->
<div id="dialogNeuTermin" class="form-horizontal">
  <!--<div class="row first-row">
    <div class="col-md-12">
      <p class="pull-left text-left"></p>
      <p class="pull-right text-right"></p>
    </div>
</div>-->
<div class="row second-row hidden">
	<div class="col-md-12">
		<p class="pull-left text-left"></p>
		<p class="pull-right text-right"></p>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<p class="pull-left text-left"></p>
		<p class="pull-right text-right"></p>
	</div>
</div> 
<div class="form-group">
	<label class="form-control-static control-label col-md-4" for="calsdate">von</label>
	<div class="col-md-8">
		<input type="text" name="start" id="startDate" class="form-control date-picker " style="width:45%;float:left;margin-right:10px;" value="<?php echo date('d.m.Y');?>" /> 
		<input type="text" name="start_time" id="start_time" class="form-control time-picker" style="width:30%;" value="<?php echo date('h.m');?>" />
        <!--<div class="input-group">
           
      <input type="text" name="start" id="calsdate" class="form-control "/>
        <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>-->
        </div>
    </div>

    <div class="form-group">
    	<label class="form-control-static control-label col-md-4" for="inputenddate">bis</label>
    	<div class="col-md-8">
    		<input type="text" name="end" id="endDate" class="form-control date-picker" style="width:45%;float:left;margin-right:10px;" value="<?php echo date('d.m.Y');?>" />
    		<input type="text" name="end_time" id="end_time" class="form-control time-picker" style="width:30%;" value="<?php echo date('h.m');?>" />
        <!-- <div class="input-group ">
       
           <input type="text" name="end" id="inputenddate" class="form-control " />
         <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>-->

        </div> 
    </div>






    <!-- Nav pills -->
    <div class="col-md-8 col-md-offset-4"> 
    	<ul class="nav nav-pills" role="tablist" style="margin-bottom:0">
    		<li class="active"><a href="#notUser" role="tab" data-toggle="tab">Allgemein</a></li>
    		<li class=""><a href="#isUser" role="tab" data-toggle="tab">Mit Patienten-ID</a></li>
    	</ul>
    </div>

    	<!-- Tab panes -->
    <div class="tab-content">
    	<div class="tab-pane fade in active" id="notUser">
    		<div class="row">
    			<div class="col-md-12">
    				<input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo $this->m->user_id(); ?>" />
    				<div class="form-group form-group-sm" data-error-message="Bitte wählen Sie Ihre Anrede aus.">
    					<label class="control-label col-sm-4 input-sm">Anrede</label>
    					<div class="col-sm-8 marf-ter">
    						<label class="radio-inline input-sm">
    							<input name="gender" type="radio" id="gender-1" value="1" />
    							Frau
    						</label>
    						<label class="radio-inline input-sm">
    							<input name="gender" type="radio" id="gender-2" value="2" />
    							Herr
    						</label>
    					</div>
    				</div>

    				<div class="form-group form-group-sm" data-error-message="Bitte geben Sie Ihren Vornamen ein.">
    					<label for="first_name" class="control-label col-sm-4 input-sm char">Vorname</label>
    					<div class="col-sm-8">
    						<input type="text" class="form-control input-sm charonly" name="first_name" id="first_name" />
    					</div>
    				</div>

    				<div class="form-group form-group-sm" data-error-message="Bitte geben Sie Ihren Nachnamen ein.">
    					<label for="last_name" class="control-label col-sm-4 input-sm char">Nachname</label>
    					<div class="col-sm-8">
    						<input type="text" class="form-control input-sm charonly" name="last_name" id="last_name" />
    					</div>
    				</div>

    				<div class="form-group form-group-sm" data-error-message="Bitte geben Sie Ihre E-Mail Adresse ein.">
    					<label for="email" class="control-label col-sm-4 input-sm">E-Mail</label>
    					<div class="col-sm-8">
    						<input type="email" class="form-control input-sm" name="email" id="email" value="" />
    					</div>
    				</div>

    				<div class="form-group form-group-sm" data-error-message="Bitte geben Sie eine gültige Telefonnummer ein.">
    					<label for="telephone" class="control-label col-sm-4 input-sm numeric">Mobil</label>
    					<div class="col-sm-8">
    						<input type="telephone" class="form-control input-sm numeric" name="telephone" id="telephone" />
    					</div>
    				</div>

    				<div class="form-group form-group-sm" data-error-message="Bitte wählen Sie Ihre Versicherungsart aus.">
    					<label class="control-label col-sm-4 input-sm">Versicherungsart <span class="optional-field">(freiwillig)</span></label>
    					<div class="col-sm-8 marf-ter">
    						<label class="radio-inline input-sm">
    							<input name="insurance" type="radio" id="insurance-type-1" value="1" />
    							privat
    						</label>
    						<label class="radio-inline input-sm">
    							<input name="insurance" type="radio" id="insurance-type-2" value="2" />
    							gesetzlich
    						</label>
    					</div>
    				</div>

    				<div class="form-group form-group-sm" data-error-message="Bitte wählen Sie Ihre Versicherung aus.">
    					<label for="insurance_provider" class="control-label col-sm-4 input-sm">Versicherung <span class="optional-field">(freiwillig)</span></label>
    					<div class="col-sm-8">
    						<select name="insurance_provider" id="insurance_provider" data-placeholder="...bitte wählen..." class="form-control input-sm bs-form-control" >
    							<option value="0">...bitte wählen...</option>
    							<?php foreach($this->insurance_provider->get()->result() as $row) : ?>
    								<option value="<?php echo $row->code; ?>" ><?php echo $row->name; ?></option>
    							<?php endforeach; ?>
    						</select>
    					</div>
    				</div>

    			</div>
    		</div>
    	</div>

    	<div class="tab-pane fade" id="isUser">
    		<div class="row">
    			<div class="col-md-12">
    				<br/>
    				<input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo $this->m->user_id(); ?>" />
    				<div class="form-group form-group-sm" data-error-message="Bitte geben Sie Ihren Vornamen ein.">
    					<label for="patient_id" class="control-label col-sm-4 input-sm">Patient-ID</label>
    					<div class="col-sm-8">
    						<input type="text" class="form-control input-sm" name="patient_id" id="patient_id" />
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>

    <div class="form-group form-group-sm" data-error-message="Bitte geben Sie an, ob Sie schon einmal bei diesem Arzt in Behandlung waren.">
    	<div id="is-patient" class="radio-group">
    		<label class="control-label col-sm-4 input-sm">Bereits Patient/in bei <?php echo $this->m->user_value('academic_grade').' '.$this->m->user_value('name').' '.$this->m->user_value('surname'); ?>?</label>
    		<div class="col-sm-8 marf-ter">
    			<label class="radio-inline input-sm">
    				<input name="returning_visitor" type="radio" id="is-patient-2" value="0" >
    				Nein
    			</label>
    			<label class="radio-inline input-sm">
    				<input name="returning_visitor" type="radio" id="is-patient-1" value="1" >
    				Ja
    			</label>
    		</div>
    	</div>
    </div>



    <div class="row">
    	<div class="col-md-12">
    		<div class="form-group">
    			<label class="col-md-4" for="inputPatientNotes">Notizen</label>
    			<div class="col-md-8"><textarea class="form-control" id="inputPatientNotes" name="text_patient_notes" placeholder="Notizen" rows="3"></textarea></div>
    		</div>
    		<div class="form-group">
    			<label class="col-md-4" for="inputDoctorAnswer">Antwort</label>
    			<div class="col-md-8"> <textarea class="form-control" id="inputDoctorAnswer" name="text_doctor_answer" placeholder="Antwort" rows="3"></textarea></div>
    		</div>
    		<div class="form-group">
    			<label class="col-md-4" for="inputNotes">Anmerkung</label>
    			<div class="col-md-8">  <textarea class="form-control" id="inputNotes" name="text_notes" placeholder="Anmerkung" rows="3"></textarea></div>
    		</div>
    	</div>
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
		padding: 10px 30px;
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
	.marf-ter{ padding-left:35px;}
	.input-sm {border-radius:0px;}
</style>