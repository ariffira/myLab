
<?php $this->ui->mc->base_init(); ?>
<div class="row">

  <div class="col-md-12">
    <?php
        $this->ui->mc->title->content="";
        /*$this->ui->mc->body->options('class', array('p-10', 'm-10', ));*/
        $this->ui->mc->content->content=$this->load->view('patient_termin_search_view', array(), TRUE);
        
        echo $this->ui->mc->output();
    ?>
  </div>

</div>
  <!-- Google Maps -->
  <!--<script type="text/javascript" src="<?php // echo base_url('assets/scripts/app.js'); ?>"></script>-->
 <script src="<?php  echo base_url('assets/js/termin.js'); ?>"></script>


 <script>
    $.pageSetup($('#content'));
</script>