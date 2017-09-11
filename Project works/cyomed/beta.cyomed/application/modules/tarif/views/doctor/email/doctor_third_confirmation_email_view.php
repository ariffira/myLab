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

<p>herzlichen Dank für Ihre Anmeldung bei IhrArzt24 / cyomed.<br/>
wenn Sie sich für unsere Online-Arztterminlösung interessieren, bitte clicken Sie <a href="<?php echo base_url().'../ia24tarif'; ?>" target="_parent"> hier: </a> <br />
<a href="<?php echo base_url().'../ia24tarif'; ?>" target="_parent"> https://www.ihrarzt24.de/apps/ia24tarif/ </a><br/>

</p>
<p>Möchten Sie sich als beratender Arzt bei uns bewerben, bitte wir Sie uns eine gut lesbare Kopie eines amtlichen Ausweises sowie eine Kopie Ihrer Approbation und Ihrer Doc Check Kennung (falls vorhanden) per Post an folgende Adresse:</p>
<p>Kostenlose Registrierung für das IhrArzt24 / Cyomed Gesundheitsportal
<a href="<?php echo site_url().'/term/output/serviceContractDoctor/3';?>">IhrArzt24 / Cyomed - Servicevertrag</a> </p>
<p>Kostenlose Registrierung für das IhrArzt24 / Cyomed Gesundheitsportal
<a href="<?php echo site_url().'/term/output/privacyDoctor/4';?>">IhrArzt24 / Cyomed - Datenschutz Einwilligungserklärung</a> 
</p>
<p>
IhrArzt24 GmbH / cyomed<br />
Hüttenstr. 30<br />
40215 Düsseldorf<br /><br />
oder per Fax an 0211 / 972 640 96<br /><br />
oder via Email an kundenservice@ihrarzt24.de.
</p>

<p>Wenn Sie innerhalb der nächsten 14 Tagen nichts von uns hören, kontaktieren Sie uns bitte unter 0211 / 972 640 94 oder per E-Mail an kundenservice@ihrarzt24.de</p>
<p><strong>Mit freundlichen Grüßen aus Düsseldorf</strong></p>
<p>Ihr IhrArzt24 / Cyomed Team</p>
</body>
</html>
