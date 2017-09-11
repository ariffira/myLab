

  <?php isset($entries) && is_array($entries) && count($entries) > 0 ? ( !empty($field) ? $field : ($field = array_keys($entries)[0] ) ) : ($field = FALSE); ?>

  <?php if (Ui::$bs_tname == 'mvpr110' && empty($disable_borders)) : ?>
    <div class="row-stat p-0">
  <?php endif; ?>

  <div class="tile quick-stats <?php echo Ui::$bs_tname == 'mvpr110' ? 'm-b-0 m-l-0 m-r-0' : '' ; ?>">
    <div id="<?php echo $quick_stat_id = 'stats-line-'.random_string('alnum', 32); ?>" class="<?php echo Ui::$bs_tname == 'sa103' ? 'pull-left' : ''; ?>">
      <!-- <?php
        if (isset($entries) && is_array($entries) && count($entries) > 0)
        {
          echo implode(',', array_filter(array_map(function($entry) use ($field) {
            return !empty($entry->$field) ? ($entry->$field > 0 ? $entry->$field : NULL) : NULL;
          }, $entries)));
        }
      ?> -->
    </div>

    <div class="data">
      <h2 data-value="<?php echo isset($entries) && is_array($entries) && count($entries) > 0 ? $entries[count($entries) - 1]->$field : ''; ?>">
        <?php echo isset($entries) && is_array($entries) && count($entries) > 0 ? $entries[0]->$field : ''; ?> <?php echo isset($unit) ? $unit : ''; unset($unit); ?>
      </h2>
      <small><?php echo !empty($desc) ? $desc : ''; ?></small>
    </div>
  </div>

  <?php if (Ui::$bs_tname == 'mvpr110' && empty($disable_borders)) : ?>
    </div>
  <?php endif; ?>

  <script type="text/javascript">

  $(document).ready(function() {
    $("#<?php echo $quick_stat_id; ?>").sparkline('html', {
      type: 'line',
      width: '100%',
      height: 64,
      lineColor: 'rgba(255, 255, 255, .4)',
      fillColor: 'rgba(0, 0, 0, .2)',
      lineWidth: 1.25,
    });
  });

  </script>

  <?php if (isset($disable_borders)) unset($disable_borders); ?>