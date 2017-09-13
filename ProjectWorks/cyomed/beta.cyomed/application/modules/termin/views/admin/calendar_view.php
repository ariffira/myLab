<!-- Full Calendar -->
<script src="<?php echo base_url('assets/js/termin.js'); ?>"></script>


<?php $has_sidebar = isset($sidebar) && is_array($sidebar) && count($sidebar) > 0 ? TRUE : FALSE; ?>
<?php $active_calendar = isset($active_calendar) && $active_calendar ? 'active' : ''; ?>
<?php $active_termin = isset($active_termin) && $active_termin ? 'active' : ''; ?>
<?php $active_profile = isset($active_profile) && $active_profile ? 'active' : ''; ?>
<?php $active_treatment = isset($active_treatment) && $active_treatment ? 'active' : ''; ?>
<?php $active_clinic = isset($active_clinic) && $active_clinic ? 'active' : ''; ?>
<?php $num_termin = isset($num_termin) && $num_termin ? $num_termin : ($this->m->user() ? count($this->m->user()->unread) : ''); ?>

<?php if ($has_sidebar) : ?>
  <p class="pull-left visible-xs">
    <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="icomoon i-list"></i></button>
  </p>
<?php endif; ?>

<div class="panel-heading" style="">
  <!--<p><small>Drücken Sie, um den entsprechenden Eintrag zu sehen</small></p>-->
  <p id="fullcalendarToggleBtns">
    <button class="btn btn-primary  btn-sm" role="button" data-toggle-type="public" >gesetzlich »</button>
    <button class="btn btn-info  btn-sm" role="button" data-toggle-type="both" >gesetzlich / privat »</button>
    <button class="btn btn-warning  btn-sm" role="button" data-toggle-type="private" >privat »</button>
    <button class="btn btn-default  btn-sm" role="button" data-toggle-type="none" >Eigene Belegung »</button>
    <button class="btn btn-success  btn-sm" role="button" data-toggle-type="close" >Schließzeiten »</button>
    <!-- <button class="btn btn-danger  btn-xs" role="button" >View Introduction »</button>-->
  </p>
</div>
<div class="row">
  <div class="col-12 col-sm-12 col-lg-12">
    <div id='fullcalendarLoading'></div>
    <div id='fullcalendar'></div>
  </div>
</div>

    <!--<div class="row">
      <div class="col-6 col-sm-6 col-lg-4">
        <h2>Heading</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
      </div>
      <div class="col-6 col-sm-6 col-lg-4">
        <h2>Heading</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
      </div>
      <div class="col-6 col-sm-6 col-lg-4">
        <h2>Heading</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
      </div>
      <div class="col-6 col-sm-6 col-lg-4">
        <h2>Heading</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
      </div>
      <div class="col-6 col-sm-6 col-lg-4">
        <h2>Heading</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
      </div>
      <div class="col-6 col-sm-6 col-lg-4">
        <h2>Heading</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
      </div>
    </div>-->

    <?php $this->load->view('dialog/termin_click_view'); ?>

    <?php $this->load->view('dialog/bearbeiten_view'); ?>

    <script type="text/javascript">
      <?php if ($this->m->user()) : ?>
      var docSettings = {
        <?php foreach (array('working_days', 'working_hours_start', 'working_hours_end', 'calendar_cell', 'termin_default_length', 'regular_termin_on', ) as $setting_name)  : ?>
        <?php echo $setting_name; ?> : <?php echo isset($this->m->user()->$setting_name) ? ('"'.$this->m->user()->$setting_name.'"') : 'false'; ?>,
      <?php endforeach; ?>
    };
  <?php endif; ?>
</script>



