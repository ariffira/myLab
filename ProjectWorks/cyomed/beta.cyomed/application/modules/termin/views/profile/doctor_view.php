<div class="theme-inbilt">
  <section class="doctor-summary">

    <div class="page-header">
      <h1 class="text-left"><?php echo (isset($doctor->academic_grade) ? $doctor->academic_grade : '').' '.(isset($doctor->name) ? $doctor->name : '').' '.(isset($doctor->surname) ? $doctor->surname : ''); ?></h1>
    </div>

    <div class="row">
      <div class="col-xs-2">
        <span class="thumbnail">
        	<img class="profile-pic img-responsive" src="<?php $this->load->model('document/mdoc'); echo ($img_path = $this->mdoc->get_profile_image_path()) ? base_url($img_path) : '//placehold.it/120x120'; ?>" alt="Profile Avatar" />
        </span>
      </div>
      <div class="col-xs-10">
        <div class="row">
          <div class="col-md-8">
            <p class="lead" style="margin:0;">
              <?php if(isset($doctor->telephone) && $doctor->telephone) : ?>
                <a href="tel:<?php echo $doctor->telephone; ?>"><?php echo $doctor->telephone; ?></a>
              <?php endif; ?>
            </p>
            <hr style="margin:0;" />
          </div>
        </div>
        <div class="row">
          <!-- <div class="col-md-5">
            <div class="row">
              <div class="col-md-12">
                <h4>Bewertung</h4>
              </div>
              <div class="col-md-4">
                <div class="rating-name">Behandlung</div>
                <div class="rating-value">
                  <span class="icomoon i-star-6"></span>
                  <span class="icomoon i-star-6"></span>
                  <span class="icomoon i-star-6"></span>
                  <span class="icomoon i-star-5"></span>
                  <span class="icomoon i-star-4"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="rating-name">Wartezeit</div>
                <div class="rating-value">
                  <span class="icomoon i-star-6"></span>
                  <span class="icomoon i-star-6"></span>
                  <span class="icomoon i-star-6"></span>
                  <span class="icomoon i-star-5"></span>
                  <span class="icomoon i-star-4"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="rating-name">Gesamtbewertung</div>
                <div class="rating-value">
                  <span class="icomoon i-star-6"></span>
                  <span class="icomoon i-star-6"></span>
                  <span class="icomoon i-star-6"></span>
                  <span class="icomoon i-star-5"></span>
                  <span class="icomoon i-star-4"></span>
                </div>
              </div>
            </div>
          </div> -->
          <div class="col-md-3">
            <div class="specialties" >
              <h4 data-item-prop="keyword">Fachgebiete</h4>
              <span data-item-prop="medicalSpecialty">
                <?php if (isset($doctor->native->specs_assoc) && is_array($doctor->native->specs_assoc)) : foreach ($doctor->native->specs_assoc as $code => $row) : ?>
                  <?php echo ' - '.$row->name.'<br/>'; ?>
                <?php endforeach; endif; ?>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
  </div>
<div class="theme-inbilt">
  <section class="calendar-container">
    <div class="page-header">
      <h2 class="text-left">Wählen Sie Ihren Wunschtermin aus</h2>
    </div>

<!--    <div class="row">
      <div class="col-md-12">
        <div class="insurance-selector pull-right">
           <a class="btn btn-default btn-xs insurance-selector-button pull-right public  <?php echo isset($doctor->native->insurance_public) && $doctor->native->insurance_public ? '  active ' : ''; ?>" href="#" data-toggle-calendar=".owl-calendar[data-doctor-id<?php echo isset($doctor->id) && $doctor->id ? ("='".$doctor->id."'") : ''; ?>]" data-item-prop="keyword" style="margin-left:10px;">gesetzlich</a> 
           <a class="btn btn-default btn-xs insurance-selector-button pull-right private <?php echo isset($doctor->native->insurance_private) && $doctor->native->insurance_private ? ' active ' : ''; ?>" href="#" data-toggle-calendar=".owl-calendar[data-doctor-id<?php echo isset($doctor->id) && $doctor->id ? ("='".$doctor->id."'") : ''; ?>]" data-item-prop="keyword" style="margin-left:10px;">privat</a> 
        </div>
      </div>
    </div>-->

    <div class="row">
      <div class="col-md-5">
        <div class="bs-callout bs-callout-info">
          <div class="media">
            <span class="pull-left">
              <?php if (isset($doctor->native->coordinate_lat) && $doctor->native->coordinate_lat && isset($doctor->native->coordinate_lng) && $doctor->native->coordinate_lng) : ?>
                <img src="//maps.googleapis.com/maps/api/staticmap?center=<?php echo $doctor->native->coordinate_lat; ?>,<?php echo $doctor->native->coordinate_lng; ?>&amp;markers=icon:https://dl.dropboxusercontent.com/u/219719190/map-marker%402x.png|<?php echo $doctor->native->coordinate_lat; ?>,<?php echo $doctor->native->coordinate_lng; ?>&amp;zoom=12&amp;size=160x160&amp;sensor=false">
              <?php else : ?>
                <img src="//placehold.it/160x160" />
              <?php endif; ?>
            </span>
            <div class="media-body">
              <h4 class="media-heading">Praxis</h4>
              <div class="name">Praxis <?php echo (isset($doctor->academic_grade) ? $doctor->academic_grade : '').' '.(isset($doctor->name) ? $doctor->name : '').' '.(isset($doctor->surname) ? $doctor->surname : ''); ?></div>
              <div class="address" data-item-prop="address">
                <?php echo isset($doctor->address) && $doctor->address ? $doctor->address : ''; ?> <br />
                <?php echo isset($doctor->zip) && $doctor->zip ? $doctor->zip : ''; ?> <?php echo isset($doctor->city) && $doctor->city ? $doctor->city : ''; ?> <?php echo isset($doctor->region) && $doctor->region ? (''.$doctor->region) : ''; ?>
              </div>
              <div class="telephone">
                <?php if(isset($doctor->telephone) && $doctor->telephone) : ?>
                  <span data-item-prop="telephone"><a href="tel:<?php echo $doctor->telephone; ?>"><?php echo $doctor->telephone; ?></a></span>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-7">
           <div class="scrollable medium" data-doctor-id="<?php echo isset($doctor->id) && $doctor->id ? $doctor->id : ''; ?>" <?php echo isset($doctor->native->insurance_public) && $doctor->native->insurance_public ? ' data-insurance-public="1" ' : ''; ?> <?php echo isset($doctor->native->insurance_private) && $doctor->native->insurance_private ? ' data-insurance-private="1" ' : ''; ?> style="margin-top:20px;">
<!--        <div class="owl-calendar calendar scrollable medium" data-doctor-id="<?php echo isset($doctor->id) && $doctor->id ? $doctor->id : ''; ?>" <?php echo isset($doctor->native->insurance_public) && $doctor->native->insurance_public ? ' data-insurance-public="1" ' : ''; ?> <?php echo isset($doctor->native->insurance_private) && $doctor->native->insurance_private ? ' data-insurance-private="1" ' : ''; ?> style="margin-top:20px;">-->
           <div class="wrapper" style="width: 929.600001335144px;"> 

           </div> 
          
           <div class="arrow left disabled"></div> 
           <div class="arrow right"></div> 

          <div class="action no-available-appointments">
            <div class="message">keine freien Termine verfügbar</div>
          </div>

          <div class="action integration_8">
            <div class="message">
              <a href="http://www.ihrarzt24.de/termin?u=8383&amp;l=7239&amp;m=&amp;tt=&amp;i=2">Freie Termine anfragen</a>
              <div>Wir kümmern uns darum und rufen Sie zurück!</div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  </div>
<div class="theme-inbilt">
  <section class="additional-info-container" style="margin-bottom:20px;">
    <div class="page-header">
      <h2 class="text-left">Weitere Informationen zu diesem Arzt</h2>
    </div>

    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        
        <?php if (isset($doctor->reviews) && is_array($doctor->reviews)) :  ?>
          <section id="reviews" data-item-scope="" data-item-type="http://schema.org/Review">
            <h3 data-item-prop="keyword">Bewertungen</h3>
            <div class="additional-info-text">
              <section data-item-scope="" class="review">
                <h4>
                Mi 25.06.2014
                
                von <span class="name" data-item-prop="author">Sarrafi</span> (Verifizierter Patient)
                </h4>
                <ul class="inlined">
                  <li data-item-prop="keyword">
                    Behandlung
                    <span class="rating rating-5"><meta data-item-prop="rating" content="5.0"></span>
                  </li>
                  <li data-item-prop="keyword">
                    Wartezeit
                    <span class="rating rating-5"><meta data-item-prop="rating" content="5.0"></span>
                  </li>
                  <li data-item-prop="keyword">
                    Gesamtbewertung
                    <span class="rating rating-5"><meta data-item-prop="rating" content="5.0"></span>
                  </li>
                </ul>
                <p data-item-prop="reviewBody">
                Ich habe gleich den nächsten Behandlungstermin ausgemacht. Sehr Empfehlenswert!
                </p>
              </section>
              <section data-item-scope="" class="review">
                <h4>
                Di 03.06.2014
                
                von <span class="name" data-item-prop="author">Neumann auuss Berlin</span> (Verifizierter Patient)
                </h4>
                <ul class="inlined">
                  <li data-item-prop="keyword">
                    Behandlung
                    <span class="rating rating-4"><meta data-item-prop="rating" content="4.0"></span>
                  </li>
                  <li data-item-prop="keyword">
                    Wartezeit
                    <span class="rating rating-5"><meta data-item-prop="rating" content="5.0"></span>
                  </li>
                  <li data-item-prop="keyword">
                    Gesamtbewertung
                    <span class="rating rating-5"><meta data-item-prop="rating" content="5.0"></span>
                  </li>
                </ul>
                <p data-item-prop="reviewBody">
                Hola, schöne Praxis im Berliner Altbau Haus , eine nette Empfangsdame steht ihnen für alle Fragen zur verfügung,
                ebenso eine entzückend nette Arzthelferin ist für alle eventualitäten behilflich, ich war jetz das erstemal zum Zahnjahrescheckup vor Ort.
                Der sehr große Praxisraum mit den Kunst Accessoires und die dezente Radiomusik im hintergrund machen den Besuch schon zu einen kleinen Erlebniss , nur an der Raumfarbgestaltung fehlt die wohlfühlfeinabstimmung.
                ansonsten gerne wieder
                </p>
              </section>
              <section data-item-scope="" class="review">
                <h4>
                Fr 30.05.2014
                
                von <span class="name" data-item-prop="author">MiaD</span> (Verifizierter Patient)
                </h4>
                <ul class="inlined">
                  <li data-item-prop="keyword">
                    Behandlung
                    <span class="rating rating-5"><meta data-item-prop="rating" content="5.0"></span>
                  </li>
                  <li data-item-prop="keyword">
                    Wartezeit
                    <span class="rating rating-5"><meta data-item-prop="rating" content="5.0"></span>
                  </li>
                  <li data-item-prop="keyword">
                    Gesamtbewertung
                    <span class="rating rating-5"><meta data-item-prop="rating" content="5.0"></span>
                  </li>
                </ul>
                <p data-item-prop="reviewBody">
                Ich bin nach wenigen Minuten direkt dran gekommen. Die Behandlung war freundlich, schnell und kompetent. Ich bin sehr zufrieden und werde bei diesem Zahnarzt bleiben.
                </p>
              </section>
            </div>
          </section>
        <?php endif; ?>

        <div class="row">
          <div class="col-md-6" style="margin-bottom:10px;">
            <?php if (isset($doctor->native->text_description) && $doctor->native->text_description) : ?>
              <a class="list-group-item">
                <h4 class="list-group-item-heading">Beschreibung</h4>
                <div class="list-group-item-text">
                  <?php echo $doctor->native->text_description; ?>
                </div>
              </a>
            <?php endif; ?>
            <?php if (isset($doctor->native->text_more_for_patient) && $doctor->native->text_more_for_patient) : ?>
              <a class="list-group-item">
                <h4 class="list-group-item-heading">Für Patienten</h4>
                <div class="list-group-item-text">
                  <?php echo $doctor->native->text_more_for_patient; ?>
                </div>
              </a>
            <?php endif; ?>
            <?php if (isset($doctor->native->langs_assoc) && $doctor->native->langs_assoc) : ?>
              <a class="list-group-item">
                <h4 class="list-group-item-heading">Sprachen</h4>
                <div class="list-group-item-text">
                  <?php foreach ($doctor->native->langs_assoc as $code => $row) : ?>
                    - <?php echo $row->name; ?> / <?php echo $row->native; ?><br/>
                  <?php endforeach; ?>
                </div>
              </a>
            <?php endif; ?>
          </div>
          <div class="col-md-6" style="margin-bottom:10px;">
            <?php if (isset($doctor->native->text_vet) && $doctor->native->text_vet) : ?>
              <a class="list-group-item">
                <h4 class="list-group-item-heading">Ausbildung</h4>
                <div class="list-group-item-text">
                  <?php echo $doctor->native->text_vet; ?>
                </div>
              </a>
            <?php endif; ?>
            <?php if (isset($doctor->native->text_membership) && $doctor->native->text_membership) : ?>
              <a class="list-group-item">
                <h4 class="list-group-item-heading">Mitgliedschaften</h4>
                <div class="list-group-item-text">
                  <?php echo $doctor->native->text_membership; ?>
                </div>
              </a>
            <?php endif; ?>
            <!-- 
            <?php if (isset($doctor->native->text_hospital_occupancy) && $doctor->native->text_hospital_occupancy) : ?>
              <a class="list-group-item">
                <h4 class="list-group-item-heading">Krankenhausbelegung</h4>
                <div class="list-group-item-text">
                  <?php echo $doctor->native->text_hospital_occupancy; ?>
                </div>
              </a>
            <?php endif; ?>
            -->
          </div>
        </div>

        <?php if (!isset($doctor->native->is_member) || !$doctor->native->is_member) : ?>
          <div class="bs-callout bs-callout-danger">
            Diese Arzt(Ärztin) ist noch kein Partner von cyomed. 
          </div>
        <?php else: ?>
          <div class="bs-callout bs-callout-info">
            Diese Arzt(Ärztin) ist ein Partner von cyomed.
          </div>
        <?php endif; ?>

      </div>
    </div>
  </section>
  
</div>
<style>
.theme-inbilt{ background:#fff; padding:10px; margin-bottom:10px;}
.page-header {
  padding-bottom: 9px;
  margin:20px 0 10px;
  border-bottom: 1px solid #eee;
}
.theme-inbilt h1, h2{ margin-bottom:0}
</style>