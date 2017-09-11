  <div class="row">
    
    <div class="col-md-7">

      <div class="row">
        <div class="col-md-12">
          <?php
            $this->load->view('graph/blood_pressure_tile_view', array(
              'entries' => !empty($category) && !empty($category->heart_frequency) ? $category->heart_frequency : NULL,
            ));
          ?>        
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <?php $this->ui->tile->rebase(); ?>
          <?php
            
            $this->ui->tile->title->content = 'Health-Score';

            $this->ui->tile->options('class', 'm-10 m-l-0 m-r-0')->body->options('class', 'text-center p-10')->content = $this->load->view('graph/pie_chart_view', array(
              'pie_charts' => array(
                (object) array('value' => $this->mopat->health_score(), 'range' => 1100, 'title' => 'Health-Score', 'no_percent' => TRUE, ),
                // (object) array('value' => mt_rand(1, 199) - 100, 'range' => 100, 'title' => 'To be defined', ),
                // (object) array('value' => mt_rand(1, 199) - 100, 'range' => 100, 'title' => 'To be defined', ),
                // (object) array('value' => mt_rand(1, 199) - 100, 'range' => 100, 'title' => 'To be defined', ),
                // (object) array('value' => mt_rand(1, 199) - 100, 'range' => 100, 'title' => 'To be defined', ),
                // (object) array('value' => mt_rand(1, 199) - 100, 'range' => 100, 'title' => 'To be defined', ),
              ),
            ), TRUE);

            echo $this->ui->tile->output();
          ?>
        </div>
      </div>

    </div>

    <div class="col-md-5">
      <!-- USA Map -->
      <?php $this->ui->tile->rebase(); ?>
      <?php
        
        $this->ui->tile->title->content = 'Travel Diagnosis';

        $this->ui->tile->options('class', 'm-b-10 m-t-0 m-l-0 m-r-0')->body->options('class', 'p-0')->content = '<div id="world-map" style="height:400px;" ></div>';

        echo $this->ui->tile->output();
      ?>
    </div>

  </div>


  <script type="text/javascript">
    //World Map

    <?php $pie_chart_color = Ui::$bs_tname == 'mvpr110' ? array(0, 0, 0, 0.4) : array(255, 255, 255, 0.6); ?>
    <?php $pie_chart_color_hover = Ui::$bs_tname == 'mvpr110' ? array(0, 0, 0, 0.7) : array(255, 255, 255, 1); ?>

    $(document).ready(function() {
      if ($('#world-map')[0]) {
        $('#world-map').vectorMap({

          map: 'world_mill_en',
          // map: 'us_aea_en',
          backgroundColor: 'rgba(0,0,0,0)',
          series: {
            regions: [{
              scale: ['#C8EEFF', '#0071A4'],
              normalizeFunction: 'polynomial'
            }]
          },
          regionStyle: {
            initial: {
              fill: 'rgba(<?php echo implode(',', $pie_chart_color); ?>)'
            },
            hover: {
              fill: 'rgba(<?php echo implode(',', $pie_chart_color_hover); ?>)'
            },
          },

          // zoomMin: 0.88,
          // focusOn: {
          //   x: 5,
          //   y: 1,
          //   scale: 1.8
          // },
          markerStyle: {
            initial: {
              fill: '#e80000',
              stroke: 'rgba(0,0,0,0.4)',
              "fill-opacity": 2,
              "stroke-width": 7,
              "stroke-opacity": 0.5,
              r: 4
            },
            hover: {
              stroke: 'black',
              "stroke-width": 2,
            },
            selected: {
              fill: 'blue'
            },
            selectedHover: {}
          },
          // zoomOnScroll: false,

          markers: [{
            latLng: [33, -86],
            name: 'Sample Name 1'
          }, {
            latLng: [33.7, -93],
            name: 'Sample Name 2'
          }, {
            latLng: [36, -79],
            name: 'Sample Name 3'
          }, {
            latLng: [29, -99],
            name: 'Sample Name 4'
          }, {
            latLng: [33, -95],
            name: 'Sample Name 4'
          }, {
            latLng: [31, -92],
            name: 'Liechtenstein'
          }, ],
        });
      }
    });

  </script>