<section class="cinema picture<?php // echo '-'.mt_rand(1,6); ?>">

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

          <div id="owlDoctors" class="inlined owl-carousel owl-theme" style="display: block; opacity: 1;">

            <?php $doctors = $this->modoc->get_all(); ?>

            <?php for ($i = 0; $i < count($doctors); $i++) : ?>

              <div class="item">
                <a href="<?php echo site_url("profile/doctor/member/{$doctors[$i]->id}"); ?>">
                  <div class="round-image"><img src="<?php echo isset($doctors[$i]->avatar) && $doctors[$i]->avatar ? $doctors[$i]->avatar : '//placehold.it/540x810'; ?>" alt="" data-item-prop="image"></div>
                  <div class="name"><?php echo isset($doctors[$i]->title) && $doctors[$i]->title ? $doctors[$i]->title : ''; ?> <?php echo isset($doctors[$i]->first_name) && $doctors[$i]->first_name ? $doctors[$i]->first_name : ''; ?> <?php echo isset($doctors[$i]->last_name) && $doctors[$i]->last_name ? $doctors[$i]->last_name : ''; ?></div>
                </a>
                <div class="speciality"><?php echo isset($doctors[$i]->specs_assoc) && is_array($doctors[$i]->specs_assoc) && count($doctors[$i]->specs_assoc) > 0 ? reset($doctors[$i]->specs_assoc)->name : 'Loremipsumarzt' ?></div>
                <div class="city"><?php echo isset($doctors[$i]->locality) && $doctors[$i]->locality ? ucfirst($doctors[$i]->locality) : ''; ?></div>
              </div>

            <?php endfor; ?>

            <?php for ($i = 0; $i < count($doctors); $i++) : ?>

              <div class="item">
                <a href="<?php echo site_url("profile/doctor/member/{$doctors[$i]->id}"); ?>">
                  <div class="round-image"><img src="<?php echo isset($doctors[$i]->avatar) && $doctors[$i]->avatar ? $doctors[$i]->avatar : '//placehold.it/540x810'; ?>" alt="" data-item-prop="image"></div>
                  <div class="name"><?php echo isset($doctors[$i]->title) && $doctors[$i]->title ? $doctors[$i]->title : ''; ?> <?php echo isset($doctors[$i]->first_name) && $doctors[$i]->first_name ? $doctors[$i]->first_name : ''; ?> <?php echo isset($doctors[$i]->last_name) && $doctors[$i]->last_name ? $doctors[$i]->last_name : ''; ?></div>
                </a>
                <div class="speciality"><?php echo isset($doctors[$i]->specs_assoc) && is_array($doctors[$i]->specs_assoc) && count($doctors[$i]->specs_assoc) > 0 ? reset($doctors[$i]->specs_assoc)->name : 'Loremipsumarzt' ?></div>
                <div class="city"><?php echo isset($doctors[$i]->locality) && $doctors[$i]->locality ? ucfirst($doctors[$i]->locality) : ''; ?></div>
              </div>

            <?php endfor; ?>

            <?php for ($i = 0; $i < count($doctors); $i++) : ?>

              <div class="item">
                <a href="<?php echo site_url("profile/doctor/member/{$doctors[$i]->id}"); ?>">
                  <div class="round-image"><img src="<?php echo isset($doctors[$i]->avatar) && $doctors[$i]->avatar ? $doctors[$i]->avatar : '//placehold.it/540x810'; ?>" alt="" data-item-prop="image"></div>
                  <div class="name"><?php echo isset($doctors[$i]->title) && $doctors[$i]->title ? $doctors[$i]->title : ''; ?> <?php echo isset($doctors[$i]->first_name) && $doctors[$i]->first_name ? $doctors[$i]->first_name : ''; ?> <?php echo isset($doctors[$i]->last_name) && $doctors[$i]->last_name ? $doctors[$i]->last_name : ''; ?></div>
                </a>
                <div class="speciality"><?php echo isset($doctors[$i]->specs_assoc) && is_array($doctors[$i]->specs_assoc) && count($doctors[$i]->specs_assoc) > 0 ? reset($doctors[$i]->specs_assoc)->name : 'Loremipsumarzt' ?></div>
                <div class="city"><?php echo isset($doctors[$i]->locality) && $doctors[$i]->locality ? ucfirst($doctors[$i]->locality) : ''; ?></div>
              </div>

            <?php endfor; ?>

          </div>

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