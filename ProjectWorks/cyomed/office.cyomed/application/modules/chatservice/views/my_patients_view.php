<?php $care_id=null;?>
<div class="col-xs-12">
   
<input id = "token" value = '<?php echo $quickblox['token'];?>' hidden>
<input id = "user_id" value = '<?php echo $quickblox['user_id'];?>' hidden>
<input id = "login" value = '<?php echo $quickblox['login'];?>' hidden>

<div id ='quickblox' class="video-chat hidden">
  <div class="mediacall l-flexbox" style="min-height:520px; max-height:768px;">
  
    <video id="remoteVideo" class="mediacall-remote-stream remoteVideo hidden">
    </video>
    <video id="localVideo" class="mediacall-local mediacall-local-stream localVideo hidden">
    </video>
    <img id="localImg" class="mediacall-local mediacall-local-avatar localImg" data-src="<?php echo $this->mod->user_value('avatar') ? $this->mod->user_value('avatar') : '//placehold.it/768x1024'; ?>" src="<?php echo $this->mod->user_value('avatar') ? $this->mod->user_value('avatar') : '//placehold.it/768x1024'; ?>" alt="avatar">
    
    <div id="remoteImg" class="mediacall-remote-user l-flexbox l-flexbox_column remoteImg">
      <img class="mediacall-remote-avatar" src="<?php echo $this->mod->user_value('avatar') ? $this->mod->user_value('avatar') : '//placehold.it/768x1024'; ?>" alt="avatar">
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
        <button id="endcall" class="btn_mediacall btn_hangup end_call" >
          <img class="btn-icon_mediacall" src="<?php echo base_url('/assets/chat/images/icon-hangup.svg');?>" alt="hangup">
        </button>
      </div>
    </div>
  </div>


  <div class="box">
    <div class="box-header">
      <h3 class="box-title">CYOMED Care- My Patients</h3>

    </div><!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Patient Name </th>
            <th>Help Submitted</th> 
            <th>Broadcasted</th>                 
            <th>Doctor Name</th>
            <th>Callback Time</th>
            <th>Action</th>
            <th>Over-ride</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php foreach($process_details as $details) :?>
            <td class='care_id'><?php echo $details['id'];?></td>
            <td><?php echo $details['name'];?>
               <button class="btn btn-info btn-sm pull-right get_patient_detail" data-toggle="modal" data-target="#patient-details">
                <i class="fa fa-info"></i>
              </button>
            </td>
            <td><?php echo $details['apply_time'];?></td>
            <td><?php echo $details['broadcast_time'];?></td>
            <td><?php echo $details['doctor_name'] ? $details['doctor_name']: 'No Response!'; ?> 
              <button class="btn btn-info btn-sm pull-right get_doctor_detail" data-toggle="modal" data-target="#doctor-details">
                <i class="fa fa-info"></i>
              </button>
            </td>
            <td><?php echo $details['doctor_callback_time'] ? $details['doctor_callback_time']: 'No Response!'; ?></td>
            <td>
              <strong><?php echo $details['help_status'];?></strong>
            </td>
            <td>
              <button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button>
            </td>
          </tr>
        <?php endforeach; ?>

        
        </tbody>
        <tfoot>
          <tr>
            <th>ID</th>
            <th>Patient Name</th>
            <th>Help Submitted</th> 
            <th>Broadcasted</th>                 
            <th>Doctor Name</th>
            <th>Callback Time</th>
            <th>Action</th>
            <th>Over-ride</th>
          </tr>
        </tfoot>
      </table>

    </div><!-- /.box-body -->
  </div><!-- /.box -->
</div><!-- /.col -->



<div id="broadcast" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h3>Choose the specialization to broadcast</h3>
      </div>
      <div class="modal-body">
        <form class="speciality" name="contact" action="<?php echo site_url('chatservice/center/update_specialization');?>" method="post">
          <input id='careId' name='careId' type='text' value='' hidden/>
          <label class="label" for="name">Select Specialzation</label><br>
          <select type="text" name="specialization" id="specialization" class="select">
            <?php foreach($specialization as $sp) :?>
              <option value="<?php echo $sp->id;?>"><?php echo $sp->splizn_name;?></option>
            <?php endforeach;?>
          </select>
          <button type="submit" id="hiddensubmit" hidden></button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <input class="btn btn-success" value="Broadcast" id="broadcast_changes">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<div id="patient-details" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h3>Details of the patient</h3>
      </div>
      <div class="modal-body">
          <div id='put_patient_detail' class="table-responsive">

          </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<div id="doctor-details" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h3>Details of the doctor</h3>
      </div>
      <div class="modal-body">
          <div id='put_doctor_detail' class="table-responsive">
                
          </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
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

<script src="<?php echo base_url('assets/theme-admin/plugins/jQuery/jQuery-2.1.4.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/chat/bower_components/quickblox/quickblox.js'); ?>"></script>
<script src="<?php echo base_url('/assets/chat/bower_components/quickblox/quickblox.chat.js'); ?>"></script>
<script src="<?php echo base_url('/assets/chat/scripts/jquery.scrollTo-min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/chat/scripts/jquery.timeago.js'); ?>"></script>
<script src="<?php echo base_url('/assets/chat/scripts/main.js'); ?>"></script>
<script src="<?php echo base_url('/assets/chat/scripts/helpers.js'); ?>"></script>
<script src="<?php echo base_url('/assets/chat/chatmain/js/public.js'); ?>"></script>



<script type="text/javascript">
jQuery(function(){
      jQuery('#quickblox').click();
    });

var patient_qb_id;
  $(function(){
    $('.select_patient').click(function(){
      $row=$(this);
      $care_id = $row.closest('tr').find('.care_id').text();
       $.getJSON("<?php echo site_url('chatservice/center/insert_care_doctor_id?id=');?>"+$care_id,function(data){             
            $.each(data,function(key,value){
                if(value==-1){
                  alert('patient taken');
                }else{
                  $row.closest('tr').find('.make_call').removeClass('hidden');
                  $row.closest('tr').find('.broadcast').removeClass('hidden');
                  $row.closest('tr').find('.select_patient').addClass('hidden');
                }
            });            
        }); 
    });
    $('.broadcast').click(function(){
     $row=$(this);
     $care_id = $row.closest('tr').find('.care_id').text();
     $('#careId').val($care_id);
    });
    $('#broadcast_changes').click(function(){
     $('#hiddensubmit').click();
    });
   
     // $('#broadcast_changes').click(function(){
     //  $.ajax({
     //        type: "POST",
     //        url: "<?php echo site_url('chatservice/center/update_specialization');?>", // 
     //        data: $('form.speciality').serialize(),
     //        success: function(){
     //          $("#broadcast").modal('hide'); 
     //        },
     //        error: function(){
     //          alert("failure");
     //        }
     // });
  
    $('.get_patient_detail').click(function(){
      $row=$(this);
      $care_id = $row.closest('tr').find('.care_id').text();
       $.getJSON("<?php echo site_url('chatservice/center/get_details?id=');?>"+$care_id,function(data){
          html='<table class="table"><tbody>';
            $.each(data,function(key,val){
              html+='<tr><th>ID:</th>';
              html+='<td>'+val.patient_id+'</td></tr>';
              html+='<tr><th>Name:</th>';
              html+='<td>'+val.name+'</td></tr>';
              html+='<tr><th>RegID</th>';
              html+='<td>'+val.regid+'</td></tr>';
              html+='<tr><th>Address:</th>';
              html+='<td>'+val.address+'</td></tr>';
              html+='<tr><th>Phone:</th>';
              html+='<td>'+val.phone+'</td></tr>';
            });
            html+='</tbody></table>';
            $('#put_patient_detail').empty();
            $('#put_patient_detail').append(html);          
        }); 
    });

    $('.get_doctor_detail').click(function(){
      $row=$(this);
      $care_id = $row.closest('tr').find('.care_id').text();
       $.getJSON("<?php echo site_url('chatservice/center/get_details?id=');?>"+$care_id,function(data){
          html='<table class="table"><tbody>';
            $.each(data,function(key,val){
              html+='<tr><th>ID:</th>';
              html+='<td>'+val.doctor_id+'</td></tr>';
              html+='<tr><th>Name:</th>';
              html+='<td>'+val.doctor_name+'</td></tr>';
              html+='<tr><th>RegID</th>';
              html+='<td>'+val.doctor_regid+'</td></tr>';
              html+='<tr><th>Address:</th>';
              html+='<td>'+val.doctor_address+'</td></tr>';
              html+='<tr><th>Phone:</th>';
              html+='<td>'+val.doctor_phone+'</td></tr>';
            });
            html+='</tbody></table>';
            $('#put_doctor_detail').empty();
            $('#put_doctor_detail').append(html);          
        }); 
    });
  });
</script>