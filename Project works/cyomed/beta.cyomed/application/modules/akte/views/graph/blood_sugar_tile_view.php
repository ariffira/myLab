  <?php if(isset($fields) && is_array($fields) && count($fields) > 0) : ?>

  <?php else : ?>
    <?php
      $fields = array(
        (object)array('field' => 'bloodsugar', 'label' => 'Blutzucker (mg/dl)', ),
        (object)array('field' => 'HbA1C', 'label' => 'HbA1C', ),
      );
    ?>
  <?php endif; ?>

<?php
if(count($entries)>0 && !empty($entries) && count($fields)>0 ){
$HbA1C = '';
$bloodsugar = '';
foreach($entries as $key=>$val){
//    $rec_array = explode("-",$val->rec_date);
//    $month = $rec_array[1]-1;
        $year = date("Y",strtotime($val->rec_date));
    $month = date("m",strtotime($val->rec_date))-1;
    $day = date("d",strtotime($val->rec_date));
    $hour = date("H",strtotime($val->rec_time));
    $min = date("i",strtotime($val->rec_time));
    $second = date("s",strtotime($val->rec_time));
    foreach($fields as $field){
        if(trim($val->{$field->field})==""){
            continue;
        }
        
   ${$field->field}.="[Date.UTC(".$year.",".$month.",".$day.",".$hour.",".$min.",".$second."), ".$val->{$field->field}."],";
    }
//   $bloodsugar.="[Date.UTC(".$year.",".$month.",".$day.",".$hour.",".$min.",".$second."), ".$val->bloodsugar."],";
//   $HbA1C.="[Date.UTC(".$year.",".$month.",".$day.",".$hour.",".$min.",".$second."), ".$val->HbA1C."],";
  
}
foreach($fields as $key=>$field){
    
   if(trim(${$field->field}) =='' || !isset(${$field->field})){
       unset($fields[$key]);
//   ${$field->field}.="[Date.UTC(".$year.",".$month.",".$day.",".$hour.",".$min.",".$second."), ".$val->{$field->field}."],";
    }
  
}
$nograph=false;
}
 else {
     $nograph=true;
}
?>


  <?php
 if(count($entries)>0 && !empty($entries)  && count($fields)>0){ 
//     echo "<pre>";print_r($entries);
//     echo "<pre>";print_r($fields);die;
//             usort($arr, function($a, $b){
//            return strtotime($a->date_added) < strtotime($b->date_added) ? 1 : (strtotime($a->date_added) == strtotime($b->date_added) ? ($a->document_date < $b->document_date ? 1 : -1) : -1);
//            });      
            ?>
        <div class='blog-list'>
        <?php 
            if($feed){
           $entry=$entries[0];
  ?>
    <div class="blog-block blog-cyan <?php //echo $colorclass;?>">
          <div class="date-block">
        <div class="date-meta"><?php echo date('d',strtotime($entry->date_added));?>. <span><?php echo date('M',strtotime($entry->date_added));?></span></div>
            </div>
       
  <?php
            }
             else{
            ?>
    
    <div class="blog-block blog-cyan blog-module ">
            <?php
            
        }
            
//            }
//        echo "<pre>";print_R($entries);
  ?>   

  <div class="blog-text">
  <div class="row" id="<?php echo $scope_id = 'scope_'.random_string('alnum', 32); ?>">
  </div>
<?php if($feed) { ?>
<div class="read-more"><a href="<?php echo site_url('/akte/vital_values/blood_sugar'); ?>" class="ajax-blood_sugar-link">Details</a>&nbsp;<span class="fa fa-chevron-right fa-right"></span></div>
<?php }?>
</div>
     </div>
</div>
            <?php } ?>
            <script type="text/javascript">
$('.ajax-blood_sugar-link').click(function(e) 
         {
          e.preventDefault();
         
          if ($(this).attr('href').indexOf('javascript:') < 0)
          $.loadUrl($(this).attr('href'), $('#content'));
         });
    $(document).ready(function() {

$(function () {
    <?php if(!$nograph && count($fields)>0){ ?>
    $('#<?php echo $scope_id; ?>').highcharts({
        chart: {
            type: 'line',
              zoomType: 'x'
        },
        title: {
            text: 'Blood Sugar'
        },xAxis:{
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
                text: ''
            }
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                 maxPointWidth: 5
            }
        },
        series: [
             <?php  foreach($fields as $field){ echo "{
           
            name: '".strtoupper($field->label)."',
            pointInterval: 24 * 3600 * 1000,
            data: [${$field->field}],
            tooltip: {
             valueSuffix: '$field->valueSuffix '
             }
                             },";
            }
            ?>

        ]
    });
}); 
<?php } ?>
    });

  </script>

 <script>

    $(document).ready(function() {

      // ====================================
      // TILE CONFIG DROPDOWN new point clear
      // ====================================

      $('a[data-toggle="modal"][href="#<?php echo $new_point_modal_id; ?>"]').click(function() {
        $('#<?php echo $new_point_modal_id; ?>').removeData('entry');
      });

      // ================
      // MODAL OPEN EVENT
      // ================
      $('#<?php echo $new_point_modal_id; ?>').on('show.bs.modal', function () {
        if (!$(this).data('entry')) {
          $(this).find('btn-insert').toggleClass('hidden', false);
          $(this).find('btn-update').toggleClass('hidden', true);
          $(this).find('btn-delete').toggleClass('hidden', true);
        } else {
          $(this).find('btn-insert').toggleClass('hidden', true);
          $(this).find('btn-update').toggleClass('hidden', false);
          $(this).find('btn-delete').toggleClass('hidden', false);
        }

        $("#linechart-tooltip").hide();
      })


    });

    $.pageSetup($('#<?php echo $scope_id; ?>'));

  </script>      


