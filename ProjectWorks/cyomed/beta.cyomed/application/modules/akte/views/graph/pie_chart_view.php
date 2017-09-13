  

  <?php if (!empty($pie_charts) && is_array($pie_charts)) : foreach($pie_charts as $pie) : ?>

    <?php $this->ui->pie_chart->rebase(); ?>
    <?php
      if (isset($pie->value))
      {
        $this->ui->pie_chart->options('value', $pie->value);
      }
      if (isset($pie->range))
      {
        $this->ui->pie_chart->options('range', $pie->range);
      }
      if (isset($pie->title))
      {
        $this->ui->pie_chart->title('content', $pie->title);
      }
      if (isset($pie->no_percent))
      {
        $this->ui->pie_chart->options('no_percent', $pie->no_percent);
      }
      echo $this->ui->pie_chart->output();
    ?>

  <?php endforeach; endif; ?>

  <script type="text/javascript">

    /* --------------------------------------------------------
     Easy Pie Charts
     -----------------------------------------------------------*/

    <?php $pie_chart_color = Ui::$bs_tname == 'mvpr110' ? array(0, 0, 0, ) : array(255, 255, 255, ); ?>

    $(function() {
      $('.pie-chart-tiny').easyPieChart({
        easing: 'easeOutBounce',
        barColor: 'rgba(<?php echo implode(',', $pie_chart_color); ?>,0.75)',
        trackColor: 'rgba(0,0,0,0.3)',
        scaleColor: 'rgba(<?php echo implode(',', $pie_chart_color); ?>,0.3)',
        lineCap: 'square',
        lineWidth: 4,
        size: 100,
        animate: 3000,
        onStep: function(from, to, percent) {
          if ($(this.el).find('.percent').hasClass('no-percent')) {
            $(this.el).find('.percent').text($(this.el).data('value-real') || $(this.el).attr('data-value-real'));
          } else {
            $(this.el).find('.percent').text(Math.round(percent));
          }
        }
      });

      $('.pie-chart-tiny .pie-title > i').on('click', function() {
        $(this).closest('.pie-chart-tiny').data('easyPieChart').update(Math.random() * 200 - 100);
      });
    });

  </script>