<div class="row" style="padding-top:10px;">
  <div class="col-md-12">
   <h4>Willkommen beim Online Verschreibungsmodel für Medikamente von Cyomed</h4>
   <br>
   <h4>Bitte beantworten Sie folgende Fragen</h4>
  </div>
</div>

<form class="form-horizontal" role="form" name="frm" method="post" action="<?php echo site_url('eprescription/epres/questions_insert'); ?>" >

  <div class="row">
   <!-- choose problem type questions or options -->
    <div class="form-group">
      <label for="questions1" class="col-sm-6 control-label"> Welches Medikament möchten Sie bestellen? </label>
      <div class="col-sm-6">
        <select class="select" name="questions1" id="questions1" >
          <option value="">Bitte wählen sie die Kategorie</option>
          <option value="blutdruck" >Blutdruckmedikament</option>
          <option value="cholesterins" >Medikament zur Senkung erhöhten Cholesterins</option>
          <option value="allergie" >Tablette gegen Allergien</option>
          <option value="sexuelle" >Tablette gegen sexuelle Funktionsstörungen</option>
          <option value="maleria" >Malariaprophylaxe</option>
          <option value="pille" >Orale Kontrazeption (Pille)</option>
        </select>
      </div>
    </div>

    <!-- if choose questions 1 -->
    <div class="form-group questions2 " hidden>
      <label for="questions2" class="col-sm-6 control-label" id="question2lbl"> </label>
      <div class="col-sm-6">
        <select class="form-control" name="questions2" id="questions2">
        </select>
      </div>
    </div>
    

  <!-- text answer for problems small answer-->
    <section class="sections" id="section1" hidden>
      <div class="form-group">
        <label class="col-sm-6 control-label">
          Nehemen Sie das Medikament moment ein oder haben Sie das Mediakament bereits eingenommen?
        </label>
        <div class="col-sm-6" id="takingmedicine">
          <div class="radio-inline">
            <label>
              <input type="radio" name="taking" value="yes" />
              Ja
            </label>
          </div>
          <div class="radio-inline">
            <label>
              <input type="radio" name="taking" value="no"/>
              Nein
            </label>
          </div>
          <div class="radio-inline">
            <label>
              <input type="radio" name="taking" value="3"/>
              Ja aber nicht moment
            </label>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="inputMedicine_taken" class="col-sm-6 control-label">In welcher Dosierung nehmen Sie das Medikament ein? </label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="Medicine_taken" id="inputMedicine_taken" value="<?php echo set_value('Medicine_taken'); ?>" placeholder="Dosierung"  />
        </div>
      </div>

      <div class="form-group">
        <label for="Medicine_taken_date" class="col-sm-6 control-label">Seit wann nehmen Sie dieses Medikament </label>
        <div class="col-sm-6">
          <div class="input-icon datetime-pick date-only">
            <input type="text" class="form-control input-sm" name="Medicine_taken_date" id="Medicine_taken_date" data-format="dd.MM.yyyy" value="" />
            <span class="add-on">
              <i class="sa-plus fa fa-calendar"></i>
            </span>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="quantity" class="col-sm-6 control-label">Wie häufig nehmen Sie dieses Medikament</label>
        <div class="col-sm-6">
          <select class="select" name="quantity" id="quantity">
            <option value="1" <?php echo set_select('quantity', '1'); ?> >1x tgl.</option>
            <option value="2" <?php echo set_select('quantity', '2'); ?> >2x tgl.</option>
            <option value="3" <?php echo set_select('quantity', '3'); ?> >3x tgl.</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="time_taken" class="col-sm-6 control-label">Wann nehmen Sie das Medikament?</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="time_taken" id="time_taken" value="<?php echo set_value('time_taken'); ?>"/>
        </div>
      </div>

      <div class="form-group">
        <label for="tablet_quantity" class="col-sm-6 control-label">Nehmen Sie eine ganze oder eine halbe Tablette</label>
        <div class="col-sm-6">
          <select class="select" name="tablet_quantity" id="tablet_quantity">
            <option value="half" <?php echo set_select('tablet_quantity', '1'); ?> >halbe</option>
            <option value="whole" <?php echo set_select('tablet_quantity', '2'); ?> >ganze</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="last_taken_date" class="col-sm-6 control-label">Wann haben Sie dieses Medikament das letzte Mal eingenommen? </label>
        <div class="col-sm-6">
          <div class="input-icon datetime-pick date-only">
            <input type="text" class="form-control input-sm" name="last_taken_date" id="last_taken_date" data-format="dd.MM.yyyy" value="<?php echo date("d.m.Y", time()); ?>" placeholder="last_taken_date"  />
            <span class="add-on">
              <i class="sa-plus fa fa-calendar"></i>
            </span>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="anderemedikament" class="col-sm-6 control-label">Nehmen Sie dierzeit andere Medikamente oder haben Sie in letzter Zeit andere Medikament eingenommen (auch wenn nur über kurze Zeit)? </label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="anderemedikament" id="anderemedikament"  />
        </div>
      </div>
      
      <div class="form-group">
        <label for="allergiegegenmedikament" class="col-sm-6 control-label">Haben Sie Allergie gegen Medikament oder eine andere Allergie? </label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="allergiegegenmedikament" id="allergiegegenmedikament"  />
        </div>
      </div>

      <div class="form-group">
        <label for="blutdruckwert" class="col-sm-6 control-label">Bitte geben Sie Ihren letzten bekannten Blutdruckwert ein </label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="blutdruckwert" id="blutdruckwert"  placeholder="xxx mmHgsys + dia"  />
        </div>
      </div>

      <div class="form-group">
        <label for="othersickness" class="col-sm-6 control-label">An welchen Krankheiten außer hohem Blutdruck leiden Sie noch?  </label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="othersickness" id="othersickness" placeholder="othersickness"  />
        </div>
      </div>

      <div class="form-group">
        <label for="operation" class="col-sm-6 control-label">Sind Sie vor Kurzem operiert worden oder ist eine Opertion geplant?</label>
        <div class="col-sm-6">
          <div class="radio-inline">
            <label>
              <input type="radio" name="operation" value="yes" />
                Ja
            </label>
            </div>
            <div class="radio-inline">
              <label>
                <input type="radio" name="operation" value="no"/>
                Nein
              </label>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-12 text-right">
          <button class="btn btn-alt btn-lg" id="sec1next" type="button">Weiter <span class="glyphicon glyphicon-arrow-right"></span></button>
        </div>
      </div>

    </section>

    <section class="sections" id="section2" hidden>
      
      <div class ="form-group">
        <label class="col-sm-6 control-label">
          Leiden Sie an einer Nierenschwäche?
        </label>
        <div class="col-sm-6">
          <div class="radio-inline">
            <label>
              <input type="radio" name="nieren" value="yes" />
                Ja
            </label>
            </div>
            <div class="radio-inline">
              <label>
                <input type="radio" name="nieren" value="no"/>
                Nein
              </label>
          </div>
        </div>
      </div> 

      <div class ="form-group">
        <label class="col-sm-6 control-label">
          Leiden Sie an einer Lebererkrankung?
        </label>
        <div class="col-sm-6">
          <div class="radio-inline">
            <label>
              <input type="radio" name="leber" value="yes" />
                Ja
            </label>
            </div>
            <div class="radio-inline">
              <label>
                <input type="radio" name="leber" value="no"/>
                Nein
              </label>
          </div>
        </div>
      </div> 

      <div class ="form-group">
        <label class="col-sm-6 control-label">
          Leiden Sie an einer Magen-Darm-Traktes Erkranungen?
        </label>
        <div class="col-sm-6">
          <div class="radio-inline">
            <label>
              <input type="radio" name="magen" value="yes" />
                Ja
            </label>
            </div>
            <div class="radio-inline">
              <label>
                <input type="radio" name="magen" value="no"/>
                Nein
              </label>
          </div>
        </div>
      </div> 

      <div class ="form-group">
        <label class="col-sm-6 control-label">
          Leiden Sie an einer Störung des Elektrolyte (Natrium, Kalium, Magnesium, Kalzium) oder des Säure-Basen-Haushaltes?
        </label>
        <div class="col-sm-6">
          <div class="radio-inline">
            <label>
              <input type="radio" name="electrolyte" value="yes" />
                Ja
            </label>
            </div>
            <div class="radio-inline">
              <label>
                <input type="radio" name="electrolyte" value="no"/>
                Nein
              </label>
          </div>
        </div>
      </div> 

      <div class ="form-group">
        <label class="col-sm-6 control-label">
          Leiden Sie an einer Hormonstörung?
        </label>
        <div class="col-sm-6">
          <div class="radio-inline">
            <label>
              <input type="radio" name="hormom" value="yes" />
                Ja
            </label>
            </div>
            <div class="radio-inline">
              <label>
                <input type="radio" name="hormom" value="no"/>
                Nein
              </label>
          </div>
        </div>
      </div> 
      
      <div class ="form-group">
        <label class="col-sm-6 control-label">
          Leiden Sie an Gicht?
        </label>
        <div class="col-sm-6">
          <div class="radio-inline">
            <label>
              <input type="radio" name="gicht" value="yes" />
                Ja
            </label>
            </div>
            <div class="radio-inline">
              <label>
                <input type="radio" name="gicht" value="no"/>
                Nein
              </label>
          </div>
        </div>
      </div> 

      <div class ="form-group">
        <label class="col-sm-6 control-label">
          Leiden Sie an Diabetes?
        </label>
        <div class="col-sm-6">
          <div class="radio-inline">
            <label>
              <input type="radio" name="diabetes" value="yes" />
                Ja
            </label>
            </div>
            <div class="radio-inline">
              <label>
                <input type="radio" name="diabetes" value="no"/>
                Nein
              </label>
          </div>
        </div>
      </div>

      <div class ="form-group">
        <label class="col-sm-6 control-label">
          Neigen Sie zu Schwindel oder sind Sie schon einmal kollabiert oder ar ohnmächtig geworden?
        </label>
        <div class="col-sm-6">
          <div class="radio-inline">
            <label>
              <input type="radio" name="schwindel" value="yes" />
                Ja
            </label>
            </div>
            <div class="radio-inline">
              <label>
                <input type="radio" name="schwindel" value="no"/>
                Nein
              </label>
          </div>
        </div>
      </div> 

      <div class ="form-group">
        <label class="col-sm-6 control-label">
          Hatten Sie schon einmal Herzinfarkt?
        </label>
        <div class="col-sm-6">
          <div class="radio-inline">
            <label>
              <input type="radio" name="herzinfarkt" value="yes" />
                Ja
            </label>
            </div>
            <div class="radio-inline">
              <label>
                <input type="radio" name="herzinfarkt" value="no"/>
                Nein
              </label>
          </div>
        </div>
      </div>

      <div class ="form-group">
        <label class="col-sm-6 control-label">
          Hatten Sie schon einmal Schlaganfall?
        </label>
        <div class="col-sm-6">
          <div class="radio-inline">
            <label>
              <input type="radio" name="schlaganfall" value="yes" />
                Ja
            </label>
          </div>
          <div class="radio-inline">
            <label>
              <input type="radio" name="schlaganfall" value="no"/>
              Nein
            </label>
          </div>
        </div>
      </div>

      <div class ="form-group">
        <label class="col-sm-6 control-label">
          Leiden Sie an chronischen Aemwegserkrankung wie Asthma oder chronisher Bronchitis?
        </label>
        <div class="col-sm-6">
          <div class="radio-inline">
            <label>
              <input type="radio" name="asthma" value="yes" />
                Ja
            </label>
            </div>
            <div class="radio-inline">
              <label>
                <input type="radio" name="asthma" value="no"/>
                Nein
              </label>
          </div>
        </div>
      </div>

      <div class ="form-group">
        <label class="col-sm-6 control-label">
          Leiden Sie an Durchblutungsstörungen der Armen oder Beine?(z.B. Schaufensterkrankheit)
        </label>
        <div class="col-sm-6">
          <div class="radio-inline">
            <label>
              <input type="radio" name="durchblutungsstörungen" value="yes" />
                Ja
            </label>
            </div>
            <div class="radio-inline">
              <label>
                <input type="radio" name="durchblutungsstörungen" value="no"/>
                Nein
              </label>
          </div>
        </div>
      </div>

      <div class ="form-group">
        <label class="col-sm-6 control-label">
          Leiden Sie an andere chronischen Herzerkrankungen oder einer Herzrhythmusstörung?
        </label>
        <div class="col-sm-6">
          <div class="radio-inline">
            <label>
              <input type="radio" name="herzerkrankung" value="yes" />
                Ja
            </label>
            </div>
            <div class="radio-inline">
              <label>
                <input type="radio" name="herzerkrankung" value="no"/>
                Nein
              </label>
          </div>
        </div>
      </div>


      <div class="form-group">
        <div class="col-sm-6 text-left">
          <button class="btn btn-alt btn-lg" id="sec2prev" type="button"><span class="glyphicon glyphicon-arrow-left"></span> Zurück</button>
        </div>
        <div class="col-sm-6 text-right">
          <button class="btn btn-alt btn-lg" id="sec2next" type="button">Weiter <span class="glyphicon glyphicon-arrow-right"></span></button>
        </div>
      </div> 

    </section>

    
    <section class="sections" id="section3" hidden>

      <div class ="form-group">
        <label class="col-sm-6 control-label">
          Haben Sie Beschwerden aufgrund Ihrer Erkrankung?
        </label>
        <div class="col-sm-6">
          <div class="radio-inline">
            <label>
              <input type="radio" name="beschwerdeErkrankung" value="yes" />
                Ja
            </label>
            </div>
            <div class="radio-inline">
              <label>
                <input type="radio" name="beschwerdeErkrankung" value="no"/>
                Nein
              </label>
          </div>
        </div>
      </div>

      <div class ="form-group">
        <label class="col-sm-6 control-label">
          Haben Sie Beschwerden durch Ihre Medikamente?
        </label>
        <div class="col-sm-6">
          <div class="radio-inline">
            <label>
              <input type="radio" name="beschwerdeMedikamente" value="yes" />
                Ja
            </label>
            </div>
            <div class="radio-inline">
              <label>
                <input type="radio" name="beschwerdeMedikamente" value="no"/>
                Nein
              </label>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-6 control-label">
          Rauchen Sie?
        </label>
        <div class="col-sm-6">
          <div class="radio-inline">
            <label>
              <input type="radio" name="smoker" value="yes" />
                Ja
            </label>
            </div>
            <div class="radio-inline">
              <label>
                <input type="radio" name="smoker" value="no"/>
                Nein
              </label>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-6 control-label">
          Trinken Sie Akohol?
        </label>
        <div class="col-sm-6">
          <div class="radio-inline">
              <label>
                <input type="radio" name="alkohol" value="no"/>
                Nein
              </label>
          </div>
          <div class="radio-inline">
            <label>
              <input type="radio" name="alkohol" value="rarely" />
                Selten
            </label>
          </div>
          <div class="radio-inline">
            <label>
              <input type="radio" name="alkohol" value="often" />
                Regelmäßig
            </label>
          </div>
          <div class="radio-inline">
            <label>
              <input type="radio" name="alkohol" value="daily" />
                Täglich
            </label>
          </div>
        </div>  
      </div>

      <div class="form-group">
        <label class="col-sm-6 control-label">
          Konsumieren Sie Drogen oder haben Sie Drogen konsumiert?
        </label>
        <div class="col-sm-6">
          <div class="radio-inline">
            <label>
              <input type="radio" name="drogen" value="yes" />
                Ja
            </label>
            </div>
            <div class="radio-inline">
              <label>
                <input type="radio" name="drogen" value="no"/>
                Nein
              </label>
          </div>
        </div>
      </div>

      <hr class="whiter m-t-20">

      <div class="form-group">
        <label class="col-sm-6 control-label">
          Sind Sie schwanger?
        </label>
        <div class="col-sm-6">
          <div class="radio-inline">
            <label>
              <input type="radio" name="pregnant" value="yes" />
                Ja
            </label>
            </div>
            <div class="radio-inline">
              <label>
                <input type="radio" name="pregnant" value="no"/>
                Nein
              </label>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-6 control-label">
          Stillen Sie?
        </label>
        <div class="col-sm-6">
          <div class="radio-inline">
            <label>
              <input type="radio" name="breastfeeding" value="yes" />
                Ja
            </label>
            </div>
            <div class="radio-inline">
              <label>
                <input type="radio" name="breastfeeding" value="no"/>
                Nein
              </label>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-6 control-label">
          Planen Sie eine Schwangerschaft?
        </label>
        <div class="col-sm-6">
          <div class="radio-inline">
            <label>
              <input type="radio" name="planPregnant" value="yes" />
                Ja
            </label>
            </div>
            <div class="radio-inline">
              <label>
                <input type="radio" name="planPregnant" value="no"/>
                Nein
              </label>
          </div>
        </div>
      </div>

      <hr class="whiter m-t-20">

      <div class="form-group">
        <label for="doctorid" class="col-sm-6 control-label">
          Wer hat Ihnen das Medikament verschrieben?  
        </label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="doctorid" id="doctorid" />
        </div>
      </div>

      <div class="form-group">
        <label for="advice" class="col-sm-6 control-label">
          Wann haben Sie das letze mal mit Ihrem behandelden Arzt über Ihre Krankheit gesprochen?  
        </label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="advice" id="advice" />
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-6 control-label">
          Wurden Sie Ihnen bereits einmal eine Langzeitblutdruckbestimmung durchgeführt?
        </label>
        <div class="col-sm-6">
          <div class="radio-inline">
            <label>
              <input type="radio" name="blutdruckbestimmung" value="yes" />
                Ja
            </label>
            </div>
            <div class="radio-inline">
              <label>
                <input type="radio" name="blutdruckbestimmung" value="no"/>
                Nein
              </label>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-6 control-label">
          Messen Sie Ihren Blutdruck regelmäßig selbst?
        </label>
        <div class="col-sm-6">
          <div class="radio-inline">
            <label>
              <input type="radio" name="measurePressure" value="yes" />
                Ja
            </label>
            </div>
            <div class="radio-inline">
              <label>
                <input type="radio" name="measurePressure" value="no"/>
                Nein
              </label>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-12">
          <div class="checkbox-inline">
            <label>
              <div class="checkbox_box">
                <input type="checkbox" value="yes" id="agree1<?php  ?>" name="agree1"/>
                <label for="agree1<?php  ?>">Hiermit bestätige ich, dass ich das gewünschte Präparat bereits regelmäßig einnehme und bislang problemlos angewendet habe</label>
              </div>
            </label>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-12">
          <div class="checkbox-inline">
            <label>
              <div class="checkbox_box">
                <input type="checkbox" value="yes" id="agree1<?php  ?>" name="agree1"/>
                <label for="agree1<?php  ?>">Hiermit bestätige ich, dass ich alle Fragen nach bestem Wissen und Gewissen beantwortet habe und das gewünschte Präparat nur und ausschließlich zu meiner eigenen Verwendung bestellt wird</label>
              </div>
            </label>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-6 text-left">
          <button class="btn btn-alt btn-lg" id="sec3prev" type="button"><span class="glyphicon glyphicon-arrow-left"></span> Zurück</button>
        </div>
        <div class="col-sm-6 text-right">
          <button class="btn btn-alt btn-lg" id="sec3next" type="button">Weiter <span class="glyphicon glyphicon-arrow-right"></span></button>
        </div>
      </div>
  
    </section>

    <section id="section4" hidden>

      <div class="form-group">
        <div class="col-sm-6 text-left">
          <button class="btn btn-alt btn-lg" id="sec4prev" type="button"><span class="glyphicon glyphicon-arrow-left"></span> Zurück</button>
        </div>
        <div class="col-sm-6 text-right">
          <button class="btn btn-alt btn-lg" type="submit"><span class="glyphicon glyphicon-ok"></span> Daten Übermitteln und fortfahren</button>
        </div>
      </div>
      
    </section>




  
</form>

<!--
    javascript function added to generate the select options for second option after choosing the sickness.
-->
<script type="text/javascript">
$(document).ready(function() {

  $("#questions1").change(function(){
   
    $.getJSON($.siteUrl +"/eprescription/epres/get_option"+"?term="+$("#questions1").val(),function(data){
        var option = [];
        $.each(data,function(key,val){
            option.push("<option value='"+val.medicine+"'>"+val.medicine+"</option>");
        });
        
        var options = option.join("");

        $("#question2lbl").html($("#questions1 option:selected").text());

        $("#questions2")
          .empty()
          .append(options);
        $(".questions2").show(); 
    });
 
  });

  $(".questions2 select").change(function(){
    $("#section1").show();
  });

  $("#sec1next").click(function(e){
      $("#questions1").prop('disabled','disabled');
      $("#questions2").prop('disabled','disabled');
      $("#section1").toggle();
      $("#section2").toggle();
  });

  $("#sec2prev").click(function(e){
      $("#questions1").prop('disabled','false');
      $("#questions2").prop('disabled','false');
      $("#section2").toggle();
      $("#section1").toggle();
  });

  $("#sec2next").click(function(e){
      $("#section2").toggle();
      $("#section3").toggle();
  });

  $("#sec3prev").click(function(e){
      $("#section3").toggle();
      $("#section2").toggle();
  });

  $("#sec3next").click(function(e){
      $("#section3").toggle();
      $("#section4").toggle();
      /*$( ".form-group" ).each(function( index, element ) {
        //var division = $(this);
        //var text = $(".control-label").text() + $(".form-control").val();
       console.log(($(this) > label).text());
      });*/
  });

  $("#sec4prev").click(function(e){
      $("#section4").toggle();
      $("#section3").toggle();
  });

  $( ".form-group" ).each(function( index, element ) {
        var division = $(this);
        var text = $(".control-label").text() + $(".form-control").val();
       console.log(text);
      });
  
});

</script>