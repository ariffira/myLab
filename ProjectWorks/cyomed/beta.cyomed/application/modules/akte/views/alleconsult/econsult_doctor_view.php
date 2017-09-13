
  <?php $this->ui->tile->base_init(); ?>

  <?php 
    $this->ui->tabs->base_init();
  ?>

  <!-- Tab All -->

  <?php $tab_all =& $this->ui->tabs->create(); ?>

  <?php $entries = !empty($category) && !empty($category->all) ? $category->all : array(); ?>

  <?php ob_start();  ?>

    <?php if (isset($entries) && is_array($entries) && count($entries) > 0) : ?>
      <?php foreach ($entries as $entry_index => $entry) : ?>

        <div class="row">

        <div class="col-md-12">
          <?php
            $this->ui->tile->title('content', 'eConsult');
            $this->ui->tile->body->options('class', array('p-10', 'm-10', ));
            $this->ui->tile->body(
              'content',
              $this->load->view('alleconsult/econsult_entry_view', array(
                'entry' => $entry,
                'readonly' => FALSE,
                'update_btn' => TRUE,
                'emergency_btn' => FALSE,
                'confirm_btn' => TRUE,
                'archive_btn' => FALSE,
                'delete_btn' => TRUE,
              ), TRUE)
            );
            echo $this->ui->tile->output();
          ?>
        </div>

      </div>

      <?php endforeach; ?>
    <?php endif; ?>

  <?php 
    $buffer = ob_get_contents();
    @ob_end_clean();
  ?>

  <?php
    $tab_all->nav->content = '<h4>All</h4>';
    $tab_all->pane->content = $buffer;

    // $this->ui->tabs->append($tab_all);
  ?>

  <!-- Tab Opened -->

  <?php $tab_opened =& $this->ui->tabs->create(); ?>
  <?php $tab_opened->options('active', TRUE); ?>
  <?php $entries = !empty($category) && !empty($category->opened) ? $category->opened : array(); ?>

  <?php ob_start();  ?>

    <?php if (isset($entries) && is_array($entries) && count($entries) > 0) : ?>
      <?php foreach ($entries as $entry_index => $entry) : ?>

        <div class="row">

        <div class="col-md-12">
          <?php
            $this->ui->tile->title('content', 'eConsult');
            $this->ui->tile->body->options('class', array('p-10', 'm-10', ));
            $this->ui->tile->body(
              'content',
              $this->load->view('alleconsult/econsult_entry_view', array(
                'entry' => $entry,
                'readonly' => FALSE,
                'update_btn' => TRUE,
                'emergency_btn' => FALSE,
                'confirm_btn' => TRUE,
                'archive_btn' => FALSE,
                'delete_btn' => TRUE,
              ), TRUE)
            );
            echo $this->ui->tile->output();
          ?>
        </div>

      </div>

      <?php endforeach; ?>
    <?php endif; ?>

  <?php 
    $buffer = ob_get_contents();
    @ob_end_clean();
  ?>

  <?php
    $tab_opened->nav->content = '<h4>Opened</h4>';
    $tab_opened->pane->content = $buffer;

    // $this->ui->tabs->append($tab_opened);
  ?>

    <!-- Tab closed -->

  <?php $tab_closed =& $this->ui->tabs->create(); ?>
  
  <?php $entries = !empty($category) && !empty($category->closed) ? $category->closed : array(); ?>

  <?php ob_start();  ?>

    <?php if (isset($entries) && is_array($entries) && count($entries) > 0) : ?>
      <?php foreach ($entries as $entry_index => $entry) : ?>

        <div class="row">

        <div class="col-md-12">
          <?php
            $this->ui->tile->title('content', 'eConsult');
            $this->ui->tile->body->options('class', array('p-10', 'm-10', ));
            $this->ui->tile->body(
              'content',
              $this->load->view('alleconsult/econsult_entry_view', array(
                'entry' => $entry,
                'readonly' => FALSE,
                'update_btn' => TRUE,
                'emergency_btn' => FALSE,
                'confirm_btn' => TRUE,
                'archive_btn' => FALSE,
                'delete_btn' => TRUE,
              ), TRUE)
            );
            echo $this->ui->tile->output();
          ?>
        </div>

      </div>

      <?php endforeach; ?>
    <?php endif; ?>

  <?php 
    $buffer = ob_get_contents();
    @ob_end_clean();
  ?>

  <?php
    $tab_closed->nav->content = '<h4>Closed</h4>';
    $tab_closed->pane->content = $buffer;

    // $this->ui->tabs->append($tab_closed);
  ?>


  <!-- Output -->

  <?php echo $this->ui->tabs->output(); ?>

  <script>
    $.pageSetup($('#content'));
  </script>