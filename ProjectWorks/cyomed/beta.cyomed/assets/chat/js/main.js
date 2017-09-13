var mediaParams, caller, callee, textvisibility, returnMessage;

QB.init(20710, 'z9STk7LvBE9PJu-', 'eTJOZ5Acn9zs9Nb');

$(document).ready(function () {
	textvisibility=false;
	returnMessage="please stay on this page, Cyomed Service will connect you soon.";
	
	$('#textchat').on('click',function(){
		toggleTextchat();
    //$('.textchat').toggle("slide",{direction: 'right'},600);
  	});

	caller = {
		id: $('#user_id').val(),
		full_name: $('#user_name').val(),
		login: $('#login').val(),
		password: 'cyomedvideo' 
	};

	createSession();

	function createSession() {
		QB.createSession(caller, function(err, res) {
			if (res) {
				connectChat();
				QB.chat.onMessageListener = showMessage;
				if(window.opener){
					if(window.opener.quickblox_id){
						document.title = 'videocall to '+window.opener.pat_name;
						setTimeout(function(){
							makecall(window.opener.quickblox_id,window.opener.pat_name);
						}, 3000);
					}
					/*send the request trigger to service center to add a table row*/
					else if(window.opener.care_id){
						careId=window.opener.care_id;
						$.ajax({
							url: $.siteUrl+'/video/get_service_for_notification',
						})
						.done(function(data){
							$.each(JSON.parse(data),function(index,service){
								setTimeout(function(){
									sendMessage(service.id,window.opener.care_id,false);
								},4000);
							});
						});
					}
				}
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



	function makecall(quickblox_id,pat_name){
		callee = {
			id: quickblox_id,
			full_name: pat_name,
			login: '',
			password: '' 
		};
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
			name: 'Cyomed Doctor'
		};
		QB.webrtc.getUserMedia(mediaParams, function(err, stream) {
			if (err) {
				console.log(err);
				$('#infoMessage').text('Devices are not found');
			} else {
				$('#callingSignal')[0].play();
				$('#makecall').attr('disabled', 'disabled');
				$('.btn_mediacall, #endcall').removeAttr('disabled'); 
				$('.make-call').addClass('hidden');
				$('.end-call').removeClass('hidden');
				$('.connecting').removeClass('hidden');
         	//$('.remoteImg').addClass('hidden'); 
         	//$('.remoteVideo').removeClass('hidden'); 
         	//$('.localImg').addClass('hidden'); 
         	//$('.localVideo').removeClass('hidden');
         	QB.webrtc.call(callee.id, 'video', extension);
       	}
     	});
	}

  // Accept call
  //
  	$('#accept').on('click', function() {
  		$('#incomingCall').modal('hide');
  		QB.webrtc.getUserMedia(mediaParams, function(err, stream) {
  			if (err) {
  				console.log(err);
  				$('#infoMessage').text('Devices are not found');
  				QB.webrtc.reject(callee.id);
  			} else {
  				$('#ringtoneSignal')[0].pause();
  				$('.btn_mediacall, #hangup, #textchat').removeAttr('disabled');
  				$('#makecall').attr('disabled', 'disabled');
  				$('.make-call').addClass('hidden');
  				$('.remoteImg').addClass('hidden'); 
  				$('.remoteVideo').removeClass('hidden'); 
  				$('.localImg').addClass('hidden'); 
  				$('.localVideo').removeClass('hidden');
  				QB.webrtc.accept(callee.id);
  			}
  		});
  	});


  // Reject
  //
  	$('#reject').on('click', function() {
  		$('#incomingCall').modal('hide');
  		$('#ringtoneSignal')[0].pause();
  		if (typeof callee != 'undefined'){
  			QB.webrtc.reject(callee.id);
  		}
  	});


  // Hangup
  //
  	$('#endcall').on('click', function() {
  		$('.btn_mediacall, #endcall').attr('disabled', 'disabled');
  		$('#makecall').removeAttr('disabled', 'disabled');
  		$('.make-call').removeClass('hidden');
  		$('video').attr('src', '');
  		$('#callingSignal')[0].pause();
  		$('#endCallSignal')[0].play();
  		$('.end-call').addClass('hidden');
  		$('.remoteImg').removeClass('hidden'); 
  		$('.remoteVideo').addClass('hidden'); 
  		$('.localImg').removeClass('hidden'); 
  		$('.localVideo').addClass('hidden');
  		extension={
  			name: 'Cyomed Doctor'
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


QB.webrtc.onCallListener = function(id, extension) {
	if(extension.name=='Cyomed Doctor'){
		returnMessage="Thank you for using our service";
	}else{
		returnMessage="Please Stay on this page, Cyomed Doctor will connect you soon";
	}
	mediaParams = {
		audio: true,
		video: extension.callType === 'video' ? true : false,
		elemId: 'localVideo',
		options: {
			muted: true,
			mirror: true
		}
	};
	callee = {
		id: extension.callerID,
		full_name: extension.name,
		login: "",
		password: ""
	};

	$('.callerName').text(callee.full_name);

	$('#ringtoneSignal')[0].play();
    // $('#incomingCall').modal({
    //   backdrop: 'static',
    //   keyboard: false
    // });
$('#accept').click();
};

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
	$('.btn_mediacall, #hangup').attr('disabled', 'disabled');
	$('#makecall').removeAttr('disabled');
	$('video').attr('src', '');
	$('.make-call').removeClass('hidden');
	$('.end-call').addClass('hidden');
	$('.remoteImg').removeClass('hidden'); 
	$('.remoteVideo').addClass('hidden'); 
	$('.localImg').removeClass('hidden'); 
	$('.localVideo').addClass('hidden');
	$('#callingSignal')[0].pause();
	$('#endCallSignal')[0].play();
	$('#infoMessage').text(callee.full_name + ' has rejected this call');
};

QB.webrtc.onStopCallListener = function(id, extension) {
	console.log(extension);
	if(extension.name=='Cyomed Service' && extension.reason=='manually'){
		$('.mediacall-remote-name').text("Connecting to Cyomed Doctor");
	}
	$('#hangup, #textchat').attr('disabled', 'disabled');
	$('#audiocall, #videocall').removeAttr('disabled');
	$('video').attr('src', '');
	$('#incomingCall').modal('hide');
	$('.remoteImg').removeClass('hidden'); 
	$('.remoteVideo').addClass('hidden'); 
	$('.localImg').removeClass('hidden'); 
	$('.localVideo').addClass('hidden');
	$('.l-chat-content').removeData().html("");
	
	if(textvisibility===true)
		toggleTextchat();
	
	$('#ringtoneSignal')[0].pause();
	$('#endCallSignal')[0].play();
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
		html+='<h4 class="message-author">';
		html+='<span class="profileUserName">';
		html+=msg.extension && msg.extension.nick;
		html+='</span>';
		html+='</h4>';
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
	}
}

function toggleTextchat(){
	if(!textvisibility){
		$('.video-chat').animate({width:'75%'});
		$('.textchat').slideToggle("slow");
		textvisibility=true;
	}else{
		$('.video-chat').animate({width:'100%'});
		$('.textchat').slideToggle("slow");
		textvisibility=false;
	}
}


function userIcon(hexColorCode) {
	return '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" viewBox="0 0 48 48"><path d="M24 30c0 0-16 0-22 14 0 0 10.020 4 22 4s22-4 22-4c-6-14-22-14-22-14zM24 28c6 0 10-6 10-16s-10-10-10-10-10 0-10 10 4 16 10 16z" fill="#' + (hexColorCode || '666') + '"></path></svg>';
}
