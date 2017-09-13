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

<p>Sie haben Ihr Passwort vergessen.
<br /><br />
Bitte Klicken Sie hier, um es zu ändern oder zu ignorieren / die E-Mail zu löschen, wenn Sie nicht, es zu tun
<a href="<?php echo base_url().'../ia24portal/index.php/patient/forgot/change_password'; ?>">Change password</a>
</p>
<p>
Sollten Sie noch Fragen haben oder Ihre Zugangsdaten verlieren, kontaktieren Sie uns bitte sofort unter <b>0211 – 972 640 94</b> oder per E-Mail unter kundenservice@cyomed.de
</p>

<p><strong>Mit freundlichen Grüßen aus Düsseldorf</strong></p>
<p>Ihr Cyomed Team</p>
</body>
</html>
