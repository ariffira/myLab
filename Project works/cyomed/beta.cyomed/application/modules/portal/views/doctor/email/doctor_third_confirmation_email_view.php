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
<br/>
<?php echo $this->lang->line('reg_lang_appointment_link'); ?>
<!-- <a href="<?php echo base_url().'../tarif'; ?>" target="_parent"> hier: </a> <br />
 -->
<a href="<?php echo base_url().'../tarif'; ?>" target="_parent"> https://www.ihrarzt24.de/apps/beta.cyomed/index.php/tarif/ </a><br/>

</p>
<p>
  <?php echo $this->lang->line('reg_lang_contact_policy'); ?>
</p>
<p>
	<?php echo $this->lang->line('reg_lang_sys_info'); ?>
<a href="<?php echo site_url().'/portal/term/output/serviceContractDoctor/3';?>">
	<?php echo $this->lang->line('reg_lang_sys_service'); ?>
</a> </p>
<p>
	<?php echo $this->lang->line('reg_lang_sys_info'); ?>
	<a href="<?php echo site_url().'/portal/term/output/privacyDoctor/4';?>">
	<?php echo $this->lang->line('reg_lang_sys_privacy'); ?>
</a> 
</p>
<p>
Cyomed GmbH.<br />
Hüttenstr. 30<br />
40215 Düsseldorf<br /><br />
0211 / 972 640 96<br /><br />
kundenservice@ihrarzt24.de.
</p>

<p>
	<?php echo $this->lang->line('email_body_contact'); ?>

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
