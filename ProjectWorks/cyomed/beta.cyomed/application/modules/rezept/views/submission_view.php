
<?php $this->ui->tile->base_init(); ?>

<div class="row">

  <div class="col-md-12">
    <?php
        $this->ui->tile->title('content', $this->lang->line('epres_final_title'));
        $this->ui->tile->body->options('class', array('p-10', 'm-10', ));
        $this->ui->tile->body(
          'content',
          $this->load->view('epres_submission_view', array(), TRUE)
        );
        echo $this->ui->tile->output();
    ?>
  </div>

</div>

 <script>
    $.pageSetup($('#content'));
  </script>
