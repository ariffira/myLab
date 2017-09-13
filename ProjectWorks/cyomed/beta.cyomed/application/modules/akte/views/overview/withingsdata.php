<?php
  $this->load->language('pwidgets/withings',$this->m->user_value('language'));
?>
<script>

 $(document).ready(function(){
	$("#syc_run").click(function(){

		$(this).find('.fa-angle-right').toggleClass('fa-angle-down');

		$( "#run_login_div" ).toggle( "", function() {

			$("#msg").html('');

		});	

	});
        
(function (jQuery) {
    jQuery.oauthpopup = function (options) {
        options.windowName = options.windowName || 'ConnectWithOAuth';
        options.windowOptions = options.windowOptions || 'location=0,status=0,width='+options.width+',height='+options.height+',scrollbars=1';
        options.callback = options.callback || function () {
            alert('fffff');
            //window.location.reload();
        };
        var that = this;
        
        that._oauthWindow = window.open(options.path, options.windowName, options.windowOptions);
//        that._oauthInterval = window.setInterval(function () {
            //if (that._oauthWindow.closed) {
              //  alert('af'));
//                window.clearInterval(that._oauthInterval);
               // options.callback();
           // }
//        }, 1000);
    };
})(jQuery);

/**
* function for the popup window for the wihtings api
 */

  $('#run_sync_button').click(function(e) {  
  var url=$(this).attr('href');
  e.preventDefault();
          if ($('#feedContent').length && $(this).attr('href').indexOf('javascript:') < 0) {
                var request=  $.ajax({
                    method: "GET", 
                    dataType:"html",
                    url: url 
                });
                    request.done(function( msg ) {             
                        $.oauthpopup({
                                    path:msg,
                                    width:600,
                                    height:300,
                                    windowName:"Withings Authantication",
                                    callback:function(){
                                        alert('asf');

                                    }
                                });
                    });
          }
        });
  });   

</script>
<div class='blog-list'>
<div class="block block-c1 block-c1-1">
  <div class="head" id="syc_run">
    <div class="pull-right"><span class="fa fa-angle-right"></span></div>
    <h2 class="font-bold">
      <?php echo strtoupper($this->lang->line('withings_sync_data')); ?>
    </h2>
  </div>
  <div id="run_login_div" class="tab-pane blog-text" style="display:none;">
    <div id="msg" style="color:red;"></div>
    <div class="panel">
      <div class="panel-body">
        <div><strong>
            <?php echo strtoupper($this->lang->line('withings_client_auth')); ?>
        </strong></div>
        <div>&nbsp;</div>
      
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
               
               <a  href="<?php echo site_url('akte/withings'); ?>" id="run_sync_button" name="run_sync_button" class="btn btn-sync" >
                <?php echo strtoupper($this->lang->line('withings_sync_data_submit')); ?>
               </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    
<div id="loading_div"></div>
<?php 
if(count((array)$data)>0 && !empty($data)) 
    {
//    echo "<pre>";print_R($data);die;
    $latest_date= $data->body->updatetime;
    if(($weight!="") || ($fatwmass!="") || ($hp!="") || ($dbp!="" || $sbp!="")){
?>
<div class="blog-block">
<div class="date-block">
            <div class="date-meta"><?php echo date('d',$latest_date);?>. <span><?php echo date('M',$latest_date);?></span></div>
          </div>
    <div class="blog-text">
<div class="row">
<!--<div class="block block-c1 block-c1-1">-->
	<div class="tab-pane">
<!--        <p class="chart_setting">
          <select id="chart_field" name="chart_field">
            <option value="container_weight" selected="selected">Weight</option>
            <option value="container_height">Height</option>
            <option value="container_fatfmass">Fat Free Mass</option>
            <option value="container_fatratio">Fat Ratio</option>
            <option value="container_fatwmass">Fat Mass Weight</option>
            <option value="container_dbp">Diastolic Blood Pressure</option>
            <option value="container_sbp">Systolic Blood Pressure</option>
            <option value="container_hp">Heart Pulse</option>
          </select>
        </p>-->
            <span style="color: red" id="withingdata_errormsg"></span>
            <?php if($weight!="") ?>
            <div id="container_weight" style="width: 550px; height: 300px; margin: 0 auto" class="graph active_graph"></div>
<!--        <div id="container_height" style="width: 550px; height: 300px; margin: 0 auto;display:none;" class="graph"></div>-->
<!--        <div id="container_fatfmass" style="width: 550px; height: 300px; margin: 0 auto;display:none;" class="graph"></div>-->
<!--        <div id="container_fatratio" style="width: 550px; height: 300px; margin: 0 auto;display:none;" class="graph"></div>-->
            <?php if($fatwmass!="") ?>
            <div id="container_fatwmass" style="width: 550px; height: 300px; margin: 0 auto;" class="graph"></div>
            <?php if($dbp !="" || $sbp !="" ) ?>
            <div id="container_dbp" style="width: 550px; height: 300px; margin: 0 auto;" class="graph"></div>
<!--        <div id="container_sbp" style="width: 550px; height: 300px; margin: 0 auto;" class="graph"></div>-->
            <?php if($hp!="") ?>
            <div id="container_hp" style="width: 550px; height: 300px; margin: 0 auto;" class="graph"></div>
    </div>
</div>
       </div>
    </div>
<?php } ?>
<script  type="text/javascript">
$(function () {
//
//$("#chart_field").on('change',function(){
//    var selected = $(this).val();
//    
//          
//            $(".graph").removeClass('active_graph'));

//   }
//$("#"+selected).addClass('active_graph'));
//	$("#container_weight").show();
//
//	$("#container_height").hide();
//
//	$("#container_fatfmass").hide();
//
//	$("#container_fatratio").hide();
//
//	$("#container_fatwmass").hide();
//        $("#container_dbp").hide();
//        $("#container_sbp").hide();
//        $("#container_hp").hide();	


	
<?php if($weight && $weight!=""){ ?>
    $('#container_weight').highcharts({

        chart: {

            type: 'spline',
			zoomType: 'x'

        },

        title: {

            text: '<?php echo strtoupper($this->lang->line('withings_graph_weight')); ?>'

        },

        xAxis: {

            type: 'datetime',

            dateTimeLabelFormats: { // don't display the dummy year

                month: '%e. %b',

                year: '%b'

            },

            title: {

                text: 'Date'

            }

        },

        yAxis: {

            title: {

                text: '<?php echo strtoupper($this->lang->line('withings_graph_weight_y_cord')); ?>'

            },

            min: 0

        },

        tooltip: {

            headerFormat: '<b>{series.name}</b><br>',

            pointFormat: '{point.x:%e. %b}: {point.y:.2f} kg'

        },



        plotOptions: {

            spline: {

                marker: {

                    enabled: true

                }

            }

        },
      series: [{

            name: '<?php echo strtoupper($this->lang->line('withings_graph_weight')); ?>',

            data: <?php echo $weight; ?>

        }]

    });
    
<?php } if($fatwmass && $fatwmass!=""){ ?>

    $('#container_fatwmass').highcharts({

        chart: {

            type: 'spline',
			zoomType: 'x'

        },

        title: {

            text: '<?php echo strtoupper($this->lang->line('withings_fat_mass')); ?>'

        },

        xAxis: {

            type: 'datetime',

            dateTimeLabelFormats: { // don't display the dummy year

                month: '%e. %b',

                year: '%b'

            },

            title: {

                text: 'Date'

            }

        },

        yAxis: {

            title: {

                text: '<?php echo strtoupper($this->lang->line('withings_fat_mass')); ?>(KG)' 

            },

            min: 0

        },

        tooltip: {

            headerFormat: '<b>{series.name}</b><br>',

            pointFormat: '{point.x:%e. %b}: {point.y:.2f} kg'

        },



        plotOptions: {

            spline: {

                marker: {

                    enabled: true

                }

            }

        },
      series: [{

            name: '<?php echo strtoupper($this->lang->line('withings_fat_mass')); ?>',

            data: <?php echo $fatwmass; ?>

        }]

    });
    
<?php } if($hp && $hp!=""){ ?>

    $('#container_hp').highcharts({

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

                text: 'Date'

            }

        },

        yAxis: {

            title: {

                text: '<?php echo strtoupper($this->lang->line('withings_heart_puls')); ?>  (bpm)'

            },

            min: 0

        },

        tooltip: {

            headerFormat: '<b>{series.name}</b><br>',

            pointFormat: '{point.x:%e. %b}: {point.y:.2f} bpm'

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

            data: <?php echo $hp; ?>

        }]

    });
    
<?php } if(($dbp && $dbp!="") || ($sbp && $sbp!="")){ ?>


    $('#container_dbp').highcharts({

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

                text: 'Date'

            }

        },

        yAxis: {

            title: {

                text: '<?php echo strtoupper($this->lang->line('withings_blood_pres')); ?> (mmHg)'

            },

            min: 0

        },

        tooltip: {

            headerFormat: '<b>{series.name}</b><br>',

            pointFormat: '{point.x:%e. %b}: {point.y:.2f} mmHg'

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

            data: <?php echo $dbp; ?>

        },
        {

            name: '<?php echo strtoupper($this->lang->line('withings_blood_pres_x_cord_sys')); ?>',

            data: <?php echo $sbp; ?>

        }
        ]

    });
    
<?php }?>

    });


</script>
<?php }  else {?>
<div style="color:red;">
    <?php echo strtoupper($this->lang->line('withings_not_sync_info')); ?>
</div>
<?php } ?>
</div>

