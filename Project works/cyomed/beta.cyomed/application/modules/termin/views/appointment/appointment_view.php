<script src="<?php echo base_url('assets/js/termin.js'); ?>"></script>

<?php $this->ui->tile->base_init(); ?>
<?php $active_termin = isset($active_termin) && $active_termin ? 'active' : ''; ?>
<?php $num_termin = isset($num_termin) && $num_termin ? $num_termin : ($this->m->user() ? count($this->m->user()->unread) : ''); ?>


<div class="container">

  <div class="layout layout-main-right layout-stack-sm">

    <div class="col-md-3 col-sm-4 layout-sidebar">

      <div class="nav-layout-sidebar-skip ">
        <strong>Tab Navigation</strong> / <a href="#settings-content">Skip to Content</a> 
      </div>

      <ul id="myTab" class="nav nav-layout-sidebar nav-stacked">
        <li class="active">
          <a href="#new-termin-tab" data-toggle="tab">
            <i class="fa fa-envelope"></i> 
            &nbsp;&nbsp;
            <?php echo $this->lang->line('apntmnt_new_event');?>
        </li>

        <li>
          <a href="#forthcoming-termin-tab" data-toggle="tab">
            <i class="fa fa-envelope-o"></i> 
            &nbsp;&nbsp;
            <?php echo $this->lang->line('apntmnt_coming_event');?>
          </a>
        </li>

        <li>
          <a href="#archive-termin-tab" data-toggle="tab">
            <i class="fa fa-archive"></i>
            &nbsp;&nbsp;
            <?php echo $this->lang->line('apntmnt_archieve_event');?>
          </a>
        </li>

        </ul>

    </div> <!-- /.col -->



    <div class="col-md-9 col-sm-8 layout-main box-shadow">

      <div id="settings-content" class="tab-content stacked-content">

        <!--New termin tab Started -->

        <div class="tab-pane fade in active" id="new-termin-tab">
          <h3 class="content-title"><u><?php echo $this->lang->line('apntmnt_new_event');?></u>
          <!-- <button class="btn btn-success dialog-new-appointment pull-right">
            <span class="icomoon i-plus-circle">
            </span>
            <?php echo $this->lang->line('apntmnt_new_event');?>
          </button> -->
          </h3>
          <p class="help-block text-muted">
            <?php echo $this->lang->line('apntmnt_new_header_info');?>
          </p>

          <?php 
          $this->load->view('appointment/new_termin_view'); 
          ?>

        </div> <!-- /.tab-pane -->
        <!--New termin tab End -->


        <!--forthcoming termin tab Started -->
        <div class="tab-pane fade" id="forthcoming-termin-tab">

          <h3 class="content-title">
            <u>
              <?php echo $this->lang->line('apntmnt_coming_event');?>
            </u>
            <button class="btn btn-success dialog-new-appointment pull-right">
              <span class="icomoon i-plus-circle"></span>
              <?php echo $this->lang->line('apntmnt_new_event');?>
            </button>
         
          </h3>
          <p class="help-block text-muted">
            <?php echo $this->lang->line('apntmnt_actual_header_info');?>
          </p>
 
          <?php 
          $this->load->view('appointment/forthcoming_termin_view'); 
          ?>

        </div> <!-- /.tab-pane -->
        <!--forthcoming termin tab End -->

        <!--archive termin tab Started -->
        <div class="tab-pane fade" id="archive-termin-tab">

          <h3 class="content-title">
            <u>
              <?php echo $this->lang->line('apntmnt_archieve_event');?>
            </u>
            <button class="btn btn-success dialog-new-appointment pull-right">
              <span class="icomoon i-plus-circle"></span>
                <?php echo $this->lang->line('apntmnt_new_event');?>
            </button>
          </h3>
          <p class="help-block text-muted">
            <?php echo $this->lang->line('apntmnt_old_header_info');?>
          </p>

          <?php 
          $this->load->view('appointment/archive_termin_view'); 
          ?>
        </div> <!-- /.tab-pane -->
        <!--archivetermin tab End -->

</div> <!-- /.tab-content -->

</div> <!-- /.col -->

</div> <!-- /.row -->


</div> <!-- /.container -->


<?php $this->load->view('dialog/bearbeiten_view'); ?>

<?php $this->load->view('dialog/neu_termin_view'); ?>


<script type="text/javascript">
  var bearbeitenData = {};
  <?php foreach ($tabs as $tab) : ?>
    <?php if (isset($tab->tabArray) && is_array($tab->tabArray) && count($tab->tabArray) > 0) : ?>
      <?php foreach ($tab->tabArray as $row) : ?>
        bearbeitenData[<?php echo $row->id; ?>] = <?php echo json_encode($row); ?>;
      <?php endforeach; ?>
    <?php endif; ?>
  <?php endforeach; ?>

  <?php foreach ($unread as $row) : ?>
    bearbeitenData[<?php echo $row->id; ?>] = <?php echo json_encode($row); ?>;
  <?php endforeach; ?>

  <?php foreach ($past as $row) : ?>
    bearbeitenData[<?php echo $row->id; ?>] = <?php echo json_encode($row); ?>;
  <?php endforeach; ?>

  <?php foreach ($archive as $row) : ?>
    bearbeitenData[<?php echo $row->id; ?>] = <?php echo json_encode($row); ?>;
  <?php endforeach; ?>
  $(".dialog-new-appointment").click(function(){
    $(".date-picker").datetimepicker('hide').blur();
  });
</script>


<style>

 input[type=checkbox],
  input[type=radio]{
    opacity:1;
}
</style>
