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
		<?php echo $this->lang->line('reserv_email_head_all');?>:<b> <?php echo $appointment_time;?> </b>
		<?php echo $this->lang->line('reserv_email_head_all2');?>: 
		<a href='<?php echo site_url().'/akte/reservation/change_reservation';?>?reserv_id=<?php echo $reserv_id;?>&id=<?php echo $id;?>'>
        <?php echo $this->lang->line('reserv_email_url');?>
        </a>
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
