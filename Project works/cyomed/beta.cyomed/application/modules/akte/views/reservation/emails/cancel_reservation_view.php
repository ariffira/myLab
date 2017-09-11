<html>
<body>
	<?php
	if ($gender == 1) {
		$gendermsg = $this->lang->line('greeting_female');
	}
	else {
		$gendermsg = $this->lang->line('greeting_male');
	}
	?>
	<p></p>
	<p>
		<?php echo $this->lang->line('reserv_email_greeting');?> <?php echo $gendermsg." ".$first_name." ".$last_name; ?>,
		<?php echo $this->lang->line('reserv_email_head');?> <?php echo $start;?> 
		<?php echo $this->lang->line('reserv_email_head2');?>:
		<b><?php echo $this->lang->line('reserv_email_name');?>:</b> <?php echo $gendermsg." ".$first_name." ".$last_name; ?>
		<b><?php echo $this->lang->line('reserv_email_gender');?>:</b> <?php if ($gender == 1) {
			echo 'Male';
		}
		else {
			echo 'Female';
		} ?>
		<b><?php echo $this->lang->line('reserv_email_start');?>:</b> <?php echo $start; ?>
		<b><?php echo $this->lang->line('reserv_email_end');?>:</b> <?php echo $end; ?>
		<b><?php echo $this->lang->line('reserv_email_phone');?>:</b> <?php echo $telephone; ?>
	</p>

	<p>
		<strong>
			<?php echo $this->lang->line('reserv_email_foot');?>
		</strong>
	</p>
	<p>
		<strong>
			<?php echo $this->lang->line('reserv_email_foot2');?>
		</strong>
	</p>

</body>
</html>
