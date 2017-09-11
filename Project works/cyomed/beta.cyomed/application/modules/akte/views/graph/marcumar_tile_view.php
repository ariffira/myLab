
     <?php if(isset($fields) && is_array($fields) && count($fields) > 0) : 
   else :     
      $fields = array(
        (object)array('field' => 'quick', 'label' => $this->lang->line('pwidget_plot_graph_quick_title'), ),
        (object)array('field' => 'INR', 'label' => $this->lang->line('pwidget_plot_graph_inr_title'), 'axis' => 1, ),
        (object)array('field' => 'upper_limit', 'label' => 'Obergrenze', 'disable_fill' => TRUE, 'axis' => 1, ),
        (object)array('field' => 'lower_limit', 'label' => 'Untergranze', 'disable_fill' => TRUE, 'axis' => 1, ),
      );
    ?>
  <?php endif; ?>

<?php   if(count($entries)>0 && !empty($entries) && count($fields)>0 ){
    foreach($entries as $key=>$val){
	$val->upper_limit = is_numeric($val->upper_limit)?$val->upper_limit:'';
	$val->lower_limit = is_numeric($val->lower_limit)?$val->lower_limit:'';
    $year = date("Y",strtotime($val->rec_date));
    $month = date("m",strtotime($val->rec_date))-1;
    $day = date("d",strtotime($val->rec_date));
    $hour = date("H",strtotime($val->rec_time));
    $min = date("i",strtotime($val->rec_time));
    $second = date("s",strtotime($val->rec_time));
	
//    $rec_array = explode("-",$val->rec_date);
//    $month = $rec_array[1]-1;
    foreach($fields as $field){
        if(trim($val->{$field->field})==""){
            continue;
        }
   ${$field->field}.="[Date.UTC(".$year.",".$month.",".$day.",".$hour.",".$min.",".$second."), ".$val->{$field->field}."],";
    }
    
//   $quick.="[Date.UTC(".$rec_array[0].",".$month.",".$rec_array[2]."), ".$val->quick."],";
//   $upper_limit.="[Date.UTC(".$rec_array[0].",".$month.",".$rec_array[2]."), ".$val->upper_limit."],";
//   $lower_limit.="[Date.UTC(".$rec_array[0].",".$month.",".$rec_array[2]."), ".$val->lower_limit."],";
//    print_r($fields);
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
 if(count($entries)>0 && !empty($entries)  && count($fields)>0){      
//             usort($arr, function($a, $b){
//            return strtotime($a->date_added) < strtotime($b->date_added) ? 1 : (strtotime($a->date_added) == strtotime($b->date_added) ? ($a->document_date < $b->document_date ? 1 : -1) : -1);
//            });  
            ?>
        <div class='blog-list'>
<?php 
            if($feed){
           $entry=$entries[0];
  ?>
     <div class="blog-block blog-blue">
          <div class="date-block">
        <div class="date-meta"><?php echo date('d',strtotime($entry->rec_date));?>. <span><?php echo date('M',strtotime($entry->rec_date));?></span></div>
            </div>
       
  <?php
            }
             else{
            ?>
    
    <div class="blog-block blog-blue blog-module">
            <?php
            
        }
        ?>
         
           <div class="blog-text">
  <div class="row" id="<?php echo $scope_id = 'scope_'.random_string('alnum', 32); ?>">
 

 </div>
               <?php   if($feed){?>
    <div class="read-more">
        <a href="<?php echo site_url('/akte/vital_values/marcumar'); ?>" class="ajax-load-link">Details</a>
        &nbsp;
        <span class="fa fa-chevron-right fa-right"></span>
    </div>
    <?php } ?>
    </div>
            </div>
</div>
         <?php 
            }
       
//        echo "<pre>";print_R($entries);
  ?>         

 
      
 
<?php 
//print_r($fields);die;
//$INR = '';
//$quick = '';
//$upper_limit = '';
//$lower_limit = '';
//foreach($entries as $key=>$val){
//    $rec_array = explode("-",$val->rec_date);
//    $month = $rec_array[1]-1;
//   $INR.="[Date.UTC(".$rec_array[0].",".$month.",".$rec_array[2]."), ".$val->INR."],";
//   $quick.="[Date.UTC(".$rec_array[0].",".$month.",".$rec_array[2]."), ".$val->quick."],";
//   $upper_limit.="[Date.UTC(".$rec_array[0].",".$month.",".$rec_array[2]."), ".$val->upper_limit."],";
//   $lower_limit.="[Date.UTC(".$rec_array[0].",".$month.",".$rec_array[2]."), ".$val->lower_limit."],";
//}

//      foreach($entries as $key=>$val){
//        $year = date("Y",strtotime($val->rec_date));
//    $month = date("m",strtotime($val->rec_date))-1;
//    $day = date("d",strtotime($val->rec_date));
//    $hour = date("H",strtotime($val->rec_time));
//    $min = date("i",strtotime($val->rec_time));
//    $second = date("s",strtotime($val->rec_time));
//      }
//        foreach($fields as $field){
//            foreach($entries as $key=>$val){
//	$val->upper_limit = is_numeric($val->upper_limit)?$val->upper_limit:'';
//	$val->lower_limit = is_numeric($val->lower_limit)?$val->lower_limit:'';
//                
//            }
//        if($val->{$field->field}!="")
//   ${$field->field}.="[Date.UTC(".$year.",".$month.",".$day.",".$hour.",".$min.",".$second."), ".$val->{$field->field}."],";
//    }

?>
  
  <script type="text/javascript">
     $('.ajax-load-link').click(function(e) 
         {
          e.preventDefault();
         
          if ($(this).attr('href').indexOf('javascript:') < 0)
          $.loadUrl($(this).attr('href'), $('#content'));
         });

    $(document).ready(function() {
        <?php if(!$nograph && count($fields)>0){ ?>
            $('#<?php echo $scope_id; ?>').highcharts({
        chart: {
            type: 'spline',
			zoomType: 'x'
        },
        title: {
            text: '<?php echo $title_main=isset($title) ?  strtoupper($title) : strtoupper($this->lang->line('pwidget_plot_graph_marcumar_title')) ?>'
        },xAxis:{
            type: 'datetime',
            dateTimeLabelFormats: { // don't display the dummy year
                month: '%e. %b',
                year: '%b'
            },
            title: {
                text: '<?php echo  strtoupper($this->lang->line('pwidget_plot_graph_insert_date')) ?>'
            },
            crosshair:true
        },
        yAxis: {
            title: {
                text: '<?php echo $label_main=isset($label) ?  strtoupper($label) : strtoupper($this->lang->line('pwidget_plot_graph_marcumar_title'))?>'
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

    <?php } ?>
    });

    $.pageSetup($('#<?php echo $scope_id; ?>'));

  </script>      