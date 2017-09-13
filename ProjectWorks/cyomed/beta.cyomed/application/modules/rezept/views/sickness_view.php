<?php $this->ui->tile->base_init(); ?>

<h4>
  <?php echo $this->lang->line('epres_select_title');?>
</h4>

<div class="row">

    <div class="col-md-4">
      <?php
        $this->ui->tile->rebase();
        $this->ui->tile->title('content', '');
        $this->ui->tile->body->options('class', array('p-10', 'text-center', ));
        $this->ui->tile->body(
          'content',
          '<a class="ajax-nav-links" href="'.site_url('rezept/questions?sickness=bp').'"><h4>' . $this->lang->line('epres_blood_pressure') . '</h4></a>'
        );
        echo $this->ui->tile->output();
      ?>
    </div>

    <div class="col-md-4">
      <?php
        $this->ui->tile->rebase();
        $this->ui->tile->title('content', '');
        $this->ui->tile->body->options('class', array('p-10', 'text-center', ));
        $this->ui->tile->body(
          'content',
          '<a class="ajax-nav-links" href="'.site_url('rezept/questions?sickness=ch').'"><h4>' . $this->lang->line('epres_high_cholesterol') . '</h4></a>'
        );
        echo $this->ui->tile->output();
      ?>
    </div>

    <div class="col-md-4">
      <?php
        $this->ui->tile->rebase();
        $this->ui->tile->title('content', '');
        $this->ui->tile->body->options('class', array('p-10', 'text-center', ));
        $this->ui->tile->body(
          'content',
          '<a class="ajax-nav-links" href="'.site_url('rezept/questions?sickness=al').'"><h4>' . $this->lang->line('epres_allergy') . '</h4></a>'
        );
        echo $this->ui->tile->output();
      ?>
    </div>
<!--
    <div class="col-md-4">
      <?php
        $this->ui->tile->rebase();
        $this->ui->tile->title('content', 'Sexuelle Funktionsstörung');
        $this->ui->tile->body->options('class', array('p-10', 'text-center', ));
        $this->ui->tile->body(
          'content',
          '<a class="ajax-nav-links" href="'.site_url('rezept/questions?sickness=se').'"><h4>Sexuelle Funktionsstörung</h4></a>'
        );
        echo $this->ui->tile->output();
      ?>
    </div>

    <div class="col-md-4">
      <?php
        $this->ui->tile->rebase();
        $this->ui->tile->title('content', 'Maleriaprophylaxe');
        $this->ui->tile->body->options('class', array('p-10', 'text-center', ));
        $this->ui->tile->body(
          'content',
          '<a class="ajax-nav-links" href="'.site_url('rezept/questions?sickness=ma').'"><h4>Maleriaprophylaxe</h4></a>'
        );
        echo $this->ui->tile->output();
      ?>
    </div>

    <div class="col-md-4">
      <?php
        $this->ui->tile->rebase();
        $this->ui->tile->title('content', 'Orale Kontrazeption');
        $this->ui->tile->body->options('class', array('p-10', 'text-center', ));
        $this->ui->tile->body(
          'content',
          '<a class="ajax-nav-links" href="'.site_url('rezept/questions?sickness=pi').'"><h4>Orale Kontrazeption</h4></a>'
        );
        echo $this->ui->tile->output();
      ?>
    </div>
  -->
    
</div>

<script>
    $.pageSetup($('#content'));
</script>