<!-- Javascript Libraries -->
<!-- jQuery -->
<!-- jQuery Library -->
<script src="<?php echo base_url('assets/sa103/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/sa103/js/jquery-ui.min.js'); ?>"></script><!-- jQuery UI -->
<script src="<?php echo base_url('assets/sa103/js/highcharts.js');?>" ></script>
<script src="<?php echo base_url('assets/sa103/js/exporting.js'); ?>"></script>
<script src="<?php echo base_url('assets/mvpr110/js/readmore.js'); ?>"></script> 
<?php if ($this->m->user() && $this->m->user_id()){?>
<script src="<?php echo base_url('assets/js/jquery.idletimer.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/jquery.idletimeout.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
 //setup the dialog
 jQuery(document).ready(function (){
    $("#dialog").dialog({
    autoOpen: false,
    modal: true,
    width: 400,
    height: 200,
    closeOnEscape: false,
    draggable: false,
    resizable: false,
    buttons: {
        'Yes, Keep Working': function(){
            jQuery(this).dialog('close');
        },
        'No, Logout': function(){
            // fire whatever the configured onTimeout callback is.
            // using .call(this) keeps the default behavior of "this" being the warning
            // element (the dialog in this case) inside the callback.
            $.idleTimeout.options.onTimeout.call(this);
        }
    }
});
//cache a reference to the countdown element so we don't have to query the DOM for it on each ping.
var $countdown = $("#dialog-countdown");
//start the idle timer plugin
$.idleTimeout('#dialog', 'div.ui-dialog-buttonpane button:first',{
    idleAfter: 900000,
    pollingInterval: 60,
    keepAliveURL:'<?php echo site_url('akte/autologin'); ?>',
    serverResponseEquals: 'OK',
    onTimeout: function(){
        window.location = "<?php echo site_url('portal/both/logout');?>";
    },
    onIdle: function(){
        $(this).dialog("open");
        },
    onCountdown: function(counter){
        $countdown.html(counter); // update the counter
    }
});
 });
</script>
<div id="dialog" title="Your session is about to expire!">
    <p>
      <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 50px 0;"></span>
      You will be logged off in <span id="dialog-countdown" style="font-weight:bold"></span> seconds.
    </p>
    <p>Do you want to continue your session?</p>
</div>
<?php }?>
   <script src="<?php echo base_url('assets/sa103/js/jquery.easing.1.3.js'); ?>"></script> <!-- jQuery Easing - Requirred for Lightbox + Pie Charts-->
    <!-- Bootstrap -->
    <script src="<?php echo base_url('assets/sa103/js/bootstrap.min.js'); ?>"></script>

    <!--[if lt IE 9]>
    <script src="./js/libs/excanvas.compiled.js"></script>
    <![endif]-->

    <!-- Common variables -->
    <script>
      $.siteUrl = "<?php echo site_url(); ?>";
      $.baseUrl = "<?php echo base_url(); ?>";
      $.uiName = "<?php echo Ui::$bs_tname; ?>";
    </script>

    <!-- ============ -->
    <!-- SA103 STARTS -->
    <!-- ============ -->

    <!-- Charts -->
    <!--<script src="<?php echo base_url('assets/sa103/js/charts/jquery.flot.js'); ?>"></script> <!-- Flot Main -->
    <!--<script src="<?php echo base_url('assets/sa103/js/charts/jquery.flot.time.js'); ?>"></script> <!-- Flot sub -->
    <!--<script src="<?php echo base_url('assets/sa103/js/charts/jquery.flot.animator.min.js'); ?>"></script> <!-- Flot sub -->
    <!--<script src="<?php echo base_url('assets/sa103/js/charts/jquery.flot.resize.min.js'); ?>"></script> <!-- Flot sub - for repaint when resizing the screen -->

    <script src="<?php echo base_url('assets/sa103/js/sparkline.min.js'); ?>"></script> <!-- Sparkline - Tiny charts -->
    <script src="<?php echo base_url('assets/sa103/js/easypiechart.js'); ?>"></script> <!-- EasyPieChart - Animated Pie Charts -->
    <script src="<?php echo base_url('assets/sa103/js/charts.js'); ?>"></script> <!-- All the above chart related functions -->

    <!-- Map -->
    <script src="<?php echo base_url('assets/sa103/js/maps/jvectormap.min.js'); ?>"></script> <!-- jVectorMap main library -->
    <script src="<?php echo base_url('assets/sa103/js/maps/usa.js'); ?>"></script> <!-- USA Map for jVectorMap -->
    <script src="<?php echo base_url('assets/sa103/js/maps/world.js'); ?>"></script> <!-- World Map for jVectorMap -->

    <!--  Form Related -->
    <script src="<?php echo base_url('assets/sa103/js/validation/validate.min.js'); ?>"></script> <!-- jQuery Form Validation Library -->
    <script src="<?php echo base_url('assets/sa103/js/validation/validationEngine.min.js'); ?>"></script> <!-- jQuery Form Validation Library - requirred with above js -->
    <script src="<?php echo base_url('assets/sa103/js/select.min.js'); ?>"></script> <!-- Custom Select -->
    <script src="<?php echo base_url('assets/sa103/js/chosen.min.js'); ?>"></script> <!-- Custom Multi Select -->
    <script src="<?php echo base_url('assets/sa103/js/datetimepicker.min.js'); ?>"></script> <!-- Date & Time Picker -->
    <script src="<?php echo base_url('assets/sa103/js/colorpicker.min.js'); ?>"></script> <!-- Color Picker -->
    <script src="<?php echo base_url('assets/sa103/js/icheck.js'); ?>"></script> <!-- Custom Checkbox + Radio -->
    <script src="<?php echo base_url('assets/sa103/js/autosize.min.js'); ?>"></script> <!-- Textare autosize -->
    <script src="<?php echo base_url('assets/sa103/js/toggler.min.js'); ?>"></script> <!-- Toggler -->
    <script src="<?php echo base_url('assets/sa103/js/input-mask.min.js'); ?>"></script> <!-- Input Mask -->
    <script src="<?php echo base_url('assets/sa103/js/spinner.min.js'); ?>"></script> <!-- Spinner -->
    <script src="<?php //echo base_url('assets/sa103/js/slider.min.js'); ?>"></script> <!-- Input Slider -->
    <script src="<?php echo base_url('assets/sa103/js/bootstrap-slider.js'); ?>"></script> <!-- Input Slider -->
    <script src="<?php echo base_url('assets/sa103/js/fileupload.min.js'); ?>"></script> <!-- File Upload -->

    <!-- Text Editor -->
    <script src="<?php echo base_url('assets/sa103/js/editor.min.js'); ?>"></script> <!-- WYSIWYG Editor -->
    <script src="<?php echo base_url('assets/sa103/js/markdown.min.js'); ?>"></script> <!-- Markdown Editor -->

    <!-- UX -->
    <script src="<?php echo base_url('assets/sa103/js/scroll.min.js'); ?>"></script> <!-- Custom Scrollbar -->

    <!-- Other -->
    <script src="<?php echo base_url('assets/sa103/js/calendar.min.js'); ?>"></script> <!-- Calendar -->
    <script src="<?php echo base_url('assets/sa103/js/feeds.min.js'); ?>"></script> <!-- News Feeds -->

    <script src="<?php echo base_url('assets/sa103/js/file-manager/elfinder.debug.js'); ?>"></script>
    
    <!-- All JS functions -->
    <!--<script src="<?php echo base_url('assets/sa103/js/functions.js'); ?>"></script>-->

    <!-- ========== -->
    <!-- SA103 ENDS -->
    <!-- ========== -->

    <!-- //..========== -->

    <!-- ============== -->
    <!-- MVPR110 STARTS -->
    <!-- ============== -->

    <!-- Plugin JS -->
    <script src="<?php echo base_url('assets/mvpr110/js/plugins/flot/jquery.flot.js'); ?>"></script>
    <script src="<?php echo base_url('assets/mvpr110/js/plugins/flot/jquery.flot.tooltip.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/mvpr110/js/plugins/flot/jquery.flot.pie.js'); ?>"></script>
    <script src="<?php echo base_url('assets/mvpr110/js/plugins/flot/jquery.flot.resize.js'); ?>"></script>
    <script src="<?php echo base_url('assets/mvpr110/js/plugins/flot/jquery.flot.stack.js'); ?>"></script>
    <script src="<?php echo base_url('assets/mvpr110/js/plugins/flot/jquery.flot.orderBars.js'); ?>"></script>

    <script src="<?php echo base_url('assets/mvpr110/js/plugins/dataTables/jquery.dataTables.js'); ?>"></script>
    <script src="<?php echo base_url('assets/mvpr110/js/plugins/dataTables/dataTables.bootstrap.js'); ?>"></script>

    <script src="<?php echo base_url('assets/mvpr110/js/plugins/fileupload/bootstrap-fileupload.js'); ?>"></script>

    <script src="<?php echo base_url('assets/mvpr110/js/plugins/magnific/jquery.magnific-popup.js'); ?>"></script>

    <script src="<?php echo base_url('assets/mvpr110/js/plugins/parsley/parsley.js'); ?>"></script>

    <!-- App JS -->
    <script src="<?php echo base_url('assets/mvpr110/js/mvpready-core.js'); ?>"></script>
    <script src="<?php echo base_url('assets/mvpr110/js/mvpready-admin.js'); ?>"></script>

    <!-- Plugin's demo app JS -->
    <!--<script src="<?php echo base_url('assets/mvpr110/js/demos/flot/area.js'); ?>"></script>-->
    <!--<script src="<?php echo base_url('assets/mvpr110/js/demos/flot/line.js'); ?>"></script>-->
    <!--<script src="<?php echo base_url('assets/mvpr110/js/demos/flot/donut.js'); ?>"></script>-->
    <!--<script src="<?php echo base_url('assets/mvpr110/js/demos/flot/pie.js'); ?>"></script>-->
    <!--<script src="<?php echo base_url('assets/mvpr110/js/demos/flot/vertical.js'); ?>"></script>-->
    <!--<script src="<?php echo base_url('assets/mvpr110/js/demos/flot/horizontal.js'); ?>"></script>-->
    <!--<script src="<?php echo base_url('assets/mvpr110/js/demos/flot/scatter.js'); ?>"></script>-->
    <!--<script src="<?php echo base_url('assets/mvpr110/js/demos/flot/stacked-area.js'); ?>"></script>-->
    <!--<script src="<?php echo base_url('assets/mvpr110/js/demos/flot/stacked-horizontal.js'); ?>"></script>-->
    <!--<script src="<?php echo base_url('assets/mvpr110/js/demos/flot/stacked-vertical.js'); ?>"></script>-->
    <!--<script src="<?php echo base_url('assets/mvpr110/js/demos/flot/area.js'); ?>"></script>-->
    <!--<script src="<?php echo base_url('assets/mvpr110/js/demos/flot/stacked-vertical.js'); ?>"></script>-->
    <!--<script src="<?php echo base_url('assets/mvpr110/js/demos/flot/donut.js'); ?>"></script>-->
    <!--<script src="<?php echo base_url('assets/mvpr110/js/demos/flot/stacked-horizontal.js'); ?>"></script>-->
    <!--<script src="<?php echo base_url('assets/mvpr110/js/demos/flot/auto.js'); ?>"></script>-->
    <!--<script src="<?php echo base_url('assets/mvpr110/js/demos/flot/line.js'); ?>"></script>-->
    <!--<script src="<?php echo base_url('assets/mvpr110/js/demos/flot/pie.js'); ?>"></script>-->
    <!--<script src="<?php echo base_url('assets/mvpr110/js/demos/flot/auto.js'); ?>"></script>-->

    <!--<script src="<?php echo base_url('assets/mvpr110/js/demos/table_demo.js'); ?>"></script>-->

    <!--<script src="<?php echo base_url('assets/mvpr110/js/demos/validation.js'); ?>"></script>-->

    <!--<script src="<?php echo base_url('assets/mvpr110/js/demos/reports/line.js'); ?>"></script>-->

    <!--<script src="<?php echo base_url('assets/mvpr110/js/demos/page-icons.js'); ?>"></script>-->

    <!--<script src="<?php echo base_url('assets/mvpr110/js/demos/pricing.js'); ?>"></script>-->


    <!-- ============ -->
    <!-- MVPR110 ENDS -->
    <!-- ============ -->

    <!-- //..========== -->

    <!-- ================== -->
    <!-- IA24 STRUCT STARTS -->
    <!-- ================== -->

    <!--  -->
    <!-- PLUGIN part -->
    <!--  -->

    <!-- Moment.js -->
    <script src="<?php echo base_url('assets/js/moment-with-langs.min.js'); ?>"></script>

    <!--  -->
    <!-- VENDOR part -->
    <!--  -->

    <!-- jquery.form -->
    <script src="<?php echo base_url('assets/vendor/jquery.form/jquery.form.min.js'); ?>"></script>

    <!-- jquery.zclip -->
    <script src="<?php echo base_url('assets/js/jquery.zclip.min.js'); ?>"></script>
    
    
    <!-- Owl.Carousel -->
    <script src="<?php echo base_url('assets/vendor/owl-carousel/owl.carousel.js'); ?>"></script>

    <!-- Full Calendar -->
    <script src="<?php echo base_url('assets/vendor/fullcalendar-2.3.1/fullcalendar.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/fullcalendar-2.3.1/gcal.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/fullcalendar-2.3.1/lang-all.js'); ?>"></script>

    <!-- Bootstrap datetimepicker Assets -->
    <!--<script src="<?php echo base_url('assets/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.js'); ?>"></script>-->

    <!-- elFinder -->
    <!--<script src="<?php echo base_url('assets/vendor/elfinder/js/elfinder.min.js'); ?>"></script>-->

    <!-- Google Code Prettify -->
    <script src="<?php echo base_url('assets/vendor/google-code-prettify/prettify.js'); ?>"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/chat/js/quickblox.js');?>"></script>
    <script src="//cdn.webrtc-experiment.com/DetectRTC.js"></script>
    
    <!--  -->
    <!-- APP part -->
    <!--  -->
    <script type="text/javascript">
      $.baseUrl = "<?php echo base_url(); ?>";
      $.siteUrl = "<?php echo site_url(); ?>";
      $.activeUrl = "<?php echo !empty($active_url) ? smart_site_url($active_url) : ''; ?>";
    </script>

    <script src="<?php echo base_url('assets/js/app.js'); ?>"></script>

     <script src="<?php echo base_url('assets/js/jQuery.print.js'); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.print').on('click', function (event) {
              if ($('.modal').is(':visible')) {
                 var modalId = $(event.target).closest('.modal').attr('id');
                 
                    $.print("#"+modalId);

            } 
        });
        }); 
    </script>
               
    <?php if($this->m->user_role() == M::ROLE_DOCTOR):?>

            <script type="text/javascript">
                var quickblox_id, pat_name, caller, msg;
                $(function(){
                    QB.init(20710,'z9STk7LvBE9PJu-','eTJOZ5Acn9zs9Nb');
                    showNotification();
                    $.getJSON($.siteUrl+"/video/get_quickblox_login_for_doctor_notification")
                    .done(function(data){
                        $.each(data,function(key,val){
                            caller={
                                id: val.user_id,
                                login: val.login,
                                password: 'cyomedvideo'
                        };
                        });
                        createSession();
                    });

                           
                    function createSession() {
                      QB.createSession(caller, function(err, res) {
                        if (res) {
                          connectChat();
                          QB.chat.onMessageListener = showBroadcast;
                        }
                      });
                    }

                    function connectChat() {
                        QB.chat.connect({
                          jid: QB.chat.helpers.getUserJid(caller.id, 20710),
                          password: caller.password
                        }, function(err, res) {
                        });
                    }

                    function showBroadcast(user_id,msg){
                        if(msg.extension.broadcast){
                            showNotification();
                        }
                    }
                    function showNotification(){
                        $.getJSON($.siteUrl+"/video/doctor_query_for_notification")
                        .done(function(data){
                                $('#video_count').text(data.length);
                                var html='<li class="nav-header"><div class="pull-left">Video Beraten</div><div class="pull-right"><a href="javascript:;">Mark as Read</a></div>';
                                $.each(data,function(key,val){
                                        html+='<li><a href="<?php echo site_url("video");?>" onclick="return popVideo(this,'+val.id+')" class="noticebar-item">';
                                        html+='<span class="noticebar-item-body">';
                                        html+='<span class="noticebar-item-text">';
                                        html+='Video Call from'+val.name;
                                        html+='</span>';
                                        html+='<span class="noticebar-item-time"><i class="fa fa-clock-o"></i>Broadcast Time '+ val.broadcast_time;
                                        html+='</span>';
                                        html+='</span></a></li>';
                                });
                                html+='<li class="noticebar-menu-view-all"><a href="#">View All Notifications</a></li>';
                                $('#video_notification').removeData().html("");
                                $('#video_notification').append(html);
                            })
                        .fail(function() {
                            $('#video_count').text('');
                            $('#video_notification').removeData().html("");
                        });
                    }
                });

                

                function popVideo(url,care_id) {
                    var left = (screen.width/4);
                    var top = (screen.height/8);
                    var link=url.href;
                    $.getJSON("<?php echo site_url('video/insert_doctor_id?id=');?>"+care_id,function(data){             
                        $.each(data,function(key,value){
                            if(value.qb_id==-1){
                              alert('Patient already taken, Thank you..');
                            }else{
                                $.ajax({
                                  url: $.siteUrl+"/video/get_doctor_qb",
                                })
                                .done(function(doctors){
                                  msg = {
                                    type: 'chat',
                                    extension: {
                                      nick: caller.full_name,
                                      time: Math.floor(Date.now() / 1000),
                                      broadcast: 'broadcast'
                                    }
                                  };
                                  $.each(JSON.parse(doctors),function(index,doctor){
                                      if(doctor.id!=caller.id){
                                          console.log(doctor.id);
                                          user_jid = QB.chat.helpers.getUserJid(doctor.id, 20710);
                                          QB.chat.send(user_jid, msg);
                                      }
                                  });
                                });
                                quickblox_id=value.qb_id;
                                pat_name = value.pat_name;
                                newwindow=window.open(link,'Video','width=800, height=500 ,left='+left+',top='+top);
                                if (window.focus) {
                                    newwindow.focus();
                                }
                                newwindow.onload=function(){
                                    newwindow.onbeforeunload=function(){
                                        window.focus();
                                        $.ajax({
                                            method: "POST",
                                            url: $.siteUrl+"/video/update_help_status_doctor_end_process",
                                            data: {careId: care_id}
                                        });
                                    };
                                };
                            }
                        });            
                    }); 
                    
                    return false;
                }

                function changeCallStatus(){
                    $.ajax({
                    url: $.siteUrl+"/video/logout",
                    async: false,
                  });
                    console.log('status change called');
                }
                
                </script>

            <?php endif;?>

            <div class="layer"></div>

            <!-- ================ -->
            <!-- IA24 STRUCT ENDS -->
            <!-- ================ -->