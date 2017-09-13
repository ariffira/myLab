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
<p><?php echo $gendermsg." ".$name." ".$surname; ?>,</p>
<p><?php echo $this->lang->line('reg_lang_2nd_email_sub'); ?></p>
<p><?php echo $this->lang->line('reg_lang_thanks_giving'); ?></p>
<p><?php echo $this->lang->line('reg_lang_packet_info_pat'); ?></p>
<p><?php echo $this->lang->line('reg_lang_email_info'); ?>
<a href="<?php echo site_url().'/portal/patient/register/patient_validation';?>?email=<?php echo $email;?>&code=<?php echo $confirm_code;?>" target="_blank">
<?php echo $this->lang->line('reg_part_confirm_link'); ?>
</a> 
</p>
<p>
	<strong>
      <?php echo $this->lang->line('email_body_contact'); ?>
	</strong>
</p>
<p>
	<strong>
      <?php echo $this->lang->line('email_body_5').'<br>'. $this->lang->line('email_body_6'); ?>
    </strong>
</p>
</body>
</html>
