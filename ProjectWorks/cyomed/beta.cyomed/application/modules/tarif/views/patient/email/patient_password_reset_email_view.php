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
<p>Wir freuen uns, dass Sie unser Service-Center nutzen möchten. Aufgrund Ihrer Passwortanforderung senden wir Ihnen die folgenden Zugangsdaten:</p>
<p>Diese lauten: 
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
	<tr>
		<td>
			<b>Temporary Password:</b>&nbsp;
			<b><?php echo $temp_pass; ?></b>
		</td>
	</tr>
</table>
</p>

<p>Falls beim Ausführen des Links ein Fehler auftritt, kopieren Sie bitte den vollständigen Link in das Eingabefeld Ihres Browsers.  Hier Ihre Email addresse zu
<a href="<?php echo site_url().'/patient/forgot/change_password';?>?email=<?php echo $email;?>&code=<?php echo $confirm_code;?>">Bestätigen</a> </p><br />
<p>Unabhängig davon, ob Sie bereits zuvor ein Passwort bei uns hatten, gilt ab Eintragung dann nur noch Ihr neues Passwort. Ihr Direktlink zur Passworteintragung ist nur einmal nutzbar.</p> 
<p>Bitte speichern Sie diese Mail ab oder drucken Sie diese aus und verwahren Sie sie an einem sicheren Ort, um
sie vor Zugriff durch nicht autorisierte Personen zu schützen.</p>
<p>Sollten Sie noch Fragen haben oder Ihre Zugangsdaten verlieren, kontaktieren Sie uns bitte sofort unter
0211 / 732 78 830 oder per E-Mail unter <a href="mailto:kundendienst@ihrarzt24.de">kundendienst@ihrarzt24.de</a></p>
<p><strong>Mit freundlichen Grüßen aus Düsseldorf</strong></p>
<p><strong>Ihr Cyomed Team. Cyomed GmbH</strong></p>
</body>
</html>
