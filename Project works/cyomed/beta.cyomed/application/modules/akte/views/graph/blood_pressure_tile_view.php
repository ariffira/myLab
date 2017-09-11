<?php if(isset($fields) && is_array($fields) && count($fields) > 0) : ?>
<?php else : ?>
<?php
      $fields = array(
        (object)array('field' => 'rr_sys', 'label' => 'RR systolisch', 'axis' => 0, ),
        (object)array('field' => 'rr_dia', 'label' => 'RR diastolisch', 'axis' => 0, ),
	(object)array('field' => 'puls', 'label' => 'Puls', 'axis' => 0, ),
      );

    ?>
<?php endif; ?>

<?php
if(count($entries)>0 && !empty($entries) && count($fields)>0 ){

foreach($fields as $key=>$field){
    
${$field->field}="";
}
foreach($entries as $key=>$val){
    $year = date("Y",strtotime($val->rec_date));
    $month = date("m",strtotime($val->rec_date))-1;
    $day = date("d",strtotime($val->rec_date));
    $hour = date("H",strtotime($val->rec_time));
    $min = date("i",strtotime($val->rec_time));
    $second = date("s",strtotime($val->rec_time));
    foreach($fields as $field){
  ${$field->field}.="[Date.UTC(".$year.",".$month.",".$day.",".$hour.",".$min.",".$second."), ".$val->{$field->field}."],";
    }
}
foreach($fields as $key=>$field){
   if(trim(${$field->field}) =='' || !isset(${$field->field})){
       unset($fields[$key]);
    }
}
  $nograph=false;
}
 else {
     $nograph=true;
}
?>

 <?php
 if(count($entries)>0 && !empty($entries) && count($fields)>0){ 
     ?>
        <div class='blog-list'>
         <?php
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
            
        } ?>
        
    <div class="blog-text">
      <div class="row" id="<?php echo $scope_id = 'scope_'.random_string('alnum', 32); ?>">
      </div>
        
        
           <?php if($feed){ ?>
      <div class="read-more">
<a href="<?php echo site_url('/akte/vital_values/blood_pressure'); ?>" class="ajax-load-link">Details</a>
&nbsp;
<span class="fa fa-chevron-right fa-right"></span>
</div>
        <?php } ?>
</div>
        </div>
<!--    </div>-->
           
 
 
 
 
    <?php }  if(($graph_sbp!='' || $graph_dbp!='' || $graph_hp!='')&& $feed && $withing){
        
         $this->load->language('pwidgets/withings',$this->m->user_value('language'));
         ?> 

        <div class="blog-block blog-cyan">
     <div class="blog-text">
      <div class="row" id="withings_graph_bp">
      </div>
      <br /><br />   
      <div class="row" id="withings_graph_hp">
      </div>   
      <div class="read-more"><a href="javscritp:void(0)" class="ajax-feed-link1"  onclick='$("#withings_link").click();'>
              Withings Details</a>&nbsp;
              <span class="fa fa-chevron-right fa-right"></span>
      </div>
     </div></div>
<?php     }  
if(count($entries)>0 && !empty($entries) && count($fields)>0){
    echo "</div>";
 }
?>
            <script type="text/javascript">
                
    $(document).ready(function() {
        <?php if(!$nograph && count($fields)>0) {?>
    
    $('#<?php echo $scope_id; ?>').highcharts({
        chart: {
            type: 'spline',
            zoomType: 'x'
        },
        title: {
            text: '<?php echo $title; ?>'
        },
        xAxis:{
            type: 'datetime',
            dateTimeLabelFormats: { // don't display the dummy year
                month: '%e. %b',
                year: '%b'
            },
            title: {
                text: '<?php echo strtoupper($this->lang->line('pwidget_plot_graph_insert_date')); ?>'
            },
            crosshair:true
        },
        yAxis: {
            title: {
                text: '<?php echo $title ?>'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [
            <?php  foreach($fields as $field){ echo "{
           
            name: '".strtoupper($field->label)."',
            pointInterval: 24 * 3600 * 1000,
            data: [${$field->field}]
                             },";
            }
            ?>          
          ]
          
    });

<?php }?>



<?php  if(($graph_sbp!='' || $graph_dbp!='' )&& $feed && $withing){ ?>
     $('#withings_graph_bp').highcharts({

        chart: {

            type: 'spline',
			zoomType: 'x'

        },

        title: {

            text: '<?php echo strtoupper($this->lang->line('withings_blood_pres')); ?>'

        },

        xAxis: {

            type: 'datetime',

            dateTimeLabelFormats: { // don't display the dummy year

                month: '%e. %b',

                year: '%b'

            },

            title: {

                text: 'DATE'

            }

        },

        yAxis: {

            title: {

                text: '<?php echo strtoupper($this->lang->line('withings_blood_pres')); ?> (MMHG)'

            },

            min: 0

        },

        tooltip: {

            headerFormat: '<b>{series.name}</b><br>',

            pointFormat: '{point.x:%e. %b}: {point.y:.2f} MMHG'

        },



        plotOptions: {

            spline: {

                marker: {

                    enabled: true

                }

            }

        },
      series: [{

            name: '<?php echo strtoupper($this->lang->line('withings_blood_pres_x_cord_dias')); ?>',

            data: <?php echo $graph_dbp; ?>

        },
        {

            name: '<?php echo strtoupper($this->lang->line('withings_blood_pres_x_cord_sys')); ?>',

            data: <?php echo $graph_sbp; ?>

        }
        ]

    });
    <?php } ?>


<?php  if(($graph_hp!=''  )&& $feed && $withing){ ?>
    $('#withings_graph_hp').highcharts({

        chart: {

            type: 'spline',
			zoomType: 'x'

        },

        title: {

            text: '<?php echo strtoupper($this->lang->line('withings_heart_puls')); ?> '

        },

        xAxis: {

            type: 'datetime',

            dateTimeLabelFormats: { // don't display the dummy year

                month: '%e. %b',

                year: '%b'

            },

            title: {

                text: 'DATE'

            }

        },

        yAxis: {

            title: {

                text: '<?php echo strtoupper($this->lang->line('withings_heart_puls')); ?>  (BPM)'

            },

            min: 0

        },

        tooltip: {

            headerFormat: '<b>{series.name}</b><br>',

            pointFormat: '{point.x:%e. %b}: {point.y:.2f} BPM'

        },



        plotOptions: {

            spline: {

                marker: {

                    enabled: true

                }

            }

        },
      series: [{

            name: '<?php echo strtoupper($this->lang->line('withings_heart_puls')); ?>',

            data: <?php echo $graph_hp; ?>

        }]

    });
<?php }?>

});
  $.pageSetup($('#<?php echo $scope_id; ?>'));
            </script>