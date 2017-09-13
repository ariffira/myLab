<div class="block block-theme1 block-cyan-chart">
	<h2 class="title">
	   <?php echo $this->lang->line('reserv_change_title');?>
	</h2>
	<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('akte/reservation/modify'); ?>"  enctype="multipart/form-data">
		<input type="hidden" name="reserv_id" id="reserv_id<?php echo $reserv_id;?>" value="<?php echo $reserv_id;?>" class="form-control">
		<fieldset>

			<div class="form-group">
				<label for="disabledTextInput">
	               <?php echo $this->lang->line('reserv_new_date');?>
				</label>
				<input type="text"  name="newDate" id="newDate<?php echo $newDate;?>" value="<?php echo $newDate;?>" class="form-control">
				<input type="hidden" name="newEndDate" id="newEndDate<?php echo $newEndDate;?>" value="<?php echo $newEndDate;?>" class="form-control">
			</div>

			<div class="form-group">
				<label>
	               <?php echo $this->lang->line('reserv_user_info');?>
				</label><br>
				<label for="">
	               <?php echo $this->lang->line('reserv_user_name');?>
				</label>
				<input type="text" name="name" id="name" value="<?php echo $first_name . " " .$last_name;?>" class="form-control">
			</div>

			<div class="form-group">
				<label for="">
	               <?php echo $this->lang->line('reserv_user_sex');?>
				</label>
				<input type="text" name="gender" id="gender" value="<?php if ($gender == 1) {
				 echo 'Female';
				}else {
					echo 'Male';
				} ?>" class="form-control">
			</div>

			<button type="submit" class="btn btn-primary">
	              <?php echo $this->lang->line('reserv_new_confirm_btn');?>
			</button>
		</fieldset>
	</form>


</div>


