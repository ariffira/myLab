
<?php 
$cancel_before = explode(" ", $calendar_setting->min_cancel_before);
$advance_book  = explode(" ", $calendar_setting->max_advance_booking);
?>

<div class="row">
	<div class="col-sm-12">
		<form role="form" method="post" action=<?php echo site_url('termin/doctor/settings/update_general_settings'); ?> enctype="multipart/form-data">
			<fieldset>
				<div class="form-group row">
					<div class="col-sm-4 form-inline">
						<label for="cancel_before">
							<?php echo $this->lang->line('cal_min_cancelation_before')?$this->lang->line('cal_min_cancelation_before'):'Minimum cancelation before';?>
						</label>				
					</div>
					<div class="col-sm-8 form-inline">
						<input type="number" class="form-control" max="999" min="1" name="cancel_before" value="<?php echo $cancel_before[0];?>" />
						<select class="form-control" name="cancel_before_time">
							<option value="days" <?php echo $cancel_before[1]=='days'?'selected="selected"':'';?> ><?php echo $this->lang->line('date_days');?></option>
							<option value="weeks" <?php echo $cancel_before[1]=='weeks'?'selected="selected"':'';?> ><?php echo $this->lang->line('date_weeks');?></option>
							<option value="months" <?php echo $cancel_before[1]=='months'?'selected="selected"':'';?> ><?php echo $this->lang->line('date_months');?></option>
						</select>
					</div>
				</div>
			</fieldset>

			<hr/>

			<fieldset>
				<div class="form-group row">
					<div class="col-sm-4 form-inline">
						<label for="advance_booking">
							<?php echo $this->lang->line('cal_max_advance_book')?$this->lang->line('cal_max_advance_book'):'Maximum advance booking';?>
						</label>
					</div>
					<div class="col-sm-8 form-inline">
						<input type="number" class="form-control" max="999" min="1" name="advance_booking" value="<?php echo $advance_book[0];?>" />
						<select class="form-control" name="advance_booking_time" id="time">
							<option value="days" <?php echo $advance_book[1]=='days'?'selected="selected"':'';?> ><?php echo $this->lang->line('date_days');?></option>
							<option value="weeks" <?php echo $advance_book[1]=='weeks'?'selected="selected"':'';?> ><?php echo $this->lang->line('date_weeks');?></option>
							<option value="months" <?php echo $advance_book[1]=='months'?'selected="selected"':'';?> ><?php echo $this->lang->line('date_months');?></option>
						</select>
					</div>
				</div>
			</fieldset>

			<hr/>

			<fieldset>
				<div class="col-sm-6">
					<div align="center">
						<h5>Vacation Settings</h5>
					</div>
					<div class="row vacations">
						<!--Here comes the vacations of the doctor-->
					</div>
					<div class="form-group row" align="center">
						<button class="addVacation btn btn-success"><span class="icomoon i-plus-circle-2"></span></button>
					</div>
				</div>
				<div class="col-sm-6">
					<div align="center">
						<h5>Closed days/holidays</h5>
					</div>
					<div class="row closed-day" align="center">
						
					</div>
					<div class="form-group row" align="center">
						<button class="addClosedDay btn btn-success"><span class="icomoon i-plus-circle-2"></span></button>
					</div>
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
</div>



<script id="vacation-template" type="text/x-custom-template">
	<div class="form-group row">
		<div class="col-sm-4">
			<label for="vacation_start">
				Vacation Start
			</label>
		</div>
		<div class="col-sm-8">
			<input type="text" class="form-control date-picker" data-date-format="dd.mm.yyyy" name="vacation_start[]" id="vacation_start" value="<?php echo isset($calendar_setting->vacation_start)?$calendar_setting->vacation_start:'';?>">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-4">
			<label for="vacation_end">
				Vacation end
			</label>
		</div>
		<div class="col-sm-8">
			<input type="text" class="form-control date-picker" data-date-format="dd.mm.yyyy" name="vacation_end[]" id="vacation_end" value="<?php echo isset($calendar_setting->vacation_end)?$calendar_setting->vacation_end:'';?>">
		</div>
	</div>
</script>

<script id="closed-day-template" type="text/x-custom-template">
	<div class="col-sm-4"></div>
	<div class="form-group row col-sm-8">
		<input type="text" class="form-control date-picker" data-date-format="dd.mm.yyyy" name="closed_day[]" value="">
	</div>
</script>

<script type="text/javascript">
	$('.addVacation').on('click',function(e) {
		e.preventDefault();
		$('.vacations').append($('#vacation-template').html());
		$.pageSetup($('.vacations'));
	});

	$('.addClosedDay').on('click',function(e){
		e.preventDefault();
		$('.closed-day').append($('#closed-day-template').html());
		$.pageSetup($('.closed-day'));
	});
</script>

