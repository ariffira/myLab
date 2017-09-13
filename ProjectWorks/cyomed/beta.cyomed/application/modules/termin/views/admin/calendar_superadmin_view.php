
    <?php $has_sidebar = isset($sidebar) && is_array($sidebar) && count($sidebar) > 0 ? TRUE : FALSE; ?>

    <?php if ($has_sidebar) : ?>
      <p class="pull-left visible-xs">
        <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="icomoon i-list"></i></button>
      </p>
    <?php endif; ?>

    
      <p><small>Drücken Sie, um den entsprechenden Eintrag zu sehen</small></p>
      <p id="fullcalendarToggleBtns">
        <a class="shortcut tile btn btn-primary  btn-xs" role="button" data-toggle-type="public" >
          <small class="t-overflow">gesetzlich »</small>
        </a>
        <a class="shortcut tile btn btn-info  btn-xs" role="button" data-toggle-type="both" >
          <small class="t-overflow">gesetzlich / privat »</small>
        </a>
        <a class="shortcut tile btn btn-warning  btn-xs" role="button" data-toggle-type="private" >
          <small class="t-overflow">privat »</small>
        </a>
        <a class="shortcut tile btn btn-default  btn-xs" role="button" data-toggle-type="none" >
          <small class="t-overflow">Eigene Belegung »</small>
        </a>
        <a class="shortcut tile btn btn-success  btn-xs" role="button" data-toggle-type="close" >
          <small class="t-overflow">Schließzeiten »</small>
        </a>
        <a class="shortcut tile btn btn-danger  btn-xs" role="button" >
          <small class="t-overflow">View Introduction »</small>
        </a>
      </p>
    </div>

    <hr class="whiter" />

    <div class="block-area">
    
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

    </div>

    <?php $this->load->view('dialog/termin_click_view'); ?>

    <?php $this->load->view('dialog/bearbeiten_view'); ?>

    <script type="text/javascript">
      <?php if ($this->mod->user()) : ?>
        var docSettings = {
          <?php foreach (array('working_days', 'working_hours_start', 'working_hours_end', 'calendar_cell', 'termin_default_length', 'regular_termin_on', ) as $setting_name)  : ?>
            <?php echo $setting_name; ?> : <?php echo isset($this->mod->user()->$setting_name) ? ('"'.$this->mod->user()->$setting_name.'"') : 'false'; ?>,
          <?php endforeach; ?>
        };
      <?php endif; ?>
    </script>