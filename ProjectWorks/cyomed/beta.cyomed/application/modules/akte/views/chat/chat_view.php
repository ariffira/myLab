<link rel="shortcut icon" href="http://quickblox.com/favicon.ico">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url('/assets/chat/chatmain/main.css');?>">
<!-- Bootstrap core CSS -->
<link href="<?php echo base_url('/assets/chat/chatmain/css/font-awesome.min.css');?>" rel="stylesheet">
<link href="<?php echo base_url('/assets/chat/chatmain/css/bootstrap.min.css');?>" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="<?php echo base_url('/assets/chat/chatmain/css/avenir-font.css');?>" rel="stylesheet">
<link href="<?php echo base_url('/assets/chat/chatmain/css/perfect-scrollbar.css');?>" rel="stylesheet">
<link href="<?php echo base_url('/assets/chat/chatmain/css/custom-theme.css');?>" rel="stylesheet">



<input id = "token" value = <?php echo $token?> hidden>
<input id = "user_id" value = <?php echo $user_id?> hidden>

  <div class = "mainpage">
    <select id="doctor" title="select Doctor">
    <option value='0'>Please select</option>
      <?php if($doctorlist):?>
        <?php foreach ($doctorlist as $key):?>
          <option value="<?php echo $key['id'];?>" name="<?php echo $key['name'];?>" > 
          <?php echo $key['name'];?> 
          </option>
        <?php endforeach;?>
      <?php endif;?>
    </select>

    <select id="patient" title="select Patient">
    <option value='0'>Please select</option>

      <?php if($patientlist):?>
        <?php foreach ($patientlist as $key):?>
          <option value="<?php echo $key['id'];?>" name="<?php echo $key['name'];?>" > 
          <?php echo $key['name'];?> 
          </option>
        <?php endforeach;?>
      <?php endif;?>
    </select>
    <button id="textchat">Click to chat</button>
    <button id="videochat">Click to Videochat</button>
  </div>
  
  <div class="wrapper">
  
  <input id = "token" value = '<?php echo $token;?>' hidden>
  <input id = "user_id" value = '<?php echo $user_id;?>' hidden>
  <input id = "login" value = '<?php echo $login;?>' hidden>
  <input id = "user_name" value = '<?php echo $this->m->user_value('name');?>' hidden>


    <section class="chat center">
      <div class="streams">
        <div class="localControls">
          <span id="callerName"></span><br>
          <video id="localVideo"></video>
          <div class="mediacall-controls l-flexbox l-flexbox_flexcenter">
            <button class="btn_mediacall btn_camera_off" data-action="mute" disabled><img class="btn-icon_mediacall" src="<?php echo base_url('/assets/chat/images/icon-camera-off.png');?>" alt="camera"></button>
            <button class="btn_mediacall btn_mic_off" data-action="mute" disabled><img class="btn-icon_mediacall" src="<?php echo base_url('/assets/chat/images/icon-mic-off.png');?>" alt="mic"></button>
          </div>
        </div>
        <div class="remoteControls">
          <span id="calleeName"></span><br>
          <video id="remoteVideo"></video>
        </div>
      </div>
      <div class="controls">
        <button id="audiocall" type="button" class="btn btn-default">
          <img class="icon-audiocall" src="<?php echo base_url('/assets/chat/images/icon-audiocall.png');?>" alt="QuickBlox Samples">Audio call
        </button>
        <button id="videocall" type="button" class="btn btn-default">
          <img class="icon-videocall" src="<?php echo base_url('/assets/chat/images/icon-videocall.png');?>" alt="QuickBlox Samples">Video call
        </button>
        <button id="hangup" type="button" class="btn btn-default" disabled>
          <img class="icon-hangup" src="<?php echo base_url('/assets/chat/images/icon-hangup.png');?>" alt="QuickBlox Samples">Hangup
        </button>
      </div>
    </section>
  </div>

  <section id="incomingCall" class="incoming modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <span class="info-notice"><span class="incoming-callType"></span> Call from <span class="caller"></span></span>
        </div>
        <div class="modal-body">
          <div class="incoming-call-controls l-flexbox l-flexbox_flexcenter">
            <button id="reject" class="btn btn-default btn_decline">Decline</button>
            <button id="accept" class="btn btn-default btn_accept">Accept</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="wrap">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Private chat with <span class="opponent"></span></h3>
        <button type="button" id="logout" class="btn tooltip-title" data-toggle="tooltip" data-placement="bottom" title="Exit">
          <span class="glyphicon glyphicon-log-out"></span>
        </button>
      </div>
      <div class="chat panel-body">
        <ul class="chat-user-list list-group">
        </ul>
        <div class="chat-content">
          <div class="messages"></div>
          <form action="#" class="controls">
            <div class="input-group">
              <span class="uploader input-group-addon">
                <span class="glyphicon glyphicon-file"></span>
                <input type="file" class="tooltip-title" data-toggle="tooltip" data-placement="right" title="Attach file">
                <div class="attach"></div>
              </span>
              <input type="text" class="form-control" placeholder="Enter your message here..">
              <span class="input-group-btn">
                <button type="submit" class="sendMessage btn btn-primary">Send</button>
              </span>
            </div>
            <div class="file-loading bg-warning">
              <img src="../images/file-loading.gif" alt="loading">
              Please wait.. File is loading
            </div>
          </form>
        </div>
      </div>
    </div><!-- .panel -->
  </section><!-- #wrap -->

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
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url('/assets/chat/chatmain/bower_components/quickblox/quickblox.js'); ?>"></script>
  <script src="<?php echo base_url('/assets/chat/chatmain/bower_components/quickblox/quickblox.chat.js'); ?>"></script>
  <script src="<?php echo base_url('/assets/chat/chatmain/scripts/jquery.scrollTo-min.js'); ?>"></script>
  <script src="<?php echo base_url('/assets/chat/chatmain/scripts/jquery.timeago.js'); ?>"></script>
  <script src="<?php echo base_url('/assets/chat/chatmain/scripts/main.js'); ?>"></script>
  <script src="<?php echo base_url('/assets/chat/chatmain/scripts/helpers.js'); ?>"></script>


  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="<?php echo base_url('/assets/chat/chatmain/js/perfect-scrollbar.jquery.js'); ?>"></script>
  <script src="<?php echo base_url('/assets/chat/chatmain/js/perfect-scrollbar.js'); ?>"></script>
  <script src="<?php echo base_url('/assets/chat/chatmain/js/bootstrap.min.js'); ?>"></script>
  <script src="<?php echo base_url('/assets/chat/chatmain/js/public.js'); ?>"></script>
  <script>
    $('.phone-call').on('click', function(){
      $('.chat-msgs').toggleClass('col-sm-12');
      $('.chat-msgs').toggleClass('col-sm-8');
      $('.chat-msgs').removeClass('col-sm-5');
      $('.audio-chat').toggleClass('hidden');
      $('.video-chat').addClass('hidden');
    });
    $('.video-call').on('click', function(){
      $('.chat-msgs').toggleClass('col-sm-5');
      $('.chat-msgs').toggleClass('col-sm-12');
      $('.chat-msgs').removeClass('col-sm-8');
      $('.video-chat').toggleClass('hidden');
      $('.audio-chat').addClass('hidden');
    });
    $('.all-user').on('click', function(){
      $('.users-list').toggle();
    });
    $(function() {
      $('.users-list, .chat-history').perfectScrollbar();   
      // with vanilla JS!
      //Ps.initialize(document.getElementById('Demo'));
    });
  </script>
