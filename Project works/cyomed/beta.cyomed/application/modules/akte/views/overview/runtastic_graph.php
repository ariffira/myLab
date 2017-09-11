<?php
  $this->load->language('pwidgets/runtastic',$this->m->user_value('language'));
?>
<?php 
if(count($entries)>0 && !empty($entries)) {
    echo '<div  class="blog-block">';
$date_latest=date("d-M-Y",strtotime($entries[0]->date->day.'.'.$entries[0]->date->month.'.'.$entries[0]->date->year));
    if( $graph_running_speed || $graph_pushups_speed  || $pullup_speed || $squat_speed || 
            $running_pace || $pushups_pace || $pullup_pace || $squat_pace ||
             $running_heartrate_avg || $pushup_heartrate_avg || $pullup_heartrate_avg || $squat_heartrate_avg ||
            $running_distance || $pushup_distance ||  $pullup_distance || $squat_distance ||
            $running_duration || $pushup_duration || $pullup_duration || $squat_duration 
            )
        
     ?>

          <div class="date-block">
            <div class="date-meta"><?php echo date('d',strtotime($date_latest));?>. <span><?php echo date('M',strtotime($date_latest));?></span></div>
          </div>
    <div class="blog-text">
<div class="row">
<!--	<div class="tab-pane">-->
<!--        <p class="chart_setting">-->
        <div class="col-md-4 col-offset-4">
            <select id="chart_field" name="chart_field" class="form-control">
            <option value="average_speed" selected="selected">
              <?php echo strtoupper($this->lang->line('runtastic_speed_select')); ?>
            </option>
            <option value="pace">
              <?php echo strtoupper($this->lang->line('runtastic_pace_select')); ?>
            </option>
            <option value="heart_rate">
              <?php echo strtoupper($this->lang->line('runtastic_heart_rate_select')); ?>
            </option>
            <option value="distance">
              <?php echo strtoupper($this->lang->line('runtastic_distance_select')); ?>
            </option>
            <option value="duration">
              <?php echo strtoupper($this->lang->line('runtastic_duration_select')); ?>
            </option>
          </select>
            </div>
<!--        </p>-->
</div>
<div class="row">
        <?php if($graph_running_speed || $graph_pushups_speed  || $pullup_speed || $squat_speed) ?>
        <div id="container_speed" style="width: 550px; height: 300px; margin: 0 auto"></div>
        <?php if($running_pace || $pushups_pace || $pullup_pace || $squat_pace) ?>
        <div id="container_pace" style="width: 550px; height: 300px; margin: 0 auto;display:none;"></div>
        <?php if(  $running_heartrate_avg || $pushup_heartrate_avg || $pullup_heartrate_avg || $squat_heartrate_avg) ?>
        <div id="container_heartrate" style="width: 550px; height: 300px; margin: 0 auto;display:none;"></div>
        <?php if(  $running_distance || $pushup_distance ||  $pullup_distance || $squat_distance) ?>
        <div id="container_distance" style="width: 550px; height: 300px; margin: 0 auto;display:none;"></div>
        <?php if($running_duration || $pushup_duration || $pullup_duration || $squat_duration ) ?>
        <div id="container_duration" style="width: 550px; height: 300px; margin: 0 auto;display:none;"></div>
    </div>
</div>


   
<script type="text/javascript">

$(document).ready(function(){

	$("#chart_field").on('change',function(){

	var selected = $(this).val();

	if(selected=="average_speed"){

	$("#container_speed").show();

	$("#container_pace").hide();

	$("#container_heartrate").hide();

	$("#container_distance").hide();

	$("#container_duration").hide();

	

	}else if(selected=="pace"){

	$("#container_speed").hide();

	$("#container_pace").show();

	$("#container_heartrate").hide();

	$("#container_distance").hide();

	$("#container_duration").hide();

	}else if(selected=="heart_rate"){

	$("#container_speed").hide();

	$("#container_pace").hide();

	$("#container_heartrate").show();

	$("#container_distance").hide();

	$("#container_duration").hide();

	}else if(selected=="distance"){

	$("#container_speed").hide();

	$("#container_pace").hide();

	$("#container_heartrate").hide();

	$("#container_distance").show();

	$("#container_duration").hide();

	}else if(selected=="duration"){

	$("#container_speed").hide();

	$("#container_pace").hide();

	$("#container_heartrate").hide();

	$("#container_distance").hide();

	$("#container_duration").show();

	}

	

	});

        

        

$(function () {

    $('#container_speed').highcharts({

        chart: {

            type: 'spline',
			zoomType: 'x'

        },

        title: {

            text: '<?php echo strtoupper($this->lang->line('runtastic_speed_select')); ?>'

        },

        xAxis: {

            type: 'datetime',

            dateTimeLabelFormats: { // don't display the dummy year

                month: '%e. %b',

                year: '%b'

            },

            title: {

                text: '<?php echo strtoupper($this->lang->line('runtastic_graph_date')); ?>'

            }

        },

        yAxis: {

            title: {

                text: '<?php echo strtoupper($this->lang->line('runtastic_speed_y_cord')); ?>'

            },

            min: 0

        },

        tooltip: {

            headerFormat: '<b>{series.name}</b><br>',

            pointFormat: '{point.x:%e. %b}: {point.y:.2f} km/h'

        },



        plotOptions: {

            spline: {

                marker: {

                    enabled: true

                }

            }

        },



        series: [{

            name: '<?php echo strtoupper($this->lang->line('runtastic_running_x_cord')); ?>',

            data: <?php echo $graph_running_speed; ?>

        },{

           name: '<?php echo strtoupper($this->lang->line('runtastic_pushup_x_cord')); ?>',

           data: <?php echo $graph_pushups_speed; ?> 

        },{

           name: '<?php echo strtoupper($this->lang->line('runtastic_pullup_x_cord')); ?>',

           data: <?php echo $pullup_speed; ?> 

        },{

           name: '<?php echo strtoupper($this->lang->line('runtastic_squat_x_cord')); ?>',

           data: <?php echo $squat_speed; ?> 

        }]

    });



 $('#container_pace').highcharts({

        chart: {

            type: 'spline',
			zoomType: 'x'

        },

        title: {

            text: '<?php echo strtoupper($this->lang->line('runtastic_pace_select')); ?>'

        },

        xAxis: {

            type: 'datetime',

            dateTimeLabelFormats: { // don't display the dummy year

                month: '%e. %b',

                year: '%b'

            },

            title: {

                text: '<?php echo strtoupper($this->lang->line('runtastic_graph_date')); ?>'

            }

        },

        yAxis: {

            title: {

                text: '<?php echo strtoupper($this->lang->line('runtastic_graph_date')); ?>'

            },

            min: 0

        },

        tooltip: {

            headerFormat: '<b>{series.name}</b><br>',

            pointFormat: '{point.x:%e. %b}: {point.y:.2f} min/km'

        },



        plotOptions: {

            spline: {

                marker: {

                    enabled: true

                }

            }

        },



        series: [{

            name: '<?php echo strtoupper($this->lang->line('runtastic_running_x_cord')); ?>',

            data: <?php echo $running_pace; ?>

        },{

           name: '<?php echo strtoupper($this->lang->line('runtastic_pushup_x_cord')); ?>',

           data: <?php echo $pushups_pace; ?> 

        },{

           name: '<?php echo strtoupper($this->lang->line('runtastic_pullup_x_cord')); ?>',

           data: <?php echo $pullup_pace; ?> 

        },{

           name: '<?php echo strtoupper($this->lang->line('runtastic_squat_x_cord')); ?>',

           data: <?php echo $squat_pace; ?> 

        }]

    });

    

    $('#container_heartrate').highcharts({

        chart: {

            type: 'spline',
			zoomType: 'x'

        },

        title: {

            text: '<?php echo strtoupper($this->lang->line('runtastic_graph_avr_puls')); ?>'

        },

        xAxis: {

            type: 'datetime',

            dateTimeLabelFormats: { // don't display the dummy year

                month: '%e. %b',

                year: '%b'

            },

            title: {

                text: '<?php echo strtoupper($this->lang->line('runtastic_graph_date')); ?>'

            }

        },

        yAxis: {

            title: {

                text: '<?php echo strtoupper($this->lang->line('runtastic_graph_avr_puls')); ?>'

            },

            min: 0

        },

        tooltip: {

            headerFormat: '<b>{series.name}</b><br>',

            pointFormat: '{point.x:%e. %b}: {point.y:.2f}'

        },



        plotOptions: {

            spline: {

                marker: {

                    enabled: true

                }

            }

        },



        series: [{

            name: '<?php echo strtoupper($this->lang->line('runtastic_running_x_cord')); ?>',

            data: <?php echo $running_heartrate_avg; ?>

        },{

           name: '<?php echo strtoupper($this->lang->line('runtastic_running_x_cord')); ?>',

           data: <?php echo $pushup_heartrate_avg; ?> 

        },{

           name: '<?php echo strtoupper($this->lang->line('runtastic_pullup_x_cord')); ?>',

           data: <?php echo $pullup_heartrate_avg; ?> 

        },{

           name: '<?php echo strtoupper($this->lang->line('runtastic_squat_x_cord')); ?>',

           data: <?php echo $squat_heartrate_avg; ?> 

        }]

    });

    

     $('#container_distance').highcharts({

        chart: {

            type: 'spline',
			zoomType: 'x'

        },

        title: {

            text: '<?php echo strtoupper($this->lang->line('runtastic_distance_select')); ?>'

        },

        xAxis: {

            type: 'datetime',

            dateTimeLabelFormats: { // don't display the dummy year

                month: '%e. %b',

                year: '%b'

            },

            title: {

                text: '<?php echo strtoupper($this->lang->line('runtastic_graph_date')); ?>'

            }

        },

        yAxis: {

            title: {

                text: '<?php echo strtoupper($this->lang->line('runtastic_distance_y_cord')); ?>'

            },

            min: 0

        },

        tooltip: {

            headerFormat: '<b>{series.name}</b><br>',

            pointFormat: '{point.x:%e. %b}: {point.y:.2f} km'

        },



        plotOptions: {

            spline: {

                marker: {

                    enabled: true

                }

            }

        },



        series: [{

            name: '<?php echo strtoupper($this->lang->line('runtastic_running_x_cord')); ?>',

            data: <?php echo $running_distance; ?>

        },{

           name: '<?php echo strtoupper($this->lang->line('runtastic_pushup_x_cord')); ?>',

           data: <?php echo $pushup_distance; ?> 

        },{

           name: '<?php echo strtoupper($this->lang->line('runtastic_pullup_x_cord')); ?>',

           data: <?php echo $pullup_distance; ?> 

        },{

           name: '<?php echo strtoupper($this->lang->line('runtastic_squat_x_cord')); ?>',

           data: <?php echo $squat_distance; ?> 

        }]

    });

    

     $('#container_duration').highcharts({

        chart: {

            type: 'spline',
			zoomType: 'x'

        },

        title: {

            text: '<?php echo strtoupper($this->lang->line('runtastic_duration_select')); ?>'

        },

        xAxis: {

            type: 'datetime',

            dateTimeLabelFormats: { // don't display the dummy year

                month: '%e. %b',

                year: '%b'

            },

            title: {

                text: '<?php echo strtoupper($this->lang->line('runtastic_graph_date')); ?>'

            }

        },

        yAxis: {

            title: {

                text: '<?php echo strtoupper($this->lang->line('runtastic_duration_y_cord')); ?>'

            },

            min: 0

        },

        tooltip: {

            headerFormat: '<b>{series.name}</b><br>',

            pointFormat: '{point.x:%e. %b}: {point.y:.2f} min'

        },



        plotOptions: {

            spline: {

                marker: {

                    enabled: true

                }

            }

        },



        series: [{

            name: '<?php echo strtoupper($this->lang->line('runtastic_running_x_cord')); ?>',

            data: <?php echo $running_duration; ?>

        },{

           name: '<?php echo strtoupper($this->lang->line('runtastic_pushup_x_cord')); ?>',

           data: <?php echo $pushup_duration; ?> 

        },{

           name: '<?php echo strtoupper($this->lang->line('runtastic_pullup_x_cord')); ?>',

           data: <?php echo $pullup_duration; ?> 

        },{

           name: '<?php echo strtoupper($this->lang->line('runtastic_squat_x_cord')); ?>',

           data: <?php echo $squat_duration; ?> 

        }]

    });

});

});

</script>
<?php echo '</div>';}