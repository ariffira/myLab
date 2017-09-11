<div class="row">

    <div class="col-md-4">

      <?php $this->load->view('graph/quick_stat_view', array(
        'desc' => 'INR',
        'entries' => !empty($entries) ? $entries : NULL, 
        'field' => !empty($entries) ? 'INR' : NULL,
      )); ?>

    </div>

    <div class="col-md-4">

      <?php $this->load->view('graph/quick_stat_view', array(
        'desc' => 'Quick',
        'entries' => !empty($entries) ? $entries : NULL, 
        'field' => !empty($entries) ? 'quick' : NULL,
      )); ?>

    </div>

  </div>

  <div class="row">

    <div class="col-md-12">

      <?php $this->load->view('graph/marcumar_tile_view', array(
        'entries' => !empty($entries) ? $entries : NULL,
           'title' => 'Quick',
              'label'=>"Quick (%)",
        'fields' => array(
          (object)array('field' => 'quick', 'label' => 'Quick (%)', ),
        ),
           'feed'=>false
      )); ?>

    </div>

  </div>

   <div class="row">

    <div class="col-md-12">

      <?php $this->load->view('graph/marcumar_tile_view', array(
        'entries' => !empty($entries) ? $entries : NULL, 
          'title' => 'INR',
              'label' => 'INR',
        'fields' => array(
          (object)array('field' => 'INR', 'label' => 'INR', 'axis' => 0, ),
          (object)array('field' => 'upper_limit', 'label' => 'Obergrenze', 'disable_fill' => TRUE, 'axis' => 0, ),
          (object)array('field' => 'lower_limit', 'label' => 'Untergranze', 'disable_fill' => TRUE, 'axis' => 0, ),
        ),
           'feed'=>false
      )); ?>

    </div>

  </div> 

  <div class="row">

    <div class="col-md-6">

      <?php $this->load->view('graph/marcumar_table_view', array(
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
            'table' => 'marcumar',
            'not_modal' => TRUE, 
            'entry' => (object) array(
              'id' => 0,
              'INR' => '',
              'quick' => '',
//              'lower_limit' => !empty($entries) && count($entries) > 0 && !empty($entries[0]->lower_limit) ? $entries[0]->lower_limit : '',
                'lower_limit' => '',
//              'upper_limit' => !empty($entries) && count($entries) > 0 && !empty($entries[0]->upper_limit) ? $entries[0]->upper_limit : '',
                'upper_limit' =>  ''
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