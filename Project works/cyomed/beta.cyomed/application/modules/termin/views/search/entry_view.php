<?php
  // PARAMETERS
  $doctor = isset($doctor) && $doctor ? $doctor : (new stdClass());
?>
<section data-item-scope="" data-item-type="http://schema.org/Physician" class="result large s100 int1 <?php echo !isset($doctor->id) ? 'hidden' : ''; ?>"
  data-marker-num="<?php echo isset($doctor->marker_num) && $doctor->marker_num ? $doctor->marker_num : ''; ?>"
  data-doctor-id="<?php echo isset($doctor->id) ? $doctor->id : ''; ?>" data-slug="<?php echo isset($doctor->academic_grade) && isset($doctor->name) && isset($doctor->surname) ? $doctor->academic_grade.' '.$doctor->name.' '.$doctor->surname : ''; ?>"
  data-index="<?php echo isset($doctor->marker_num) && $doctor->marker_num ? $doctor->marker_num : ''; ?>"
>
  <div class="wrapper">
       <div class="photo">
      <img data-item-prop="photo" src="<?php echo isset($doctor->native->avatar) && $doctor->native->avatar ? $doctor->native->avatar : (isset($doctor->native->gender) ? ($doctor->native->gender == '1' ? base_url('assets/images/avatars/female_doctor.jpg') : ($doctor->native->gender == '2' ? base_url('assets/images/avatars/male_doctor.jpg') : base_url('assets/images/avatars/doctors.png')) ) : base_url('assets/images/avatars/doctors.png')); ?>" alt="<?php echo isset($doctor->academic_grade) && isset($doctor->name) && isset($doctor->surname) ? $doctor->academic_grade.' '.$doctor->name.' '.$doctor->surname : ''; ?>" />
    </div>
     <header>
       <?php if (isset($doctor->marker_num) && $doctor->marker_num) : ?>
        <div class="map-pin"><?php echo $doctor->marker_num; ?></div>
      <?php endif; ?>

      <div class="title">
        <h2 class="name">
          <span data-item-prop="name">
            <a data-item-prop="url" href="<?php echo site_url('/termin/profile/doctor/'.(isset($doctor->id) ? 'member' : 'google').'/'.(isset($doctor->id) ? $doctor->id : '')); ?>" data-fill="doctor-name"><?php echo isset($doctor->academic_grade) && isset($doctor->name) && isset($doctor->surname) ? $doctor->academic_grade.' '.$doctor->name.' '.$doctor->surname : ''; ?></a>
          </span>
        </h2>
        <span data-item-prop="telephone"><a href="tel:<?php echo isset($doctor->telephone) ? $doctor->telephone : ''; ?>"><?php echo isset($doctor->telephone) ? $doctor->telephone : ''; ?></a></span>
      </div>

      <p data-item-prop="address" data-item-scope="" data-item-type="http://data-vocabulary.org/Address" class="address">
        <span class="microdata-hidden" data-item-prop="geo" data-item-scope="" data-item-type="http://schema.org/Place">
          <span data-item-scope="" data-item-type="http://schema.org/GeoCoordinates">
            <span property="latitude" data-fill="latitude" content="<?php echo isset($doctor->native->coordinate_lat) ? $doctor->native->coordinate_lat : ''; ?>"></span>
            <span property="longitude" data-fill="longitude" content="<?php echo isset($doctor->native->coordinate_lng) ? $doctor->native->coordinate_lng : ''; ?>"></span>
          </span>
        </span>
     <!--    <?php $doctor->dist = mt_rand(1,100) / 10; ?>
        <?php $doctor->dist_str = $doctor->dist . "km"; ?>
        <?php echo $doctor->dist_str; ?> |  -->
        <?php echo $doctor->distance. "km"; ?>
        <span data-item-prop="address" data-item-scope="" data-item-type="http://data-vocabulary.org/Address">
          <span data-item-prop="streetAddress"><?php echo isset($doctor->address) ? $doctor->address : ''; ?></span>
          <span class="zip-city">
            <span data-item-prop="postalCode"><?php echo isset($doctor->zip) ? $doctor->zip : ''; ?></span>
            <span data-item-prop="addressLocality"><?php echo isset($doctor->city) ? $doctor->city : ''; ?></span>
          </span>
          <span style="display:block;">
            <button class="btn btn-primary btn-xs gmap-relocate">&nbsp;&nbsp;&nbsp; <span class="icomoon i-location-4"></span> &nbsp;&nbsp;&nbsp;</button>
          </span>
        </span>
      </p>
    </header>

   
      
    <div class="owl-calendar calendar scrollable large" data-doctor-id="<?php echo isset($doctor->id) ? $doctor->id : ''; ?>">

      <div class="action no-available-appointments">
        <div class="message">keine freien Termine verfügbar</div>
      </div>

      <div class="action integration_8">
        <div class="message">
          <a href="http://www.ihrarzt24.de/termin?u=8383&amp;l=7239&amp;m=&amp;tt=&amp;i=2" style="float:right;margin-right:.5rem;">Hier registrieren</a>
          <div>Möcheten Sie Ihre Termine hier sehen?</div>
        </div>
      </div>

    </div>

    <div class="additional-info roll-out">
      <ul>
        <li data-opens="details"><span>..</span></li>
        <li data-opens="treatments"><span>..</span></li>
        <li data-opens="reviews"><span>..</span></li>
      </ul>
    </div>
  
  </div>
</section>