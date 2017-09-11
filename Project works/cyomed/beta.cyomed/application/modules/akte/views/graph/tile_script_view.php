

  <?php $xaxis_color_1 = Ui::$bs_tname == 'sa103' ? array(255, 255, 255, 0.05) : array(0, 0, 0, 0.05); ?>
  <?php $xaxis_color_2 = Ui::$bs_tname == 'sa103' ? array(255, 255, 255, 0.8) : array(0, 0, 0, 0.8); ?>

  <?php $yaxis_color_1 = Ui::$bs_tname == 'sa103' ? array(255, 255, 255, 0.15) : array(0, 0, 0, 0.2); ?>
  <?php $yaxis_color_2 = Ui::$bs_tname == 'sa103' ? array(255, 255, 255, 0.8) : array(0, 0, 0, 0.8); ?>

  // ==========
  // PLOT GRAPH
  // ==========

  if ($('#<?php echo $tile_script_graph_id; ?>')[0]) {

    <?php if(isset($tile_script_entries) && is_array($tile_script_entries) && count($tile_script_entries) > 0) : ?>

      var d = {};

      <?php foreach ($tile_script_fields as $field_index => $field) : ?>
      
        d['<?php echo $field->field; ?>'] = [
          <?php if(isset($tile_script_entries) && is_array($tile_script_entries) && count($tile_script_entries) > 0) : foreach ($tile_script_entries as $entry_index => $entry) : ?>
            <?php if (!empty($entry->{$field->field})) : ?>
              <?php
                $time = $entry->rec_date.' ';
                $time .= (!empty($entry->rec_time) && strlen($entry->rec_time) == 5 ? $entry->rec_time : '00:00').':00';
                if (($time = strtotime($time)) === FALSE)
                {
                  if (($time = strtotime($entry->rec_date.' '.'00:00:00')) === FALSE)
                  {
                    continue;
                  }
                }

                if ($time < 0)
                {
                  continue;
                }

              ?>
              [new Date(<?php echo $time; ?>000), <?php echo $entry->{$field->field}; ?>, <?php echo json_encode($entry) ?>, ],
            <?php endif; ?>
          <?php endforeach; endif; ?>
        ];

      <?php endforeach; ?>

      $.plot('#<?php echo $tile_script_graph_id; ?>', [
      
        <?php foreach ($tile_script_fields as $field_index => $field) : ?>
        
          {
            data: d["<?php echo $field->field ?>"],
            label: "<?php echo $field->label; ?>",
            color: 
              <?php if (Ui::$bs_tname == 'sa103') : ?>
                "<?php echo !empty($field->color) && is_array($field->color) ? ('rgba('.implode(', ', $field->color).', .8)') : 'rgba(255, 255, 255, .8)'; ?>",
              <?php endif; ?>
              <?php if (Ui::$bs_tname == 'mvpr110') : ?>
                
                "<?php echo !empty($field->color) && is_array($field->color) ? ('rgba('.implode(', ', $field->color).', .8)') : 'rgba(255, 255, 255, .8)'; ?>",
              <?php endif; ?>
            lines: {
              <?php if (empty($field->disable_fill)) : ?>
                fill: 0.25,
              <?php endif; ?>
              <?php if (empty($field->disable_fill)) : ?>
                fillColor: 
                  <?php if (Ui::$bs_tname == 'sa103') : ?>
                    "<?php echo !empty($field->color) ? ('rgba('.implode(', ', $field->color).', .15)') : 'rgba(255, 255, 255, .15)'; ?>",
                  <?php endif; ?>
                  <?php if (Ui::$bs_tname == 'mvpr110') : ?>
                    
                    "<?php echo !empty($field->color) ? ('rgba('.implode(', ', $field->color).', .15)') : 'rgba(255, 255, 255, .15)'; ?>",
                  <?php endif; ?>
              <?php endif; ?>
            },
            yaxis: <?php echo (isset($field->axis) ? $field->axis : $field_index) + 1; ?>,
          },

        <?php endforeach; ?>

      ], {

        series: {
          lines: {
            show: true,
            lineWidth: 1,
            // fill: 0.25,
            // fillColor: 'rgba(255,255,255,0.25)',
          },

          color: 'rgba(255,255,255,0.7)',
          shadowSize: 4,
          points: {
            show: true,
          }
        },

        yaxes: [ {
          // min: 15,
          // max: 50,
          position: 'left',
          tickColor: 'rgba(<?php echo implode(',', $yaxis_color_1) ?>)',
          tickDecimals: 0,
          font: {
            lineHeight: 13,
            style: "normal",
            color: "rgba(<?php echo implode(',', $yaxis_color_2) ?>)",
          },
          shadowSize: 0,
          // zoomRange: [0, 9],
          // panRange: [0, 30],
        }, {
          // min: 15,
          // max: 50,
          position: 'right',
          tickColor: 'rgba(<?php echo implode(',', $yaxis_color_1) ?>)',
          tickDecimals: 0,
          font: {
            lineHeight: 13,
            style: "normal",
            color: "rgba<?php echo implode(',', $yaxis_color_2) ?>)",
          },
          shadowSize: 0,
          // zoomRange: [0, 9],
          // panRange: [0, 30],
        }, {
          // min: 15,
          // max: 50,
          position: 'right',
          tickColor: 'rgba(<?php echo implode(',', $yaxis_color_1) ?>)',
          tickDecimals: 0,
          font: {
            lineHeight: 13,
            style: "normal",
            color: "rgba(<?php echo implode(',', $yaxis_color_2) ?>)",
          },
          shadowSize: 0,
          // zoomRange: [0, 9],
          // panRange: [0, 30],
        }, {
          // min: 15,
          // max: 50,
          position: 'right',
          tickColor: 'rgba(<?php echo implode(',', $yaxis_color_1) ?>)',
          tickDecimals: 0,
          font: {
            lineHeight: 13,
            style: "normal",
            color: "rgba(<?php echo implode(',', $yaxis_color_2) ?>)",
          },
          shadowSize: 0,
          // zoomRange: [0, 9],
          // panRange: [0, 30],
        }, ],

        xaxis: {
          mode: 'time',
          // timeformat: '%d.%m.%Y %H:%M:%S',
          timeformat: '%d.%m.%y',
          tickColor: 'rgba(<?php echo implode(',', $xaxis_color_1) ?>)',
          // tickDecimals: 0,
          // minTickSize: [5, 'hour'],
          // tickSize: [1, 'month'],
          font: {
            lineHeight: 13,
            style: "normal",
            color: "rgba(<?php echo implode(',', $xaxis_color_2) ?>)",
          },
        },
        grid: {
          borderWidth: 1,
          borderColor: 'rgba(255,255,255,0.25)',
          labelMargin: 10,
          hoverable: true,
          clickable: true,
          mouseActiveRadius: 6,
        },
        legend: {
          // show: false
          backgroundOpacity: 0.4,
          <?php if (Ui::$bs_tname == 'sa103') : ?>
            labelBoxBorderColor: "none",
          <?php endif; ?>
          backgroundColor: 'rgba(255,255,255,1)',
          position: "nw",
        },
        zoom: {
          interactive: true
        },
        pan: {
          interactive: true
        },
      });

      $("#<?php echo $tile_script_graph_id; ?>").bind("plothover", function(event, pos, item) {
        if (item) {
          var
            x = item.datapoint[0].toFixed(2),
            y = item.datapoint[1].toFixed(2);
          $("#linechart-tooltip").html(item.series.label + ": " + y + '<br/>' + moment(item.datapoint[0]).format('DD.MM.YYYY HH:mm:ss')).css({
            top: item.pageY + 5,
            left: item.pageX + 5
          }).fadeIn(200);
        } else {
          $("#linechart-tooltip").hide();
        }
      }).bind("plotclick", function(event, pos, item) {
        if (item) {
          var $modal = $('#<?php echo $tile_script_new_point_modal_id; ?>'), v;

          $modal.data('entry', item.series.data[item.dataIndex][2]);
          $modal.modal('show');

          $("#linechart-tooltip").hide();

        } else {
          
        }
      });

    <?php endif; ?>
  }


