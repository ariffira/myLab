<script src="<?php echo base_url('assets/js/termin.js'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/stylesheets/search.min.css'); ?>" />    

<!-- Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>

<section id="search">
  <div style="height:100%; width:100%;">
  <div id="search-map" ></div>
  </div>

</section>

<section id="results-list">

  <form id="filters" class="expanded" action="" method="get" style="">
    <div id="filters-wrapper">

      <input type="hidden" name="a" value="search" />
      
      <div class="filters-primary row">

        <div class="filter essential location col-lg-3 col-md-4 col-xs-6 ">
          <label for="filter-location">Ort</label>
          <input id="filter-location" type="text" name="form[location]" placeholder="Ort" value="">
        </div>

        <div class="filter col-lg-3 col-md-4 col-xs-6 ">
          <label for="filter-distance">Max. Entfernung vom Suchort</label>
          <select id="input_distance_select" name="form[distance]" class="input_text">
            <?php for ($i = 0; $i < 10; $i++) : ?>
              <option value="<?php echo $i; ?>"><?php echo ($i + 1) * 5 ?>km</option>
            <?php endfor; ?>
          </select>
        </div>

        <!-- <div class="filter col-lg-3 col-md-4 col-xs-6 ">
          <label for="filter-district">Stadtteil</label>
          <select id="filter-district">
            <option value="">Stadtteil auswählen...</option>
          </select>
          <input type="hidden" id="filter-selected-district" name="form[district_id]" class="input_text" value="" />
        </div> -->
          
        <div class="filter reset essential specialty col-lg-3 col-md-4 col-xs-6 ">
          <label for="filter-specialty">Fachrichtung</label>
        
          <select id="filter-specialty" name="form[medical_specialty_id]">
            <option value="">Bitte wählen</option>
            <?php foreach($speciality as $row) : ?>
              <option value="<?php echo $row->code; ?>"><?php echo $row->name; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      
        <!-- <div class="filter col-lg-3 col-md-4 col-xs-6 ">
          <label for="filter-insurance-type">Versicherungsart</label>
          
          <input type="radio" id="filter-insurance-type-1" name="form[insurance_id]" value="2" checked="">
          <label class="s33" for="filter-insurance-type-1">gesetzlich</label>
          
          <input type="radio" id="filter-insurance-type-2" name="form[insurance_id]" value="1">
          <label class="s33" for="filter-insurance-type-2">privat</label>
        </div> -->

        <!-- <div class="filter col-lg-3 col-md-4 col-xs-6 ">
          <label for="filter-treatment">Behandlungsgrund</label>
          <select id="filter-treatment" name="form[treatmenttype_id]" class="placeholder">
            <option value="">Bitte wählen</option>
          </select>
        </div> -->

      </div>

    </div>

    <div class="toggler" style="margin-top: 0; bottom: 16px; left: 16px; right: 16px;">
      <div id="filters-essential">
      </div>
      <button type="submit" class="refresh-filters"><span class="icomoon  i-search-5"></span> Suche</button>
      <button type="button" class="toggle-filters to-hide">
        Show/hide
      </button>
    </div>

  </form>
  
  <div class="headline">
    <h1 data-item-prop="headline">
      <span class="docs-count" data-item-prop="headline"><!-- 200 --></span> 
      <span class="specialty" data-item-prop="keywords" role="button"><!-- Ärzte --></span>
      in 
      <span class="location" data-item-prop="keywords"><!-- Duisburg --></span>
      haben Termine für Sie.
    </h1>
    <div class="pagination">
      <?php echo isset($pagination) ? $pagination : ''; ?>
    </div>
  </div>

  <div id="search-location" data-lat="52.519171" data-lng="13.4060912" data-name="Suchstandort"></div>

  <div id="providers" data-date-start="2014-06-26" data-date-end="2014-07-15" data-date-days="14" data-date-calendar-days="20">
    <div id="providers-wrapper">

      <?php $this->load->view('search/entry_view', array()); ?>

      <?php if(isset($doctors) && is_array($doctors) && count($doctors) > 0) : foreach ($doctors as $doctor) : ?>
        <?php $this->load->view('search/entry_view', array('doctor' => $doctor, )); ?>
      <?php endforeach; endif; ?>

    </div>
  </div>

  <div class="pagination justified-blocks">
    <?php echo isset($pagination) ? $pagination : ''; ?>
  </div>
  

  <script id="essenScript">
    var postData = <?php echo $post_data; ?>;
    var doctors = <?php echo json_encode($doctors); ?>;
  </script>  

  <div class="wrapper">
    <div class="Google-list">
      <div class="photo">
        <img src='http://placehold.it/100x100' alt='' />
      </div>
      <h2 class="name"><a href="#"></a></h2>
      <div class="street"></div>
      <div class="cityzip"></div>
      <div class="actions">
        <a role="button" class="btn btn-primary" href="#">Termine anzeigen</a>
      </div>
    </div>

  </div>


</section>


