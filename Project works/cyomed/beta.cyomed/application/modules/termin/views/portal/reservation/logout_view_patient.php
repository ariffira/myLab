<script>
$(document).ready(function(){
$(".btn-primary").click(function(){
$("#tabIsUser").addClass('hidden');
$("#tabFinalStep").removeClass('hidden');
});

$(".btn-default").click(function(){
   $("#tabIsUser").removeClass('hidden');
   $("#tabFinalStep").addClass('hidden');
});

});
function cancelTermin(doctor_id){
         var URL = $.siteUrl+'/termin/patient_termin';
         var docpos =  $('.termin-load');
         $('html,body').animate({scrollTop: docpos.offset().top},'slow'); 
         $.loadUrl(URL,docpos);      
}
</script>
<div class="row">
<?php
if($user_role=='role_doctor'){
    $user_id = $patient_data->id;
    $user_role = "role_patient";
    $regid= $patient_data->regid;
    $name = $patient_data->name;
    $surname= $patient_data->surname;
    $user_email = $patient_data->email;
    $telephone = $patient_data->mobile;
    $gender = $patient_data->gender;
}else{
    $user_id = $this->m->user_id();
    $user_role = $this->m->user_role();
    $regid= $this->m->user_value('regid');
    $name = $this->m->user_value('name');
    $surname= $this->m->user_value('surname');
    $user_email = $this->m->user_value('email');
    $telephone = $this->m->user_value('mobile'); 
    $gender = $this->m->user_value('gender');
}
?>
  <div class="" id="form">
    <div class="bs-callout bs-callout-info">
        <div class="panel panel-default" id="termin_success_div" style="display:none;">
            <div class="panel-heading">
                <h3 class="panel-title" style="padding:8px;font-size:24px;">Success</h3>
            </div>
            <div class="panel-body">
            
              <div class="form-horizontal">

                <div class="row">
                  <div class="col-md-12">
                    <p class="alert alert-info text-center">
                      Thank You. Your booking has successfully made. <br>
                                          </p>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-4">Termin Time</label>
                  <div class="col-sm-8">
                    <p class="form-control-static">
                      <span class="datetime momentjs" data-datetime="">From <?php echo date("d-m-Y h:i",strtotime($termin->start)); ?></span> To <?php echo date("d-m-Y h:i",strtotime($termin->end)); ?>                
                    </p>
                  </div>
                </div>

                                
                  <div class="form-group">
                    <label class="control-label col-sm-4">Doctor</label>
                    <div class="col-sm-8">
                        <p class="form-control-static" id="doctor_div">
                                                <?php echo $doctor->academic_grade.' '.$doctor->name.' '.$doctor->surname; ?>                                            
                      </p>
                    </div>
                  </div>
                
              </div>

            </div>
      </div>  
        <div class="panel panel-default" id="termin_fail_div" style="display:none;">
            <div class="panel-heading">
                <h3 class="panel-title" style="padding:8px;font-size:24px;">Fail</h3>
            </div>
            <div class="panel-body">
            
              <div class="form-horizontal">

                <div class="row">
                  <div class="col-md-12">
                      <p class="alert alert-info text-center" style="background-color:#C12E2A;">
                      Due to unavailability, Your booking has not successfully made. <br>
                                          </p>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-4">Termin Time</label>
                  <div class="col-sm-8">
                    <p class="form-control-static">
                      <span class="datetime momentjs" data-datetime="">From <?php echo date("d-m-Y h:i",strtotime($termin->start)); ?></span> To <?php echo date("d-m-Y h:i",strtotime($termin->end)); ?>                
                    </p>
                  </div>
                </div>

                                
                  <div class="form-group">
                    <label class="control-label col-sm-4">Doctor</label>
                    <div class="col-sm-8">
                        <p class="form-control-static" id="doctor_div">
                                                <?php echo $doctor->academic_grade.' '.$doctor->name.' '.$doctor->surname; ?>                                            
                      </p>
                    </div>
                  </div>
                
              </div>

            </div>
      </div>
        
        <div id="termin_booking_div">
      <form id="booking-form" class="" action="<?php echo site_url('termin/portal/reservation/reserve'); ?>" method="post" enctype="application/x-www-form-urlencoded">

        <input type="hidden" name="terminid" value="<?php echo $termin->terminid; ?>">
        <input type="hidden" name="start" value="<?php echo $termin->start; ?>">
        <input type="hidden" name="end" value="<?php echo $termin->end; ?>">
        <input type="hidden" name="doctor_id" value="<?php echo $doctor->id; ?>">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <input type="hidden" name="user_role" value="<?php echo $user_role; ?>">

        <div class="row">
          <div class="col-md-4 hidden">
            <div class="list-group" role="tablist" id="tablistReservation">
              <?php if ($this->m->user()) : ?>
                <a href="#tabIsUser" role="tab" data-toggle="tab" class="list-group-item <?php echo $this->m->user() ? ' active ' : ''; ?>">
                   <h4>Ihre Angaben</h4> &nbsp;<h4 class="list-group-item-heading">Als Benutzer</h4>
                  <p class="list-group-item-text">Als Benutzer Buchung machen und alle Vorteile haben</p>
                </a>
              <?php else : ?>
                <a href="#tabNotUser" role="tab" data-toggle="tab" class="list-group-item <?php echo $this->m->user() ? '' : ' active '; ?>">
                  <h4 class="list-group-item-heading">Nicht Benutzer</h4>
                  <p class="list-group-item-text">Nicht als Benutzer Buchung machen</p>
                </a>
              <?php endif; ?>
              <a href="#tabFinalStep" role="tab" data-toggle="tab" class="list-group-item">
                <h4 class="list-group-item-heading">Buchung</h4>
                <p class="list-group-item-text">Endschritt der Buchung</p>
              </a>
            </div>
          </div>
          <div class="col-md-12">
             <p class="font-bold font18">Booking for: <?php echo date("d-m-Y h:i",strtotime($termin->start)); ?></p>
             <div class="clear"></div>
            <div class="als-block">

              <?php if ($this->m->user()) : ?>

                <div class="tab-pane fade <?php echo $this->m->user() ? ' in active ' : ''; ?>" id="tabIsUser">
                  <div class=" panel-default">
                    <div class="">
                      <h3 class="panel-title1">Als Benutzer</h3>
                    </div>
                    <div class="">

                      <div id="step-2" class="step">
                        <fieldset class="form-horizontal">
                          <div class="form-group" data-error-message="Bitte geben Sie Ihren Vornamen ein.">
                            <label for="regid" class="control-label col-sm-4">Profil-ID</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="regid" id="regid" value="<?php echo $regid; ?>" <?php echo $this->m->user() ? 'readonly="readonly"' : ''; ?> />
                            </div>
                          </div>

                          <div class="form-group" data-error-message="Bitte wählen Sie Ihre Anrede aus.">
                            <label class="control-label col-sm-4">Anrede</label>
                            <div class="col-sm-7" style="margin-left: 20px;">
                              <label class="radio-inline">
                                <input name="gender" type="radio" style="opacity:1;" id="gender-1" value="1" <?php echo ($gender==1 || $gender=="Female")?"checked":''; ?>  <?php echo $this->m->user() ? 'readonly="readonly"' : ''; ?> />
                                Frau
                              </label>&nbsp;&nbsp;&nbsp;
                              <label class="radio-inline">
                                <input name="gender" type="radio" style="opacity:1;" id="gender-2" value="2" <?php echo ($gender==2 || $gender=="Male")?"checked":''; ?> <?php echo $this->m->user() ? 'readonly="readonly"' : ''; ?> />
                                Herr
                              </label>
                            </div>
                          </div>
                          
                          <div class="form-group" data-error-message="Bitte geben Sie Ihren Vornamen ein.">
                            <label for="first_name" class="control-label col-sm-4">Vorname</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $name; ?>" <?php echo $this->m->user() ? 'readonly="readonly"' : ''; ?> />
                            </div>
                          </div>
                          
                          <div class="form-group" data-error-message="Bitte geben Sie Ihren Nachnamen ein.">
                            <label for="last_name" class="control-label col-sm-4">Nachname</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $surname; ?>" <?php echo $this->m->user() ? 'readonly="readonly"' : ''; ?> />
                            </div>
                          </div>
                          
                          <div class="form-group" data-error-message="Bitte geben Sie Ihre E-Mail Adresse ein.">
                            <label for="email" class="control-label col-sm-4">E-Mail</label>
                            <div class="col-sm-8">
                              <input type="email" class="form-control" name="email" id="email" value="<?php echo $user_email; ?>" <?php echo $this->m->user() ? 'readonly="readonly"' : ''; ?> />
                            </div>
                          </div>
                          
                          <div class="form-group" data-error-message="Bitte geben Sie eine gültige Telefonnummer ein.">
                            <label for="telephone" class="control-label col-sm-4">Mobil</label>
                            <div class="col-sm-8">
                              <input type="telephone" class="form-control" name="telephone" id="telephone" value="<?php echo $telephone; ?>" <?php echo $this->m->user() ? 'readonly="readonly"' : ''; ?> />
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="col-sm-8 col-md-offset-4">
                              <button type="button" class="btn btn-danger" id="terminLogout" onclick="cancelTermin('<?php echo $doctor->id; ?>');">Das bin ich nicht</button>
                           
                              <button type="button" class="btn btn-primary pull-right" data-target="#tablistReservation" data-toggle="tabNext" >Weiter <span class="icomoon i-arrow-right-2"></span></button>
                            </div>
                          </div>

                        </fieldset>
                      </div>

                    </div>
                  </div>
                </div>

              <?php else : ?>

                <div class="tab-pane fade <?php echo $this->m->user() ? '' : ' in active '; ?>" id="tabNotUser">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title">Nicht Benutzer</h3>
                    </div>
                    <div class="panel-body">

                      <div id="step-1" class="step">
                        <fieldset class="form-horizontal">

                          <div class="row">
                            <div class="col-md-12">
                              <p class="alert alert-info text-center">
                                Sind Sie bereits registriert?
                                <a href="<?php echo base_url().'../ia24portal/index.php/both/login/page?p&r='.rawurlencode($current_url).'&c='.rawurlencode($encrypted_url); ?>"><br/><strong>Hier einloggen.</strong></a><br/>
                                oder
                                <a href="<?php echo base_url().'../ia24portal/index.php/both/register/page?p&r='.rawurlencode($current_url).'&c='.rawurlencode($encrypted_url); ?>"><br/><strong>Hier registrieren.</strong></a>
                              </p>
                            </div>
                          </div>

                          <div class="form-group" data-error-message="Bitte wählen Sie Ihre Anrede aus.">
                            <label class="control-label col-sm-4">Anrede</label>
                            <div class="col-sm-8">
                              <label class="radio-inline">
                                <input name="gender" type="radio" id="gender-1" value="1" required <?php echo $this->m->user_radio('gender', '1'); ?> <?php echo $this->m->user_radio('gender', 'Female'); ?> />
                                Frau
                              </label>
                              <label class="radio-inline">
                                <input name="gender" type="radio" id="gender-2" value="2" required <?php echo $this->m->user_radio('gender', '2'); ?> <?php echo $this->m->user_radio('gender', 'Male'); ?> />
                                Herr
                              </label>
                            </div>
                          </div>
                          
                          <div class="form-group" data-error-message="Bitte geben Sie Ihren Vornamen ein.">
                            <label for="first_name" class="control-label col-sm-4">Vorname</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $this->m->user_value('name'); ?>" required />
                            </div>
                          </div>
                          
                          <div class="form-group" data-error-message="Bitte geben Sie Ihren Nachnamen ein.">
                            <label for="last_name" class="control-label col-sm-4">Nachname</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $this->m->user_value('surname'); ?>" required />
                            </div>
                          </div>
                          
                          <div class="form-group" data-error-message="Bitte geben Sie Ihre E-Mail Adresse ein.">
                            <label for="email" class="control-label col-sm-4">E-Mail</label>
                            <div class="col-sm-8">
                              <input type="email" class="form-control" name="email" id="email" value="<?php echo $this->m->user_value('email'); ?>" required />
                            </div>
                          </div>
                          
                          <div class="form-group" data-error-message="Bitte geben Sie eine gültige Telefonnummer ein.">
                            <label for="telephone" class="control-label col-sm-4">Mobil</label>
                            <div class="col-sm-8">
                              <input type="telephone" class="form-control" name="telephone" id="telephone" value="<?php echo $this->m->user_value('telephone'); ?>" required />
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="col-sm-12 text-right">
                              <button type="button" class="btn btn-primary" data-target="#tablistReservation" data-toggle="tabNext" >Weiter <span class="icomoon i-arrow-right-2"></span></button>
                            </div>
                          </div>

                        </fieldset>
                      </div>

                    </div>
                  </div>
                </div>

              <?php endif; ?>

              <div class="tab-pane hidden" id="tabFinalStep">
                <div class="panel panel-info">
                  <div class="">
                    <h3 class="panel-title1">Buchung</h3>
                  </div>
                  <div class="panel-body">

                    <div id="step-3" class="step">
                      <fieldset class="form-horizontal">

                        <div class="form-group">
                          <div class="col-sm-12 text-left">
                            <button type="button" class="btn btn-default" data-target="#tablistReservation" data-toggle="tabPrev" ><span class="icomoon i-arrow-left"></span> Prev</button>
                          </div>
                        </div>
                        
                          <div class="form-group" style="display:none;">
                          <label for="inputSpeciality" class="col-sm-4">
                            Behandlungsgrund 
                            <span class="optional-field">
                              (freiwillig)
                            </span>
                          </label>
                          <div class="col-sm-8">
                            <select name="speciality[]" class="chosen-select bs-form-control form-control" id="inputSpeciality" data-placeholder="Wählen Spezialisierung ein" multiple="multiple">
                              <?php foreach ($this->speciality->get_assoc() as $row) : ?>
                              <option <?php echo ($termin->specification==$row->code)?'selected':''; ?> value="<?php echo $row->code; ?>" <?php echo set_select('speciality[]', $row->code); ?> >
                              <?php echo $row->name; ?>
                              </option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div> 

 
                        <div class="form-group" data-error-message="Bitte wählen Sie Ihre Versicherungsart aus.">
                          <label class=" col-sm-4">
                            Versicherungsart 
                            <span class="optional-field">
                              (freiwillig)
                            </span>
                          </label>
                          <div class="col-sm-7" style="margin-left:20px">
                            <label class="radio-inline">
                              <input name="insurance" type="radio" style="opacity:1" id="insurance-type-1" value="1" <?php echo $this->m->user_radio('insurance', '1'); ?> <?php echo $this->m->user() ? 'readonly="readonly"' : ''; ?> />
                              privat
                            </label>&nbsp;&nbsp;&nbsp;
                            <label class="radio-inline">
                              <input name="insurance" type="radio" style="opacity:1" id="insurance-type-2" value="2" <?php echo $this->m->user_radio('insurance', '2'); ?> <?php echo $this->m->user() ? 'readonly="readonly"' : ''; ?> />
                              gesetzlich
                            </label>
                          </div>
                        </div>
                        

                          <div class="form-group">
                          <label for="inputInsurance_provider" class="col-sm-4">
                            Versicherung 
                            <span class="optional-field">
                              (freiwillig)
                            </span>
                          </label>
                          <div class="col-sm-8">
                            <select name="insurance_provider[]" class="chosen-select bs-form-control form-control" id="inputInsurance_provider" data-placeholder="Bitte wählen Sie Ihre Versicherung aus.">
                              <?php foreach ($this->insurance_provider->get_assoc() as $row) : ?>
                              <option value="<?php echo $row->code; ?>" <?php echo set_select('insurance_provider[]', $row->code); ?> >
                              <?php echo $row->name; ?>
                              </option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        
                        <div class="form-group" data-error-message="Bitte geben Sie an, ob Sie schon einmal bei diesem Arzt in Behandlung waren.">
                          <div id="is-patient" class="radio-group">
                            <label class="col-sm-4">Waren Sie bereits Patient/in bei<br/><?php echo $doctor->academic_grade.' '.$doctor->name.' '.$doctor->surname; ?>?</label>
                            <div class="col-sm-7" style="margin-left:20px">
                              <label class="radio-inline">
                                <input name="returning_visitor" type="radio" id="is-patient-2" value="0" required  style="opacity:1">
                                Nein
                              </label>&nbsp;&nbsp;&nbsp;
                              <label class="radio-inline">
                                <input name="returning_visitor" type="radio" id="is-patient-1" value="1" required  style="opacity:1">
                                Ja
                              </label>
                            </div>
                          </div>
                        </div>
                        
                        
                        <div class="form-group">
                          <label for="patient_notes" class=" col-sm-4">Notizen <span class="optional-field">(freiwillig)</span></label>
                          <div class="col-sm-8">
                            <textarea name="patient_notes" id="patient_notes" class="form-control" placeholder="Nachricht an Arzt(in)" ></textarea>
                          </div>
                        </div>
                        
                        <div class="form-group" data-error-message="Bitte bestätigen Sie die Einwilligung.">
                          <div class="col-sm-12">
                            <label class="radio-inline">
                              <input type="checkbox" id="checkbox-tos" name="agb" value="1" required style="opacity:1">
                              Ich stimme der Verwendung meiner Daten zur Vermittlung meines Termins unter den in der
                              <a href="#" data-toggle="modal" data-target="#modalServiceContractPatient" >Servicevertrag</a> und
                              <a href="#" data-toggle="modal" data-target="#modalPrivacyPatient" >Datenschutz Einwilligungserklärung</a> genannten Bedingungen zu. IhrArzt24.de darf insbesondere meine Daten an den Arzt weiterleiten und dieser rückübermitteln, ob ich den Termin wahrgenommen habe.
                            </label>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-sm-12 text-right">
                            <button type="button" class="btn btn-success" onclick="submitReserv();">Termin buchen!</button>
                            <span id="loading"></span>
                          </div>
                        </div>

                      </fieldset>
                    </div>

                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

      </form>
      </div>
    </div>
  </div>

</div>

<!-- modal Service -->
<div class="modal fade" id="modalServiceContractPatient" role="dialog" aria-labelledby="modalLabelServiceContractPatient" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Schließen</span></button>
        <h3 class="modal-title" id="modalLabelServiceContractPatient">Servicevertrag</h3>
      </div>
      <div class="modal-body">
        <h3>Servicevertrag zum Betrieb eines IhrArzt24 / Cyomed Nutzerkontos</h3>
        <p class="popupcontent">
          Der nachfolgende Vertrag wird zwischen Ihnen („<b>Nutzer</b>“) und der GmbH, Düsseldorf („<b>IhrArzt24 / Cyomed</b>“), geschlossen.<br/><br/>
          Alle Anfragen sind zu richten an die: IhrArzt24 / Cyomed GmbH, Rheindorfer Weg 4, 40591 Düsseldorf .
        </p>
        <h3>1. Vorbemerkung</h3>
        <p class="popupcontent">
          IhrArzt24 / Cyomed bietet telemedizinische Beratung an, die auf der Bewertung der vom Patienten zur Verfügung gestellten Informationen
          beruht. Diese Informationen werden durch ausgefüllte Online-Fragen, Fragebogen, Telefonate, Textnachrichten, Mitteilungen in
          der Online-Patientenakte und/oder Fotos vom Patienten bereitgestellt.
        </p>
        <h3>2. Zustandekommen des Vertrages über ein IhrArzt24 / Cyomed Nutzerkonto</h3>
        <p class="popupcontent">
          2.1 Die Angebote von <b>IhrArzt24 / Cyomed</b> auf der Website <b>www.IhrArzt24 / Cyomed.de</b> sind unverbindlich. Mit dem Setzen des Häkchens „Ich
          stimme den Regelungen des IhrArzt Servicevertrags zu [...]“ im Verlauf der Anmeldung bei <b>IhrArzt24 / Cyomed</b> erklärt der Nutzer
          verbindlich gegenüber <b>IhrArzt24 / Cyomed</b>, ein <b>IhrArzt24 / Cyomed</b> Nutzerkonto eröffnen und den entsprechenden <b>IhrArzt24 / Cyomed</b> Service in
          Anspruch nehmen zu wollen. <b>IhrArzt24 / Cyomed</b> ist berechtigt, das darin liegende Vertragsangebot innerhalb von zwei Wochen
          durch Zusendung einer Auftragsbestätigung per e-Mail oder in anderer Form anzunehmen. Der Vertrag kommt erst (a)
          durch diese Auftragsbestätigung oder (b) die Eröffnung und Nutzung des <b>IhrArzt24 / Cyomed</b> Nutzerkontos oder (c) die
          Erbringung der beauftragten Serviceleistungen zustande, je nachdem, welches Ereignis zuerst stattfindet.<br/><br/>
          2.2 Für die Inanspruchnahme unserer Dienstleistungen ist eine Registrierung auf unserer Website zwingend erforderlich.
          Hierbei finden auch unsere Datenschutzbestimmungen Anwendung. Mit der Registrierung wird eine Online-
          Patientenakte (elektronische Gesundheitsakte „eGA“ §68 SGB V), zugleich Nutzerkonto, angelegt, die sowohl
          persönliche Daten enthalten kann, als auch Gesundheitsdaten des Nutzers nach §3 Abs. 9 BDSG.
        </p>
        <h3>3. Anwendungsbereich</h3>
        <p class="popupcontent">
          3.1 Dem Anwendungsbereich dieses Vertrages unterliegen vorbehaltlich der Regelungen gemäß Ziffer 2.2 sämtliche
          Handlungen, die der Nutzer während der Laufzeit dieses Vertrages als registrierter Nutzer des <b>IhrArzt24 / Cyomed</b> Nutzerkontos
          vornimmt und alle Bereitstellungen von Software und/oder Leistungen durch <b>IhrArzt24 / Cyomed</b> im Rahmen des <b>IhrArzt24 / Cyomed</b>
          Nutzerkontos.<br/><br/>
          3.2 <b><u>Nicht</u></b> Teil der Leistungen von <b>IhrArzt24 / Cyomed</b> im Rahmen dieses Vertrages – und somit vom Anwendungsbereich dieses
          Vertrages ausgenommen – sind jegliche von dritten Anbietern unter der <b>IhrArzt24 / Cyomed</b> Plattform bereitgestellten Software,
          Services und Links, die der Nutzer nutzen kann und/oder über die Dritte in den <b>IhrArzt24 / Cyomed</b> Nutzerkonto Informationen
          ablegen und verarbeiten können. In diesem Zusammenhang übernimmt <b>IhrArzt24 / Cyomed</b> insbesondere keine Gewähr für die
          Verfügbarkeit, Fehlerfreiheit und/oder Zulässigkeit der insoweit von den Dritten bereit gestellten Software und Services.
          Die einzige Verpflichtung von <b>IhrArzt24 / Cyomed</b> besteht insoweit darin, die im <b>IhrArzt24 / Cyomed</b> Nutzerkonto unter Nutzung von
          Software und Services Dritter abgelegten Daten und Informationen gemäß den hier getroffenen Vereinbarungen
          bereitzustellen und zu verarbeiten.
        </p>
        <h3>4. Passwort, Geheimhaltung, Verlust</h3>
        <p class="popupcontent">
          4.1 Für die Eröffnung des <b>IhrArzt24 / Cyomed</b> Nutzerkontos und dessen weitere Nutzung muss der Nutzer seine Personalien
          angeben, damit bei der Buchung eines kostenpflichtigen Services eine ordentlich Rechnung erstellt werden kann. Diese
          Daten werden getrennt von den Gesundheitsdaten gespeichert. Aus der Anmeldung wird der Kunde eine eindeutige
          zufällig generierte anonyme Identifikationsnummer („ID“) erhalten, unter der der Nutzer dann seine Gesundheitsdaten
          hinterlegen kann.<br/><br/>
          4.2 Die Eingabe der Anmeldedaten ermöglicht es dem Nutzer, jederzeit seine im <b>IhrArzt24 / Cyomed</b> Nutzerkonto hinterlegten Daten
          einzusehen, zu verändern, Freigaben auf diese zu erteilen oder diese zu löschen.<br/><br/>
          4.3 Der Nutzer ist verpflichtet, die Anmeldedaten sorgfältig aufzubewahren und so zu behandeln, dass ein Verlust
          ausgeschlossen ist und unbefugte Dritte keine Kenntnis davon erlangen können.<br/><br/>
          4.4 Bei einer unbeabsichtigten Preisgabe der Anmeldedaten an Dritte (z.B. Identitätsdiebstahl, Diebstahl notierter
          Informationen, etc.) ist der Nutzer selbst dafür verantwortlich, geeignete Schritte zum Schutz der in seinem geschützten
          Bereich gespeicherten Information zu treffen (u.a. durch eine Änderung der Anmeldeinformationen).<br/><br/>
          4.5 Hat ein Dritter Kenntnis von den Anmeldedaten ganz oder teilweise erhalten, so ist allein der Nutzer für alle unter
          seinen Anmeldedaten getätigten Handlungen verantwortlich, insbesondere für eine Veränderung des Bestands an
          Nutzerinhalten (wie nachfolgend in Ziffer 8 definiert). Sofern (technisch) möglich wird <b>IhrArzt24 / Cyomed</b> für den Nutzer
          unterstützend tätig.
        </p>
        <h3>5. Leistungen von IhrArzt24 / Cyomed</h3>
        <p class="popupcontent">
          5.1 Während der Laufzeit des Vertrages räumt <b>IhrArzt24 / Cyomed</b> dem Nutzer die Möglichkeit zur Nutzung seines von ihm erstellten
          IhrArzt24 / Cyomed Nutzerkontos gemäß den jeweils aktuell von <b>IhrArzt24 / Cyomed</b> im Rahmen von <b>IhrArzt24 / Cyomed</b> bereitgestellten
          Funktionalitäten ein.<br/><br/>
          5.2 Der Nutzer hat während der Laufzeit des Vertrages Zugriff auf den <b>IhrArzt24 / Cyomed</b> Kundensupport, der
          unter www.Ihrarzt24 / Cyomed.de oder per E-Mail (support@ihrarzt24 / Cyomed.de) kontaktiert werden kann.<br/><br/>
          5.3 Die Leistungen der kostenpflichtigen Zusatzdienste können unter www.Ihrarzt24 / Cyomed.de eingesehen werden. Die dort
          angebotenen Dienste werden durch eigenes Personal und durch fremde Spezialisten und Fachkräfte erbracht (in der
          Plattform auch als beratende Ärzte, Ärztepool und alle Ärzte). Eine zusätzliche Datenschutzvereinbarung nach §5
          BDSG (Verschwiegenheitspflicht) ist Voraussetzung für die Mitarbeit bei IhrArzt24 / Cyomed (vgl. 9.10).
        </p>
        <h3>6. Vertragsänderungen</h3>
        <p class="popupcontent">
          6.1 <b>IhrArzt24 / Cyomed</b> ist berechtigt, während der Laufzeit des Vertrages unter angemessener Berücksichtigung der Interess en des
          Nutzers die Leistungsbeschreibung anzupassen, vorausgesetzt, dass hierdurch der bereits vereinbarte
          Leistungsumfang nicht wesentlich verringert wird. <b>IhrArzt24 / Cyomed</b> wird die Änderung der Leistungsbeschreibung in
          geeigneter Weise allen Nutzern der <b>IhrArzt24 / Cyomed</b> Plattform so mitteilen, dass diese angemessen Kenntnis von den
          angepassten Bedingungen erhalten können.
        </p>
        <h3>7. Voraussetzungen für den Abschluss eines IhrArzt24 / Cyomed Nutzerkontos</h3>
        <p class="popupcontent">
          7.1 Sämtliche Leistungen nach diesem Vertrag sind ausschließlich auf Einwohner der Bundesrepublik Deutschland und die
          dort geltenden Rechtsvorschriften angepasst. Der Nutzer hat während der Eröffnung seines <b>IhrArzt24 / Cyomed</b> Nutzerkontos
          auch bestätigt, dass er zu diesem Zeitpunkt Einwohner der Bundesrepublik Deutschland ist und der dortigen
          Rechtsprechung unterliegt. <b>IhrArzt24 / Cyomed</b> haftet nicht für Rechtsverletzungen, die darauf beruhen, dass der Nutzer das
          <b>IhrArzt24 / Cyomed</b> Nutzerkonto außerhalb der Bundesrepublik Deutschland nutzt.<br/><br/>
          7.2 Der Abschluss dieses Vertrages ist nur unter der Voraussetzung möglich, dass der Nutzer zu diesem Zeitpunkt das
          achtzehnte (18te) Lebensjahr vollendet hat, d.h. volljährig ist. Nutzerkonten für minderjährige Kinder (Family-Tarif)
          müssen von den erziehungsberechtigten Personen gepflegt werden.
        </p>
        <h3>8. Zulässige Nutzung des IhrArzt24 / Cyomed Nutzerkontos</h3>
        <p class="popupcontent">
          8.1 Dem Nutzer wird mit dem Zugang zu seinem <b>IhrArzt24 / Cyomed</b> Nutzerkonto die Möglichkeit eingeräumt, hierauf
          personenbezogene Daten, einschließlich Gesundheits- und Sozialdaten, und sonstige Informationen aus dem Bereich
          „Gesundheit“ oder damit verwandten Bereichen („Nutzerinhalte“) zu speichern, zu bearbeiten und für Dritte frei zu
          geben oder an Dritte zu übermitteln. <b>IhrArzt24 / Cyomed</b> hat ohne Freigaben auf die Nutzerinhalte im Regelbetrieb der Plattform
          keinen Zugriff. Der Nutzer ist somit für die Nutzerinhalte allein verantwortlich.<br/><br/>
          8.2 Der Nutzer stellt sicher, dass Nutzerinhalte nur in folgendem Rahmen und unter folgenden Voraussetzungen
          gespeichert, verarbeitet und übermittelt werden:<br/><br/>
          Der Nutzer<br/><br/>
          <blockquote>
            a. hat alle nach anwendbarem Recht erforderlichen Einwilligungserklärungen zur Erhebung, Speicherung,
            Übermittlung und sonstigen Verarbeitung der Nutzerinhalte (insgesamt „Datennutzung“) in dem von ihm
            getätigten Umfang eingeholt; dies gilt insbesondere für das Einholen der Einwilligung von Dritten zur Einstellung
            von deren Nutzerinhalten im Nutzerkonto des Nutzers;<br/><br/>
            b. beachtet bei der eigenen Datennutzung alle weiteren Anforderungen anwendbaren Rechts;<br/><br/>
            c. unterlässt jegliche Nutzung des IhrArzt24 / Cyomed Nutzerkontos zum Versand von Werbekommunikation oder zur
            Generierung von Werbeinhalten, insbesondere SPAM- oder Kettenmails oder dem Versand anderer nicht
            angeforderter Kommunikation;<br/><br/>
            d. unterlässt die Nutzung des IhrArzt24 / Cyomed Nutzerkontos zur Ablage von und/oder dem Zugriff auf Daten, Dateien und
            Informationen, die nicht aus dem Bereich „Gesundheit“ oder anderen damit verwandten Bereichen stammen, für
            die die IhrArzt24 / Cyomed Plattform offenkundig nicht eingerichtet und betrieben wird. Dies betrifft insbesondere Videos,
            Streams und/oder Musikdateien oder Software;<br/><br/>
            e. wird nicht versuchen, unbefugt den IhrArzt24 / Cyomed Service umzuleiten, zu verändern oder abgeleitete Dienste daraus
            zu erstellen;<br/><br/>
            f. wird IhrArzt24 / Cyomed unverzüglich benachrichtigen, sobald ihm eine Verletzung von Sicherheitsvorkehrungen und/oder
            der Datenintegrität und/oder eine sonstige unbefugte Nutzung des IhrArzt24 / Cyomed Service bekannt werden.
          </blockquote><br/><br/>
          8.3 Der Nutzer ist nicht berechtigt, den <b>IhrArzt24 / Cyomed</b> Service zum Weitervertrieb, einschließlich der Einräumung der
          Nutzungsberechtigung Dritter für seinen <b>IhrArzt24 / Cyomed</b> Nutzerkonto, anzubieten; hiervon ausgenommen ist das Recht des
          Nutzers, Dritten (z.B. Ärzten oder anderen Leistungserbringern im Gesundheitsbereich), zu gestatten, in seinem
          <b>IhrArzt24 / Cyomed</b> Nutzerkonto Daten und Informationen zu seiner Person zu hinterlegen, einzusehen und/oder zu bearbeiten.
          Der Nutzer ist für das Handeln Dritter in seinem <b>IhrArzt24 / Cyomed</b> Nutzerkonto wie für eigenes Handeln verantwortlich, es sei
          denn, der Dritte hat sich durch unbefugtes Handeln Zugriff auf das Nutzerkonto verschafft und der Nutzer ist hierfür
          nicht verantwortlich. Der <b>IhrArzt24 / Cyomed</b> Service ist <b><u>nicht</u></b> dazu ausgerichtet, Diagnose- und/oder Behandlungsleistungen zu
          erbringen.<br/><br/>
          8.4 Bei Verletzung der vorstehenden Pflichten durch den Nutzer ist <b>IhrArzt24 / Cyomed</b> nach Ablauf einer angemessenen Frist
          berechtigt, zur Beendigung des vertragswidrigen Verhaltens, bei Gefahr im Verzug oder nicht nur unwesentlichen
          Vertragsverletzungen auch ohne vorherige Androhung, den Zugriff des Nutzers auf das Nutzerkonto vorläufig zu
          sperren. Gleiches gilt, wenn <b>IhrArzt24 / Cyomed</b> feststellt, dass vom Nutzerkonto des Nutzers aus automatisierte Prozesse oder
          Dienstleistungen ausgehen oder über diesen ablaufen, die auf einen unbefugten Missbrauch des Nutzerkontos durch
          Dritte hinweisen (z.B. BOTs, „Spider“, periodisches Caching von Informationen, die <b>IhrArzt24 / Cyomed</b> gespeichert hat oder
          „Meta Searching“). Die Rechte zur Kündigung gemäß Ziffer Artikel 15 - bleiben unberührt.
        </p>
        <h3>9. Datenschutz</h3>
        <p class="popupcontent">
          9.1 Der Nutzer hat im Rahmen seiner Anmeldung für das <b>IhrArzt24 / Cyomed</b> Nutzerkonto ausdrücklich in die Datennutzung von
          personenbezogenen Daten im nachstehenden Umfang per gesonderte Einwilligungserklärung eingewilligt. Bei Widerruf
          seiner Einwilligung ist die Fortführung des <b>IhrArzt24 / Cyomed</b> Nutzerkontos des Nutzers nicht länger möglich, und <b>IhrArzt24 / Cyomed</b> ist
          dazu berechtigt, den Vertrag gemäß Ziffer 13.2 aus wichtigem Grund zu kündigen und die darunter gespeicherten
          Daten zu löschen, vgl. Ziffer 13.3.<br/><br/>
          9.2 Die Vertragspartner beachten die gesetzlichen Vorschriften für den Schutz von personenbezogenen Daten,
          insbesondere die Bestimmungen des Bundesdatenschutzgesetzes (BDSG).<br/><br/>
          9.3 Der Nutzer ist im Verhältnis zu <b>IhrArzt24 / Cyomed</b> verantwortlich für sämtliche personenbezogenen Daten dritter Personen, die
          er in sein <b>IhrArzt24 / Cyomed</b> Nutzerkonto integriert und dort verarbeitet oder anderweitig nutzt.<br/><br/>
          9.4 Umfang, Art und Zweck der vorgesehenen Datennutzung, die Art der Daten und den Kreis der Betroffenen bestimmt
          grundsätzlich allein der Nutzer selbst durch die von ihm im Rahmen seines <b>IhrArzt24 / Cyomed</b> Nutzerkontos hinterlegten
          personenbezogenen Daten, einschließlich der dort ggf. abgelegten „besonderen personenbezogenen Daten“ i.S.v. § 3
          Nr. 9 BDSG (Gesundheitsdaten). <b>IhrArzt24 / Cyomed</b> hat auf die im <b>IhrArzt24 / Cyomed</b> Nutzerkonto des Nutzers hinterlegten
          personenbezogenen Daten im operativen Betrieb nur im Rahmen der erteilten Berechtigungen eingeschränkten Zugriff.
          Ein Zugriff auf die Daten kann erfolgen (a) im Rahmen der Erbringung der vertraglich geregelten Leistungen gemäß
          Punkt 5, (b) im Rahmen von erforderlichen Betriebsleistungen (z.B. für BackUps, die Wiederherstellung von Daten,
          etc.), wird aber insoweit auf das technisch notwendige Maß reduziert, und (c) im Rahmen der gesetzlichen
          Verpflichtungen von <b>IhrArzt24 / Cyomed</b>, z.B. auf behördliche und/oder gerichtliche Anweisung.<br/><br/>
          9.5 <b>IhrArzt24 / Cyomed</b> darf die bei der Anmeldung angegebene Email-Adresse des Kunden nutzen, um diese zu validieren und dem
          Kunden Informationen zu seinem Konto, zur Plattform und Anwendungen zu übermitteln. Eine Nutzung der E-Mail-
          Adresse zu anderen als Informationszwecken sowie eine Weitergabe der E-Mail-Adresse an Dritte ist ausgeschlossen.
          Der Kunde kann die Einwilligung jederzeit schriftlich widerrufen. Der isolierte Widerruf der Einwilligung in die Nutzung
          seiner E-Mail-Adresse zu Informationszwecken hat keinen Einfluss auf die Berechtigung des Kunden zur
          vertragsgemäßen Nutzung von <b>IhrArzt24 / Cyomed</b>, sofern eine äquivalente Alternative zur Verfügung gestellt und akzeptiert wird.<br/><br/>
          9.6 <b>IhrArzt24 / Cyomed</b> ist dazu berechtigt, durch technische Maßnahmen wie z.B. Firewalls und andere Sicherheitsmaßnahmen die
          Integrität und Nutzbarkeit des <b>IhrArzt24 / Cyomed</b> Service für alle Nutzer sicherzustellen und dadurch bedingt ggf. bestimmte
          Informationen von der Übermittlung auszunehmen.<br/><br/>
          9.7 <b>IhrArzt24 / Cyomed</b> hat im Rahmen des <b>IhrArzt24 / Cyomed</b> Services in Relation zu Art und Umfang der personenbezogenen Daten
          angemessene, technische und organisatorische Maßnahmen zum Schutz der personenbezogenen Daten getroffen.
          Details der von <b>IhrArzt24 / Cyomed</b> getroffenen Maßnahmen sind unter www.ihrarzt24 / Cyomed.de einzusehen.<br/><br/>
          9.8 Der Nutzer allein ist für die in seinem <b>IhrArzt24 / Cyomed</b> Nutzerkonto erhobenen, gespeicherten oder sonst verarbeiteten
          personenbezogenen Daten Dritter verantwortlich, insbesondere für den korrekten Umgang mit Weisungen sowie
          Löschungs- und Änderungsverlangen der Dritten in Bezug auf deren personenbezogene Daten.<br/><br/>
          9.9 <b>IhrArzt24 / Cyomed</b> hat einen Datenschutzbeauftragten bestellt.<br/><br/>
          9.10 <b>IhrArzt24 / Cyomed</b> hat seine bei der Datenverarbeitung eingesetzten Mitarbeiter nach § 5 BDSG schriftlich auf das
          Datengeheimnis verpflichtet.<br/><br/>
          9.11 <b>IhrArzt24 / Cyomed</b> ist berechtigt, sich zur Datenverarbeitung eines mit <b>IhrArzt24 / Cyomed</b> im Sinne von §§ 15 ff. AktG verbundenen
          Unternehmens oder zuverlässigen Dritten zu bedienen und wird diesen entsprechend den datenschutzrechtlichen
          Regelungen dieses Vertrages verpflichten und überwachen.<br/><br/>
          9.12 Die getroffenen Maßnahmen zum Schutz personenbezogener Daten können von <b>IhrArzt24 / Cyomed</b> entsprechend einer
          technischen und organisatorischen Weiterentwicklung im Bereich von <b>IhrArzt24 / Cyomed</b> angepasst werden; das bei
          Vertragsschluss bestehende Sicherheitsniveau wird hierdurch nicht verringert.<br/><br/>
          9.13 Die Haftung des Auftragnehmers gegenüber dem Nutzer für Datenschutzverletzungen ist ausgeschlossen, soweit die
          Datenschutzverletzung auf einer Weisung des Nutzers beruht.<br/><br/>
          9.14 Bei Beendigung des Vertrages werden die Daten des Nutzers für den weiteren Zugriff gesperrt und nach spätestens 90
          Tagen gelöscht.
        </p>
        <h3>10. Nutzungsrechte am IhrArzt24 / Cyomed Nutzerkonto</h3>
        <p class="popupcontent">
          10.1 Mit Abschluss des Vertrages räumt <b>IhrArzt24 / Cyomed</b> dem Nutzer alle für die Nutzung des <b>IhrArzt24 / Cyomed</b> Nutzerkontos im
          vertraglich vereinbarten Umfang gegebenenfalls erforderlichen Rechte ein. Diese sind nicht-ausschließlich und nicht
          übertragbar.<br/><br/>
          10.2 Soweit der Nutzer von <b>IhrArzt24 / Cyomed</b> im Rahmen dieses Vertrages gegebenenfalls überlassene Software nutzt, wird er die
          Software nicht ändern, de-assemblieren, dekompilieren und kein Reverse Engineering betreiben.<br/><br/>
          10.3 Der Nutzer wird die im Rahmen des <b>IhrArzt24 / Cyomed</b> Service oder in der Dokumentation enthaltenen Urheberrechtsvermerke,
          Warenzeichen und Marken von <b>IhrArzt24 / Cyomed</b> und/oder ihren Lizenzgebern nicht entfernen.<br/><br/>
          10.4 Im Verhältnis zu <b>IhrArzt24 / Cyomed</b> stehen alle Rechte an den in den jeweiligen <b>IhrArzt24 / Cyomed</b> Nutzerkonto eingestellten Daten,
          Bildern und Informationen dem Nutzer zu, der hieran <b>IhrArzt24 / Cyomed</b> nur die zur Erfüllung dieses Vertrages erforderlichen
          Rechte einräumt.<br/><br/>
          10.5 Design und die Funktionsweise der Web-Applikation sind nach internationalem Recht geschützt. Alle Rechte liegen bei
          der <b>IhrArzt24 / Cyomed</b>.
        </p>
        <h3>11. Vergütung</h3>
        <p class="popupcontent">
          11.1 Dem Nutzer wird die Nutzung des <b>IhrArzt24 / Cyomed</b> Nutzerkontos während der Vertragslaufzeit kostenfrei zur Verfügung
          gestellt.<br/><br/>
          11.2 Es bleibt den Vertragspartnern unbenommen, für etwaige hierüber hinausgehende Leistungen eine Vergütung zu
          vereinbaren.<br/><br/>
          11.3 Für die Nutzung der kostenpflichtigen Premiumdienste gelten die Preise gemäß Darstellung unter www.ihrarzt24 / Cyomed.de.
        </p>
        <h3>12. Haftung für Sach- und Rechtsmängel</h3>
        <p class="popupcontent">
          12.1 Mit dem <b>IhrArzt24 / Cyomed</b> Service ist nicht beabsichtigt, medizinische Diagnosen und/oder Behandlungen zu ersetzen.
          <b>IhrArzt24 / Cyomed</b> übernimmt keine Haftung für Folgen, die sich daraus ergeben, dass der Nutzer oder Dritte die hinterlegten
          Daten und Informationen unsachgemäß verwenden.<br/><br/>
          12.2 Der <b>IhrArzt24 / Cyomed</b> Service wird über Telefon und das Internet grundsätzlich auf einer 7 / 24h Basis betrieben. Aufgrund der
          Beschaffenheit dieser Medien und von Computersystemen übernimmt <b>IhrArzt24 / Cyomed</b> jedoch keine Gewähr für die
          ununterbrochene Verfügbarkeit des <b>IhrArzt24 / Cyomed</b> Service und des entsprechenden Nutzerkontos.<br/><br/>
          12.3 Soweit und solange nach diesem Vertrag Leistungen unentgeltlich zur Verfügung gestellt werden, ist eine Haftung für
          Mängel des <b>IhrArzt24 / Cyomed</b> Service und dessen Dokumentation sowie für jegliche sonstige Schlechtleistung in diesem
          Rahmen sowie für Rechtsmängel, insbesondere für die Richtigkeit, Fehlerfreiheit, Freiheit von Schutz- und
          Urheberrechten Dritter, Vollständigkeit und/oder Verwendbarkeit - außer bei Vorsatz oder Arglist - ausgeschlossen.<br/><br/>
          12.4 Weitergehende oder andere als die in diesem Artikel geregelten Ansprüche des Nutzers gegen <b>IhrArzt24 / Cyomed</b> und dessen
          Erfüllungsgehilfen wegen eines Sach- und/oder Rechtsmangels sind ausgeschlossen.
        </p>
        <h3>13. Haftung von IhrArzt24 / Cyomed</h3>
        <p class="popupcontent">
          13.1 <b>IhrArzt24 / Cyomed</b> haftet für einen von ihr zu vertretenden Personenschaden mit bis zu EURO 100.000,-. und ersetzt bei einem
          von ihr verschuldeten Sachschaden den Aufwand für die Wiederherstellung der Sachen bis zu einem Betrag von EUR
          500,- je Schadensereignis. Bei Beschädigung von Datenträgermaterial umfasst die Ersatzpflicht nicht den Aufwand für
          die Wiederbeschaffung verlorener Daten und Informationen.<br/><br/>
          13.2 Weitergehende Schadens- und Aufwendungsersatzansprüche des Nutzers (im Folgenden: Schadensersatzansprüche),
          gleich aus welchem Rechtsgrund, insbesondere wegen Verletzung von Pflichten aus dem Schuldverhältnis und aus
          unerlaubter Handlung, sind ausgeschlossen.<br/><br/>
          13.3 Soweit <b>IhrArzt24 / Cyomed</b> nach diesem Vertrag Telekommunikationsdienstleistungen erbringt, insbesondere im Bereich der
          Datenübermittlung, ist die Haftung von <b>IhrArzt24 / Cyomed</b> für Vermögensschäden, die nicht vorsätzlich verursacht wurden, auf
          EURO 1.000,- im Einzelfall begrenzt. Der Haftungshöchstbetrag wird anteilig gemindert, wenn die Gesamtsumme der
          Haftungsansprüche aller Geschädigten wegen eines Schadensereignisses einen Betrag von EUR 100.000,-
          überschreitet. <b>IhrArzt24 / Cyomed</b> haftet nicht für die mangelfreie Funktion von Netzinfrastrukturen und Netzverbindungen. Die
          Regelungen dieses Absatzes 3 gehen im Fall eines Widerspruches zu den Regelungen in Absatz 1 und/oder 2 vor.<br/><br/>
          13.4 <b>IhrArzt24 / Cyomed</b> haftet nicht für Kommunikationskosten (Telefon und Internet). Hierfür ist der Nutzer selbst verantwortlich.<br/><br/>
          13.5 Die Haftungsbeschränkungen der Absätze 1 bis 3 gelten nicht, soweit zwingend gehaftet wird. Der
          Schadensersatzanspruch für die Verletzung wesentlicher Vertragspflichten ist jedoch auf den vertragstypischen,
          vorhersehbaren Schaden begrenzt.
        </p>
        <h3>14. Vertragslaufzeit</h3>
        <p class="popupcontent">
          14.1 Der Nutzer kann jederzeit schriftlich oder per elektronische Mitteilung die Löschung seines Nutzerkontos verlangen.
          <b>IhrArzt24 / Cyomed</b> wird diesen Fall als Kündigungserklärung seitens des Nutzers nach Ziffer 14.2 betrachten.<br/><br/>
          14.2 Jeder Vertragspartner ist berechtigt, diesen Vertrag unter Einhaltung einer Frist von vier Wochen zum Monatsende
          ordentlich zu kündigen. Das Recht zur Kündigung aus wichtigem Grund bleibt unberührt. Als wichtiger Grund für die
          Kündigung seitens <b>IhrArzt24 / Cyomed</b> gilt insbesondere die Geltendmachung von Rechten durch Dritte oder Änderungen von
          gesetzlichen und/oder behördlichen Vorgaben, die es <b>IhrArzt24 / Cyomed</b> nach vernünftiger eigener Einschätzung erschweren
          oder verbieten, die <b>IhrArzt24 / Cyomed</b> Plattform und/oder das Nutzerkonto des Nutzers weiter zu betreiben. Jede Kündigung
          bedarf zu ihrer Wirksamkeit der Einhaltung der schriftlichen oder elektronischen Form – entsprechende Erklärungen
          sind eindeutig authentifizierbar abzugeben.<br/><br/>
          14.3 Im Fall einer Kündigung ist der Nutzer verpflichtet, unverzüglich alle Anmeldedaten und Nutzerinhalte zu löschen.
          Sofern dies nicht innerhalb von 14 Tagen nach Kündigung erfolgt ist, wird IhrArzt24 / Cyomed die Löschung vornehmen, sobald
          die Daten zur Abwicklung des IhrArzt24 / Cyomed Nutzerkontos nicht mehr benötigt werden.
        </p>
        <h3>15. Schlussbestimmungen</h3>
        <p class="popupcontent">
          15.1 <b>IhrArzt24 / Cyomed</b> ist berechtigt, diesen Vertrag sowie alle Rechte und Pflichten aus dem Vertrag und den zugehörigen
          Einzelverträgen ganz oder teilweise an ein mit ihr direkt oder indirekt verbundenes Unternehmen zu übertragen,
          vorausgesetzt, dieses besitzt eine hinreichende technische und finanzielle Ausstattung.<br/><br/>
          15.2 Sollte eine Bestimmung dieses Servicevertrages oder eine künftige Bestimmung ganz oder teilweise nicht
          rechtswirksam oder nicht durchführbar sein oder werden, so soll hierdurch die Wirksamkeit der übrigen
          Vertragsbestimmungen nicht berührt werden. Das Gleiche gilt, soweit sich herausstellen sollte, dass der Vertrag eine
          Regelungslücke enthält. Anstelle der unwirksamen oder undurchführbaren Bestimmungen oder zur Ausfüllung der
          Lücke soll eine angemessene Regelung gelten, die, soweit rechtlich möglich, dem am nächsten kommt, was die
          Vertragsparteien gewollt haben oder nach dem Sinn und Zweck des Vertrages gewollt hätten, sofern sie bei Abschluss
          des Vertrages oder bei der späteren Aufnahme einer Bestimmung den Punkt bedacht hätten. Dies gilt auch, wenn die
          Unwirksamkeit einer Bestimmung etwa auf einem indem Vertrag vorgeschriebenen Maß der Leistung oder Zeit beruht;
          es soll dann ein dem Gewollten möglichst nahe kommendes, rechtlich zulässiges Maß der Leistung oder Zeit als
          vereinbart gelten.
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
        <button type="button" class="btn btn-primary"><span class="icomoon i-print-2"></span> Drucken</button>
      </div>
    </div>
  </div>
</div>

<!-- modal -->
<div class="modal fade" id="modalPrivacyPatient" role="dialog" aria-labelledby="modalLabelPrivacyPatient" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Schließen</span></button>
        <h3 class="modal-title" id="modalLabelPrivacyPatient">Datenschutz Einwilligungserklärung</h3>
      </div>
      <div class="modal-body">
        <p class="popupcontent">
          Durch die Registrierung willigt der Nutzer ausdrücklich in die Datenschutzbestimmungen ein:
        </p>
        <h3>1. Zweck der IhrArzt24 / Cyomed Plattform Deutschland</h3>
        <p class="popupcontent">
          IhrArzt24 / Cyomed bietet den Nutzer eine individuelle und auf die Person zugeschnittene telemedizinische Betreuung an. Durch den
          kombinierten Einsatz der telemedizinischen Betreuung und einer elektronischen Gesundheitsakte nach § 68 SGB V wird der
          mündige Bürger in die Lage versetzt, sich möglichst selbstständig um die eigene gesundheitliche Belange zu kümmern.
          Vergleichbar einem Steuerberater für steuerliche Fragen unterstütz IhrArzt24 / Cyomed den Nutzer in allen medizinischen Fragen im
          Rahmen des geltenden Rechts (z.B. Zweitmeinungen etc).
        </p>
        <h3>2. Definition und Gegenstand der Datennutzung</h3>
        <p class="popupcontent">
          Gegenstand sind alle personenbezogenen Daten, die im Rahmen der Nutzung des IhrArzt24 / Cyomed Kontos eingeben, gespeichert,
          geändert oder gelöscht (Eingabe, Speicherung, Änderung und Löschung infolge auch „Datennutzung“) werden. Dabei handelt
          es sich insbesondere um Personenstammdaten (z.B. Name, Geburtsdatum, Kontaktdaten, etc.) und auch Gesundheitsdaten
          und sonstige Auswertungen/Berichte dritter Leistungsträger (z.B. Krankenhäuser, Ärzte) über den Gesundheitszustand.
          <br/><br/>
          Bei den gespeicherten Daten handelt es sich also zu einem erheblichen Teil um „personenbezogene Daten besonderer Art“ im
          Sinne des Bundesdatenschutzgesetzes (BDSG § 3, Abs. 9).
        </p>
        <h3>3. Umfang, Art und Zweck der Datennutzung durch IhrArzt24 / Cyomed</h3>
        <p class="popupcontent">
          Ein IhrArzt24 / Cyomed Konto ist grundsätzlich anonym und losgelöst von ihrer natürlichen Person. Es entspricht einem Nummernkonto
          auf welchem nur ein vom Nutzer autorisierter Personenkreis Zugriff hat. Abrechnungs- und Kontaktdaten werden in separaten
          und verschlüsselten Datenbänken gehalten. Die Datennutzungsautorisierung wird, mit Ausnahme der zu den Notfalldaten
          gehörigen Datensätze, durch den Nutzer global oder je Eintrag selbst festgelegt. Bei Autorisierung erfolgt ein Zugriff nur auf die
          vom Nutzer freigegebene Eintragungen. Wünscht der Nutzer seine Daten geheim zu halten, kann er im „Privacy mus“
          verbleiben bzw. diesen jederzeit aktivieren. Der „Privacy mus“ ist als Standard festgelegt.
          <br/><br/>
          Da die telemedizinische Betreuung bei IhrArzt24 / Cyomed durch Ärzte und medizinisches Fachpersonal erfolgt, ist eine berufsbedingte
          Schweigepflicht und diskrete Handhabung aller Daten sicher gestellt. Zusätzlich verpflichten sich alle Mitarbeiter und
          Dienstleister zur Verschwiegenheit nach §5 BDSG.
          <br/><br/>
          Bei Notfällen (z.B. Unfall und Bewusstlosigkeit) kann eine autorisierte Stelle (z.B. Notfallambulanz) zwecks Behandlung Einsicht
          in die Notfalldatensätze nehmen um eine bestmöglich Notfallversorgung sicherstellen zu können. Zugriff auf die
          personenbezogenen Daten kann jedoch auch erfolgen (a) im Rahmen der Erbringung von Wartungsleistungen
          (Systemüberwachung, Backups, Austausch v. Datenträgern, etc.), jedoch auf das technisch notwendige Maß reduziert, (b) im
          Rahmen der gesetzlichen Verpflichtungen von IhrArzt24 / Cyomed, z.B. auf behördliche und/oder gerichtliche Anweisung, und (c) völlig
          anonymisiert und ohne individuelle Zuordenbarkeit im Rahmen von statistischen Gesamtauswertungen wie sie bereits von den
          Krankenkassen und Statistischen Bundesamt praktiziert werden (z.B. zur Ermittlung der allgemeinen Volksgesundheit).
          <br/><br/>
          IhrArzt24 / Cyomed ist dazu berechtigt, durch technische und organisatorische Maßnahmen wie z.B. Verfahrensanweisungen, Firewalls
          und Sicherheitseinstellungen die Integrität und Nutzbarkeit des IhrArzt24 / Cyomed Services für alle Nutzer sicherzustellen und dadurch
          bedingt ggf. bestimmte Informationen von der Übermittlung bzw. Speicherung auszunehmen (z.B. übergroße Bilddateien etc.).
        </p>
        <h3>4. Zugriff Dritter</h3>
        <p class="popupcontent">
          Der Nutzer ist zu jeder Zeit im Besitz seiner eigenen Daten. IhrArzt24 / Cyomed ist Treuhänder dieser und sorgt für die sichere
          Verwahrung und den sicheren Übermittlungskanal. Es gibt über die unter 4. genannte Punkte kein hinaus keinen automatisierten Zugriff
          Dritter, keine Erweiterung der Nutzungszwecke und -arten ohne gesonderte Einwilligung.
          <br/><br/>
          Die im IhrArzt24 / Cyomed Konto gespeicherten personenbezogenen Daten nach §3 Abs. 9 BDSG werden auf Basis dieser Einwilligung
          ausschließlich durch IhrArzt24 / Cyomed innerhalb der EU im vorgenannten Rahmen erhoben, gespeichert und genutzt. Dritte haben
          standardmäßig keinen Zugriff auf diese Daten.
          <br/><br/>
          Der Nutzer kann diese Einwilligungserklärung jederzeit durch entsprechende Mitteilung an IhrArzt24 / Cyomed widerrufen. Ein Widerruf
          der Einwilligung führt automatisch zur Kündigung des IhrArzt24 / Cyomed Nutzerkontos, da die Fortführung des IhrArzt24 / Cyomed Kontos nicht
          länger möglich ist. IhrArzt24 / Cyomed wird die im Account vorhandenen personenbezogenen und sonstigen Daten unverzüglich löschen,
          spätestens, sobald die Daten nicht mehr zur Abwicklung des Kontos benötigt werden. Ein Zugriff auf diese Daten ist dann nicht
          mehr möglich. Dem Nutzer ist bekannt, dass im Falle der Löschung IhrArzt24 / Cyomed keine Wiederherstellung der Daten mehr anbieten
          kann und eine Haftung von IhrArzt24 / Cyomed für den Verlust dieser somit ausgeschlossen ist.
          <br/><br/>
          <b><u>Jeder Nutzer hat, um in den anmeldungspflichtigen Bereich der IhrArzt24 / Cyomed-Plattform zu gelangen, in die Erhebung,
          Verarbeitung und Nutzung seiner personenbezogenen Daten einschließlich der von ihm bestimmten
          Gesundheitsdaten, also auch besonderer Arten personenbezogener Daten gemäß BDSG § 3, Abs. 9, im vorgenannten
          Umgang ausdrücklich eingewilligt. Die Einwilligung kann jederzeit widerrufen werden, wobei dann seitens des Nutzers auf den
          anmeldungspflichtigen Bereich der IhrArzt24 / Cyomed-Plattform nicht mehr zugegriffen kann.</u></b>
        </p>
        <h3>5. Verantwortlicher Betreiber</h3>
        <p class="popupcontent">
          Verantwortliche Stelle zum Betrieb der IhrArzt24 / Cyomed Plattform ist die: <b>IhrArzt24 / Cyomed GmbH,</b> Rheindorfer Weg 4, 40591 Düsseldorf.
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
        <button type="button" class="btn btn-primary"><span class="icomoon i-print-2"></span> Drucken</button>
      </div>
    </div>
  </div>
</div>
<style>
.bs-callout-danger { border-color:#eee!important}

.bs-callout-danger h4 {
  color: #093a80!important;
  font-size: 22px!important;
}
.alert-danger{  background-color: #f2dede!important;}.bs-callout-info h4 {
  color: #7DC6D2;
}
.bs-callout-info {
  border-left-color: #eee!important;
}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$('html, body').animate({
	    	scrollTop: $("#main-content").offset().top
		},1000);
	});
</script>
