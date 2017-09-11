<table border="0" cellpadding="0" cellspacing="0" width="400" style="padding: 20px; margin-bottom: 20px; background-color: #F5F5F5; border: 1px solid #E3E3E3; border-radius: 4px; box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.05) inset;">
	<tbody>
		<tr><td colspan="2"><img src="<?php echo site_url('../assets/img/logo/logo.png');?>"/></td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">Hello <?php echo $first_name.' '.$last_name.',';?></td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2"><?php echo $reminder_email_body;?></td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">Here are the details for your records...</td></tr>
		<tr><th align="left">Termin Time:</th> <td><?php echo $termin_time;?></td></tr>
		<tr><th align="left">Doctor:</th> <td><?php echo $doctor;?></td></tr>
		<tr><th align="left">Gender:</th> <td><?php echo $gender;?></td></tr>
		<tr><th align="left">First Name:</th> <td><?php echo $first_name;?></td></tr>
		<tr><th align="left">Last name:</th> <td><?php echo $last_name;?></td></tr>
		<tr><th align="left">Email:</th> <td><?php echo $email;?></td></tr>
		<tr><th align="left">Telephone:</th> <td><?php echo $telephone;?></td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">Thank You</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">With regards,</td></tr>
		<tr><td colspan="2">Cyomed Team</td></tr>
	</tbody>
</table>