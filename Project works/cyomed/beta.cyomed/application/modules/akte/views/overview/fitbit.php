<?php 
 $this->load->language('global/general_text',$this->m->lang);
?>
<script>
  $(document).ready(function(){
	$("#syc_run").click(function(){

		$(this).find('.fa-angle-right').toggleClass('fa-angle-down');

		$( "#run_login_div" ).toggle( "", function() {

			$("#msg").html('');

		});	

	});
 (function (jQuery){
    jQuery.oauthpopup = function (options) {
        options.windowName = options.windowName || 'ConnectWithOAuth';
        options.windowOptions = options.windowOptions || 'location=0,status=0,width='+options.width+',height='+options.height+',scrollbars=1';
        options.callback = options.callback || function () {
            alert('fffff');
            //window.location.reload();
        };
        var that = this;
        
        that._oauthWindow = window.open(options.path, options.windowName, options.windowOptions);
     };
})(jQuery);

/**
* function for the popup window for the wihtings api
 */
 $('#run_sync_button').click(function(e) {
 $(this).attr('disabled',"disabled");
  var url=$(this).attr('href');
  e.preventDefault();
          if ($('#feedContent').length && $(this).attr('href').indexOf('javascript:') < 0) {
                var request=  $.ajax({
                    method: "GET", 
                    dataType:"text",
                    url: url 
                });
                    request.done(function( msg ) {
//					alert(msg);
                        $.oauthpopup({
                                    path:msg,
                                    width:600,
                                    height:300,
                                    windowName:"fitbit Authantication",
                                    callback:function(){
                                        alert('asf');

                                    }
                                });
                    });
          }
        });
  });   

</script>
<div class="blog-list">
<div class="block block-c1 block-c1-1">
  <div class="head" id="syc_run">
    <div class="pull-right"><span class="fa fa-angle-right"></span></div>
    <h2 class="font-bold">Sync Fit Bit data</h2>
  </div>
  <div id="run_login_div" class="tab-pane" style="display:none;">
    <div id="msg" style="color:red;"></div>
    <div class="panel">
      <div class="panel-body">
        <div><strong> Fit Bit client Authentication</strong></div>
        <div>&nbsp;</div>
      
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
               <a  href="<?php echo site_url('akte/fit/geturi'); ?>" id="run_sync_button"  name="run_sync_button" class="btn btn-sync" >
                Sync data
               </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="loading_div"></div>
<?php 
 if(count((array)$data)>0  && !empty($data)) 
 {
//   $stepdata=unserialize(json_decode($data->data));
     if(count((array)$profile)>0  && !empty($profile)){
?>

<div class="block block-c1 block-c1-1">
    <div class="tab-pane">
        <?php  foreach ($profile as $value) {  ?>
        <div class="fitbit-block">
            <h2 class="portlet-title"><u><?php echo  str_replace('_',' ',$value->badgeType) ?></u></h2>
        <div class="col-md-2"><img src="<?php echo  $value->image100px ?>" alt="<?php echo  $value->description ?>"/></div>
        <div class="col-md-10">
        <span>
            <?php echo  $value->value ?>  <?php $unit =isset($value->unit)?$value->unit:strtoupper($this->lang->line('fitbit_graph_titile_step')); echo $unit  ; ?>
        </span>
          <p>
            <?php echo  $value->earnedMessage ?>
        </p>
     
        </div>
        <div class="clear"></div>
        </div>
           <div class="clear"></div>
        <?php } ?>
        <hr />
         <span style="color: red" id="fitbit_errormsg"></span>
    </div>
</div>
<?php }if($graph_stpes!="" || $sleep!="" || $distance!=""){?>
         <div class="blog-block">
              <div class="date-block">
            <div class="date-meta"><?php echo date('d',strtotime($latest_date));?>. <span><?php echo date('M',strtotime($latest_date));?></span></div>
          </div>
    <div class="blog-text">
<div class="row">
        <?php if($graph_stpes!="")?>
        <div id="graph_steps" style="width: 550px; height: 300px; margin: 0 auto"></div>
        <?php if($sleep!="")?>
        <div id="graph_sleeps" style="width: 550px; height: 300px; margin: 0 auto"></div>
        <?php if($distance!="")?>
        <div id="graph_distances" style="width: 550px; height: 300px; margin: 0 auto"></div>
    </div>
</div>
         </div>
<?php }?>
<script type="text/javascript">
$(function () {
    <?php if($graph_stpes!=""){?>
    $('#graph_steps').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: '<?php echo strtoupper($this->lang->line('fitbit_graph_titile_step')) ?>'
        },
//        subtitle: {
//            text: 'Source: fitbit.com'
//        },
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
            min: 0,
            title: {
                text: '<?php echo strtoupper($this->lang->line('fitbit_graph_titile_step')).' '.strtoupper($this->lang->line('fitbit_graph_titile_count')) ?>'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} <?php echo strtoupper($this->lang->line('fitbit_graph_titile_step')) ?> </b></td></tr>',
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
        series: [{
            name: '<?php echo strtoupper($this->lang->line('fitbit_graph_titile_step')).' '.strtoupper($this->lang->line('fitbit_graph_titile_count')) ?>',
            data: <?php  echo  $graph_stpes; ?>

        }, ]
    });
    <?php } if($sleep!=""){?>
     $('#graph_sleeps').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: '<?php echo strtoupper($this->lang->line('fitbit_graph_titile_sleep')) ?>'
        },
//        subtitle: {
//            text: 'Source: fitbit.com'
//        },
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
            min: 0,
            title: {
                text: '<?php echo strtoupper($this->lang->line('fitbit_graph_titile_sleep')) ?> MIN.'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} MIN.</b></td></tr>',
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
        series: [{
            name: '<?php echo strtoupper($this->lang->line('fitbit_graph_titile_sleep')) ?>',
            data: <?php  echo  $sleep; ?>

        }, ]
    });
       <?php } if($distance!=""){?>
    $('#graph_distances').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: '<?php echo strtoupper($this->lang->line('fitbit_graph_titile_distance')) ?>'
        },
//        subtitle: {
//            text: 'Source: fitbit.com'
//        },
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
            min: 0,
            title: {
                text: '<?php echo strtoupper($this->lang->line('fitbit_graph_titile_distance')) ?> KM'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} KM.</b></td></tr>',
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
        series: [{
            name: '<?php echo strtoupper($this->lang->line('fitbit_graph_titile_distance')) ?>',
            data: <?php  echo  $distance; ?>

        }, ]
    });
    <?php } ?>
});
		</script>
<?php }  else {?>
<div style="color:red;">Ihre Fit Bit Daten nicht mit unserem Portal zu synchronisieren, klicken Sie bitte auf Sync-Taste, um Daten zu synchronisieren.</div>
<?php } ?>
</div>
