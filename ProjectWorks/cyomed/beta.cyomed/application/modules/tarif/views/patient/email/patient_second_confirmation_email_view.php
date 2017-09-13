<html>
<body>
<?php
if ($gender == 1) {
    $gendermsg = "geehrte Frau";
}
else {
    $gendermsg = "geehrter Herr";
}
?>
<p>Sehr <?php echo $gendermsg; ?>&nbsp;<?php echo $name; ?>&nbsp;<?php echo $surname; ?>,</p>

<p>Herzlichen Dank für Ihre Anmeldung bei IhrArzt24 / cyomed und willkommen bei Ihrem persönlichen Gesundheitsmanager!
<br /><br />
Mit dieser Mail erhalten Sie Ihre persönliche Patienten-ID und das Ihre PIN: 
</p>
<p>
<table cellpadding='0' cellspacing='0'>
	<tr>
		<td>
			<b>Patient-ID:</b>&nbsp;
			<b><?php echo $regid; ?></b>
		</td>
	</tr>
	<tr>
		<td>
			<b>PIN:</b>&nbsp;
			<b><?php echo $pin; ?></b>
		</td>
	</tr>

	</table>
</p>
<p>
Bitte speichern Sie diese Mail ab oder drucken Sie diese aus und verwahren Sie sie an einem sicheren Ort, um sie vor Zugriff durch nicht autorisierte Personen zu schützen.<br /><br />
Sollten Sie noch Fragen haben oder Ihre Zugangsdaten verlieren, kontaktieren Sie uns bitte sofort unter <b>0211 – 972 640 94</b> oder per E-Mail unter kundenservice@ihrarzt24.de
</p>

<p><strong>Mit freundlichen Grüßen aus Düsseldorf</strong></p>
<p>Ihr IhrArzt24 / Cyomed Team</p>
</body>
</html>
