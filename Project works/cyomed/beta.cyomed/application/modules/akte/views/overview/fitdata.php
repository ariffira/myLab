<?php
  $this->load->language('pwidgets/googlefit',$this->m->user_value('language'));
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
  var url=$(this).attr('href');
  
  e.preventDefault();
          if ($(this).attr('href').indexOf('javascript:') < 0) 
          {
             

                        $.oauthpopup({
                                    path:url,
                                    width:600,
                                    height:300,
                                    windowName:"Step Count",
                                    callback:function(){
                                 
                                    }
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
       <?php echo strtoupper($this->lang->line('googlefit_sync_data')); ?>
    </h2>
  </div>
  <div id="run_login_div" class="tab-pane" style="display:none;">
    <div id="msg" style="color:red;"></div>
    <div class="panel">
      <div class="panel-body">
        <div><strong> 
           <?php echo strtoupper($this->lang->line('googlefit_client_auth')); ?>
        </strong></div>
        <div>&nbsp;</div>
      
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
               <a  href="<?php echo $oauthurl; ?>" id="run_sync_button"  name="run_sync_button" class="btn btn-sync" >
                 <?php echo strtoupper($this->lang->line('googlefit_sync_data')); ?>
               </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="loading_div"></div>
<?php 
 if(count((array)$data)>0 && !empty($data) && $step_count!="") 
 {
    $latest_date=key($data);   
?>
<div class="blog-block">
<div class="date-block">
            <div class="date-meta"><?php echo date('d',strtotime($latest_date));?>. <span><?php echo date('M',strtotime($latest_date))  ;?></span></div>
          </div>
    <div class="blog-text">
    
<div class="row">
	<div class="tab-pane">
        <p class="chart_setting">
        </p>
        <div id="container_stepcount" style="width: 550px; height: 300px; margin: 0 auto"></div>
    </div>
</div>
    </div>
</div>
<script>
$(document).ready(function(){
$("#container_stepcount").show();
$(function () {
    $('#container_stepcount').highcharts({
        chart: {
            type: 'spline',
			zoomType: 'x'
        },
        title: {
            text: '<?php echo strtoupper($this->lang->line('googlefit_graph_step_x_cord')); ?>'
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
                text: '<?php echo strtoupper($this->lang->line('googlefit_graph_step_x_cord')); ?>'
            },
            min: 0
        },
        tooltip: {
            headerFormat: '<b>{series.name}</b><br>',
            pointFormat: '{point.x:%e. %b}: {point.y:.f}'
        },
        plotOptions: {
            spline: {
                marker: {
                    enabled: true
                }
            }
        },
        series: [{
            name: '<?php echo strtoupper($this->lang->line('googlefit_graph_step_x_cord')); ?>',
            data: <?php echo $step_count; ?>
        }]
    });
 
    

   
});
});
</script>
<?php }  else {?>
<div style="color:red;">
    <?php echo strtoupper($this->lang->line('googlefit_not_sync_info')); ?>
</div>
<?php } ?>
</div>