<!DOCTYPE html>

<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/videochat/css/videochat.css'); ?>" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    <script src="https://code.oovoo.com/webrtc/oovoosdk-2.0.0.min.js"></script>

    <script src="<?php echo base_url('assets/videochat/js/video.js'); ?>"></script> 

    <script src="<?php echo base_url('assets/videochat/js/video.VideoHelper-0.0.5.js'); ?>"></script> 



</head>
<body style="margin:0px;">

<input type="hidden" id="confid" value="<?php echo $conferenceId ?>" />
<input type="hidden" id="sessionid" value="<?php echo $sessionId ?>" />
<input type="hidden" id="user_id" value="videochat_cyomed" />  


<div class="callContainer" ondblclick="toggleFullScreen();" onUnload="LogmeOut();">
    <div id="popupsContainer">
            <div id="dvBackground" class="popup_background"></div>
            <div id="dvAccess" class="popup_form" style="display: none; height: 250px;top:125px;">
                <h2>Allow camera and mic access </h2>
                <div class="popup_allow_access">
                </div>
                <div style="text-align:center;font-size:12px;margin-left:20px;margin-right:20px;">Click the Allow button in the upper corner of your browser to enable real-time communication.</div>
            </div>
            <div id="dvDenied" class="popup_form" style="display: none; height: 240px;top:125px;">
                <h2>Allow camera and mic access </h2>
                <div class="popup_access_denied">
                </div>
                <div style="text-align:center;font-size:12px;margin-left:20px;margin-right:20px;">
                Find this icon in the URL bar and allow ooVoo access your media devices.</div>
            </div>
            <div id="dvNotFound" class="popup_form" style="display: none; height: 165px; top: 163px;">
                <h2>Media device not found </h2>
                <div style="text-align:center;font-size:16px;margin-left:20px;margin-right:20px;">
                  Please make sure you have camera and microphone connected.
                </div>
            </div>
            <div id="dvName" class="popup_form" style="height: 135px; top: 178px;">
                <div class="popup_close" onclick="closeDisplayNameWin();"></div>
                <br />
                <input id="dname" type="text" value="" maxlength="30" placeholder="Your Name" onkeyup="popupKeyPress(event,changeDisplayName, closeDisplayNameWin);" />
                <br />
                <br />
                <input type="button" value="CONTINUE" onclick="changeDisplayName();" style=" width: 110px !important; height: 40px !important; line-height: 40px; margin: 0px 0 35px 50px !important;" />
                <br />
            </div>
            <div id="dvNotSupported" class="popup_form" style="height: 178px; top: 156px;">
                <h2>Sorry for the inconvenience</h2>
                <div class="popup_browser_not_supported"></div>
                <div style="float: left; margin-left: 4px;">
                    Your browser is incompatible !
                    <br />Please use latest Chrome/Firefox/Opera<br /> browsers.
                </div>
            </div>
        </div>

    


    <div class="videoWinContainer" oncontextmenu="return false;">
        <div id="mainVideoContainer" class="two_wayMainVideoContainer">
            <video autoplay id="mainVideo"  class="localVideo" ></video>
            <div id="mainDisplayName" class="displayname"></div>
        </div>

        <div id="remoteVideosContainer" class="two_wayRemoteVideosContainer">
            <div id="remoteVideos"></div>
        </div>
    </div>

    <div class="main_control_bar">
        <div>
            <div id="localMic" title="mute mic" class="icon mic left10 disabled" onclick="muteLocal(event)"></div>
            <div id="localSpk" title="mute speakers" class="icon spk left10 disabled" onclick="muteRemote(event)"></div>
            <div id="localCam" title="stop video" class="icon cam left10 disabled" onclick="stopLocal(event)"></div>
            <div id="localFilter" title="select filter" class="icon filter left10 disabled" onclick="$('#ddlFilters').show();"></div>
        </div>
        <div class="left10">
            <!--
             <form class="form-horizontal" method="post" action="<?php echo site_url('akte/videochat/callend'); ?>" enctype="multipart/form-data">
                <input type="hidden" name="callid"  value= "<?php echo $callid; ?>" />
                <button id="disconnect" type="submit" class="icon disconnect_disabled"  style="no-repeat;border:none;" >
                </button>

            </form>
            -->

            <div id="disconnect" class="icon disconnect_disabled" onclick="conf.disconnect()"></div>
        </div>
    </div>

    <div id="ddlFilters" class="filters_container" onmouseleave="$('#ddlFilters').hide();">
        <div onclick="changeFilter('filter-grayscale');">Grayscale</div>
        <div onclick="changeFilter('filter-saturate');">Saturate</div>
        <div onclick="changeFilter('filter-invert');">Invert</div>
        <div onclick="changeFilter('filter-sepia');">Sepia</div>
        <div onclick="changeFilter('none');">None</div>
    </div>
</div>

</body>
</html>
