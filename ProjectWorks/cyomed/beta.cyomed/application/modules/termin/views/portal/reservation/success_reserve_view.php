
<?php $this->ui->tile->base_init(); ?>

<?php if (Ui::$bs_tname == 'mvpr110') : ?>
    <div id="<?php echo $accordion_parent_id = 'accordion-container-'.random_string('alnum', 32); ?>" class="panel-group accordion-simple">
<?php endif; ?>

<div class="row">

  <div class="col-md-12">
    <?php $this->ui->tile->rebase(); ?>
    <?php
      if (Ui::$bs_tname == 'mvpr110')
       {
        $this->ui->tile->options('accordion', 'active');
        $this->ui->tile->options('accordion_parent', $accordion_parent_id);
        $this->ui->tile->options('accordion_active', empty($accordion_active) ? ($accordion_active = 'active') : FALSE);
       }

        $this->ui->tile->title('content', 'Successful reservation');
        $this->ui->tile->body->options('class', array('p-10', 'm-10', ));
        $this->ui->tile->body(
          'content',
          $this->load->view('portal/reservation/success_view', array(), TRUE)
        );
        echo $this->ui->tile->output();
    ?>
  </div>

</div>

<?php if (Ui::$bs_tname == 'mvpr110') : ?>
    </div>
<?php endif; ?>

  <script>
    $.pageSetup($('#content'));
  </script>