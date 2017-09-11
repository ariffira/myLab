
  <div class="row">

    <div class="col-md-4">

      <?php $this->load->view('graph/quick_stat_view', array(
        'desc' => 'Gewicht (kg)',
        'entries' => !empty($entries) ? $entries : NULL, 
        'field' => !empty($entries) ? 'weight' : NULL,
      )); ?>

    </div>

    <div class="col-md-4">

      <?php $this->load->view('graph/quick_stat_view', array(
        'desc' => 'BMI',
        'entries' => !empty($entries) ? $entries : NULL, 
        'field' => !empty($entries) ? 'bmi' : NULL,
      )); ?>

    </div>

  </div>

  <div class="row">

<!--    <div class="col-md-12">-->

      <?php $this->load->view('graph/weight_bmi_tile_view', array(
        'entries' => !empty($entries) ? $entries : NULL, 
      )); ?>

<!--    </div>-->

  </div>

  <div class="row">

    <div class="col-md-6">

      <?php $this->load->view('graph/weight_bmi_table_view', array(
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
            'table' => 'weight_bmi',
            'not_modal' => TRUE, 
            'entry' => (object) array(
              'id' => 0,
              'size' => '',
              'weight' => '',
              'bmi' => '',
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