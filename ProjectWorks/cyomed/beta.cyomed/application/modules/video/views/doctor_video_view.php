<link rel="shortcut icon" href="<?php echo base_url('/assets/chat/images/favicon.ico');?>">
<link href="<?php echo base_url('/assets/chat/css/bootstrap.min.css');?>" rel="stylesheet">
<link href="<?php echo base_url('/assets/chat/css/qm.css');?>" rel="stylesheet">
  

<!-- Bootstrap core CSS -->
<link href="<?php echo base_url('/assets/chat/css/font-awesome.min.css');?>" rel="stylesheet">

<input id = "token" value = '<?php echo $token;?>' hidden>
<input id = "user_id" value = '<?php echo $user_id;?>' hidden>
<input id = "login" value = '<?php echo $login;?>' hidden>
<input id = "user_name" value = '<?php echo $this->m->user_value('name');?> <?php echo $this->m->user_value('surname');?>' hidden>

<div id="chat"></div>


<div class="row-fluid no-gutter">
<div class="video-chat col-xs-12 col-sm-12 col-md-12 col-lg-12">
  <div class="mediacall l-flexbox" style="">
    <video id="remoteVideo" class="mediacall-remote-stream remoteVideo hidden">
    </video>
    <video id="localVideo" class="mediacall-local mediacall-local-stream localVideo hidden">
    </video>
    <img id="localImg" class="mediacall-local mediacall-local-avatar localImg" src="<?php $this->load->model('document/mdoc'); echo ($img_path = $this->mdoc->get_profile_image_path()) ? base_url($img_path) : '//placehold.it/60x60'; ?>" alt="avatar">
    
    <div id="remoteImg" class="mediacall-remote-user l-flexbox l-flexbox_column remoteImg">
      <img class="mediacall-remote-avatar" src="<?php echo base_url('/assets/chat/images/chatcare.jpg');?>" alt="avatar">
      <section class="connecting center hidden">
        <div class="spinner_bounce">
          <div class="spinner_bounce-bounce1"></div>
          <div class="spinner_bounce-bounce2"></div>
          <div class="spinner_bounce-bounce2"></div>
        </div>
      </section>
    </div>
    
    <div class="mediacall-info l-flexbox l-flexbox_column l-flexbox_flexcenter">
      <img class="mediacall-info-logo" src="<?php echo base_url('/assets/chat/images/favicon.ico');?>" alt="Cyomed">
      <span class="mediacall-info-duration is-hidden"></span>
    </div>
    <div class="mediacall-controls l-flexbox l-flexbox_flexcenter">
      <button class="btn_mediacall btn_full-mode" onclick="toggleFullScreen()">
        <img class="btn-icon_mediacall" src="<?php echo base_url('/assets/chat/images/icon-full-mode-on.png');?>" alt="full mode">
      </button>
      <button class="btn_mediacall btn_camera_off" data-action="mute" disabled>
        <img class="btn-icon_mediacall" src="<?php echo base_url('/assets/chat/images/icon-camera-off.svg');?>"  alt="camera">
        </button>
        <button class="btn_mediacall btn_mic_off" data-action="mute" disabled>
          <img class="btn-icon_mediacall" src="<?php echo base_url('/assets/chat/images/icon-mic-off.svg');?>"  alt="mic">
        </button>
        <button id="makecall" class="btn_mediacall btn_hangup make-call" >
          <img class="btn-icon_mediacall" src="<?php echo base_url('/assets/chat/images/icon-audiocall.svg');?>" alt="makecall">
        </button>
        <button id="endcall" class="btn_mediacall btn_hangup end-call hidden" >
          <img class="btn-icon_mediacall" src="<?php echo base_url('/assets/chat/images/icon-hangup.svg');?>" alt="hangup">
        </button>
        <button id="textchat" class="btn_mediacall btn_chat" >
          <img class="btn-icon_mediacall" src="<?php echo base_url('/assets/chat/images/icon-message.png');?>" alt="textchat">
        </button>

      </div>
    </div>
  </div>

 <div class="textchat col-xs-3 col-sm-3 col-md-3 col-lg-3" style="display:none; float:right;">
    <section class="l-chat-content">
    </section>
    <footer class ="l-chat-footer">
      <form class="l-message" action="#">
        <div class="form-input-message textarea" contenteditable="true" placeholder="Type a message" style="overflow: hidden; outline: none;" tabindex="0"></div>
        <input class="attachment" type="file">
        <button class="btn_message btn_message_attach"><img src="<?php echo base_url('/assets/chat/images/icon-attach.svg');?>" alt="attach"></button>
      </form>
    </footer>
  </div>
</div>


<!--A bootstrap modal to show when there is a call -->
<div id="incomingCall" class="incoming modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <span class="info-notice"><span class="incoming-callType"></span> Call from </span>
      </div>
      <div class="modal-body">
        <span class="caller"></span>
      </div>
      <div class="modal-footer">
        <div class="incoming-call-controls l-flexbox l-flexbox_flexcenter">
          <button id="reject" class="btn btn-default btn_decline">Decline</button>
          <button id="accept" class="btn btn-default btn_accept accept">Accept</button>
        </div>
      </div>
    </div>
  </div>
</div>

<audio id="callingSignal" loop>
  <source src="<?php echo base_url('/assets/chat/audio/calling.ogg');?>"></source>
  <source src="<?php echo base_url('/assets/chat/audio/calling.mp3');?>"></source>
</audio>

<audio id="ringtoneSignal" loop>
  <source src="<?php echo base_url('/assets/chat/audio/ringtone.ogg');?>"></source>
  <source src="<?php echo base_url('/assets/chat/audio/ringtone.mp3');?>"></source>
</audio>

<audio id="endCallSignal">
  <source src="<?php echo base_url('/assets/chat/audio/end_of_call.ogg');?>"></source>
  <source src="<?php echo base_url('/assets/chat/audio/end_of_call.mp3');?>"></source>
</audio>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="<?php echo base_url('/assets/chat/js/quickblox.js'); ?>"></script>


<script src="<?php echo base_url('/assets/chat/js/main.js'); ?>"></script>
<script src="<?php echo base_url('/assets/chat/js/bootstrap.min.js'); ?>"></script>


<script>
    $.siteUrl = "<?php echo site_url(); ?>"; 
</script>

<script type="text/javascript">
  // jQuery(function(){
  //   jQuery('#chat').click();
  // }); 


  $(function(){
    $(window).on('beforeunload',function(){
      $.ajax({
        url: $.siteUrl+"/video/logout",
        async: false,
      });
      //return "Are u sure want to log out!";

    });
  });

</script>