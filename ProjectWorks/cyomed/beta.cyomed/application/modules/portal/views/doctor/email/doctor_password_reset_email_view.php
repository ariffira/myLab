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
<p><?php echo $gendermsg . $name . $surname; ?>,</p>
<p>
	<?php echo $this->lang->line('email_body_1'); ?>
</p>
<p>
    <?php echo $this->lang->line('email_body_2'); ?>
</p>
<p>
<table cellpadding='0' cellspacing='0'>
	<tr>
		<td>
			<b>
               <?php echo $this->lang->line('email_body_doc_id'); ?>
			</b>&nbsp;
			<b><?php echo $regid; ?></b>
		</td>
	</tr>
	<tr>
		<td>
			<b>
               <?php echo $this->lang->line('email_body_doc_pin'); ?>
			</b>&nbsp;
			<b><?php echo $pin; ?></b>
		</td>
	</tr>
	<tr>
		<td>
			<b>
               <?php echo $this->lang->line('email_body_temp_pass'); ?>
			</b>&nbsp;
			<b><?php echo $temp_pass; ?></b>
		</td>
	</tr>
</table>
</p>

<p>
    <?php echo $this->lang->line('email_body_if_err'); ?>
<a href="<?php echo site_url().'/portal/doctor/forgot/change_password';?>?email=<?php echo $email;?>&code=<?php echo $confirm_code;?>">
	<?php echo $this->lang->line('email_body_link_confirm'); ?>
	
</a> </p><br /> 
<p>
		<?php echo $this->lang->line('email_body_3'); ?>
</p> 
<p>
	    <?php echo $this->lang->line('email_body_4'); ?>
</p>
<p>
	    <?php echo $this->lang->line('email_body_contact'); ?>
<a href="mailto:kundendienst@ihrarzt24.de">kundendienst@ihrarzt24.de</a></p>
<p><strong>
    <?php echo $this->lang->line('email_body_5'); ?>
</strong></p>
<p><strong>
    <?php echo $this->lang->line('email_body_6'); ?>
	</strong></p>
</body>
</html>
