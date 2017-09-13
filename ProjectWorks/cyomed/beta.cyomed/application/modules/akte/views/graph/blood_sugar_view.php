
  <div class="row">

    <div class="col-md-4">

      <?php $this->load->view('graph/quick_stat_view', array(
        'desc' => 'Blutzucker (mg/dl)',
        'entries' => !empty($entries) ? $entries : NULL, 
        'field' => !empty($entries) ? 'bloodsugar' : NULL,
      )); ?>

    </div>

    <div class="col-md-4">

      <?php $this->load->view('graph/quick_stat_view', array(
        'desc' => 'HbA1C',
        'entries' => !empty($entries) ? $entries : NULL, 
        'field' => !empty($entries) ? 'HbA1C' : NULL,
      )); ?>

    </div>

  </div>

  <div class="row">

    <div class="col-md-12">

      <?php $this->load->view('graph/blood_sugar_tile_view', array(
              'title' => $this->lang->line('overview_lang_blood_sugar_title'),
              // 'hide_menu' => TRUE, 
              'entries' => !empty($entries) ? $entries : NULL,
              'colorclass'=>$colorclass,
              'fields' => array(
                (object)array('field' => 'bloodsugar', 'label' => $this->lang->line('pwidget_plot_graph_blood_sugar_title'),'valueSuffix'=>'mg/dl' ),
                (object)array('field' => 'HbA1C', 'label' => $this->lang->line('pwidget_plot_graph_blood_sugar_hba'),'valueSuffix'=>'%'),
              ),
                'feed'=>false,
      )); ?>

    </div>

  </div>

  <div class="row">

    <div class="col-md-6">

      <?php $this->load->view('graph/blood_sugar_table_view', array(
        'entries' => !empty($entries) ? $entries : NULL, 
      )); ?>

    </div>

    <div class="col-md-6">
      <?php $this->ui->tile->rebase(); ?>
      <?php
        $this->ui->tile->options('class', 'm-b-10 m-t-5 m-l-0 m-r-0');
        $this->ui->tile->title('content', $this->lang->line('pwidget_plot_graph_new_point'));

        $this->ui->tile->body->options('class', array('p-10', 'm-10', ));
        $this->ui->tile->body(
          'content',
          $this->load->view('graph/insert_view', array(
            'table' => 'blood_sugar',
            'not_modal' => TRUE, 
            'entry' => (object) array(
              'id' => 0,
              'bloodsugar' => '',
              'HbA1C' => '',
            ),
          ), TRUE)
        );
      ?>

      <?php
        echo $this->ui->tile->output();
      ?>
    </div>

  </div>

  <script>

    $(document).ready(function() {


    });

    $.pageSetup($('#content'));

  </script>