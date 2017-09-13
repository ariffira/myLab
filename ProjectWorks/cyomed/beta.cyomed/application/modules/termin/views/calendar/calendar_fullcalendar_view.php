<!-- Full Calendar -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/fullcalendar-2.3.1/lib/cupertino/jquery-ui.min.css'); ?>" />    
<script> $.lang = '<?php echo $this->m->user_value('language', $this->m->lang ?: 'en'); ?>'; </script>
<script src="<?php echo base_url('assets/js/termin.js'); ?>"></script>

<script>
 
$( "#fullcalendarToggleBtns .btn-primary" ).click(function() {
    $('#fullcalendar .btn-primary').css( "display",'block' );
    $('#fullcalendar .btn-info').css( "display",'none' );
    $('#fullcalendar .btn-warning').css( "display",'none' );
    $('#fullcalendar .btn-default').css( "display",'none' );
    $('#fullcalendar .btn-success').css( "display",'none' );
});
$( "#fullcalendarToggleBtns .btn-info" ).click(function() {
    $('#fullcalendar .btn-info').css( "display",'block' );
    $('#fullcalendar .btn-primary').css( "display",'none' );
    $('#fullcalendar .btn-warning').css( "display",'none' );
    $('#fullcalendar .btn-default').css( "display",'none' );
    $('#fullcalendar .btn-success').css( "display",'none' );
});
$( "#fullcalendarToggleBtns .btn-warning" ).click(function() {
    $('#fullcalendar .btn-warning').css( "display",'block' );
    $('#fullcalendar .btn-primary').css( "display",'none' );
    $('#fullcalendar .btn-info').css( "display",'none' );
    $('#fullcalendar .btn-default').css( "display",'none' );
    $('#fullcalendar .btn-success').css( "display",'none' );
});
$( "#fullcalendarToggleBtns .btn-default" ).click(function() {
    $('#fullcalendar .btn-default').css( "display",'block' );
    $('#fullcalendar .btn-primary').css( "display",'none' );
    $('#fullcalendar .btn-info').css( "display",'none' );
    $('#fullcalendar .btn-warning').css( "display",'none' );
    $('#fullcalendar .btn-success').css( "display",'none' );
});
$( "#fullcalendarToggleBtns .btn-success" ).click(function() {
    $('#fullcalendar .btn-success').css( "display",'block' );
    $('#fullcalendar .btn-primary').css( "display",'none' );
    $('#fullcalendar .btn-info').css( "display",'none' );
    $('#fullcalendar .btn-warning').css( "display",'none' );
    $('#fullcalendar .btn-default').css( "display",'none' );
});
$( "#fullcalendarToggleBtns .btn-danger" ).click(function() {
    $('#fullcalendar .btn-success').css( "display",'block' );
    $('#fullcalendar .btn-primary').css( "display",'block' );
    $('#fullcalendar .btn-info').css( "display",'block' );
    $('#fullcalendar .btn-warning').css( "display",'block' );
    $('#fullcalendar .btn-default').css( "display",'block' );
});

</script>

<?php $active_calendar = isset($active_calendar) && $active_calendar ? 'active' : ''; ?>


<div class="" style="padding-bottom:10px;">
  <!--<p><small>Drücken Sie, um den entsprechenden Eintrag zu sehen</small></p>-->
  <p id="fullcalendarToggleBtns" class="pull-left">
    <button class="btn btn-danger btn-sm" role="button"><?php echo $this->lang->line('cal_btn_view_all'); ?> »</button>
    <button class="btn btn-primary btn-sm" role="button"><?php echo $this->lang->line('cal_btn_legal'); ?> »</button>
    <button class="btn btn-info btn-sm" role="button"><?php echo $this->lang->line('cal_btn_privatorlegal'); ?>»</button>
    <button class="btn btn-warning btn-sm" role="button"><?php echo $this->lang->line('cal_btn_privat'); ?> »</button>
    <button class="btn btn-default btn-sm" role="button"><?php echo $this->lang->line('cal_btn_own'); ?> »</button>
    <button class="btn btn-success btn-sm" role="button"><?php echo $this->lang->line('cal_btn_close_time'); ?> »</button>
</p>
 <p id="" class="pull-right">
    <a href="<?php echo site_url('/termin/doctor/termin'); ?>" class="ajax-termin-link"><button class="btn btn-warning  btn-sm" role="button" ><span class="fa fa-lg fa-envelope"></span></button></a>
    <a href="<?php echo site_url('/termin/doctor/settings'); ?>" class="ajax-settings-link"><button class="btn btn-info btn-sm" role="button"  ><span class="fa fa-lg fa-cog"></span></button></a>
    <a href="<?php echo site_url('/termin/doctor/plugin'); ?>" class="ajax-plugin-link"><button class="btn btn-primary  btn-sm" role="button"  ><span class="fa fa-lg fa-link"></span></button> </a>  
 </p>
</div>
<div class="row">
  <div class="col-12 col-sm-12 col-lg-12">
     <!--<div id="load">    
        <img style="margin-top:0px;" src="http://www.fonacot.gob.mx/PublishingImages/loading.gif" alt="loading" />
        <br />
    </div>-->
    <div id='fullcalendarLoading'></div>
    <div id='fullcalendar'></div>
  </div>
</div>



    <?php $this->load->view('dialog/termin_click_view'); ?>

    <?php $this->load->view('dialog/bearbeiten_view'); ?>

    <script type="text/javascript">
      <?php if ($this->m->user()) : ?>
      var docSettings = {
        <?php foreach (array('working_days', 'working_hours_start', 'working_hours_end', 'calendar_cell', 'termin_default_length', 'regular_termin_on') as $setting_name)  : ?>
        <?php echo $setting_name; ?> : <?php echo isset($this->m->user()->$setting_name) ? ('"'.$this->m->user()->$setting_name.'"') : 'false'; ?>,
      <?php endforeach; ?>
    };
  <?php endif; ?>
</script>

