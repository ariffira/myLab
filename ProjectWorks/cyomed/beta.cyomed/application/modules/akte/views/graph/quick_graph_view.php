<?php

$data='[';  
$date='[';
$i=0;
foreach($entries as $entry){
    $date=$entry->rec_date;
    $d= date('d',  strtotime($date));
    $m=date('m',strtotime($date))-1;
    $y=date('Y',strtotime($date)); 
    if($entry->$field !=''){
        
          $data.='[Date.UTC('.$y.','.$m.','.$d.'),'.$entry->$field.'],';
        
    }
}
$data.=']';
$date.=']';
?>

<div id="container_<?php echo $field; ?>" style="height: 120px;" ></div>
<script type="text/javascript">
    var bloodsugar='bloodsugar';
    var puls='puls';
    var bmi='bmi';
$(function () {
    $('#container_<?php echo $field; ?>').highcharts({
	chart: {
            zoomType: 'x'
        },
      title: {
            text: ''
      },
      exporting:{
          enabled:false,
      },
        xAxis: {
              type: 'datetime',

            dateTimeLabelFormats: { 

                month: '%e. %b',

                year: '%b'

            },
             plotLines: [{
                value: 0,
                width: 0,
                color: '#808080'
            }],
             labels:{
                enabled:false
            }
        },
        yAxis: {
            title: {
                text: ''
            },
             plotLines: [{
                value: 0,
                width: 0,
                color: '#808080'
            }],
           labels:{
                enabled:false
            }
        },
         tooltip: {

            headerFormat: '<b>{series.name}</b><br>',

            pointFormat: '{point.x:%e. %b}: {point.y:.2f} <?php echo $unit; ?>'

        },
      plotOptions: {
    series: {
      cursor: 'pointer',
      marker: {
                    radius: 3,
                    lineColor: '#8f8a7a',
                    lineWidth: 1,
                    color:'#ffffff'
                },
      point: {events: {click:
                  function() {
                  if(puls=='<?php echo $field;?>')
                  {
                    $("#puls").html(this.y);  
                  }
                  if(bloodsugar=='<?php echo $field;?>')
                  {
                    $("#bloodsugar").html(this.y);    
                  }
                  if(bmi=='<?php echo $field;?>')
                  {
                   $("#bmis").html(this.y);    
                  }
                  /*alert('Category:, value: '+ this.y + 'Series:  ID: ');*/
              }}}
     }
   },
        series: [{
             color: '#b9b9b9',
                showInLegend: false,  
            name: '<?php echo  $field; ?>',
            data:  <?php echo  $data; ?>
        }
        ]
    });
});

</script>
