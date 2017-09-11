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
<p>Wilkommen Sie bei cyomed. </p>
<p>sie haben sich unter dieser Email Adresse bei Cyomed registriert und das FREE Paket gebucht . </p>
<p>Bitte klicken Sie auf den folgenden Link, um Ihre Email Adresse zu bestätigen. Hier Ihre Email addresse zu 
<a href="<?php echo site_url().'/patient/register/patient_validation';?>?email=<?php echo $email;?>&code=<?php echo $confirm_code;?>">Bestätigen</a> </p>
<p><strong>Mit freundlichen Grüßen aus Düsseldorf</strong></p>
<p><strong>Ihr Cyomed Team</strong></p>
</body>
</html>
