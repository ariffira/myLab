<?php if (isset($alert)) : ?>
  <div class="row">
    <div class="col-md-12">
      <div class="<?php echo is_object($alert) && isset($alert->base) ? $alert->base : 'alert'; ?> <?php echo is_object($alert) && isset($alert->base) ? $alert->base : 'alert'; ?>-<?php echo is_object($alert) && isset($alert->type) ? $alert->type : 'warning'; ?> <?php echo is_object($alert) && isset($alert->class) ? $alert->class : 'warning'; ?>">
        <?php echo is_object($alert) && isset($alert->text) ? $alert->text : (is_string($alert) ? $alert : ''); ?>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php $this->lang->load('package', 'german'); ?>

<?php $this_is_default = ($package->name == 'free'); ?>

<div class="row">

  <div class="col-md-6" id="info-block">
    <div class="bs-callout bs-callout-danger">
      <h4 class="h2">Ihre Tarifwahl</h4>
      <div class="alert alert-danger termin-timebar" role="alert">
        <div class="h4">
          <span class="light pull-right"><?php echo $package->intro_top_right; ?></span>
          <strong><?php echo $this->lang->line('package_'.$package->name) ? $this->lang->line('package_'.$package->name) : ''; ?></strong>          
        </div>
      </div>
      <ul class="media-list">
        <li class="media">
          <?php if (isset($package->avatar) && $package->avatar) : ?>
            <a class="pull-left thumbnail col-md-4" href="#">
              <img src="<?php echo $package->avatar; ?>" alt="<?php echo $this->lang->line('package_'.$package->name) ? $this->lang->line('package_'.$package->name) : ''; ?>">
            </a>
          <?php endif; ?>          
          <div class="media-body">
            <h5 class="media-heading">
              <div class="conjunction">Tarif</div>
              <div class="name h3" style="margin-top:0;"><?php echo $this->lang->line('package_'.$package->name) ? $this->lang->line('package_'.$package->name) : ''; ?></div>
            </h5>
            <p></p>
            <div class="bs-callout bs-callout-info">
              <div class="media">
                <div class="media-body">
                  <h4 class="media-heading">INTRO</h4>
                  <div class="name">
                    <div class="row">
                      <div class="col-md-offset-2 col-md-8">
                        <?php echo $package->intro; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>
      <ul class="comfort-elements">
        <li class="cancelation">Sollten sich Ihre Pläne ändern, können Sie den Termin jederzeit stornieren.</li>
        <li class="contact">Unser Supportteam erreichen Sie kostenfrei unter <a href="tel:0211 / 972 64 094">0211 / 972 64 094</a></li>
      </ul>
    </div>
  </div>

  <div class="col-md-6" id="form">
    <div class="bs-callout bs-callout-warning">
      <h4>Error</h4>
      
      <div class="row">
        <div class="col-md-12">
          <p>
            <?php echo isset($page_content) ? $page_content : ''; ?>
          </p>
        </div>
      </div>

    </div>
  </div>

</div>

