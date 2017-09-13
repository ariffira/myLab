
<section id="search">
  
  <div id="search-map"></div>
  <div class="search-map-shadow top"></div>
  <div class="search-map-shadow right"></div>
  <div class="search-map-shadow blocker"></div>
  
  <div class="map-popup-wrapper">
    <div class="map-popup">
      <div class="photo">
        <img src='http://placehold.it/100x200' alt='' />
      </div>
      <h2 class="name"><a href="#">Lorem Ipsum</a></h2>
      <div class="street">IhrArztstr. 24</div>
      <div class="cityzip">10177 Berlin</div>
      <div class="actions">
        <a role="button" class="btn btn-primary" href="#">Termine anzeigen</a>
      </div>
    </div>
  </div>

</section>

<section id="results-list">

  
  <form id="filters" class="expanded" action="/suche" method="get" style="">
    <div id="filters-wrapper" style="bottom: 48px;">

      <input type="hidden" name="a" value="search" />
      
      <div class="filters-primary">

        <div class="filter essential location">
          <label for="filter-location">Ort</label>
          <input id="filter-location" type="text" name="form[location]" placeholder="Ort" value="Berlin">
        </div>

        <div class="filter">
          <label for="filter-distance">Max. Entfernung vom Suchort</label>
          <select id="input_distance_select" name="form[distance]" class="input_text">
            <option value="0">5km</option>
            <option value="1">10km</option>
            <option value="2" selected="selected">50km</option>
          </select>
        </div>

        <div class="filter">
          <label for="filter-district">Stadtteil</label>
          <select id="filter-district">
            <option value="0">Stadtteil auswählen...</option>
            <option value="62">Adlershof</option>
            <option value="83">Alt-Hohenschönhausen</option>
            <option value="56">Alt-Treptow</option>
            <option value="61">Altglienicke</option>
            <option value="58">Baumschulenweg</option>
            <option value="72">Biesdorf</option>
          </select>
          <input type="hidden" id="filter-selected-district" name="form[district_id]" class="input_text" value="" />
        </div>
          
        <div class="filter col-2 reset essential specialty">
          <label for="filter-specialty">Fachrichtung</label>
        
          <select id="filter-specialty" name="form[medical_specialty_id]">
            <option value="">Bitte wählen</option>
            <?php foreach($speciality as $row) : ?>
              <option value="<?php echo $row->code; ?>"><?php echo $row->name; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      
        <div class="filter col-2">
          <label for="filter-insurance-type">Versicherungsart</label>
          
          <input type="radio" id="filter-insurance-type-1" name="form[insurance_id]" value="2" checked="">
          <label class="s33" for="filter-insurance-type-1">gesetzlich</label>
          
          <input type="radio" id="filter-insurance-type-2" name="form[insurance_id]" value="1">
          <label class="s33" for="filter-insurance-type-2">privat</label>
        </div>

        <div class="filter col-2">
          <label for="filter-treatment">Behandlungsgrund</label>
          <select id="filter-treatment" name="form[treatmenttype_id]" class="placeholder">
            <option value="">Bitte wählen</option>
            <option value="1">Akute Zahnschmerzen</option>
            <option value="24">Beratung: Implantat</option>
            <option value="4">Beratung: Zahnersatz</option>
            <option value="26">Bleaching/Zahnaufhellung </option>
            <option value="320">CEREC-Verfahren</option>
            <option value="136">Ersttermin</option>
            <option value="46">Funktionsdiagnostik/-therapie</option>
            <option value="2">Füllungen</option>
            <option value="142">Implantat</option>
            <option value="240">Kiefergelenksbeschwerden</option>
            <option value="143">Kindersprechstunde</option>
            <option value="5">Kontrolluntersuchung</option>
            <option value="45">Laserbehandlung</option>
            <option value="165">Notfallsprechstunde</option>
            <option value="47">Orale Chirurgie</option>
            <option value="43">Parodontologie</option>
            <option value="6">Professionelle Zahnreinigung</option>
            <option value="41">Prophylaxe</option>
            <option value="7">Sonstige Behandlung</option>
            <option value="302">Sprechstunde</option>
            <option value="25">Weisheitszahnproblematik</option>
            <option value="3">Wurzelbehandlung/Endodontie</option>
            <option value="42">Zahnschmuck</option>
            <option value="44">Ästhetische Zahnheilkunde</option>
          </select>
        </div>

      </div>

    </div>

    <div class="toggler" style="bottom: 16px; left: 16px; right: 16px;">
      <div id="filters-essential">
      </div>
      <button type="submit" class="refresh-filters"><span>Ergebnisse filtern</span></button>
      <button type="button" class="toggle-filters to-hide"> Filter <span class="show">einblenden</span> <span class="hide">ausblenden</span> </button>
    </div>

  </form>
  
  <div class="headline">
    <h1 data-item-prop="headline">
      <span class="docs-count" data-item-prop="headline">1908</span> 
      <span class="specialty" data-item-prop="keywords" role="button">Zahnärzte</span>
      in 
      <span class="location" data-item-prop="keywords">Berlin</span>
      haben Termine für Sie.
    </h1>
    <div class="pagination">
      <span>&nbsp;</span>
      <a class="next page-numbers" href="/suche?a=q&amp;medical_specialty_id=1&amp;insurance_id=2&amp;lat=52.519171&amp;lng=13.4060912&amp;location=Berlin&amp;distance=2&amp;p=2">
        mehr Ärzte
      </a>
    </div>
  </div>

  <div id="search-location" data-lat="52.519171" data-lng="13.4060912" data-name="Suchstandort"></div>

  <div id="providers" data-date-start="2014-06-26" data-date-end="2014-07-15" data-date-days="14" data-date-calendar-days="20">
    <div id="providers-wrapper">
    
      <section data-item-scope="" class="result large s100 int1" data-user-id="961" data-slug="dr-sc-med-uwe-walter" data-index="0">
        <div class="wrapper">

          <header>

            <div class="map-pin">1</div>

            <div class="title">
              <h2 class="name">
                <span data-item-prop="name">
                  <a data-item-prop="url" href="/arzt/dr-sc-med-uwe-walter/gkv">Dr. sc. med.  Uwe  Walter</a>
                </span>
              </h2>
              <span class="rating rating-5" data-item-prop="aggregateRating" data-item-scope="" data-item-type="http://schema.org/AggregateRating">
                <meta data-item-prop="worstRating" content="1">
                <meta data-item-prop="ratingValue" content="4.9">
                <meta data-item-prop="bestRating" content="5">
              </span>
              <span data-item-prop="telephone"><a href="tel:030-577022432">030-577022432</a></span>
            </div>

            <p data-item-prop="address" data-item-scope="" data-item-type="http://data-vocabulary.org/Address" class="address">
              <span class="microdata-hidden" data-item-prop="geo" data-item-scope="" data-item-type="http://schema.org/Place">
                <span data-item-scope="" data-item-type="http://schema.org/GeoCoordinates">
                  <span property="latitude" content="52.524363"></span>
                  <span property="longitude" content="13.407642"></span>
                </span>
              </span>
              0,6km | 
              <span data-item-prop="address" data-item-scope="" data-item-type="http://data-vocabulary.org/Address">
                <span data-item-prop="streetAddress">Rochstr. 1</span>
                <span class="zip-city">
                  <span data-item-prop="postalCode">10178</span>
                  <span data-item-prop="addressLocality">Berlin</span>
                </span>
              </span>
            </p>
          </header>

          <div class="photo">
            <img data-item-prop="photo" src="<?php echo base_url('assets/images/carousel_doctors/02.07.2013_Dr. med. Ralph Herzog_4.jpg'); ?>" alt="Dr. sc. med.  Uwe  Walter" />
          </div>        
            
          <div class="calendar type-appointments       scrollable large" data-user-id="961" data-specialty-id="1" data-insurance-id="2" data-location-id="603" style="width:auto;">
            <!-- <div class="wrapper" style="width: 929.600001335144px;"> -->

              <div class="col " data-date="2014-06-26">
                &nbsp;
              </div>

              <div class="col " data-date="2014-06-26">
                <div class="col-header">
                  <span class="day">Do</span>
                  <span class="date">26.06.</span>
                  <span><?php echo date('Y-m-d H:i:s', time()); ?></span>
                </div>
              </div>

              <div class="col " data-date="2014-06-27">
                <div class="col-header">
                  <span class="day">Fr</span>
                  <span class="date">27.06.</span>
                </div>

                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140627T110000" rel="nofollow">11:00</a>
              
              </div>

              <div class="col week-start" data-date="2014-06-30">
                <div class="col-header">
                  <span class="day">Mo</span>
                  <span class="date">30.06.</span>
                </div>

                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140630T180000" rel="nofollow">18:00</a>
                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140630T183000" rel="nofollow">18:30</a>
              
              </div>

              <div class="col " data-date="2014-07-01">
                <div class="col-header">
                  <span class="day">Di</span>
                  <span class="date">01.07.</span>
                </div>

                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140701T120000" rel="nofollow">12:00</a>
                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140701T123000" rel="nofollow">12:30</a>
              
              </div>

              <div class="col " data-date="2014-07-02">
                <div class="col-header">
                  <span class="day">Mi</span>
                  <span class="date">02.07.</span>
                </div>            
              </div>

              <div class="col " data-date="2014-07-03">
                <div class="col-header">
                  <span class="day">Do</span>
                  <span class="date">03.07.</span>
                </div>

                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140703T160000" rel="nofollow">16:00</a>
            
              </div>

              <div class="col " data-date="2014-07-04">
                <div class="col-header">
                  <span class="day">Fr</span>
                  <span class="date">04.07.</span>
                </div>

                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140704T110000" rel="nofollow">11:00</a>
            
              </div>
              
              <div class="col week-start" data-date="2014-07-07">
                <div class="col-header">
                  <span class="day">Mo</span>
                  <span class="date">07.07.</span>
                </div>

                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140707T180000" rel="nofollow">18:00</a>
                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140707T183000" rel="nofollow">18:30</a>
                <div class="appointment more">
                  <div>mehr</div>
                  <div class="appointments">
                    <a class="appointment" href="https://www.ihrarzt24.de/termin?u=40808&amp;l=9017&amp;m=1&amp;tt=&amp;i=2&amp;s=20140627T090000" rel="nofollow">09:00</a>
                    <a class="appointment" href="https://www.ihrarzt24.de/termin?u=40808&amp;l=9017&amp;m=1&amp;tt=&amp;i=2&amp;s=20140627T093000" rel="nofollow">09:30</a>
                    <a class="appointment" href="https://www.ihrarzt24.de/termin?u=40808&amp;l=9017&amp;m=1&amp;tt=&amp;i=2&amp;s=20140627T100000" rel="nofollow">10:00</a>
                    <a class="appointment" href="https://www.ihrarzt24.de/termin?u=40808&amp;l=9017&amp;m=1&amp;tt=&amp;i=2&amp;s=20140627T103000" rel="nofollow">10:30</a>
                    <a class="appointment" href="https://www.ihrarzt24.de/termin?u=40808&amp;l=9017&amp;m=1&amp;tt=&amp;i=2&amp;s=20140627T110000" rel="nofollow">11:00</a>
                    <a class="appointment" href="https://www.ihrarzt24.de/termin?u=40808&amp;l=9017&amp;m=1&amp;tt=&amp;i=2&amp;s=20140627T113000" rel="nofollow">11:30</a>
                    <a class="appointment" href="https://www.ihrarzt24.de/termin?u=40808&amp;l=9017&amp;m=1&amp;tt=&amp;i=2&amp;s=20140627T150000" rel="nofollow">15:00</a>
                    <a class="appointment" href="https://www.ihrarzt24.de/termin?u=40808&amp;l=9017&amp;m=1&amp;tt=&amp;i=2&amp;s=20140627T153000" rel="nofollow">15:30</a>
                    <a class="appointment" href="https://www.ihrarzt24.de/termin?u=40808&amp;l=9017&amp;m=1&amp;tt=&amp;i=2&amp;s=20140627T160000" rel="nofollow">16:00</a>
                    <a class="appointment" href="https://www.ihrarzt24.de/termin?u=40808&amp;l=9017&amp;m=1&amp;tt=&amp;i=2&amp;s=20140627T163000" rel="nofollow">16:30</a>
                  </div> <!-- END - appointments (inner) -->
                </div> <!-- END - more -->
            
              </div>

              <div class="col " data-date="2014-07-08">
                <div class="col-header">
                  <span class="day">Di</span>
                  <span class="date">08.07.</span>
                </div>

                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140708T120000" rel="nofollow">12:00</a>
                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140708T123000" rel="nofollow">12:30</a>
            
              </div>

              <div class="col " data-date="2014-07-09">
                <div class="col-header">
                  <span class="day">Mi</span>
                  <span class="date">09.07.</span>
                </div>            
              </div>

              <div class="col " data-date="2014-07-10">
                <div class="col-header">
                  <span class="day">Do</span>
                  <span class="date">10.07.</span>
                </div>

                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140710T160000" rel="nofollow">16:00</a>
            
              </div>

              <div class="col " data-date="2014-07-11">
                <div class="col-header">
                  <span class="day">Fr</span>
                  <span class="date">11.07.</span>
                </div>

                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140711T110000" rel="nofollow">11:00</a>
            
              </div>

              <div class="col week-start" data-date="2014-07-14">
                <div class="col-header">
                  <span class="day">Mo</span>
                  <span class="date">14.07.</span>
                </div>

                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140714T180000" rel="nofollow">18:00</a>
                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140714T183000" rel="nofollow">18:30</a>
          
              </div>

              <div class="col " data-date="2014-07-15">
                <div class="col-header">
                  <span class="day">Di</span>
                  <span class="date">15.07.</span>
                </div>

                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140715T120000" rel="nofollow">12:00</a>
                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140715T123000" rel="nofollow">12:30</a>
          
              </div>

              <div class="col " data-date="2014-06-26">
                &nbsp;
              </div>

              <div class="col " data-date="2014-06-26">
                &nbsp;
              </div>

              <div class="col " data-date="2014-06-26">
                <div class="col-header">
                  <span class="day">Do</span>
                  <span class="date">26.06.</span>
                </div>
              </div>

              <div class="col " data-date="2014-06-27">
                <div class="col-header">
                  <span class="day">Fr</span>
                  <span class="date">27.06.</span>
                </div>

                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140627T110000" rel="nofollow">11:00</a>
              
              </div>

              <div class="col week-start" data-date="2014-06-30">
                <div class="col-header">
                  <span class="day">Mo</span>
                  <span class="date">30.06.</span>
                </div>

                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140630T180000" rel="nofollow">18:00</a>
                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140630T183000" rel="nofollow">18:30</a>
              
              </div>

              <div class="col " data-date="2014-07-01">
                <div class="col-header">
                  <span class="day">Di</span>
                  <span class="date">01.07.</span>
                </div>

                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140701T120000" rel="nofollow">12:00</a>
                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140701T123000" rel="nofollow">12:30</a>
              
              </div>

              <div class="col " data-date="2014-07-02">
                <div class="col-header">
                  <span class="day">Mi</span>
                  <span class="date">02.07.</span>
                </div>            
              </div>

              <div class="col " data-date="2014-07-03">
                <div class="col-header">
                  <span class="day">Do</span>
                  <span class="date">03.07.</span>
                </div>

                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140703T160000" rel="nofollow">16:00</a>
            
              </div>

              <div class="col " data-date="2014-07-04">
                <div class="col-header">
                  <span class="day">Fr</span>
                  <span class="date">04.07.</span>
                </div>

                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140704T110000" rel="nofollow">11:00</a>
            
              </div>
              
              <div class="col week-start" data-date="2014-07-07">
                <div class="col-header">
                  <span class="day">Mo</span>
                  <span class="date">07.07.</span>
                </div>

                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140707T180000" rel="nofollow">18:00</a>
                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140707T183000" rel="nofollow">18:30</a>
                <div class="appointment more">
                  <div>mehr</div>
                  <div class="appointments">
                    <a class="appointment" href="https://www.ihrarzt24.de/termin?u=40808&amp;l=9017&amp;m=1&amp;tt=&amp;i=2&amp;s=20140627T090000" rel="nofollow">09:00</a>
                    <a class="appointment" href="https://www.ihrarzt24.de/termin?u=40808&amp;l=9017&amp;m=1&amp;tt=&amp;i=2&amp;s=20140627T093000" rel="nofollow">09:30</a>
                    <a class="appointment" href="https://www.ihrarzt24.de/termin?u=40808&amp;l=9017&amp;m=1&amp;tt=&amp;i=2&amp;s=20140627T100000" rel="nofollow">10:00</a>
                    <a class="appointment" href="https://www.ihrarzt24.de/termin?u=40808&amp;l=9017&amp;m=1&amp;tt=&amp;i=2&amp;s=20140627T103000" rel="nofollow">10:30</a>
                    <a class="appointment" href="https://www.ihrarzt24.de/termin?u=40808&amp;l=9017&amp;m=1&amp;tt=&amp;i=2&amp;s=20140627T110000" rel="nofollow">11:00</a>
                    <a class="appointment" href="https://www.ihrarzt24.de/termin?u=40808&amp;l=9017&amp;m=1&amp;tt=&amp;i=2&amp;s=20140627T113000" rel="nofollow">11:30</a>
                    <a class="appointment" href="https://www.ihrarzt24.de/termin?u=40808&amp;l=9017&amp;m=1&amp;tt=&amp;i=2&amp;s=20140627T150000" rel="nofollow">15:00</a>
                    <a class="appointment" href="https://www.ihrarzt24.de/termin?u=40808&amp;l=9017&amp;m=1&amp;tt=&amp;i=2&amp;s=20140627T153000" rel="nofollow">15:30</a>
                    <a class="appointment" href="https://www.ihrarzt24.de/termin?u=40808&amp;l=9017&amp;m=1&amp;tt=&amp;i=2&amp;s=20140627T160000" rel="nofollow">16:00</a>
                    <a class="appointment" href="https://www.ihrarzt24.de/termin?u=40808&amp;l=9017&amp;m=1&amp;tt=&amp;i=2&amp;s=20140627T163000" rel="nofollow">16:30</a>
                  </div> <!-- END - appointments (inner) -->
                </div> <!-- END - more -->
            
              </div>

              <div class="col " data-date="2014-07-08">
                <div class="col-header">
                  <span class="day">Di</span>
                  <span class="date">08.07.</span>
                </div>

                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140708T120000" rel="nofollow">12:00</a>
                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140708T123000" rel="nofollow">12:30</a>
            
              </div>

              <div class="col " data-date="2014-07-09">
                <div class="col-header">
                  <span class="day">Mi</span>
                  <span class="date">09.07.</span>
                </div>            
              </div>

              <div class="col " data-date="2014-07-10">
                <div class="col-header">
                  <span class="day">Do</span>
                  <span class="date">10.07.</span>
                </div>

                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140710T160000" rel="nofollow">16:00</a>
            
              </div>

              <div class="col " data-date="2014-07-11">
                <div class="col-header">
                  <span class="day">Fr</span>
                  <span class="date">11.07.</span>
                </div>

                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140711T110000" rel="nofollow">11:00</a>
            
              </div>

              <div class="col week-start" data-date="2014-07-14">
                <div class="col-header">
                  <span class="day">Mo</span>
                  <span class="date">14.07.</span>
                </div>

                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140714T180000" rel="nofollow">18:00</a>
                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140714T183000" rel="nofollow">18:30</a>
          
              </div>

              <div class="col " data-date="2014-07-15">
                <div class="col-header">
                  <span class="day">Di</span>
                  <span class="date">15.07.</span>
                </div>

                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140715T120000" rel="nofollow">12:00</a>
                <a class="appointment" href="https://www.ihrarzt24.de/termin?u=961&amp;l=603&amp;m=1&amp;tt=&amp;i=2&amp;s=20140715T123000" rel="nofollow">12:30</a>
          
              </div>

              <div class="col " data-date="2014-06-26">
                &nbsp;
              </div>

            <!-- </div> -->
            
            <!-- <div class="arrow left disabled"></div> -->
            <!-- <div class="arrow right"></div> -->

          </div>

          <div class="additional-info roll-out">
            <ul>
              <li data-opens="details"><span>Details zum Arzt</span></li>
              <li data-opens="treatments"><span>Behandlungsmöglichkeiten (22)</span></li>
              <li data-opens="reviews"><span>Bewertungen (3)</span></li>
            </ul>
          </div>
        
        </div>
      </section>

      <section data-item-scope="" class="result large s100 int1" data-user-id="10283" data-slug="dr-patrick-prinz" data-index="1">
        <div class="wrapper">
          <header>
            <div class="map-pin">8</div>
            
            <div class="title">
              <h2 class="name">
                <span data-item-prop="name">
                  <a data-item-prop="url" href="/arzt/dr-patrick-prinz/gkv">Dr. Patrick Prinz</a>
                </span>
              </h2>

              <span class="rating rating-5" data-item-prop="aggregateRating" data-item-scope="" data-item-type="http://schema.org/AggregateRating">
                <meta data-item-prop="worstRating" content="1">
                <meta data-item-prop="ratingValue" content="5.0">
                <meta data-item-prop="bestRating" content="5">
              </span>
                  
              <span data-item-prop="telephone"><a href="tel:030 6098351 81">030 6098351 81</a></span>
            </div>
            
            <p data-item-prop="address" data-item-scope="" data-item-type="http://data-vocabulary.org/Address" class="address">
              <span class="microdata-hidden" data-item-prop="geo" data-item-scope="" data-item-type="http://schema.org/Place">
                <span data-item-scope="" data-item-type="http://schema.org/GeoCoordinates">
                <span property="latitude" content="52.528351"></span>
                <span property="longitude" content="13.378448"></span>
                </span>
              </span>
              2,1km | 
              <span data-item-prop="address" data-item-scope="" data-item-type="http://data-vocabulary.org/Address">
                <span data-item-prop="streetAddress">Robert-Koch-Platz 11</span>
                <span class="zip-city">
                  <span data-item-prop="postalCode">10115</span>
                  <span data-item-prop="addressLocality">Berlin</span>
                </span>
              </span>
            </p>
          </header>

          <div class="photo">
            <img data-item-prop="photo" src="<?php echo base_url('assets/images/carousel_doctors/Osterland_4.jpg'); ?>" alt="Dr. Patrick Prinz" />
          </div>
            
          <!-- type-available-appointments / type-no-available-appointments / type-integration_8 -->
          <div class="calendar type-no-available-appointments     exception large" data-user-id="10283" data-specialty-id="1" data-insurance-id="2" data-location-id="9017">
            <div class="wrapper" style="">
              <div class="col">
                <div class="col-header">
                  <span class="day"></span>
                  <span class="date"></span>
                </div>
              </div>
              <div class="col">
                <div class="col-header">
                  <span class="day"></span>
                  <span class="date"></span>
                </div>
              </div>
              <div class="col">
                <div class="col-header">
                  <span class="day"></span>
                  <span class="date"></span>
                </div>
              </div>
              <div class="col">
                <div class="col-header">
                  <span class="day"></span>
                  <span class="date"></span>
                </div>
              </div>
              <div class="col">
                <div class="col-header">
                  <span class="day"></span>
                  <span class="date"></span>
                </div>
              </div>
              <div class="col">
                <div class="col-header">
                  <span class="day"></span>
                  <span class="date"></span>
                </div>
              </div>
              <div class="col">
                <div class="col-header">
                  <span class="day"></span>
                  <span class="date"></span>
                </div>
              </div>
              <div class="col">
                <div class="col-header">
                  <span class="day"></span>
                  <span class="date"></span>
                </div>
              </div>
              <div class="col">
                <div class="col-header">
                  <span class="day"></span>
                  <span class="date"></span>
                </div>
              </div>
              <div class="col">
                <div class="col-header">
                  <span class="day"></span>
                  <span class="date"></span>
                </div>
              </div>
              <div class="col">
                <div class="col-header">
                  <span class="day"></span>
                  <span class="date"></span>
                </div>
              </div>
              <div class="col">
                <div class="col-header">
                  <span class="day"></span>
                  <span class="date"></span>
                </div>
              </div>
              <div class="col">
                <div class="col-header">
                  <span class="day"></span>
                  <span class="date"></span>
                </div>
              </div>
              <div class="col">
                <div class="col-header">
                  <span class="day"></span>
                  <span class="date"></span>
                </div>
              </div>
              <div class="col">
                <div class="col-header">
                  <span class="day"></span>
                  <span class="date"></span>
                </div>
              </div>
              <div class="col">
                <div class="col-header">
                  <span class="day"></span>
                  <span class="date"></span>
                </div>
              </div>
            </div>
            
            <div class="arrow left disabled"></div>
            <div class="arrow right disabled"></div>
            
            <div class="action no-available-appointments">
              <div class="message">keine freien Termine verfügbar</div>
            </div>

            <!-- <div class="action integration_8">
              <div class="message">
                <a href="http://www.ihrarzt24.de/termin?u=8383&amp;l=7239&amp;m=&amp;tt=&amp;i=2">Freie Termine anfragen</a>
                <div>Wir kümmern uns darum und rufen Sie zurück!</div>
              </div>
            </div> -->

          </div>

          <div class="additional-info roll-out">
            <ul>
              <li data-opens="details"><span>Details zum Arzt</span></li>
              <li data-opens="treatments"><span>Behandlungsmöglichkeiten (21)</span></li>
              <li data-opens="reviews"><span>Bewertungen (3)</span></li>
            </ul>
          </div>
        
        </div>
      </section>

    </div>
  </div>

  <div class="pagination justified-blocks">
    <span>&nbsp;</span>
    <a class="next page-numbers" href="/suche?a=q&amp;medical_specialty_id=1&amp;insurance_id=2&amp;lat=52.519171&amp;lng=13.4060912&amp;location=Berlin&amp;distance=2&amp;p=2">
      mehr Ärzte
    </a>
  </div>
  

  <script>
    var postData = '<?php echo $post_data; ?>';
    var doctors = [
      {name : "Lorem Ipsum", street : "Neustadtstr. 88", cityzip : "45476 Mülheim an der Ruhr", }, 
      {name : "Dolor laboris ea.", street : "Tulpenstr. 10", cityzip : "47057, Duisburg", }, 
      {name : "Anim veniam culpa", street : "Hültenstr. 33", cityzip : "Düsseldorf", }, 
    ];
    var mapSpecialtyTreatment = {"1":{"1":"Akute Zahnschmerzen","24":"Beratung: Implantat","4":"Beratung: Zahnersatz","26":"Bleaching\/Zahnaufhellung ","320":"CEREC-Verfahren","136":"Ersttermin","46":"Funktionsdiagnostik\/-therapie","2":"F\u00fcllungen","142":"Implantat","240":"Kiefergelenksbeschwerden","143":"Kindersprechstunde","5":"Kontrolluntersuchung","45":"Laserbehandlung","165":"Notfallsprechstunde","47":"Orale Chirurgie","43":"Parodontologie","6":"Professionelle Zahnreinigung","41":"Prophylaxe","7":"Sonstige Behandlung","302":"Sprechstunde","25":"Weisheitszahnproblematik","3":"Wurzelbehandlung\/Endodontie","42":"Zahnschmuck","44":"\u00c4sthetische Zahnheilkunde"},"2":{"185":"Check Up","181":"Chirotherapie","186":"EKG","187":"Ersttermin","15":"Sonstige Behandlung","166":"Sprechstunde"},"3":{"68":"3D Ultraschall","8":"Akute Beschwerden\/Notfall","80":"Alternative Heilmethoden\/ Akupunktur","293":"Ambulante Chemotherapie","58":"Ambulante Operationen","307":"Beckenbodenprobleme","56":"Beratung: Verh\u00fctung","182":"Empf\u00e4ngnisregelung Beratung","137":"Ersttermin","59":"Geschlechtskrankheiten","9":"Gespr\u00e4ch","183":"Halbjahreskontrolluntersuchung","49":"Hormonbehandlung","140":"Impfung","48":"Kinderwunsch","10":"Kontrolluntersuchung","11":"Krebsvorsorge\u00a0","157":"Nachsorge","160":"Notfallsprechstunde","285":"OP-Termin","275":"Polyzystisches Ovarialsyndrom","57":"Reisemedizin","12":"Schwangeren Erstuntersuchung\u00a0","13":"Schwangerschaftsvorsorge\u00a0","14":"Sonstige Behandlung","168":"Sprechstunde","174":"Teenager Sprechstunde","175":"Vorgespr\u00e4che OP"},"4":{"52":"Allergiediagnostik","94":"Alternative Heilmethoden\/ Akupunktur","51":"Ambulante Operationen","53":"Beratung: H\u00f6rger\u00e4te","131":"Ersttermin","84":"H\u00f6rdiagnostik\/ H\u00f6rtest","83":"H\u00f6rger\u00e4te: Versorgung und Kontrolle","150":"Kontrolle","87":"Krebsvorsorge","162":"Notfallsprechstunde","55":"Plastische Chirurgie","54":"Reisemedizin","82":"Riech- und Geschmackst\u00f6rung","85":"Schnarchtherapie","50":"Schwindeltherapie\/ Tinitus","16":"Sonstige Behandlung","169":"Sprechstunde","81":"Stimm- und Sprachst\u00f6rung","86":"Tauchtauglichkeit"},"5":{"65":"Aknetherapie","62":"Allergiediagnostik","120":"Allergietest","63":"Ambulante Operationen","78":"Beratung: Haarausfall","125":"Ersttermin","67":"Haut- und Geschlechtskrankheiten","145":"Kontrolle","64":"Kosmetische Behandlung: Fruchts\u00e4urepeeling","61":"Krebsvorsorge","60":"Laserbehandlung","159":"Notfallsprechstunde","79":"Photodynamische Therapier\/ Lichttherapie","66":"Reisemedizin","17":"Sonstige Behandlung"},"6":{"72":"Ambulante Operationen","73":"Beratung: Diabetes mellitus","70":"Beratung: Kontaktlinsen","126":"Ersttermin","76":"Kontaktlinsen: Anpassung und Kontrolle","146":"Kontrolle","75":"Kosmetische Chirurgie","69":"Laserbehandlung","74":"Refraktive Chirurgie","77":"Reisemedizin","71":"Sehtest","18":"Sonstige Behandlung","167":"Sprechstunde"},"7":{"101":"Alternative Heilmethoden\/ Akupunktur","104":"Ambulante Operationen","133":"Ersttermin","99":"Ostheoporose","98":"Schmerztherapie","19":"Sonstige Behandlung","100":"Sportmedizinische Untersuchung","171":"Sprechstunde","102":"Sto\u00dfwellentherapie","103":"S\u00e4uglings- und Kinderorthop\u00e4die","294":"Taping"},"8":{"309":"Burnout","271":"Ersttermin","317":"Gestalttherapie","270":"Kognitive Verhaltenstherapie","318":"Paartherapie"},"9":{"109":"Ambulante Operationen","122":"Blasenspiegelung (Frau)","123":"Blasenspiegelung (Mann)","265":"Circumcision","105":"Erektionsst\u00f6rungen","135":"Ersttermin","106":"Fruchtbarkeitsuntersuchung\/ -behandlung","110":"Geschlechtskrankheiten","138":"Harnr\u00f6hrenabstrich","113":"H\u00e4morrhoiden","112":"Kinderurologie","308":"Kontinenzprobleme","155":"Krebsvorsorge","107":"Medizinische Vorhautentfernung","156":"Metabolic Balance","164":"Notfallsprechstunde","111":"Prostatadiagnostik","21":"Sonstige Behandlung","172":"Sprechstunde","264":"Vasektomie","176":"Vorsorge","108":"Vorsorgeuntersuchung Mann"},"10":{"199":"Armstraffung","200":"Augenlidstraffung","201":"Bauchdeckenstraffung","202":"Bodylifting","203":"Botulinumtoxin","205":"Brustreduktion beim Mann","89":"Brustvergr\u00f6\u00dferung\/ -verkleinerung","206":"Faltenunterspritzung","93":"Gesichtslifting\/ facelifting","207":"Haartransplantation","88":"Handchirurgie","208":"Implantat- wechsel","209":"Kinnkorrektur","90":"Liposuktion\/ Fettabsaugen","210":"Lippenvergr\u00f6sserung","91":"Narbenentfernung","211":"Nasenkorrektur","212":"Ohrenkorrektur","233":"Penisverl\u00e4ngerung","95":"Permanent Make-Up","97":"Phlebologie","213":"Profilkorrektur","214":"Schamlippenverkleinerung","92":"Schwei\u00dfdr\u00fcsenentfernung","22":"Sonstige Behandlung","215":"Stirnlifting \/ Brauenlifting","96":"Unfallchirurgie"},"11":{"23":"Sonstige Behandlung"},"12":{"20":"Sonstige Behandlung"},"13":{"239":"Ersttermin","304":"Kontrolluntersuchung","303":"Schmerzfall","301":"Sprechstunde"},"14":{"128":"Ersttermin","147":"Kontrolle"},"15":{"178":"Sprechstunde"},"17":{"238":"Orale Chirurgie"},"18":{"221":"CT","224":"Duplex-Sonographie","114":"Kinderradiologie","227":"Mammographie","234":"MRT-Diagnostik","226":"R\u00f6ntgen","115":"Sonstige Behandlungen","223":"Ultraschall-Sonographie"},"19":{"261":"Hom\u00f6opathische Therapie"},"20":{"124":"Check Up","177":"EKG","306":"Ergometrie","132":"Ersttermin","139":"Impfung","151":"Kontrolle","163":"Notfallsprechstunde","170":"Sprechstunde","305":"Tauchtauglichkeit"},"21":{"217":"Ersttermin"},"22":{"119":"Allergietest","218":"Bioresonanz","121":"Ersttermin","144":"Kontrolle","153":"Krebsvorsorge","158":"Notfallsprechstunde"},"23":{"129":"Ersttermin","148":"Kontrolle","154":"Krebsvorsorge","161":"Notfallsprechstunde"},"24":{"251":"Biokybernetische Medizin"},"25":{"252":"An\u00e4sthesist"},"26":{"33":"Allergien","34":"Autoimmunerkrankungen","118":"Beratung","27":"Beschwerden des Bewegungsapparats","36":"Diabetes","28":"Entgiftung und Ausleitungstherapie","290":"Ersttermin","130":"Ersttermin","39":"Gewichtsreduktion","149":"Kontrolle","37":"Kopfschmerzen und Migr\u00e4ne","38":"Menstruations- und Wechseljahrsbeschwerden","32":"Nahrungsmittelunvertr\u00e4glichkeiten","35":"Neurodermitis","29":"Schmerzsyndrome","31":"Stoffwechselerkrankungen","30":"Verdauungsst\u00f6rungen"},"32":{"310":"Massagetherapie"},"27":{"241":"chinesische Kr\u00e4utertherapie","289":"Ersttermin","242":"Traditionelle Chinesische Medizin"},"28":{"237":"Akupunktur"},"29":{"311":"Ersttermin"},"30":{"180":"Chirurgie","141":"Implantat","179":"Laserbehandlung","173":"Sprechstunde"},"31":{"313":"Ayurveda","312":"Traditionelle Chinesische Medizin","314":"traditionelle Phythotherapie"},"33":{"191":"Krankengymnastik","195":"Lymphdrainagen","192":"Manuelle Therapie","196":"Massagen","193":"Osteopathie","197":"Physikalische Therapie","194":"Sportphysiotherapie"},"34":{"184":"kindersprechstunde"},"35":{"236":"Sprechstunde"},"36":{"188":"Kinderwunsch"},"37":{"272":"Diabetes mellitus","127":"Ersttermin"},"38":{"198":"Ersttermin"},"39":{"288":"Ersttermin"},"40":{"229":"Botox","228":"Faltenunterspritzung","230":"G-Punkt-Unterspritzung","284":"Hyalurons\u00e4ure","283":"Laserbehandlung"},"41":{"235":"Ergotherapie"},"42":{"253":"Schmerztherapie"},"43":{"266":"Ersttermin"},"45":{"189":"Sonstige Behandlung"},"46":{"190":"Ersttermin"},"47":{"216":"Ersttermin"},"48":{"282":"Ellenbogen-MRT","220":"Gyn\u00e4kologisches MRT","278":"Knie-MRT","281":"MRT der H\u00e4nde","279":"MRT der H\u00fcfte","219":"Neuro-MRT","280":"Schulter-MRT","276":"Sch\u00e4del-MRT","277":"Wirbels\u00e4ulen-MRT"},"60":{"324":"Ersttermin"},"62":{"247":"Atemtherapie","248":"Gespr\u00e4chstherapie","245":"Hypnose","249":"NLP (Neurolinguistisches Programmieren)","243":"Psychotherapie","244":"Singtherapie","246":"Stimmtherapie"},"63":{"250":"Sprechstunde"},"64":{"257":"Darmspiegelung","254":"Ersttermine","256":"Magenballon","255":"Magenspiegelung"},"65":{"258":"Hypnose","259":"Raucherentw\u00f6hnung"},"66":{"260":"Bioresonanztherapie"},"67":{"295":"Akupunktur","300":"Allergien","299":"Dorn- \/ Breu\u00dftherapie","296":"Fu\u00dfreflexzonenmassage","297":"Irisdiagnose","263":"Schmerztherapie","298":"Triggerpunktmassage","262":"Tumortherapie"},"69":{"267":"Ersttermin"},"70":{"268":"Ersttermin"},"71":{"269":"First appointment"},"73":{"274":"Arthrose","273":"Osteoporose"},"74":{"322":"Ersttermin"},"77":{"287":"Ersttermin"},"78":{"286":"Ersttermin"},"79":{"291":"Ersttermin"},"80":{"292":"Ersttermin"},"81":{"316":"Ersttermin"},"82":{"319":"Ersttermin"},"83":{"321":"Ersttermin"},"84":{"323":"Ersttermine"}};
  </script>

  
  

  <footer>

    <div class="row">
      <div class="logo">
        <a href="/">
          IhrArzt24
        </a>
      </div>

      <div id="press"><ul class="inlined"></ul></div>

    </div>

    <nav>
      <div id="legal">
      <h4>Rechtliches</h4>
      <ul>
        <li><a href="/agb">AGB</a></li>
        <li><a href="/impressum">Impressum</a></li>
        <li><a href="/datenschutz">Datenschutz</a></li>
      </ul>
      </div>    
    </nav>

  </footer>


</section>