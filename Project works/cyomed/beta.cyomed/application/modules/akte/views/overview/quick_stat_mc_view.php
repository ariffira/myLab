
  <div class="row">

    <?php if (!empty($quick_stats) && is_array($quick_stats)) : foreach($quick_stats as $stat) : ?>

      <div class="col-md-3">

        <?php $this->load->view('graph/quick_stat_view', array(
          'desc' => !empty($stat['desc']) ? $stat['desc'] : '',
          'entries' => !empty($stat['entries']) ? $stat['entries'] : NULL,
          'field' => !empty($stat['field']) ? $stat['field'] : NULL,
        )); ?>

      </div>

    <?php endforeach; endif; ?>

  </div>