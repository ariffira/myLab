<section class="cinema picture<?php // echo '-'.mt_rand(1,6); ?>">

  <div id="owl-cinema" class="owl-carousel owl-theme">
   
    <div class="item"><img src="<?php echo base_url('assets/images/frontpage_pics/1.jpg'); ?>" alt=""></div>
    <div class="item"><img src="<?php echo base_url('assets/images/frontpage_pics/2.jpg'); ?>" alt=""></div>
    <div class="item"><img src="<?php echo base_url('assets/images/frontpage_pics/3.jpg'); ?>" alt=""></div>
    <div class="item"><img src="<?php echo base_url('assets/images/frontpage_pics/4.jpg'); ?>" alt=""></div>
    <div class="item"><img src="<?php echo base_url('assets/images/frontpage_pics/5.jpg'); ?>" alt=""></div>
    <div class="item"><img src="<?php echo base_url('assets/images/frontpage_pics/6.jpg'); ?>" alt=""></div>
    <div class="item"><img src="<?php echo base_url('assets/images/frontpage_pics/7.jpg'); ?>" alt=""></div>
    <div class="item"><img src="<?php echo base_url('assets/images/frontpage_pics/8.jpg'); ?>" alt=""></div>

   
  </div>

  <div class="headline">
    <h1>Buchen Sie jetzt Ihren Arzttermin!</h1>
    <ul class="inlined">
      <li>In Ihrer Nähe</li>
      <li>zu Ihrem persönlichen Wunschtermin</li>
      <li>einfach &amp; kostenfrei</li>
    </ul>
  </div>

  <form class="search-box" action="<?php echo site_url('search_result#providers'); ?>" method="get" enctype="application/x-www-form-urlencoded" >

    <input type="hidden" name="a" value="search">
    
    <div class="text-input">

      <div>
        <select name="form[medical_specialty_id]" class="placeholder">
          <option value="" class="select-placeholder">Bitte wählen</option>
          <?php foreach($speciality as $row) : ?>
            <option value="<?php echo $row->code; ?>"><?php echo $row->name; ?></option>
          <?php endforeach; ?>
        </select>
        <label>Fachrichtung</label>
      </div>

      <div>
        <input type="text" placeholder="z.B. Berlin oder 10115" name="form[location]">
        <label>Ort oder PLZ</label>
      </div>

      <div>
        <select name="form[insurance_id]" class="placeholder">
          <option value="" class="select-placeholder">Bitte wählen</option>
          <option value="2">gesetzlich</option>
          <option value="1">privat</option>
        </select>
        <label>Versicherung</label>
      </div>

    </div>
    
    <button type="submit">Termin finden</button>
    
  </form>

</section>

<section id="doctors">

  <h2>Überzeugen Sie sich von unseren Ärzten</h2>

  <div id="demo">
    <div class="container">
      <div class="row">
        <div class="col-md-12">

          <ul id="owl-demo" class="inlined owl-carousel owl-theme" style="display: block; opacity: 1;">

            <?php $doctors = $this->modoc->get_all(); ?>

            <?php for ($i = 0; $i < count($doctors); $i++) : ?>

              <li class="item">
                <a href="<?php echo site_url("profile/doctor/member/{$doctors[$i]->id}"); ?>">
                  <div class="round-image"><img src="<?php echo isset($doctors[$i]->avatar) && $doctors[$i]->avatar ? $doctors[$i]->avatar : '//placehold.it/540x810'; ?>" alt="" data-item-prop="image"></div>
                  <div class="name"><?php echo isset($doctors[$i]->title) && $doctors[$i]->title ? $doctors[$i]->title : ''; ?> <?php echo isset($doctors[$i]->first_name) && $doctors[$i]->first_name ? $doctors[$i]->first_name : ''; ?> <?php echo isset($doctors[$i]->last_name) && $doctors[$i]->last_name ? $doctors[$i]->last_name : ''; ?></div>
                </a>
                <div class="speciality"><?php echo isset($doctors[$i]->specs_assoc) && is_array($doctors[$i]->specs_assoc) && count($doctors[$i]->specs_assoc) > 0 ? reset($doctors[$i]->specs_assoc)->name : 'Loremipsumarzt' ?></div>
                <div class="city"><?php echo isset($doctors[$i]->locality) && $doctors[$i]->locality ? ucfirst($doctors[$i]->locality) : ''; ?></div>
              </li>

            <?php endfor; ?>

            <?php for ($i = 0; $i < count($doctors); $i++) : ?>

              <li class="item">
                <a href="<?php echo site_url("profile/doctor/member/{$doctors[$i]->id}"); ?>">
                  <div class="round-image"><img src="<?php echo isset($doctors[$i]->avatar) && $doctors[$i]->avatar ? $doctors[$i]->avatar : '//placehold.it/540x810'; ?>" alt="" data-item-prop="image"></div>
                  <div class="name"><?php echo isset($doctors[$i]->title) && $doctors[$i]->title ? $doctors[$i]->title : ''; ?> <?php echo isset($doctors[$i]->first_name) && $doctors[$i]->first_name ? $doctors[$i]->first_name : ''; ?> <?php echo isset($doctors[$i]->last_name) && $doctors[$i]->last_name ? $doctors[$i]->last_name : ''; ?></div>
                </a>
                <div class="speciality"><?php echo isset($doctors[$i]->specs_assoc) && is_array($doctors[$i]->specs_assoc) && count($doctors[$i]->specs_assoc) > 0 ? reset($doctors[$i]->specs_assoc)->name : 'Loremipsumarzt' ?></div>
                <div class="city"><?php echo isset($doctors[$i]->locality) && $doctors[$i]->locality ? ucfirst($doctors[$i]->locality) : ''; ?></div>
              </li>

            <?php endfor; ?>

            <?php for ($i = 0; $i < count($doctors); $i++) : ?>

              <li class="item">
                <a href="<?php echo site_url("profile/doctor/member/{$doctors[$i]->id}"); ?>">
                  <div class="round-image"><img src="<?php echo isset($doctors[$i]->avatar) && $doctors[$i]->avatar ? $doctors[$i]->avatar : '//placehold.it/540x810'; ?>" alt="" data-item-prop="image"></div>
                  <div class="name"><?php echo isset($doctors[$i]->title) && $doctors[$i]->title ? $doctors[$i]->title : ''; ?> <?php echo isset($doctors[$i]->first_name) && $doctors[$i]->first_name ? $doctors[$i]->first_name : ''; ?> <?php echo isset($doctors[$i]->last_name) && $doctors[$i]->last_name ? $doctors[$i]->last_name : ''; ?></div>
                </a>
                <div class="speciality"><?php echo isset($doctors[$i]->specs_assoc) && is_array($doctors[$i]->specs_assoc) && count($doctors[$i]->specs_assoc) > 0 ? reset($doctors[$i]->specs_assoc)->name : 'Loremipsumarzt' ?></div>
                <div class="city"><?php echo isset($doctors[$i]->locality) && $doctors[$i]->locality ? ucfirst($doctors[$i]->locality) : ''; ?></div>
              </li>

            <?php endfor; ?>

          </ul>

          <!-- <div class="customNavigation">
            <a class="btn prev">Previous</a>
            <a class="btn next">Next</a>
            <a class="btn play">Autoplay</a>
            <a class="btn stop">Stop</a>
          </div> -->

        </div>
      </div>
    </div>
  </div>

</section>

<!-- <section id="quotes">
  <div class="quote">
    <h2>Das sagen Patienten über unsere Praxen</h2>
      <p class="quote-text">
        Ich wurde sehr nett aufgenommen. Die Behandlung war sehr angenehm und die Ärztin sehr kompetent und hat sich Zeit für mich genommen. Lange mußte ich nicht warten. Sehr gut ist die Parkplatzsituation - gar kein Problem.
        <span class="quote-doc-name">&nbsp;—&nbsp; Serap V.</span>
      </p>
  </div>
</section> -->

<!-- <section id="for-patients">
  <h2>Ihre Gesundheit liegt uns am Herzen!</h2>
  <h3>Machen Sie sich keine Sorgen - wir kümmern uns um Ihren Arzttermin</h3>

  <section>
    <div class="image-container competent"></div>
    <div class="text-container">
      <h4>Vertrauen durch Kompetenz</h4>
      <p>
        Auf den Profilen der Praxen können Sie sich eine Übersicht über das Leistungsspektrum der Ärzte verschaffen. Die Bewertungen anderer Patienten helfen Ihnen dabei, sich ein umfassendes Bild über den ausgewählten Arzt zu machen.
      </p>
    </div>
  </section>

  <section>
    <div class="image-container easy"></div>
    <div class="text-container">
      <h4>Einfach und sicher</h4>
      <p>
        Wir kümmern uns um Ihren Termin, damit Sie schnell wieder in den Alltag starten können. Wir fragen dabei nur nach den für den Termin notwendigen Informationen - Datensicherheit steht bei uns an oberster Stelle.
      </p>
    </div>
  </section>

  <section>
    <div class="image-container near"></div>
    <div class="text-container">
      <h4>Direkt in Ihrer Nähe</h4>
      <p>
        Auf ihrarzt24.de vereinbaren Sie ohne langes Suchen Ihren Wunschtermin bei einem Facharzt in Ihrer Nähe. Schnell und einfach finden Sie die richtige Praxis und ersparen sich Zeit sowie lästiges Telefonieren.
      </p>
    </div>
  </section>

</section> -->

<!-- <section id="shortcuts-to-doctors">
  <h2>Wählen Sie aus einer Vielzahl an empfohlenen Ärzten!</h2>
  <h3>In über 15 Städten finden wir für jeden Patienten den richtigen Arzttermin.</h3>
  <nav id="cities">
    <h4><i class="icomoon i-location-4"></i> Städte</h4>
    <ul>
      <li><a href="http://www.ihrarzt24.de/allgemeinarzt/berlin">Berlin</a></li>
      <li><a href="http://www.ihrarzt24.de/zahnarzt/bremen">Bremen</a></li>
      <li><a href="http://www.ihrarzt24.de/zahnarzt/dresden">Dresden</a></li>
      <li><a href="http://www.ihrarzt24.de/zahnarzt/dortmund">Dortmund</a></li>
      <li><a href="http://www.ihrarzt24.de/zahnarzt/duesseldorf">Düsseldorf</a></li>
      <li><a href="http://www.ihrarzt24.de/zahnarzt/essen">Essen</a></li>
      <li><a href="http://www.ihrarzt24.de/frauenarzt/frankfurt">Frankfurt</a></li>
      <li><a href="http://www.ihrarzt24.de/zahnarzt/hamburg">Hamburg</a></li>
      <li><a href="http://www.ihrarzt24.de/zahnarzt/hannover">Hannover</a></li>
      <li><a href="http://www.ihrarzt24.de/frauenarzt/koeln">Köln</a></li>
      <li><a href="http://www.ihrarzt24.de/zahnarzt/leipzig">Leipzig</a></li>
      <li><a href="http://www.ihrarzt24.de/allgemeinarzt/muenchen">München</a></li>
      <li><a href="http://www.ihrarzt24.de/zahnarzt/nuernberg">Nürnberg</a></li>
      <li><a href="http://www.ihrarzt24.de/zahnarzt/stuttgart">Stuttgart</a></li>
      <li><a href="http://www.ihrarzt24.de/internist/koblenz">Koblenz</a></li>
    </ul>
  </nav>
  <nav id="specialties">
    <h4><i class="fa fa-medkit"></i> Fachärzte</h4>
    <ul>
      <li class="column-1"><a href="http://www.ihrarzt24.de/suche?a=search&form%5Bmedical_specialty_id%5D=28&form%5Blocation%5D=Berlin&form%5Binsurance_id%5D=2">Akupunkteur</a></li>
      <li class="column-1"><a href="http://www.ihrarzt24.de/allergologe/berlin">Allergologe</a></li>
      <li class="column-1"><a href="http://www.ihrarzt24.de/allgemeinarzt/berlin">Allgemeinarzt / Hausarzt</a></li>
      <li class="column-1"><a href="http://www.ihrarzt24.de/suche?a=search&form%5Blocation%5D=Berlin&form%5Bmedical_specialty_id%5D=25">Anästhesist</a></li>
      <li class="column-1"><a href="http://www.ihrarzt24.de/augenarzt/berlin">Augenarzt</a></li>
      <li class="column-1"><a href="http://www.ihrarzt24.de/suche?a=search&form%5Bmedical_specialty_id%5D=38&form%5Blocation%5D=Berlin&form%5Binsurance_id%5D=2">Chirurg</a></li>
      <li class="column-1"><a href="http://www.ihrarzt24.de/suche?a=search&form%5Bmedical_specialty_id%5D=41&form%5Blocation%5D=&form%5Binsurance_id%5D=2">Ergotherapeut</a></li>
      <li class="column-1"><a href="http://www.ihrarzt24.de/suche?a=search&form%5Bmedical_specialty_id%5D=23&form%5Blocation%5D=Berlin&form%5Binsurance_id%5D=2">Facharzt für Venenleiden</a></li>
      <li class="column-1"><a href="http://www.ihrarzt24.de/frauenarzt/berlin">Frauenarzt / Gynäkologe</a></li>
      <li class="column-1"><a href="http://www.ihrarzt24.de/hautarzt/berlin">Hautarzt / Dermatologe</a></li>
      <li class="column-1"><a href="http://www.ihrarzt24.de/heilpraktiker/berlin">Heilpraktiker</a></li>
      <li class="column-1"><a href="http://www.ihrarzt24.de/hno/berlin">HNO-Arzt</a></li>
      <li class="column-1"><a href="http://www.ihrarzt24.de/suche?a=search&form%5Bmedical_specialty_id%5D=19&form%5Blocation%5D=&form%5Binsurance_id%5D=2">Homöopath</a></li>

      <li class="column-2 reset"><a href="http://www.ihrarzt24.de/implantologe/berlin">Implantologe</a></li>
      <li class="column-2"><a href="http://www.ihrarzt24.de/internist/berlin">Internist</a></li>
      <li class="column-2"><a href="http://www.ihrarzt24.de/kardiologe/muenchen">Kardiologe</a></li>
      <li class="column-2"><a href="http://www.ihrarzt24.de/kieferorthopaede/berlin">Kieferorthopäde</a></li>
      <li class="column-2"><a href="http://www.ihrarzt24.de/kinderarzt/berlin">Kinderarzt</a></li>
      <li class="column-2"><a href="http://www.ihrarzt24.de/suche?a=search&form%5Blocation%5D=Berlin&form%5Bmedical_specialty_id%5D=36&form%5Binsurance_id%5D=2&ok=Termin+finden">Kinderwunsch</a></li>
      <li class="column-2"><a href="http://www.ihrarzt24.de/kinderzahnarzt/berlin">Kinderzahnarzt</a></li>
      <li class="column-2"><a href="http://www.ihrarzt24.de/suche?a=search&form[distance]=2&form[insurance_id]=2&form[treatmenttype_id]=&form[location]=B%C3%BCsum&form[medical_specialty_id]=84">Laserheilkunde</a></li>
      <li class="column-2"><a href="http://www.ihrarzt24.de/mrt/berlin">MRT-Diagnostik</a></li>
      <li class="column-2"><a href="http://www.ihrarzt24.de/suche?a=search&form%5Blocation%5D=Berlin&form%5Bmedical_specialty_id%5D=15&form%5Binsurance_id%5D=2&ok=Termin+finden">Mund-Kiefer-Gesichtschirurg</a></li>
      <li class="column-2"><a href="http://www.ihrarzt24.de/suche?a=search&form%5Bmedical_specialty_id%5D=46&form%5Btreatmenttype_id%5D=&form%5Blocation%5D=Berlin&form%5Binsurance_id%5D=2&search=Erneut+suchen">Neurochirurg</a></li>
      <li class="column-2"><a href="http://www.ihrarzt24.de/suche?a=search&form%5Bmedical_specialty_id%5D=17&form%5Btreatmenttype_id%5D=&form%5Blocation%5D=Berlin&form%5Binsurance_id%5D=2&search=Erneut+suchen">Oralchirurg</a></li>
      <li class="column-2"><a href="http://www.ihrarzt24.de/orthopaede/berlin">Orthopäde</a></li>

      <li class="column-3 reset"><a href="http://www.ihrarzt24.de/suche?a=search&form%5Bmedical_specialty_id%5D=31&form%5Btreatmenttype_id%5D=&form%5Blocation%5D=Berlin&form%5Binsurance_id%5D=2&search=Erneut+suchen">Pflanzenheilkunde</a></li>
      <li class="column-3"><a href="http://www.ihrarzt24.de/suche?a=search&form%5Bdistance%5D=2&form%5Bdistrict_id%5D=&form%5Binsurance_id%5D=2&form%5Blocation%5D=Berlin&form%5Bmedical_specialty_id%5D=43">Pneumologe / Lungenfacharzt</a></li>
      <li class="column-3"><a href="http://www.ihrarzt24.de/suche?a=search&form%5Bmedical_specialty_id%5D=21&form%5Btreatmenttype_id%5D=&form%5Blocation%5D=Berlin&form%5Binsurance_id%5D=2&search=Erneut+suchen">Psychiater</a></li>
      <li class="column-3"><a href="http://www.ihrarzt24.de/suche?a=search&form%5Bmedical_specialty_id%5D=29&form%5Btreatmenttype_id%5D=&form%5Blocation%5D=Berlin&form%5Binsurance_id%5D=2&search=Erneut+suchen">Psychosomatiker</a></li>
      <li class="column-3"><a href="http://www.ihrarzt24.de/radiologie/berlin">Radiologe</a></li>
      <li class="column-3"><a href="http://www.ihrarzt24.de/suche?a=search&form%5Bmedical_specialty_id%5D=42&form%5Btreatmenttype_id%5D=&form%5Blocation%5D=berlin&form%5Binsurance_id%5D=2&search=Erneut+suchen">Schmerztherapeut</a></li>
      <li class="column-3"><a href="http://www.ihrarzt24.de/suche?a=search&form%5Bmedical_specialty_id%5D=27&form%5Btreatmenttype_id%5D=&form%5Blocation%5D=berlin&form%5Binsurance_id%5D=2&search=Erneut+suchen">Traditionelle chinesische Medizin</a></li>
      <li class="column-3"><a href="http://www.ihrarzt24.de/suche?a=search&form%5Bmedical_specialty_id%5D=9&form%5Btreatmenttype_id%5D=&form%5Blocation%5D=berlin&form%5Binsurance_id%5D=2&search=Erneut+suchen">Urologe</a></li>
      <li class="column-3"><a href="http://www.ihrarzt24.de/suche?a=search&form%5Bmedical_specialty_id%5D=47&form%5Btreatmenttype_id%5D=&form%5Blocation%5D=berlin&form%5Binsurance_id%5D=2&search=Erneut+suchen">Wirbelsäulenchirurg</a></li>
      <li class="column-3"><a href="http://www.ihrarzt24.de/zahnarzt/berlin">Zahnarzt</a></li>
    </ul>
  </nav>
</section> -->