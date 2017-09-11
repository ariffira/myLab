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
<?php echo $this->lang->line('reg_lang_thanks_giving'); ?>
<br /><br />
<?php echo $this->lang->line('reg_lang_email_info'); ?>
</p>
<p>
<table cellpadding='0' cellspacing='0'>
	<tr>
		<td>
			<b>
              <?php echo $this->lang->line('email_body_id'); ?>
			</b>&nbsp;
			<b><?php echo $regid; ?></b>
		</td>
	</tr>
	<tr>
		<td>
			<b>
              <?php echo $this->lang->line('email_body_pin'); ?>
			</b>&nbsp;
			<b><?php echo $pin; ?></b>
		</td>
	</tr>

	</table>
</p>
<p>
    <?php echo $this->lang->line('email_body_4'); ?>
<br /><br />
 <?php echo $this->lang->line('email_body_contact'); ?>
<b>0211 – 972 640 94</b> 
</p>

<p>
	<strong>
    <?php echo $this->lang->line('email_body_5'); ?>
    </strong>
</p>
<p>
<?php echo $this->lang->line('email_body_6'); ?>
</p>
</body>
</html>
