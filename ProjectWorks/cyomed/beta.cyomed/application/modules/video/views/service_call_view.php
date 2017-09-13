<div style="margin-bottom: 20px">
    <div class="row-fluid" >
        <div class="head btn-primary"><a href="#" class="close-video pull-right" onclick="closeVideo()"><img src="<?php echo base_url('assets/img/back.png');?>"></a><h2>CYOMED VIDEO SERVICE</h2></div>
    </div>

    <div class="panel panel-default" style="margin:0;">
       <div class="panel-heading">
        <span id="browser-info"></span>
    </div>

    <div class="panel-body">
      <form class = "form-horizontal" role="form" method="post" action="#" enctype="multipart/form-data">
        <br />
        <div class= 'form-group-fluid center-block' >	
            <div class="col-sm-12 text-center">		
                <h5 class="title"><span class="status status-online"></span>
                    <img src="<?php echo base_url('/assets/img/loading.png');?>" width="40px">
                    Cyomed Service
                </h5>
            </div>
            <div class="col-sm-12">
                By Submitting a request you will routed to your triage nurse who will connect you to the correct
                specialist in no time. Please make sure your popup blocker is switched off.
                <br />
            </div>

            <div class='col-sm-12 text-center' style="padding:11px;">	
                <a id='loadQuickblox' href='#' class="btn btn-primary btn-sm font-bold uprCase" >Submit Request</a>
                <br />
            </div>
        </div>

    </form>
    <div class="row status-info hidden" style="padding-bottom:10px">
        <div class="col-sm-12">
            <div class="col-sm-8">
                <h6 class="title">
                    <span class="message"></span>
                </h6>
            </div>
            <div class="col-sm-4 pull-right">
                <a id='complete-request' href='#' class="btn btn-primary btn-sm" disabled="disabled">Request Complete</a>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<script>
    $.pageSetup($('#content'));
    $.siteUrl = "<?php echo site_url(); ?>"; 
</script>

<script type="text/javascript">
var care_id;
    $(function(){
        if(DetectRTC.isWebRTCSupported){

        }
        else if(DetectRTC.isMobileDevice){
            $('#browser-info').append("<span>Please use our mobile app for Videochat.</span>");
        }
        else{
            $('#browser-info').append("<span>This browser doesn't support Videochat, Please use Chrome or Firefox.</span>");
        }
        $('#loadQuickblox').on('click',function(event){
            event.preventDefault();
            $(document).find('.ajax-video-link > button').attr('disabled','disabled');
            
            $('.status-info').removeClass('hidden');
            $(this).attr('disabled','disabled');
            $('.message').text('Your request is in progress.');
            $.ajax({
                url: $.siteUrl+'/video/insert_care_chatservice',
            })
            .done(function(id){
                quickblox(id);
            });

        }); 
        $('#complete-request').on('click',function(event){
            event.preventDefault();
            $(document).find('.ajax-video-link > button').removeAttr('disabled');    
            $(document).find('#videoContent').slideUp();
            $(document).find('#videoContent').text('');
            care_id=undefined;
        });
    });

    function quickblox(id){
        var left = (screen.width/4);
        var top = (screen.height/8);
        care_id = id;
        newwindow=window.open($.siteUrl+"/video",'Video','width=800, height=500, left='+left+',top='+top);
        if (window.focus) {
            newwindow.focus();
            newwindow.onload=function(){
                newwindow.onunload=function(){
                    window.focus();
                    $.ajax({
                        method: "POST",
                        url: $.siteUrl+"/video/check_status",
                        data: {careId: id},
                        dataType: "json"
                    }).done(function(data){
                        $('.message').text(data.msg);
                        if(data.status==3)
                            $('#complete-request').removeAttr('disabled');
                        else{
                            $('#loadQuickblox').text('Reopen video');
                            $('#loadQuickblox').removeAttr('disabled');
                        }
                    });
                };
            };
        }
        return false;
    }
    function closeVideo(){
        event.preventDefault();
        if(care_id===undefined){
            $(document).find('#videoContent').slideUp('slow');
            $(document).find('#videoContent').text('');
        }
    }
</script>