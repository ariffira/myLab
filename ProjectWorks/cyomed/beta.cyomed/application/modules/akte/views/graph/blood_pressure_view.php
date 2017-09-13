
  <div class="row">

    <div class="col-md-4">

      <?php $this->load->view('graph/quick_stat_view', array(
        'desc' => 'RR systolisch',
        'entries' => !empty($entries) ? $entries : NULL, 
        'field' => !empty($entries) ? 'rr_sys' : NULL,
      )); ?>

    </div>

    <div class="col-md-4">

      <?php $this->load->view('graph/quick_stat_view', array(
        'desc' => 'RR diastolisch',
        'entries' => !empty($entries) ? $entries : NULL, 
        'field' => !empty($entries) ? 'rr_dia' : NULL,
      )); ?>

    </div>

    <div class="col-md-4">

      <?php $this->load->view('graph/quick_stat_view', array(
        'desc' => 'Puls',
        'entries' => !empty($entries) ? $entries : NULL, 
        'field' => !empty($entries) ? 'puls' : NULL,
      )); ?>

    </div>

  </div>

  <div class="row">

    <div class="col-md-12">
      <?php $this->load->view('graph/blood_pressure_tile_view', array(
              'title' =>strtoupper($this->lang->line('graph_title_bloodpressure')),
              'entries' =>!empty($entries) ? $entries : NULL,
              'fields' => array(
                (object)array('field' => 'rr_sys', 'label' => strtoupper($this->lang->line('graph_blood_pres_x_cord_sys')), 'axis' => 0, ),
                (object)array('field' => 'rr_dia', 'label' => strtoupper($this->lang->line('graph_blood_pres_x_cord_dias')), 'axis' => 0, ),
              ),
              'valuepostfix'=>'MMHG',
                'feed'=>false,            
      )); ?>

    </div>

  </div>

  <div class="row">

    <div class="col-md-12">

      <?php $this->load->view('graph/blood_pressure_tile_view', array(
                'feed'=>false,
               'title' => strtoupper($this->lang->line('graph_title_heart_puls')),
              'entries' => !empty($entries) ? $entries : NULL,
               'withing'=>false,
              'fields' => array(
                (object)array('field' => 'puls', 'label' => strtoupper($this->lang->line('graph_title_heart_puls')), ),
              ),
      )); ?>
    </div>

  </div>

  <div class="row">

    <div class="col-md-6">

      <?php $this->load->view('graph/blood_pressure_table_view', array(
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
            'table' => 'heart_frequency',
            'not_modal' => TRUE, 
            'entry' => (object) array(
              'id' => 0,
              'rr_sys' => '',
              'rr_dia' => '',
              'puls' => '',
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