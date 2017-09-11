<?php 
 $this->load->language('global/general_text',$this->m->lang);
?>
<script type="text/javascript">
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
//            alert('fffff');
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
//                                        alert('asf');

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
    <h2 class="font-bold">Sync Jawbone data</h2>
  </div>
  <div id="run_login_div" class="tab-pane" style="display:none;">
    <div id="msg" style="color:red;"></div>
    <div class="panel">
      <div class="panel-body">
        <div><strong> Jawbone client Authentication</strong></div>
        <div>&nbsp;</div>
      
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
               <a  href="<?php echo site_url('akte/jawbone/geturi'); ?>" id="run_sync_button"  name="run_sync_button" class="btn btn-sync" >
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
 if(count((array)$data)>0 && !empty($data)) 
 {
//     echo $sleep;
//     echo $steps;
//echo "<pre>";     print_R($data);die;

if(count((array)$data->userinfo)>0)   
{?>
<div class="block block-c1 block-c1-1">
    <div class="tab-pane">
        <div class="jawbone-block">
            <h2 class="portlet-title"><u><?php echo  $data->userinfo->first ?></u></h2>
        <div class="col-md-2"><img src="http://jawbone.com/<?php echo  $data->userinfo->image ?>" alt="<?php echo  $data->userinfo->first.' '.$data->userinfo->first  ?>"/></div>
        <div class="col-md-10">
        <span>
            <?php echo  $data->userinfo->first." ".$data->userinfo->last ?>
        </span>
         <span>
            <?php echo strtoupper($this->lang->line('jawbone_user_weight')).' : '.round($data->userinfo->weight, 2)." Kg";?>
        </span>
            <span>
                <?php echo strtoupper($this->lang->line('jawbone_user_height')).' : '.round($data->userinfo->height, 2)." m";?>
        </span>

        </div>
        <div class="clear"></div>
        </div>
           <div class="clear"></div>
        <?php // } ?>
        <hr />
       
    </div>
</div>
<?php } if($sleep!="" || $steps!=""){ ?>
          <div class="blog-block">
              <div class="date-block">
            <div class="date-meta"><?php echo date('d',strtotime($latest_date));?>. <span><?php echo date('M',strtotime($latest_date));?></span></div>
          </div>
    <div class="blog-text">
<div class="row">
        <?php if($sleep!="") ?>
           <div id="usersleep" style="width: 550px; height: 300px; margin: 0 auto"></div>
           <?php if($steps!="") ?>
           <div id="usersteps" style="width: 550px; height: 300px; margin: 0 auto"></div>
<!--           <div id="userdistance" style="width: 550px; height: 300px; margin: 0 auto"></div>-->
</div></div></div>
<script type="text/javascript">
    $(function(){
        <?php  if($steps!="") {?>
$('#usersteps').highcharts({

        chart: {

            type: 'spline',
			zoomType: 'x'

        },

        title: {

            text: '<?php echo strtoupper($this->lang->line('jawbone_user_step')) ?>'

        },

        xAxis: {

            type: 'datetime',

            dateTimeLabelFormats: { // don't display the dummy year

                month: '%e. %b',

                year: '%b'

            },

            title: {

                text: '<?php echo strtoupper($this->lang->line('jawbone_user_sleep_date')) ?>'

            }

        },

        yAxis: {

            title: {

                text: '<?php echo strtoupper($this->lang->line('jawbone_user_step') )?>'

            },

            min: 0

        },

        tooltip: {

            headerFormat: '<b>{series.name}</b><br>',

            pointFormat: '{point.x:%e. %b}: {point.y:.2f} <?php echo strtoupper($this->lang->line('jawbone_user_step')) ?>',
			
			crosshairs:{
			width:1
			}

        },



        plotOptions: {

            spline: {

                marker: {

                    enabled: true

                }

            }

        },



        series: [{

            name: '<?php echo strtoupper($this->lang->line('jawbone_user_step')) ?>',

            data: <?php echo $steps; ?>
        },]

    });
    <?php } if($sleep!="") {?>
 $('#usersleep').highcharts({

        chart: {

            type: 'spline',
			zoomType: 'x'

        },

        title: {

            text: '<?php echo strtoupper($this->lang->line('jawbone_user_sleep')) ?>'

        },

        xAxis: {

            type: 'datetime',

            dateTimeLabelFormats: { // don't display the dummy year

                month: '%e. %b',

                year: '%b'

            },

            title: {

                text: '<?php echo strtoupper($this->lang->line('jawbone_user_sleep_date')); ?>'

            }

        },

        yAxis: {

            title: {

                    text: '<?php echo strtoupper($this->lang->line('jawbone_user_sleep'));echo ' '; echo strtoupper($this->lang->line('jawbone_user_sleep_hour'))?>'

            },

            min: 0

        },

        tooltip: {

            headerFormat: '<b>{series.name}</b><br>',

            pointFormat: '{point.x:%e. %b}: {point.y:.2f} <?php echo strtoupper($this->lang->line('jawbone_user_sleep_hour'));?>'
			
			

        },



        plotOptions: {

            spline: {

                marker: {

                    enabled: true

                }

            }

        },



        series: [{

            name: '<?php echo strtoupper($this->lang->line('jawbone_user_sleep')); ?>',

            data:<?php echo $sleep; ?>
        }]

    });
<?php } ?>


});
</script>
<?php }}  else {?>
<span style="color: red" id="jawbone_errormsg"></span>
<div style="color:#87CBD6;">Ihre Jawbone Daten nicht mit unserem Portal zu synchronisieren, klicken Sie bitte auf Sync-Taste, um Daten zu synchronisieren.</div>
<?php } ?>
</div>
