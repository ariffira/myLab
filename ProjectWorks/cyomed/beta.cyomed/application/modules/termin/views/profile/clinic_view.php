<main data-item-scope="" data-item-type="http://schema.org/Physician">
  <section class="doctor-summary">
    <div class="right">
      <div class="headline justified-blocks">
        <h1 data-item-prop="name"><?php echo $doctor->name_combine; ?></h1>
        <?php if(isset($doctor->telephone) && $doctor->telephone) : ?>
          <div data-item-prop="telephone"><a href="tel:<?php echo $doctor->telephone; ?>"><?php echo $doctor->telephone; ?></a></div>
        <?php endif; ?>
      </div>
      <div class="photo">
        <img data-item-prop="image" data-item-scope="" data-item-type="http://schema.org/MediaObject" src="<?php echo isset($doctor->avatar) && $doctor->avatar ? $doctor->avatar : '//placehold.it/82x126'; ?>" >
      </div>
      <div class="middle">
        <div class="address" data-item-prop="address">
          <?php echo isset($doctor->street) && $doctor->street ? $doctor->street : ''; ?> <?php echo isset($doctor->street_additional) && $doctor->street_additional ? $doctor->street_additional : ''; ?><br />
          <?php echo isset($doctor->postal_code) && $doctor->postal_code ? $doctor->postal_code : ''; ?> <?php echo isset($doctor->locality) && $doctor->locality ? $doctor->locality : ''; ?>
        </div>
        <div class="ratings" data-item-prop="aggregateRating" data-item-scope="" data-item-type="http://schema.org/AggregateRating">
          <h4>Bewertung</h4>
          <div>
            <div class="rating-name">Behandlung</div>
            <div class="rating rating-4-5"><meta data-item-prop="ratingValue" content="4.7"></div>
          </div>
          <div>
            <div class="rating-name">Wartezeit</div>
            <div class="rating rating-5"><meta data-item-prop="ratingValue" content="5.0"></div>
          </div>
          <div>
            <div class="rating-name">Gesamtbewertung</div>
            <div class="rating rating-5"><meta data-item-prop="ratingValue" content="5.0"></div>
          </div>
        </div>
        <div class="specialties" data-item-scope="" data-item-type="http://schema.org/Physician">
          <h4 data-item-prop="keyword">Fachgebiete</h4>
          <span data-item-prop="medicalSpecialty">
            <?php if (isset($doctor->specs_assoc) && is_array($doctor->specs_assoc)) : foreach ($doctor->specs_assoc as $code => $row) : ?>
              <?php echo (!isset($pfs) || !$pfs ? (($pfs = TRUE) ? '' : '') : ', ').$row->name; ?>
            <?php endforeach; endif; ?>
          </span>
        </div>
      </div>
      <div class="location-map">
        <?php if (isset($doctor->coordinate_lat) && $doctor->coordinate_lat && isset($doctor->coordinate_lng) && $doctor->coordinate_lng) : ?>
          <img data-item-prop="map" src="//maps.googleapis.com/maps/api/staticmap?center=<?php echo $doctor->coordinate_lat; ?>,<?php echo $doctor->coordinate_lng; ?>&amp;markers=icon:https://dl.dropboxusercontent.com/u/219719190/map-marker%402x.png|<?php echo $doctor->coordinate_lat; ?>,<?php echo $doctor->coordinate_lng; ?>&amp;zoom=11&amp;size=300x220&amp;sensor=false">
        <?php else : ?>
          <img data-item-prop="map" src="//placehold.it/300x220" />
        <?php endif; ?>
      </div>
    </div>
  </section>

  <section class="calendar-container">
    <h2>Wählen Sie Ihren Wunschtermin aus</h2>
    <div class="insurance-selector">
      <a class="insurance-selector-button public  <?php echo isset($doctor->insurance_public) && $doctor->insurance_public ? '  active ' : ''; ?>" href="#" data-toggle-calendar="" data-item-prop="keyword" style="width:auto;">gesetzlich</a>
      <a class="insurance-selector-button private <?php echo isset($doctor->insurance_private) && $doctor->insurance_private ? ' active ' : ''; ?>" href="#" data-toggle-calendar="" data-item-prop="keyword" style="width:auto;">privat</a>
    </div>
    <div id="providers" data-date-start="2014-06-27" data-date-end="2014-07-16" data-date-days="14" data-date-calendar-days="20">
      <?php $doctors = $this->modoc->get_all(); ?>
      <?php for ($i = 0; $i < count($doctors); $i++) : ?>
        <?php $this->load->view('search/entry_view', array('doctor' => $doctors[$i],)); ?>
      <?php endfor; ?>
    </div>
  </section>
  <section data-item-scope="" class="additional-info">
    <h2>Weitere Informationen zu diesem Arzt</h2>

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
    <?php if (isset($doctor->text_description) && $doctor->text_description) : ?>
      <section data-item-scope="" data-item-type="http://schema.org/Physician">
        <h3>Beschreibung</h3>
        <div class="additional-info-text" data-item-prop="description">
          <p><?php echo $doctor->text_description; ?></p>
        </div>
      </section>
    <?php endif; ?>
    <?php if (isset($doctor->text_more_for_patient) && $doctor->text_more_for_patient) : ?>
      <section data-item-scope="" data-item-type="http://schema.org/Physician">
        <h3>Für Patienten</h3>
        <div class="additional-info-text" data-item-prop="availableService">
          <p><?php echo $doctor->text_more_for_patient; ?></p>
        </div>
      </section>
    <?php endif; ?>
    <?php if (isset($doctor->langs_assoc) && $doctor->langs_assoc) : ?>
      <section data-item-scope="" data-item-type="http://schema.org/Physician">
        <h3>Sprachen</h3>
        <div class="additional-info-text" data-item-prop="description">
          <p>
            <?php foreach ($doctor->langs_assoc as $code => $row) : ?>
              - <?php echo $row->name; ?> / <?php echo $row->native; ?><br/>
            <?php endforeach; ?>
          </p>
        </div>
      </section>
    <?php endif; ?>
    <?php if (isset($doctor->text_vet) && $doctor->text_vet) : ?>
      <section data-item-scope="" data-item-type="http://schema.org/Physician">
        <h3>Ausbildung</h3>
        <div class="additional-info-text" data-item-prop="description">
          <p><?php echo $doctor->text_vet; ?></p>
        </div>
      </section>
    <?php endif; ?>
    <?php if (isset($doctor->text_membership) && $doctor->text_membership) : ?>
      <section data-item-scope="" data-item-type="http://schema.org/Physician">
        <h3>Mitgliedschaften</h3>
        <div class="additional-info-text" data-item-prop="description">
          <p><?php echo $doctor->text_membership; ?></p>
        </div>
      </section>
    <?php endif; ?>
    <?php if (isset($doctor->text_hospital_occupancy) && $doctor->text_hospital_occupancy) : ?>
      <section data-item-scope="" data-item-type="http://schema.org/Physician">
        <h3>Krankenhausbelegung</h3>
        <div class="additional-info-text" data-item-prop="description">
          <p><?php echo $doctor->text_hospital_occupancy; ?></p>
        </div>
      </section>
    <?php endif; ?>
    <section class="info-text-container">
      <div style="clear:both" class="non-pay profile-disclaimer">
        <?php if (!isset($doctor->is_member) || !$doctor->is_member) : ?>
          Diese Praxis ist noch kein Partner von IhrArzt24.de, dennoch ist Ihnen unser kostenfreier Buchungsservice gerne bei der Terminvereinbarung behilflich.
        <?php endif; ?>
      </div>
    </section>
  </section>
</main>