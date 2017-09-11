<div class="already-registered pull-right">
  Sind Sie bereits registriert? 
  <a href="<?php echo site_url('portal/patient/login'); ?>">
    Hier einloggen.
  </a>
</div>
<h1>
  Registrieren Sie sich als : 
  <img src="<?php echo base_url('assets/images/doctor_reg.png'); ?>" alt="" /> 
</h1>


<!--doctor FORM-->
<div id="doctor">
  <form class="form-horizontal" role="form" name="doctorform" id="doctorform" action="" method="post">

    <div class="form-group"> 
      Ärzte Anmeldeformular 
    </div> 

    <div class="form-group">
      <label for="firstname"  class="col-md-3 control-label" >
        Vorname 
        <span style="color:red">
          *
        </span>
      </label>
      <div class="col-md-3">
        <input type="text" class="form-control input-lg"  name="doctors_firstname" id="doctors_firstname" placeholder="Vorname"/>
      </div>
      <label for="lastname" class="col-md-3 control-label" >
        Nachname
        <span style="color:red">
          *
        </span>
      </label>
      <div class="col-md-3">
        <input type="text" class="form-control input-lg"  name="doctors_surname" id="doctors_surname" placeholder="Nachname"/>
      </div>
    </div>



    <div class="form-group">
      <label for="doctorsgrade" class="col-md-3 control-label" >
        Akademischer Grad
      </label>
      <div class="col-md-3">
        <input type="text" class="form-control input-lg"  name="doctors_grade" id="doctors_grade" placeholder=""/>
      </div>


      <label for="address" class="col-md-3 control-label" >
        Strasse und Hausnummer 
        <span style="color:red">
          *
        </span>
      </label>
      <div class="col-md-3">
        <input type="text" class="form-control input-lg"  name="doctors_address" id="doctors_address" placeholder="e.g. Hirschberger strasse,64"/>
      </div>

    </div>



    <div class="form-group">
      <label for="region"  class="col-md-3 control-label" >
       Region
     </label>
     <div class="col-md-3">
      <input type="text" class="form-control input-lg"  name="doctor_region" id="doctor_region" placeholder=""/>
    </div>

    <label for="country" class="col-md-3 control-label" >
      Land
    </label>
    <div class="col-md-3">
      <select class="form-control" type="text" name="doctors_country" id="doctorscountry">
        <option value="">
          Land wählen
        </option>
        <?php foreach ($country_arr as $row) : ?>
        <option value="<?php echo $row->id; ?>">
          <?php echo $row->country_name; ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

</div>


<div class="form-group">
  <label for="email"  class="col-md-3 control-label" >
    Email
    <span style="color:red">
      *
    </span>
  </label>
  <div class="col-md-3">
    <input type="text" class="form-control input-lg"  name="doctors_email" id="doctors_email" placeholder="e.g. ricardo@ihrarzt.de"/>
  </div>

  <label for="email_confirm" class="col-md-3 control-label" >
    E-Mail Adresse wiederholen
    <span style="color:red">
      *
    </span>
  </label>
  <div class="col-md-3">
    <input type="text" class="form-control input-lg"  name="doctors_email_confirm" id="doctors_email_confirm" placeholder=""/>
  </div>

</div>

<div class="form-group">
  <label for="password"  class="col-md-3 control-label" >
    Passwort
    <span style="color:red">
      *
    </span>
  </label>
  <div class="col-md-3">
    <input type="password" class="form-control input-lg"  name="doctors_password" id="doctors_password" placeholder="*************"/>
  </div>

  <label for="password_confirm" class="col-md-3 control-label" >
    Passwort wiederholen
    <span style="color:red">
      *
    </span>
  </label>
  <div class="col-md-3">
    <input type="password" class="form-control input-lg"  name="doctors_password_confirm" id="doctors_password_confirm"  placeholder="***********"/>
  </div>

</div>



<div class="form-group">
  <label for="mobile"  class="col-md-3 control-label" >
    HandyNummer
  </label>
  <div class="col-md-3">
    <input type="text" class="form-control input-lg"  name="doctors_mobile" id="doctors_mobile" placeholder="015*-********"/>
  </div>

  <label for="telephone" class="col-md-3 control-label" >
    Telephone
    <span style="color:red">
      *
    </span>
  </label>
  <div class="col-md-3">
    <input type="text" class="form-control input-lg"  placeholder="" name="doctors_telephone" id="doctors_telephone"/>
  </div>
</div>

<div class="form-group">
  <label for="doctorswebsite"  class="col-md-3 control-label" >
    Internetseite
  </label>
  <div class="col-md-3">
    <input type="text" class="form-control input-lg"  name="doctors_website" id="doctors_website" placeholder="e.g. www.ihrazt24.de"/>
  </div>

  <label for="doctorsfax" class="col-md-3 control-label" >
    Faxnummer
    <span style="color:red">
      *
    </span>
  </label>
  <div class="col-md-3">
    <input type="text" class="form-control input-lg"  placeholder="" name="doctors_fax" id="doctors_fax"/>
  </div>
</div>



<div class="form-group">
  <label for="doctorseme_number"  class="col-md-3 control-label" >
    Notfallnummer falls vorhanden
  </label>
  <div class="col-md-3">
    <input type="text" class="form-control input-lg" name="doctorseme_number" id="doctorseme_number" placeholder=""/>
  </div>

  <label for="" class="col-md-3 control-label" >
    Fachrichtung
  </label>

  <div class="col-md-3">
    <select class="form-control" type="text" name="doctors_speciality" id="doctors_speciality">

      <option value="">
        Wählen Spezialisierung ein
      </option>
      <?php foreach ($specialization_arr as $row) : ?>
      <option value="<?php echo $row->id; ?>">
       <?php echo $row->splizn_name; ?> 
     </option>
     
   </option>
 <?php endforeach; ?>

</select>
</div>

</div>



<div class="form-group">
  <label for="" class="col-md-3 control-label" >
    Zusatzbezeichnung
  </label>

  <div class="col-md-3">
    <select class="form-control" type="text" name="doctors_designation_add" id="doctors_designation_add">

      <option value="">
        Wählen Zusatzbezeichnung
      </option>
      <?php foreach ($title_arr as $row) : ?>
      <option value="<?php echo $row->id; ?>">
        <?php echo $row->addn_name; ?>
      </option>
    <?php endforeach; ?>

  </select>
</div>

</div>


<div class="form-group">

  <label for="avatar" class="col-md-3 control-label" >
    Bild Hochladen
  </label>
  <div class="col-md-3">
   <input type="file" name="avatar" id="avatar">
 </div>

</div>

<div class="form-group">
  <div class="checkbox">
    <label>
      <input type="checkbox" name="checkbox" id="checkbox" value="">
      "Hiermit willige ich in die Erhebung, Verarbeitung und Nutzung meiner personenbezogenen Daten ein und gestatte der IhrArzt24 GmbH gemäß der Datenschutzbestimmumgen diese, widerruflich, für die Kontaktaufnahme und Vetragserfüllung zu verwenden."
    </br>
    <span style="color:red;">* notwendige Angabe</span>
  </label>
</div>
</div>

<div class="form-group">
 <div class="col-md-6">
  <button type="submit" class="btn btn-primary">Akzeptieren</button>
</div>
<div class="col-md-6">
 <button type="reset" class="btn btn-warning">Rücksetzen</button>
</div>
</div>


</form>

</div>



<!--doctor FORM finish-->

