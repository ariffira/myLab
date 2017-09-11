<?php $care_id=null;?>
<div class="col-xs-12">
   
<input id = "token" value = '<?php echo $quickblox['token'];?>' hidden>
<input id = "user_id" value = '<?php echo $quickblox['user_id'];?>' hidden>
<input id = "login" value = '<?php echo $quickblox['login'];?>' hidden>
<input id = "user_name" value = '<?php echo $this->mod->user_value('name');?> <?php echo $this->mod->user_value('surname');?>' hidden>

<div id ='quickblox' class="video-chat row-fluid hidden">
  <div class="mediacall l-flexbox col-md-8" style="min-height:520px; max-height:768px;">

    <video id="remoteVideo" class="mediacall-remote-stream remoteVideo hidden">
    </video>
    <video id="localVideo" class="mediacall-local mediacall-local-stream localVideo hidden">
    </video>
    <img class="mediacall-local mediacall-local-avatar localImg" data-src="<?php echo $this->mod->user_value('avatar') ? $this->mod->user_value('avatar') : '//placehold.it/768x1024'; ?>" src="<?php echo $this->mod->user_value('avatar') ? $this->mod->user_value('avatar') : '//placehold.it/768x1024'; ?>" alt="avatar">
    
    <div id="remoteImg" class="mediacall-remote-user l-flexbox l-flexbox_column remoteImg">
      <img class="mediacall-remote-avatar remoteImg" src="<?php echo $this->mod->user_value('avatar') ? $this->mod->user_value('avatar') : '//placehold.it/768x1024'; ?>" alt="avatar">
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
  <div class="textchat col-md-4">
    <section class="l-chat-content">
    </section>
    <footer class ="l-chat-footer">
      <form class="l-message" action="#">
        <div class="form-input-message textarea" contenteditable="true" placeholder="Type a message" style="overflow: hidden; outline: none;" tabindex="0"></div>
        <button class="btn_message btn_message_attach"><img src="<?php echo base_url('/assets/chat/images/icon-attach.svg');?>" alt="attach"></button>
        <input class="attachment" type="file">
      </form>
    </footer>
  </div>

</div>



  <div class="box">
    <div class="box-header">
      <h3 class="box-title">CYOMED Care- Pending</h3>
      
      <a href="<?php echo site_url('chatservice/center')?>" class="btn btn-social-icon btn-bitbucket pull-right"><i class="fa fa-refresh"></i></a>
    </div><!-- /.box-header -->
    <div class="box-body">
        
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="pending active"><a href="#in_queue" data-toggle="tab" aria-expanded="true">New in Queue</a></li>
          <li class="not_broadcasted"><a href="#not_broadcasted" data-toggle="tab" aria-expanded="false">Yet to Broadcast</a></li>
        </ul>
        
        <div class="tab-content">
          <div class="tab-pane active" id="in_queue">

            <table id="pending" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Patient Name</th>
                  <th>Patient Regid</th>                  
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Help Submitted</th>
                  <th>Action</th>
                  <th>Over-ride</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($patients as $patient) :?>
                  <tr>
                    <td class='care_id'><?php echo $patient['id'];?></td>
                    <td><?php echo $patient['name'];?></td>
                    <td><?php echo $patient['regid'];?></td>
                    <td><?php echo $patient['address'];?></td>
                    <td><?php echo $patient['phone'];?></td>
                    <td><?php echo $patient['apply_time'];?></td>
                    <td>
                      <input class = "patient_qb_id" value = "<?php echo $patient['quickblox_id'];?>" hidden>
                      <button class="btn btn-info select_patient <?php echo $patient['care_doctor_id']==0?'':'hidden';?>" style="margin-right: 5px;"> Select</button>
                      <button class="btn btn-success make_call <?php echo $patient['care_doctor_id']==0?'hidden':'';?>" data-regid="<?php echo $patient['regid'];?>"><i class="fa fa-phone"></i> Call</button>
                      <button class="btn btn-primary broadcast <?php echo $patient['care_doctor_id']==0?'hidden':'';?>" data-toggle="modal" data-target="#broadcast"><i class="fa fa-rss"></i> Broadcast</button>
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
                  <th>Status</th>
                  <th>Help Submitted</th>
                  <th>Patient Name</th>
                  <th>Patient Details</th>                  
                  <th>All Details</th>
                  <th>Action</th>
                  <th>Over-ride</th>
                </tr>
              </tfoot>
            </table>


          </div><!-- /.tab-pane -->
          <div class="tab-pane" id="not_broadcasted">
            <table id="example2" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Patient Name</th>
                  <th>Patient Regid</th>                  
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Help Submitted</th>
                  <th>Action</th>
                  <th>Over-ride</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php foreach($my_selected_patients as $patient) :?>
                    <td class='care_id'><?php echo $patient['id'];?></td>
                    <td><?php echo $patient['name'];?></td>
                    <td><?php echo $patient['regid'];?></td>
                    <td><?php echo $patient['address'];?></td>
                    <td><?php echo $patient['phone'];?></td>
                    <td><?php echo $patient['apply_time'];?></td>
                    <td>
                      <input class = "patient_qb_id" value = '<?php echo $patient['quickblox_id'];?>' hidden>
                      <button class="btn btn-info select_patient <?php echo $patient['care_doctor_id']==0?'':'hidden';?>" style="margin-right: 5px;"> Select</button>
                      <button class="btn btn-success make_call <?php echo $patient['care_doctor_id']==0?'hidden':'';?>" data-regid="<?php echo $patient['regid'];?>"><i class="fa fa-phone"></i> Call</button>
                      <button class="btn btn-primary broadcast <?php echo $patient['care_doctor_id']==0?'hidden':'';?>" data-toggle="modal" data-target="#broadcast"><i class="fa fa-rss"></i> Broadcast</button>
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
                  <th>Status</th>
                  <th>Help Submitted</th>
                  <th>Patient Name</th>
                  <th>Patient Details</th>                  
                  <th>All Details</th>
                  <th>Action</th>
                  <th>Over-ride</th>
                </tr>
              </tfoot>
            </table>
          </div><!-- /.tab-pane -->

        </div><!-- /.tab-content -->
      </div>

    </div><!-- /.box-body -->
  </div><!-- /.box -->



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
        <button class="btn btn-success"id="broadcast_changes">Broadcast</button>
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
<script src="<?php echo base_url('assets/chat/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/chat/js/quickblox.js'); ?>"></script>
<script src="<?php echo base_url('/assets/chat/js/main.js'); ?>"></script>



<script type="text/javascript">
var site_url='<?php echo site_url("chatservice");?>';

var patient_qb_id;
  $(function(){   
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

    $('.btn_message_attach').on('click',function(e){
      e.preventDefault();
      $('.attachment').click();
    });


  });
</script>