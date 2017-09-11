  <?php if(isset($fields) && is_array($fields) && count($fields) > 0) : ?>

  <?php else : ?>
    <?php
      $fields = array(
        (object)array('field' => 'bmi', 'label' => 'BMI', ),
        (object)array('field' => 'weight', 'label' => 'Gewicht (kg)', ),
        (object)array('field' => 'size', 'label' => 'Größe (m)', 'disable_fill' => TRUE, ),
      );
    ?>
  <?php endif; ?>
<?php
if(count($entries)>0 && !empty($entries) && count($fields)>0){
foreach($entries as $key=>$val){
    $year = date("Y",strtotime($val->rec_date));
    $month = date("m",strtotime($val->rec_date))-1;
    $day = date("d",strtotime($val->rec_date));
    $hour = date("H",strtotime($val->rec_time));
    $min = date("i",strtotime($val->rec_time));
    $second = date("s",strtotime($val->rec_time));
    
//    $rec_array = explode("-",$val->rec_date);
//    echo $month;die;
//    $month = $rec_array[1]-1;
   // $height = $val->size*100;
//   $bmi.="[Date.UTC(".$rec_array[0].",".$month.",".$rec_array[2]."), ".$val->bmi."],";
//   $weight.="[Date.UTC(".$rec_array[0].",".$month.",".$rec_array[2]."), ".$val->weight."],";
//   $height.="[Date.UTC(".$rec_array[0].",".$month.",".$rec_array[2]."), ".$val->size."],";
       foreach($fields as $field){
        if(trim($val->{$field->field})==""){
            continue;
        }
   ${$field->field}.="[Date.UTC(".$year.",".$month.",".$day.",".$hour.",".$min.",".$second."), ".$val->{$field->field}."],";
    }

//   $bmi.="[Date.UTC(".$year.",".$month.",".$day.",".$hour.",".$min.",".$second."), ".$val->bmi."],";
//   $weight.="[Date.UTC(".$year.",".$month.",".$day.",".$hour.",".$min.",".$second."), ".$val->weight."],";
//   $height.="[Date.UTC(".$year.",".$month.",".$day.",".$hour.",".$min.",".$second."), ".$val->size."],";
}
foreach($fields as $key=>$field){
        
   if(trim(${$field->field}) =='' || !isset(${$field->field})){       
       unset($fields[$key]);
//   ${$field->field}.="[Date.UTC(".$year.",".$month.",".$day.",".$hour.",".$min.",".$second."), ".$val->{$field->field}."],";
    }
  
}
$nograph=false;
}
else{
    $nograph=true;
}
?>

 <?php
 if(count($entries)>0 && !empty($entries) && count($fields)>0){ 
            echo "<div class='blog-list'>";

//             usort($arr, function($a, $b){
//            return strtotime($a->date_added) < strtotime($b->date_added) ? 1 : (strtotime($a->date_added) == strtotime($b->date_added) ? ($a->document_date < $b->document_date ? 1 : -1) : -1);
//            });      
            if($feed){
           $entry=$entries[0];
  ?>
    <div class="blog-block blog-cyan <?php //echo $colorclass;?>">
          <div class="date-block">
        <div class="date-meta"><?php echo date('d',strtotime($entry->rec_date));?>. <span><?php echo date('M',strtotime($entry->rec_date));?></span></div>
            </div>
       
  <?php
            }
             else{
            ?>
    
    <div class="blog-block blog-cyan blog-module ">
            <?php
            
        }
?>
  <div class="blog-text">
      
  <div class="row" id="<?php echo $scope_id = 'scope_'.random_string('alnum', 32); ?>">
   <?php /*<div class="col-md-12">

      <?php $this->ui->tile->rebase(); ?>
      <?php
        $this->ui->tile->options('class', 'm-b-10 m-t-0 m-l-0 m-r-0');
        $this->ui->tile->title('content', isset($title) ? $title : $this->lang->line('overview_lang_blood_bmi_title'));
        $this->ui->tile->config->append('tile_info_toggle', array(
          'tile_info_toggle' => TRUE, 
          'text' => 'Werte Info Panel',
        ));

        $this->ui->tile->config->append('reload', array(
          'href' => 'javascript:void(0);', 
          'text' => 'Nachladen',
        ));

        $this->ui->tile->config->append('new_point', array(
          'href' => '#'.($new_point_modal_id = random_string('alnum', 32)), 
          'attr' => array(
            'data-toggle' => 'modal',
          ),
          'text' => '<span class="icomoon i-plus-circle"></span> ' . $this->lang->line('pwidget_plot_graph_new_point'),
        ));

        $this->ui->tile->body->options('class', array('p-10', ));
        $this->ui->tile->body(
          'content',
          '<div id="'.($graph_id = 'graph_'.random_string('alnum', 32)).'" class="main-chart" style="height: 250px"></div>'
        );
      ?>

      <?php ob_start();  ?>

        <div class="chart-info <?php echo Ui::$bs_tname == 'sa103' ? '' : 'hidden'; ?>" style="display:none;">
          <ul class="list-unstyled">
            <?php foreach ($fields as $field_index => $field) : ?>
              <?php
                $pct = 
                  isset($entries) && is_array($entries) && count($entries) > 1 ? 
                  ($entries[count($entries) - 2]->{$field->field} != 0 ?
                    ( $entries[count($entries) - 1]->{$field->field} - $entries[count($entries) - 2]->{$field->field} ) / $entries[count($entries) - 2]->{$field->field} : 
                    0
                  ) : 
                  0;
              ?>
              <li>
                <small>
                  <?php echo $field->label; ?>
                  <span class="pull-right text-muted t-s-0">
                    <i class="fa m-l-15 fa-chevron-<?php echo $pct != 0 ? ($pct > 0 ? 'up' : 'down') : ''; ?>"></i>
                    <?php echo round($pct * 1000) / 10; ?>%
                  </span>
                </small>
                <div class="progress progress-small">
                  <div class="progress-bar <?php echo $pct < 0 ? 'pull-right' : ''; ?>" role="progressbar" aria-valuenow="<?php echo $pct != 0 ? abs($pct * 100) : 50; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $pct != 0 ? abs($pct * 100) : 50; ?>%; background-color: rgb(<?php echo implode(', ', $field->color); ?>);"></div>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        </div> 

      <?php 
        $buffer = ob_get_contents();
        @ob_end_clean();
      ?>

      <?php
        $this->ui->tile->body->content .= $buffer;
        echo $this->ui->tile->output();
      ?>

      <?php
        $this->load->view('graph/insert_modal_view', array(
          'modal_id' => $new_point_modal_id,
          'modal_title' => $this->lang->line('pwidget_plot_graph_new_point'),
          'table' => 'weight_bmi',
          'entry' => (object) array(
            'id' => 0,
            'size' => '',
            'weight' => '',
            'bmi' => '',
          ),
        ));
      ?>

    </div>
<?php */?>
  </div>
      <?php if($feed){
          ?>
<div class="read-more"><a href="<?php echo site_url('/akte/vital_values/weight_bmi'); ?>" class="ajax-load-link">Details</a>&nbsp;<span class="fa fa-chevron-right fa-right"></span></div>
</div>  
    <?php } ?>
     </div>
</div>       <?php    
//print_r($bmi);echo "<br/><br/>";
//print_r($weight);echo "<br/><br/>";
//print_r($size);echo "<br/><br/>";
//die;
            }
       
  ?>         

  <?php /* $rand_arr = array(); ?>

  <?php foreach ($fields as $field_index => $field) : ?>

    <?php
      for ( $new_color_rand = mt_rand(1, 4) ; !empty($rand_arr) && in_array($new_color_rand, $rand_arr); $new_color_rand = mt_rand(1, 4) ) {}
      $rand_arr[] = $color_rand = $new_color_rand;

      $fields[$field_index]->color =
          $color_rand <= 1 ? array('255', '214', '0') : 
        ( $color_rand <= 2 ? array('91', '192', '222', ) : 
        ( $color_rand <= 3 ? array('217', '83', '79', ) : 
        ( $color_rand <= 4 ? array('92', '184', '92', ) : array('0', '0', '0', )
      ) ) );
    ?>

  <?php endforeach; */?>

<script>
    $('.ajax-load-link').click(function(e) 
         {
          e.preventDefault();
         
          if ($(this).attr('href').indexOf('javascript:') < 0)
          $.loadUrl($(this).attr('href'), $('#content'));
         });
    $(document).ready(function() {
        <?php if(!$nograph && count($fields)>0){?>
 $('#<?php echo $scope_id;?>').highcharts({
        chart: {
            type:'stack',
            zoomType: 'x'
        },
        title: {
            text: '<?php echo  strtoupper($this->lang->line('pwidget_plot_graph_weight_title')); ?>'
        },
        xAxis: [{
            type: 'datetime',
            dateTimeLabelFormats: { // don't display the dummy year
                 month: '%e. %b',
                 year: '%b'
            },
            title: {
                text: '<?php echo  strtoupper($this->lang->line('pwidget_plot_graph_insert_date')); ?>'
            },
            crosshair: true
        }],
        yAxis: [{ // Primary yAxis
            labels: {
                format: '{value} CM',
                style: {
                    color: Highcharts.getOptions().colors[2]
                }
            },
            title: {
                text: '<?php echo  strtoupper($this->lang->line('pwidget_plot_graph_height')); ?>',
                style: {
                    color: Highcharts.getOptions().colors[2]
                }
            },
            opposite: true

        }, { // Secondary yAxis
            gridLineWidth: 0,
            title: {
                text: '<?php echo  strtoupper($this->lang->line('pwidget_plot_graph_bmi')); ?>',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            labels: {
                format: '{value}',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            }

        }, { // Tertiary yAxis
            gridLineWidth: 0,
            title: {
                text: '<?php echo  strtoupper($this->lang->line('pwidget_plot_graph_weight')); ?>',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            },
            labels: {
                format: '{value} Kg',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            },
            opposite: true
        }],
        tooltip: {
            shared: true
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            x: 80,
            verticalAlign: 'top',
            y: 55,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
        },
          plotOptions: {
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },
        series: [
        <?php if(isset($bmi) && !empty($bmi)){ ?>
        {
            name: '<?php echo  strtoupper($this->lang->line('pwidget_plot_graph_bmi')); ?>',
            type: 'column',
            yAxis: 1,
            pointInterval: 24 * 3600 * 1000,
            data: [<?php echo $bmi; ?>],
            tooltip: {
                valueSuffix: ''
            }

        }, <?php } if(isset($weight) && !empty($weight)){ ?> 
        {
            name: '<?php echo  strtoupper($this->lang->line('pwidget_plot_graph_weight')); ?>',
            type: 'spline',
            yAxis: 2,
            pointInterval: 24 * 3600 * 1000,
            data: [<?php echo $weight; ?>],
            marker: {
                enabled: false
            },
            dashStyle: 'shortdot',
            tooltip: {
                valueSuffix: ' KG'
            }

        },<?php } if(isset($size) && !empty($size)){ ?> 
        {
            name: '<?php echo  strtoupper($this->lang->line('pwidget_plot_graph_height')); ?>',
            type: 'spline',
            pointInterval: 24 * 3600 * 1000,
            data: [<?php echo $size; ?>],
            tooltip: {
                valueSuffix: 'CM'
            }
         } <?php } ?>  
        ]
    });
      <?php 
        }
      
      /*$this->load->view('graph/tile_script_view', array(
        'tile_script_graph_id' => $graph_id,
        'tile_script_entries' => $entries,
        'tile_script_fields' => $fields,
        'tile_script_new_point_modal_id' => $new_point_modal_id, 
      ));*/ ?>

    });

  </script>
  <script>
    $.pageSetup($('#<?php echo $scope_id; ?>'));
  </script>      


