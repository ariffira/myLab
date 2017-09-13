var mediaParams, caller, callee;

QB.init(20710,'z9STk7LvBE9PJu-','eTJOZ5Acn9zs9Nb');

$(document).ready(function() {

  caller = {
    id: $('#user_id').val(),
    full_name: $('#user_name').val(),
    login: $('#login').val(),
    password: 'cyomedvideo' };

    createSession();

    function createSession() {
      QB.createSession(caller, function(err, res) {
        if (res) {
          connectChat();
          QB.chat.onMessageListener = showMessage;
    //   if(window.opener){
    //   console.log(window.opener.quickblox_id);
    //   if(window.opener.quickblox_id){
    //     setTimeout(function(){
    //     makecall(window.opener.quickblox_id);
    //     document.title = 'videocall to '+window.opener.pat_name;
    //     }, 5000);
    //   }
    // }
  }
});
    }

    $('input:file').change(function(){
     var file = $('input:file')[0].files[0];
     $('.textarea').text("loading......");
     $('.textarea').addClass('disabled');
     if(file){
      QB.content.createAndUpload({file: file, 'public': true}, function(err, result) {
        if (err) {
          console.log(err.detail);
        } else {
          name = result.name;
          uid = result.uid;
          path = result.path;
          msg = {
            type: 'chat',
            extension: {
              nick: caller.full_name,
              time: Math.floor(Date.now() / 1000),
              fileName: name,
              fileUID: uid,
              filePath: path
            }
          };
          $('.textarea').removeClass('disabled');
          $('.textarea').text("");

          user_jid = QB.chat.helpers.getUserJid(callee.id, 20710);
          QB.chat.send(user_jid, msg);

          showMessage(null, msg);
        }
      });
    }
  });

    $('#broadcast_changes').on('click',function(e){
      e.preventDefault();
      var msg, user_id;
      $.ajax({
        type: "POST",
      url: site_url+"/center/update_specialization", // 
      data: $('form.speciality').serialize(),
    })
      .done(function(doctors){
        $("#broadcast").modal('hide');
        msg = {
          type: 'chat',
          extension: {
            nick: caller.full_name,
            time: Math.floor(Date.now() / 1000),
            broadcast: 'broadcast'
          }
        };
        $.each(JSON.parse(doctors),function(index,doctor){
          user_jid = QB.chat.helpers.getUserJid(doctor.quickbloxId, 20710);
          QB.chat.send(user_jid, msg);
        });
      })
      .fail(function(){
        alert("failure");
      });
    });

    /*event trigger for onclock select button with jquery delegation on ajax loaded rows*/
    $('#pending').on('click', 'button',function(e){
      $row = $(this);
      if($row.is('.select_patient')){
        $care_id = $row.closest('tr').find('.care_id').text();
        $.getJSON(site_url+'/center/insert_care_doctor_id?id='+$care_id,function(data){             
            $.each(data,function(key,value){
                if(value==-1){
                  alert('patient taken');
                  $row.closest('tr').remove();
                }else{
                  $row.closest('tr').find('.make_call').removeClass('hidden');
                  $row.closest('tr').find('.broadcast').removeClass('hidden');
                  $row.closest('tr').find('.select_patient').addClass('hidden');
                  $.ajax({
                     url: site_url+'/center/get_service_for_notification',
                  })
                  .done(function(data){
                     $.each(JSON.parse(data),function(index,service){
                        if(service.id!=caller.id) //don't send the msg to oneself
                           sendMessage(service.id,$care_id,false);
                     });
                  });
                }
            });            
        }); 
      }
    });

    /*event trigger for onclock call button with jquery delegation on ajax loaded rows*/
    $('#pending, #example2').on('click', 'button',function(e){
      $row=$(this);
      if($row.is('.make_call')){
        $regid = $row.data('regid');
       	$care_id = $row.closest('tr').find('.care_id').text();
        $.getJSON(site_url+'/center/img_src?regid='+$regid+'&care_id='+$care_id,function(data){
          $.each(data,function(key,val){
            if(val){
              $('.remoteImg').attr('src',val);
            }else{
              $('.remoteImg').attr('src','//placehold.it/768x1024');
            }
          });
        });
        $patient_qb_id = $row.closest('tr').find('.patient_qb_id').val();
        callee = {
          id: $patient_qb_id,
          full_name: 'Cyomed User',
          login: '',
          password: '' };
          mediaParams = {
            audio: true,
            video: true,
            elemId: 'localVideo',
            options: { 
              muted: true,
              mirror: true
            }
          };

          extension={
            name: 'Cyomed Service'
          };
          QB.webrtc.getUserMedia(mediaParams, function(err, stream) {
            if (err) {
              console.log(err);
              $('#infoMessage').text('Devices are not found');
            } else {
              $('.box').addClass('hidden');
              $('#quickblox').removeClass('hidden');
              $('.connecting').removeClass('hidden');
              $('#callingSignal')[0].play();
              QB.webrtc.call(callee.id, 'video', extension);
            }
          });
         }
         else if($row.is('.broadcast')){
            $care_id = $row.closest('tr').find('.care_id').text();
            $('#careId').val($care_id);    //set the care id in modal 
         }    
      });
  // Hangup
  //
  $('#endcall').on('click', function() {
    $('video').attr('src', '');
    $('#callingSignal')[0].pause();
    $('#endCallSignal')[0].play();
    $('.box').removeClass('hidden');
    $('#quickblox').addClass('hidden');
    extension={
  		name: 'Cyomed Service'
  	};
    if (typeof callee != 'undefined'){
      QB.webrtc.stop(callee.id, 'manually',extension);
    }
  });


  // Mute camera
  //
  $('.btn_camera_off').on('click', function() {
    var action = $(this).data('action');
    if (action === 'mute') {
      $(this).addClass('off').data('action', 'unmute');
      QB.webrtc.mute('video');
    } else {
      $(this).removeClass('off').data('action', 'mute');
      QB.webrtc.unmute('video');
    }
  });


  // Mute microphone
  //
  $('.btn_mic_off').on('click', function() {
    var action = $(this).data('action');
    if (action === 'mute') {
      $(this).addClass('off').data('action', 'unmute');
      QB.webrtc.mute('audio');
    } else {
      $(this).removeClass('off').data('action', 'mute');
      QB.webrtc.unmute('audio');
    }
  });
});

QB.webrtc.onAcceptCallListener = function(id, extension) {
  $('#callingSignal')[0].pause();
  $('#infoMessage').text(callee.full_name + ' has accepted this call');
  $('.remoteImg').addClass('hidden'); 
  $('.remoteVideo').removeClass('hidden'); 
  $('.localImg').addClass('hidden'); 
  $('.localVideo').removeClass('hidden'); 
  $('.connecting').addClass('hidden');
};

QB.webrtc.onRejectCallListener = function(id, extension) {
  $('video').attr('src', '');
  $('#callingSignal')[0].pause();
  $('#endCallSignal')[0].play();
  $('.box').removeClass('hidden');
  $('#quickblox').addClass('hidden');
  $('#infoMessage').text(callee.full_name + ' has rejected this call');
};

QB.webrtc.onStopCallListener = function(id, extension) {
  $('video').attr('src', '');
  $('#incomingCall').modal('hide');
  $('#callingSignal')[0].pause();
  $('#endCallSignal')[0].play();
  $('.box').removeClass('hidden');
  $('#quickblox').addClass('hidden');
};

QB.webrtc.onRemoteStreamListener = function(stream) {
  QB.webrtc.attachMediaStream('remoteVideo', stream);
};



function connectChat() {
  $('#infoMessage').text('Connecting to chat...');
  QB.chat.connect({
    jid: QB.chat.helpers.getUserJid(caller.id, 20710),
    password: caller.password
  }, function(err, res) {
    $('.connecting').addClass('hidden');
    $('.chat').removeClass('hidden');
    $('#callerName').text('You');
    $('#infoMessage').text('Logged in as ' + caller.full_name);
  });
}

function toggleFullScreen() {
  if ((document.fullScreenElement && document.fullScreenElement !== null) ||    
   (!document.mozFullScreen && !document.webkitIsFullScreen)) {
    if (document.documentElement.requestFullScreen) {  
      document.documentElement.requestFullScreen();  
    } else if (document.documentElement.mozRequestFullScreen) {  
      document.documentElement.mozRequestFullScreen();  
    } else if (document.documentElement.webkitRequestFullScreen) {  
      document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);  
    }  
  } else {  
    if (document.cancelFullScreen) {  
      document.cancelFullScreen();  
    } else if (document.mozCancelFullScreen) {  
      document.mozCancelFullScreen();  
    } else if (document.webkitCancelFullScreen) {  
      document.webkitCancelFullScreen();  
    }  
  }  
}

$('.textarea').keydown(function(evt){
  if(evt.keyCode !=13 || $('.textarea').text()===""){
    return;
  }
  evt.preventDefault();
  var msg = $('.textarea').text();
  sendMessage(callee.id,msg);
  $('.textarea').text("");
  
});


/**
 * [text chat function to send text]
 * @param  {[type]} user_id [description]
 * @param  {[type]} val     [description]
 * @return {[type]}         [description]
 */
 function sendMessage(user_id, val,showMsg) {
  var msg, user_jid;
  showMsg = typeof showMsg !== 'undefined'?showMsg:true;
  msg = {
    type: 'chat',
    body: val,
    extension: {
      nick: caller.full_name,
      role: 'service',
      time: Math.floor(Date.now() / 1000),
    }
  };

  user_jid = QB.chat.helpers.getUserJid(user_id, 20710);
  if(showMsg){
    showMessage(null, msg);
  }else{
    msg.extension.broadcast = 'broadcast';
  }
  QB.chat.send(user_jid, msg);
}
// Show messages in UI
//
function showMessage(userId, msg) {
  if(!msg.extension.broadcast){
    var html;
    var time = msg.extension && msg.extension.time;
    var messageDate = new Date(time * 1000);
    html='<article class="message l-flexbox l-flexbox_alignstretch ';
    html+=(userId)?"is-opponent":"is-own";
    html+='" data-id=';
    html+= (userId)?userId:caller.id;
    html+=' data-type="message">';
    html+='<div class="message-avatar avatar contact-avatar_message profileUserAvatar " style="background-image:url('+$.baseUrl+'assets/chat/images/chatcare.jpg)"></div>';
    html+='<div class="message-container-wrap">';
    html+='<div class="message-container l-flexbox l-flexbox_flexbetween l-flexbox_alignstretch">';
    html+='<div class="message-content">';
    html+='<h5 class="message-author">';
    html+='<span class="profileUserName">';
    html+=msg.extension && msg.extension.nick;
    html+='</span>';
    html+='</h5>';
    html+='<div class="message-body">';
    html+=msg.body?msg.body:'';
    
    if(msg.extension.fileName && msg.extension.fileUID){
      url=msg.extension.filePath;
      html+='<div class="preview preview-photo" data-url="';
      html+=url;
      html+='" ><a href="' + url + '" download><img src="';
      html+=url;
      html+='" alt="attach" class="mCS_img_loaded"></a></div>';
    }
    html+='</div>';
    html+='</div>';
    html+='<time class="message-time">';
    html+=messageDate.getHours() + ':' + (messageDate.getMinutes().toString().length === 1 ? '0'+messageDate.getMinutes() : messageDate.getMinutes()) + ':' + messageDate.getSeconds();
    html+='</time></div></div></article>';
    $('.l-chat-content').append(html);
    $('.l-chat-content').stop().animate({
      scrollTop: $('.l-chat-content')[0].scrollHeight
    },800);
   }else{
      if(msg.extension.role){    //broadcast msg from service person on patient select to service persons to delete selected row from table
         delete_selected_patient(msg.body);
      }else{                     //broadcast msg from patient on request made to all sevice person to add a new row to table
         add_new_patient_request(msg.body); 
      }       
   }
}

$(window).on('beforeunload',function(){
  $('#endcall').click();
});


function add_new_patient_request(care_id){
  var row;
  var newRequest=true;
  $('#pending > tbody > tr').each(function(){
      $row=$(this);
      if($row.find('.care_id').text()==care_id){
        // if($('.not_broadcasted').hasClass('active')){
        //     $('.not_broadcasted').removeClass('active');
        //     $('#not_broadcasted').removeClass('active');
        //     $('#not_broadcasted').hide();
        //     $('.pending').addClass('active');
        //     $('#pending').addClass('active');
        // }
        alert('Care ID '+care_id+'needs your attention'); 
        newRequest=false;
      }
   });
  $('#example2 > tbody > tr').each(function(){
      $row=$(this);
      if($row.find('.care_id').text()==care_id){
        // if($('.pending').hasClass('active')){
        //     $('.pending').removeClass('active');
        //     $('#pending').removeClass('active');
        //     $('#pending').hide();
        //     $('.not_broadcasted').addClass('active');
        //     $('#not_broadcasted').addClass('active');
        // }
        alert('Care ID '+care_id+'needs your attention');
        newRequest=false;
      }
   });
  if(newRequest){
  	$.getJSON(site_url+'/center/get_new_request?care_id='+care_id,function(data){
  		$.each(data,function(key,val){
  			row='<tr>';
  			row+='<td class="care_id">'+val.id+'</td>';
  			row+='<td>'+val.name+'</td>';
  			row+='<td>'+val.regid+'</td>';
  			row+='<td>'+val.address+'</td>';
  			row+='<td>'+val.phone+'</td>';
  			row+='<td>'+val.apply_time+'</td>';
  			row+='<td>';
  			row+='<input class = "patient_qb_id hidden" value ='+ val.quickblox_id+'>';
  			row+='<button class="btn btn-info select_patient" style="margin-right: 5px;"> Select</button>';
  			row+='<button class="btn btn-success make_call hidden" data-regid='+val.regid+'><i class="fa fa-phone"></i> Call</button>';
  			row+='<button class="btn btn-primary broadcast hidden" data-toggle="modal" data-target="#broadcast"><i class="fa fa-rss"></i> Broadcast</button>';
  			row+='</td>';
  			row+='<td>';
  			row+='<button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button>';
  			row+='</td>';
  			row+='</tr>';
  		});
  		$('#pending > tbody').append(row);
  	}).fail(function() {
  		console.log( "error" );
  	});
  }
}

function delete_selected_patient(care_id){
   $('#pending > tbody > tr').each(function(){
      $row=$(this);
      if($row.find('.care_id').text()==care_id)
        $row.remove(); 
   });

}

function userIcon(hexColorCode) {
  return '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" viewBox="0 0 48 48"><path d="M24 30c0 0-16 0-22 14 0 0 10.020 4 22 4s22-4 22-4c-6-14-22-14-22-14zM24 28c6 0 10-6 10-16s-10-10-10-10-10 0-10 10 4 16 10 16z" fill="#' + (hexColorCode || '666') + '"></path></svg>';
}
