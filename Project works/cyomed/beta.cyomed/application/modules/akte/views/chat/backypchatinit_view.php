<link rel="shortcut icon" href="http://quickblox.com/favicon.ico">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url('/assets/chat/main.css');?>">

<!-- Bootstrap core CSS -->
<link href="<?php echo base_url('/assets/chat/chatmain/css/font-awesome.min.css');?>" rel="stylesheet">
<link href="<?php echo base_url('/assets/chat/chatmain/css/bootstrap.min.css');?>" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="<?php echo base_url('/assets/chat/chatmain/css/avenir-font.css');?>" rel="stylesheet">
<link href="<?php echo base_url('/assets/chat/chatmain/css/perfect-scrollbar.css');?>" rel="stylesheet">
<link href="<?php echo base_url('/assets/chat/chatmain/css/custom-theme.css');?>" rel="stylesheet">


<input id = "token" value = '<?php echo $token;?>' hidden>
<input id = "user_id" value = '<?php echo $user_id;?>' hidden>
<input id = "login" value = '<?php echo $login;?>' hidden>
<input id = "user_name" value = '<?php echo $this->m->user_value('name');?><?php echo $this->m->user_value('surname');?>' hidden>


 <div class="chat_container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="chat-block-main">                    
                    <div class="row">
                        <div class="col-sm-3 sidebar-block">
                            <div class="sidebar">
                                <div class="user-itself">
                                    <div class="img">
                                    <img src="<?php $this->load->model('document/mdoc'); echo ($img_path = $this->mdoc->get_profile_image_path()) ? base_url($img_path) : '//placehold.it/60x60'; ?>"  width="60px" alt="Profile Image">
                                    </div>
                                    <h4 class="title"><span class="status status-online"></span> <?php echo $this->m->user_value('name'); ?> <?php echo $this->m->user_value('surname'); ?></h4>
                                    <div class="date-time">12 Apr 2015 <span>3:50 PM</span></div>
                                </div>
                                <div class="my-user">
                                    <div class="all-user visible-xs"><a href="javascript:void(0);"><span class="fa fa-bars"></span></a></div>
                                    <div class="search-user">
                                        <input type="text" value="" class="inputbox">
                                        <button class="search-btn"><span class="fa fa-search"></span></button>
                                    </div>
                                    <div class="users-list">
                                      <?php foreach ($my_users as $key):?>    
                                        
                                        <form name="search-form<?php echo $key['id'];?>" id="search-form" method="post" action="<?php echo site_url('akte/chat/callsend'); ?>" enctype="multipart/form-data">
                                          <input type="hidden" name="callee_id"  value= "<?php echo $key['id'];?>" />
                                          <input type="hidden" name="callee_name"  value= "<?php echo $key['name'];?>" />
                                          <input type="hidden" name="callee_regid"  value= "<?php echo $key['regid'];?>" />
                                          <input type="hidden" name="user_id"  value= "<?php echo $user_id;?>" />
                                          <input type="hidden" name="token"  value= "<?php echo $token;?>" />
                                          <input type="hidden" name="login"  value= "<?php echo $login;?>" />
                                          
                                          <div  class="user-block" onClick="document.forms['search-form<?php echo $key['id'];?>'].submit();"  > 
                                            

                                            <div class="img">
                                              <img src="<?php $this->load->model('document/mdoc');echo ($img_path = $this->mdoc->get_profile_img_path($key['regid'])) ? base_url($img_path) : '//placehold.it/120x120'; ?>"  width="40px" alt="Profile Image"/> 
                                            </div>
                                            <h4 class="title"><span class="status status-online"></span> <?php echo $key['name'];?> </h4>
                                          </div>

                                        </form>

                                      <?php endforeach;?>
                                      
                                    </div>

                                    
                                    <!--
                                    <div class="users-list">
                                    <?php foreach ($my_users as $key):?>
                                        
                                        <div  class="user-block "  id="videochat" >
                                            <input class = "callee_id" value = '<?php echo $key['id'];?>' hidden>
                                            <input class = "callee_name" value = '<?php echo $key['name'];?>' hidden>
                                            <div class="img">
                                                <img src="<?php $this->load->model('document/mdoc');echo ($img_path = $this->mdoc->get_profile_img_path($key['regid'])) ? base_url($img_path) : '//placehold.it/120x120'; ?>"  width="40px" alt="Profile Image"/> 
                                            </div>
                                            <h4 class="title"><span class="status status-online"></span> <?php echo $key['name'];?> </h4>
                                        </div>
                                        
                                    <?php endforeach;?>
                                    </div>
                                    -->
                                </div>
                            </div>
                        </div>


                        <div  class="col-sm-9 chat-block" >
                            <div class="user-detail row">
                                <div id="textchat" class="col-sm-3 col-xs-4 callto" data-value="<?php echo $callee_id;?>">
                                    <input class = "callee_id" value = '<?php echo $callee_id;?>' hidden>
                                    <input class = "callee_name" value = '<?php echo $callee_name;?>' hidden>

                                    <div class="img">
                                    <img src="<?php $this->load->model('document/mdoc');echo ($img_path = $this->mdoc->get_profile_img_path($callee_regid)) ? base_url($img_path) : '//placehold.it/120x120'; ?>"  width="100%" alt="Profile Image"/> 
                                    </div>
                                </div>
                                <div class="col-sm-5 col-xs-8">
                                    <div class="info">
                                        <h2 ><?php echo $callee_name;?></h2>
                                        <h4><span class="status status-online"></span> Online</h4>
                                        <p class="font12">Last login at <?php echo $key['lastlogin'];?></p>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12 text-center" >
                                          
                                    <ul class="list-inline chat-actions">
                                        <li>
                                            <button id="audiochat" class="btn btn-primary btn-icon phone-call"><span class="fa fa-phone"></span></button>
                                            <button id="videochat" class="btn btn-primary btn-icon video-call" value="<?php echo $callee_id;?>" name="<?php echo $callee_name;?>" data-value="<?php echo $callee_id;?>"><span class="fa fa-video-camera"></span>
                                              </button>
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
                                
                                <section id="wrapper">
                                <div class="col-sm-7 video-chat hidden">
                                    <div class="video-block">
                                        <div class="img"><video id="remoteVideo"></video></div>
                                        <div class="me-img"><video id="localVideo"></video></div>
                                        <ul class="text-center list-inline">
                                            <li><button class="btn btn-link"><span class="fa fa-microphone-slash"></span></button></li>
                                            <li><button id="hangup" type="button" class="btn btn-danger hang-up hidden" disabled><span class="fa fa-phone"></span></button></li>
                                            <li><button id="videocall" type="button" class="btn btn-success videocall" ><span class="fa fa-phone"></span></button></li>
                                            <li><button class="btn btn-link"><span class="fa fa-microphone"></span></button></li>
                                        </ul>
                                    </div>                                    
                                </div> 
                                </section>

                                <section id="wraping">

                                <div class="chat col-sm-12 chat-msgs">

                                  <div class="chat-history">
                                    <div class="messages"></div>
                                  </div>

                                  <div class="send-msg">
                                    <form action="#" class="">

                                    <input type="text" class="form-control"  rows="10" cols="5" placeholder="Enter your message here..">

                                      <div class="action-bar">


                                
                                        <button type="submit" class="sendMessage btn btn-primary pull-right">Send</button>
                                        

                                        <div class="file-select font12"><span class="fa fa-paperclip"></span> Choose file to send
                                          <input type="file"  data-toggle="tooltip"  title="Attach file">
                                            
                                        </div>
                                            <div class="attach"></div>
                                            <div class="clr"></div>

                                      </div>

                                      <div class="file-loading bg-warning">
                                        <img src="../images/file-loading.gif" alt="loading">
                                        Please wait.. File is loading
                                      </div>
                                    </form>
                                  </div>

                                  </div>

                                </section><!-- #wrap -->
                                

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
  <script src="<?php echo base_url('/assets/chat/bower_components/quickblox/quickblox.js'); ?>"></script>
  <script src="<?php echo base_url('/assets/chat/bower_components/quickblox/quickblox.chat.js'); ?>"></script>
  <script src="<?php echo base_url('/assets/chat/scripts/jquery.scrollTo-min.js'); ?>"></script>
  <script src="<?php echo base_url('/assets/chat/scripts/jquery.timeago.js'); ?>"></script>
  <script src="<?php echo base_url('/assets/chat/scripts/main.js'); ?>"></script>
  <script src="<?php echo base_url('/assets/chat/scripts/helpers.js'); ?>"></script>


  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="<?php echo base_url('/assets/chat/chatmain/js/perfect-scrollbar.jquery.js'); ?>"></script>
  <script src="<?php echo base_url('/assets/chat/chatmain/js/perfect-scrollbar.js'); ?>"></script>
  <script src="<?php echo base_url('/assets/chat/chatmain/js/public.js'); ?>"></script>
  <script>

    jQuery(function(){
      jQuery('#textchat').click();
    });


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
    $('.videocall').on('click', function(){
      $('.hang-up ').toggleClass('hidden');
      $('.videocall').addClass('hidden');
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
