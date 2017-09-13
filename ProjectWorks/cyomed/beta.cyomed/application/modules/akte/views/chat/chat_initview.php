<link rel="shortcut icon" href="http://quickblox.com/favicon.ico">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url('/assets/chat/chatmain/main.css');?>">
<!-- Custom styles for this template -->
<link href="<?php echo base_url('/assets/chat/chatmain/css/avenir-font.css');?>" rel="stylesheet">
<link href="<?php echo base_url('/assets/chat/chatmain/css/perfect-scrollbar.css');?>" rel="stylesheet">
<link href="<?php echo base_url('/assets/chat/chatmain/css/custom-theme.css');?>" rel="stylesheet">

 <div class="chat_container">
    	
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="chat-block-main">                    
                    <div class="row">
                    	<div class="col-sm-3 sidebar-block">
                        	<div class="sidebar">
                            	<div class="user-itself">
                                	<div class="img"><img src="images/img.jpg" width="60px" alt=""></div>
                                    <h4 class="title"><span class="status status-online"></span> Steve Doe</h4>
                                    <div class="date-time">12 Apr 2015 <span>3:50 PM</span></div>
                                </div>
                                <div class="my-user">
                                	<div class="all-user visible-xs"><a href="javascript:void(0);"><span class="fa fa-bars"></span></a></div>
                                	<div class="search-user">
                                    	<input type="text" value="" class="inputbox">
                                        <button class="search-btn"><span class="fa fa-search"></span></button>
                                    </div>
                                    <div class="users-list">
                                    	<div class="user-block">
                                        	<div class="img"><img src="images/img.jpg" width="40px" alt=""></div>
                                            <h4 class="title"><span class="status status-online"></span> Steve Doe</h4>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9 chat-block">
                        	<div class="user-detail row">
                                <div class="col-sm-3 col-xs-4">
                                    <div class="img"><img src="images/img.jpg" width="100%" alt=""></div>
                                </div>
                                <div class="col-sm-5 col-xs-8">
                                    <div class="info">
                                        <h2>Julia Robert</h2>
                                        <h4><span class="status status-online"></span> Online</h4>
                                        <p class="font12">Last login at 12 Apr 2015 3:45 PM</p>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12 text-center">
                                    <ul class="list-inline chat-actions">
                                        <li>
                                            <button class="btn btn-primary btn-icon phone-call"><span class="fa fa-phone"></span></button>
                                            <button class="btn btn-primary btn-icon video-call"><span class="fa fa-video-camera"></span></button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        	<div class="row"> 
                            	<div class="col-sm-4 audio-chat hidden">
                                    <div class="audio-block">
                                    	<div class="img"><img src="images/img.jpg" width="100%" alt=""></div>
                                        <div class="call-time text-center">00.00.24</div>
                                        <ul class="text-center list-inline">
                                            <li><button class="btn btn-link"><span class="fa fa-microphone-slash"></span></button></li>
                                            <li><button class="btn btn-danger"><span class="fa fa-phone"></span></button></li>
                                            <li><button class="btn btn-link"><span class="fa fa-microphone"></span></button></li>
                                        </ul>
                                    </div>                                    
                                </div>
                                <div class="col-sm-7 ">
                                    <div class="video-block">
                                    	<section id="emptyList" class="">
                                          <span class="text text_alert">Oops...</span>
                                          <span class="text">You have't selected any contacts.</span>
                                          <img class="cap-anybody" src="<?php echo base_url('/assets/chat/chatmain/images/anybody.png');?>" alt="anybody">
                                      </section>
                                    </div>                                    
                                </div>                           	
                                <div class="col-sm-12 chat-msgs">                                    
                                    <div class="chat-history">
                                        <div class="chat">
                                            <div class="chat-msg">Hi</div>
                                            <div class="chat-time">12 Apr 2015 3:45 PM</div>
                                        </div>
                                        <div class="chat chat-me">
                                            <div class="chat-msg">Hi</div>
                                            <div class="chat-time">12 Apr 2015 3:45 PM</div>
                                        </div>
                                    </div>
                                    <div class="send-msg">
                                        <textarea class="form-control" rows="10" cols="5" placeholder="Type a message here"></textarea>
                                        <div class="action-bar">
                                        	<button class="btn btn-primary pull-right">Send</button>
                                            <div class="file-select font12"><span class="fa fa-paperclip"></span> Choose file to send</div>
                                            <div class="clr"></div>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
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
