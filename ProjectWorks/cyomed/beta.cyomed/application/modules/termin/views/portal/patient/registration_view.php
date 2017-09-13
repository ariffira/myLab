<div class="already-registered pull-right">
  Sind Sie bereits registriert? 
  <a href="<?php echo site_url('portal/patient/login'); ?>">
    Hier einloggen.
  </a>
</div>
<h1>
  Registrieren Sie sich als : 
  <img src="<?php echo base_url('assets/images/patient_reg.png'); ?>" alt="" />
</h1>

<!--PATIENT FORM-->
<div id="patient">
  <form class="form-horizontal" role="form" name="patientform" id="patientform" action="" method="post">
    <div class="form-group"> 
      Patienten Anmeldeformular 
    </div>


    <div class="form-group">
      <label for="firstname"  class="col-md-3 control-label">
        Vorname 
        <span style="color:red">
          *
        </span>
      </label>
      <div class="col-md-3">
        <input type="text" class="form-control input-lg" name="patientfirstname" id="patient_firstname" placeholder="Vorname"/>
      </div>

      <label for="lastname" class="col-md-3 control-label">
        Nachname
        <span style="color:red">
          *
        </span>
      </label>
      <div class="col-md-3">
        <input type="text" class="form-control input-lg" name="patientsurname" id="patient_surname" placeholder="Nachname"/>
      </div>
    </div>


    <div class="form-group">
      <label for="birthname"  class="col-md-3 control-label" >
        Geburtsname
      </label>
      <div class="col-md-3">
        <input type="text" class="form-control input-lg"  name="birthname" id="birthname" placeholder="Geburtsname"/>
      </div>

      <label for="birthdate" class="col-md-3 control-label">
        Geburtstag
        <span style="color:red">
          *
        </span>
      </label>
      <div class="col-md-3">
        <input type="text" class="form-control input-lg" placeholder="Geburtstag" name="dob" id="dob"/>
      </div>
    </div>


    <div class="form-group">
      <label for="gender"  class="col-md-3 control-label">
        Geschlecht
        <span style="color:red">
          *
        </span>
      </label>

      <div class="col-md-3">
        <div class="radio">
          <label>
            <input  type="radio" name="gender" id="radio" value="Female" />
            weiblich/ Frau
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="gender" id="radio" value="Male"/>
              männlich/ Mann
            </label>
          </div>
        </div>

        <label for="address" class="col-md-3 control-label">
          Strasse und Hausnummer 
          <span style="color:red">
            *
          </span>
        </label>
        <div class="col-md-3">
          <input type="text" class="form-control input-lg" name="address" id="patient_address" placeholder="e.g. Hirschberger strasse,64"/>
        </div>

      </div>

      <div class="form-group">
        <label for="zip"  class="col-md-3 control-label">
          PLZ(Postleitzahl)
        </label>
        <div class="col-md-3">
          <input type="text" class="form-control input-lg" name="zip" id="zipcode" placeholder="e.g. 53119"/>
        </div>

        <label for="city" class="col-md-3 control-label">
          Stadt
          <span style="color:red">
            *
          </span>
        </label>
        <div class="col-md-3">
          <input type="text" class="form-control input-lg"  placeholder="e.g. Berlin" name="city" id="city"/>
        </div>

      </div>



      <div class="form-group">
        <label for="region"  class="col-md-3 control-label">
         Region
       </label>
       <div class="col-md-3">
        <input type="text" class="form-control input-lg" name="region" id="region" placeholder=""/>
      </div>

      <label for="country" class="col-md-3 control-label" >
        Land
      </label>
      <div class="col-md-3">
        <select class="form-control" type="text" name="country" id="patientscountry">
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
    <label for="mobile"  class="col-md-3 control-label" >
      HandyNummer
    </label>
    <div class="col-md-3">
      <input type="text" class="form-control input-lg"  name="mobile" id="mobile" placeholder="015*********"/>
    </div>

    <label for="telephone" class="col-md-3 control-label">
      Telephone
      <span style="color:red">
        *
      </span>
    </label>
    <div class="col-md-3">
      <input type="text" class="form-control input-lg"  placeholder="" name="telephone" id="telephone"/>
    </div>
  </div>


  <div class="form-group">
    <label for="fax"  class="col-md-3 control-label">
      Faxnummer 
    </label>
    <div class="col-md-3">
      <input type="text" class="form-control input-lg"  name="faxnumber" id="faxnumber" placeholder=""/>
    </div>

    <label for="promocode" class="col-md-3 control-label">
      Promocode
    </label>
    <div class="col-md-3">
      <input type="text" class="form-control input-lg"  name="promocode" id="promocode" placeholder=""/>
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
      <input type="text" class="form-control input-lg"  name="email" id="email" placeholder="e.g. ricardo@ihrarzt.de"/>
    </div>

    <label for="email_confirm" class="col-md-3 control-label" >
      E-Mail Adresse wiederholen
      <span style="color:red">
        *
      </span>
    </label>
    <div class="col-md-3">
      <input type="text" class="form-control input-lg"  name="email_confirm" id="email_confirm" placeholder=""/>
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
      <input type="password" class="form-control input-lg"  name="password" id="password" placeholder="at least 6 characrter"/>
    </div>

    <label for="password_confirm" class="col-md-3 control-label" >
      Passwort wiederholen
      <span style="color:red">
        *
      </span>
    </label>
    <div class="col-md-3">
      <input type="password" class="form-control input-lg"  name="password_confirm" id="password_confirm" placeholder="******"/>
    </div>

  </div>



  <div class="form-group">
    <label for="insurance"  class="col-md-3 control-label">
      Versicherungsart
      <span style="color:red">
        *
      </span>
    </label>

    <div class="col-md-6">
      <div class="radio-inline" id="insurance">
        <label for="insurance-1" class="radio-inline">
          <input  type="radio" name="insurance" id="insurance-1" value="1" />
          <?php echo set_radio('insurance', '1'); ?>
          privat versichert
        </div>
        <div class="radio-inline">
          <label for="insurance-2" class="radio-inline">
            <input type="radio" name="insurance" id="insurance-2" value="2"/>
            gesetzlich versichert
          </label>
        </div>
      </div>
    </div>






    <div class="form-group bg-danger">

      Registrierung für die kostenlose persönliche Gesundheitsakte

    </div>


    <div class="form-group">
      IhrArzt24 - Servicevertrag
    </div> 

    <div class="form-group">
      <a href="# "  title="Servicevertrag">
       Klicken Sie hier 
     </a>
     <?php //$this->load->view("portal/services_popover_view"); ?>
   </div>


   <div class="form-group">
    IhrArzt24 - Datenschutz Einwilligungserklärung
  </div>

  <div class="form-group">
    <a  href="#"  title="Datenschutz Einwilligungserklärung">
     Klicken Sie hier 
   </a>
   <?php // $this->load->view("portal/privacy_popover_view"); ?>
 </div>

 <div class="form-group">
  <div class="checkbox">
    <label>
      <input type="checkbox" name="checkbox" id="checkbox" value="">

      "Ich stimme den Regelungen des IhrArzt24-Servicevertrages zu und willige in die Erhebung, Verarbeitung und Nutzung meiner personenbezogenen Daten einschließlich der von mir bestimmten Gesundheitsdaten, also auch besonderer Arten personenbezogener Daten gemäß § 3 Abs. 9 BDSG, gemäß der Einwilligungserklärung ein."
    </br>  </br>

    Um Ihr Konto verwenden zu können, müssen Sie die oben dargestellten Bedingungen ausdrücklich akzeptieren, indem Sie das Kontrollkästchen oben aktivieren. </br>
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
<!--patient FORM finish-->




