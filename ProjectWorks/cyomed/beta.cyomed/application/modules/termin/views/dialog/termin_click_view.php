<!--  -->
<!-- Dialog Area -->
<!--  -->
<!--<link id="bsdp-css" href="http://eternicode.github.io/bootstrap-datepicker/bootstrap-datepicker/css/datepicker.css" rel="stylesheet">-->


<div id="dialogTerminClick" class="form form-horizontal">
	<div class="form-group first-row">
		<div class="col-md-12">
			<p class="pull-left text-left"></p>
			<p class="pull-right text-right"></p>
		</div>
	</div>
	<div class="form-group">
	<label class="control-label col-md-4" for="inputStart">
		<?php echo $this->lang->line('apntmnt_from');?>
	</label>
		<div class="col-md-8">

			<div class="input-group" id="inputStart">

				<!--                <input type="hidden" name="start_picker" id="start_date"  class="form-control datetime-picker" value="" />-->
				<input type="text" name="startDate" id="startDate" class="form-control  " style="width:45%;float:left;margin-right:10px;" value="" readonly="readonly" /> 
				<input type="text" name="start_time" id="start_time" class="form-control time-picker" style="width:35%;" value=""/>

<!--            <div class='input-group ' id='inputStart' onclick="displayCalendar(document.getElementById('start_picker'),'mm/dd/yyyy',this)">
	<input type="text" name="start_picker" id="start_picker" class="form-control " />-->

<!--                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>-->
            </div>
        </div>
    </div>
    <div class="form-group">
    	<label class="control-label col-md-4" for="inputEnd">
    		<?php echo $this->lang->line('apntmnt_until');?>
    	</label>
    	<div class="col-md-8">

    		<div class="input-group" id="inputEnd">
    			<!--                <input type="hidden" name="end_picker" id="end_date"  class="form-control datetime-picker" value=""/>-->
    			<input type="text" name="endDate" id="endDate" class="form-control " style="width:45%;float:left;margin-right:10px;" value="" readonly="readonly"/>
    			<input type="text" name="end_time" id="end_time" class="form-control time-picker" style="width:35%;" value=""/>

<!--            <div class='input-group' id='inputEnd' onclick="displayCalendar(document.getElementById('end_picker'),'mm/dd/yyyy',this)">
	<input type="text" name="end_picker" id="end_picker" class="form-control" />-->
	<!--                <input type="button" class="cal_image"  style="width:20px; height:20px; border:0px;" onclick="displayCalendar(document.getElementById('end_picker'),'mm/dd/yyyy hh:ii',this)" />-->

<!--                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>-->
            </div>
        </div>
    </div>
    
    
    <div class="form-group">
    	<div class="col-md-8 col-md-offset-4">
    		<label class="checkbox"><input type="checkbox" name="ready" value="1"><?php echo $this->lang->line('times_slot_pub_visibility');?></label>
    		<label class="checkbox"><input type="checkbox" name="allday" value="1"><?php echo $this->lang->line('apntmnt_allday');?></label>
    	</div>
    </div>
    <div class="form-group">
    	<div class="col-md-8 col-md-offset-4">
    		<label class="checkbox"><input type="checkbox" name="insurance[]" id="checkboxTerminType1" value="1"> <?php echo $this->lang->line('times_insurance_public');?></label>
    		<label class="checkbox"><input type="checkbox" name="insurance[]" id="checkboxTerminType2" value="2"> <?php echo $this->lang->line('times_insurance_private');?></label>
    		<label class="checkbox"><input type="checkbox" name="insurance[]" id="checkboxTerminType3" value="0"> <?php echo $this->lang->line('times_insurance_own');?></label>
    		<label class="checkbox"><input type="checkbox" name="mask" id="checkboxTerminType4" value="1"><?php echo $this->lang->line('apntmnt_reserve');?></label>
    	</div>
    </div>
    <div class="form-group">
    	<label class="control-label col-md-4">Terminart</label>
    	<div class="col-md-8">
    		<label class="radio"><input type="radio" name="repetitive" id="radioTerminRepeat1" value="1" checked><?php echo $this->lang->line('termin_regular');?></label>
    		<label class="radio"><input type="radio" name="repetitive" id="radioTerminRepeat0" value="0"><?php echo $this->lang->line('termin_single');?></label>
    		<div class="help-block hidden dialog-start-date"><?php echo $this->lang->line('termin_start_week');?> : <span></span>.</div>
    	</div>
    </div>
    <div class="reservation hidden">
    	<!-- Nav pills -->
	    <div class="col-md-8 col-md-offset-4"> 
	    	<ul class="nav nav-pills" role="tablist" style="margin-bottom:0">
	    		<li class=""><a href="#isUser" role="tab" data-toggle="tab"><?php echo $this->lang->line('apntmnt_pat_id_btn');?></a></li>
	    		<li class=""><a href="#notUser" role="tab" data-toggle="tab"><?php echo $this->lang->line('apntmnt_general_insurance_btn');?></a></li>
	    	</ul>
	    </div>
	    	<!-- Tab panes -->
	    <div class="tab-content">
	    	<div class="tab-pane fade in" id="notUser">
	    		<div class="row">
	    			<div class="col-md-12">
	    				<div class="form-group form-group-sm" data-error-message="Bitte wählen Sie Ihre Anrede aus.">
	    					<label class="control-label col-sm-4"><?php echo $this->lang->line('apntmnt_pat_title_m');?></label>
	    					<div class="col-sm-8" style="display: inline-flex;">
	    						<label class="radio">
	    							<input name="gender" type="radio" id="gender-2" value="2" />
	    							<?php echo $this->lang->line('apntmnt_pat_title_m');?>
	    						</label>
	    						<label class="radio inline" >
	    							<input name="gender" type="radio" id="gender-1" value="1" />
	    							<?php echo $this->lang->line('apntmnt_pat_title_f');?>
	    						</label>
	    					</div>
	    				</div>
	    				<div class="form-group form-group-sm" data-error-message="Bitte geben Sie Ihren Vornamen ein.">
	    					<label for="first_name" class="control-label col-sm-4 char"><?php echo $this->lang->line('user_firstname');?></label>
	    					<div class="col-sm-8">
	    						<input type="text" class="form-control input-sm charonly" name="first_name" id="first_name" />
	    					</div>
	    				</div>
	    				<div class="form-group form-group-sm" data-error-message="Bitte geben Sie Ihren Nachnamen ein.">
	    					<label for="last_name" class="control-label col-sm-4 char"><?php echo $this->lang->line('user_lastname');?></label>
	    					<div class="col-sm-8">
	    						<input type="text" class="form-control input-sm charonly" name="last_name" id="last_name" />
	    					</div>
	    				</div>
	    				<div class="form-group form-group-sm" data-error-message="Bitte geben Sie Ihre E-Mail Adresse ein.">
	    					<label for="email" class="control-label col-sm-4">E-Mail</label>
	    					<div class="col-sm-8">
	    						<input type="email" class="form-control input-sm" name="email" id="email" value="" />
	    					</div>
	    				</div>
	    				<div class="form-group form-group-sm" data-error-message="Bitte geben Sie eine gültige Telefonnummer ein.">
	    					<label for="telephone" class="control-label col-sm-4 numeric"><?php echo $this->lang->line('pwidgets_my_account_mobile_number');?></label>
	    					<div class="col-sm-8">
	    						<input type="tel" class="form-control input-sm numeric" name="telephone" id="telephone" />
	    					</div>
	    				</div>
	    				<div class="form-group form-group-sm" data-error-message="Bitte wählen Sie Ihre Versicherungsart aus.">
	    					<label class="control-label col-sm-4 input-sm"><?php echo $this->lang->line('pat_insurance_type');?> <span class="optional-field">(freiwillig)</span></label>
	    					<div class="col-sm-8" style="display: inline-flex;">
	    						<label class="radio" > 
	    							<input name="insurance-type" type="radio" id="insurance-type-1" value="1" />
	    							<?php echo $this->lang->line('apntmnt_private_insurance_btn');?>
	    						</label>
	    						<label class="radio">
	    							<input name="insurance-type" type="radio" id="insurance-type-2" value="2" />
	    							<?php echo $this->lang->line('apntmnt_legal_insurance_btn');?>
	    						</label>
	    					</div>
	    				</div>
	    				<div class="form-group form-group-sm" data-error-message="Bitte wählen Sie Ihre Versicherung aus.">
	    					<label for="insurance_provider" class="control-label col-sm-4 input-sm"><?php echo $this->lang->line('pat_insurance_name');?> <span class="optional-field">(freiwillig)</span></label>
	    					<div class="col-sm-8">
	    						<select name="insurance_provider" id="insurance_provider" data-placeholder="...bitte wählen..." class="form-control input-sm bs-form-control" >
	    							<option value="0">...<?php echo $this->lang->line('pat_insurance_choose');?>...</option>
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
	    		<label class="control-label col-sm-4 input-sm"><?php echo $this->lang->line('apntmnt_pat_existence').' '.$this->m->user_value('academic_grade').' '.$this->m->user_value('name').' '.$this->m->user_value('surname'); ?>?</label>
	    		<div class="col-sm-8" style="display: inline-flex;">
	    			<label class="radio">
	    				<input name="returning_visitor" type="radio" id="is-patient-1" value="1" >
	    				<?php echo $this->lang->line('apntmnt_pat_existence_y');?>
	    			</label>
	    			<label class="radio">
	    				<input name="returning_visitor" type="radio" id="is-patient-2" value="0" >
	    				<?php echo $this->lang->line('apntmnt_pat_existence_n');?>
	    			</label>
	    		</div>
	    	</div>
	    </div>
    </div>
    <!--
    <div class="form-group">
        <label class="control-label col-md-4">Patient</label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="inputPatient" name="text_patient" placeholder="Patient">
        </div>
    </div>-->
    <div class="form-group">
        <label class="control-label col-md-4"><?php echo $this->lang->line('apntmnt_new_remark');?></label>
        <div class="col-md-8">
            <textarea class="form-control" id="inputNotes" name="text_notes" placeholder="Anmerkung" rows="3"></textarea>
        </div>
    </div>
	<!--
	<div class="row">
	    <div class="col-md-12">
	      <p class="text-right">
	        <button class="btn btn-primary">Speichern</button>
	        <button class="btn btn-default">Abbrechen</button>
	      </p>
	    </div>
	</div> -->
</div>

<div id="dialogApplyChangesTo">
	<div class="row">
		<div class="col-md-12">
			<?php echo $this->lang->line('termin_change_question');?>
		</div>
	</div>
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
	#topBar*{ float:left}
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

