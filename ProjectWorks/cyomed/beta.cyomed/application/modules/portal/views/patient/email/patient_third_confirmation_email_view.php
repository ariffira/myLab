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

</p>
<p>
<ul>
	<li>
      <?php echo $this->lang->line('reg_3rd_email_info_record'); ?>
    </li>
	<li>
		
	</li>
	<li>

	</li>
	</ul>
</p>
<p>
   <?php echo $this->lang->line('reg_3rd_email_info_pdf'); ?>
</p>
<p>
    <?php echo $this->lang->line('reg_lang_sys_info'); ?>
<a href="<?php echo site_url().'/portal/term/output/serviceContractPatient/1';?>">
    <?php echo $this->lang->line('reg_lang_sys_service'); ?>
</a>
</p>
<p>
    <?php echo $this->lang->line('reg_lang_sys_info'); ?>
<a href="<?php echo site_url().'/portal/term/output/privacyPatient/2';?>">
    <?php echo $this->lang->line('reg_lang_sys_privacy'); ?>
</a> 
</p>
<p>
IhrArzt24 GmbH / cyomed<br />
Hüttesntr. 30<br />
40215 Düsseldorf<br /><br />
Fax an 0211 / 972 640 96<br /><br />
Email an kundenservice@ihrarzt24.de.
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
