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

<p>herzlichen Dank für Ihre Anmeldung bei IhrArzt24 / Cyomed und willkommen bei Ihrem persönlichen Gesundheitsmanager!<br /><br />
Sie haben sich für das Free Paket für 0,00 € pro Monat mit folgenden Leistungen entschieden </p>
<p>
<ul><li>persönliche Gesundheitsakte (eGA)</li>
	<li>Gesundheitstagebuch</li>
	<li>persönlicher Notfalldatensatz</li>
	</ul>
</p>
<p>
Im Anhang erhalten Sie Ihren Benutzervertrag im PDF-Format zugestellt. Bitte prüfen Sie sämtliche Angaben und korrigieren diese falls nötig. Bei bedarf können Sie sich unter folgende Adressen an uns wenden:
</p>
<p>Kostenlose Registrierung für das IhrArzt24 / Cyomed Gesundheitsportal
<a href="<?php echo site_url().'/term/output/serviceContractPatient/1';?>">IhrArzt24 / Cyomed - Servicevertrag</a> </p>
<p>Kostenlose Registrierung für das IhrArzt24 / Cyomed Gesundheitsportal
<a href="<?php echo site_url().'/term/output/privacyPatient/2';?>">IhrArzt24 / Cyomed - Datenschutz Einwilligungserklärung</a> 
</p>
<p>
IhrArzt24 GmbH / cyomed<br />
Hüttesntr. 30<br />
40215 Düsseldorf<br /><br />
oder per Fax an 0211 / 972 640 96<br /><br />
oder via Email an kundenservice@ihrarzt24.de.
</p>
<p>Der Zugang zu Ihrer Gesundheitsakte ist sofort für Sie frei geschaltet, die Nutzung der medizinischen Hotline, der Internetberatung und der weiteren Services steht Ihnen nach Autorisierung durch Ihre Unterlagen sofort zur Verfügung.<br /><br />
Wenn Sie innerhalb der nächsten 14 Tage nichts von uns hören, kontaktieren Sie uns bitte unter 0211 / 972 640 94 oder per E-Mail an kundenservice@ihrarzt24.de
</p>

<p><strong>Mit freundlichen Grüßen aus Düsseldorf</strong></p>
<p>Ihr IhrArzt24 / Cyomed Team</p>
</body>
</html>
