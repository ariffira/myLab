
<?php $this->ui->tile->base_init(); ?>

<div class="row">

  <div class="col-md-12">
    <?php
        $this->ui->tile->title('content', 'Liste der eRezept');
        $this->ui->tile->body->options('class', array('p-10', 'm-10', ));
        $this->ui->tile->body(
          'content',
          $this->load->view('doctors/eprescription_list_view', array(), TRUE)
        );
        echo $this->ui->tile->output();
    ?>
  </div>

</div>

 <script>
    $.pageSetup($('#content'));
</script>