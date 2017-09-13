<!--<script>
//	FB.XFBML.parse();
//	(function(d, s, id){
//		var js, fjs = d.getElementsByTagName(s)[0];
//		if (d.getElementById(id)) {
//			//return;
//		}
//		js = d.createElement(s); js.id = id;
//		js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=960188584042276";
//		fjs.parentNode.insertBefore(js, fjs);
//   }	
//   (document, 'script', 'facebook-jssdk'));
</script>-->
<?php 
if(!empty($v_users))
  {
    $this->load->language('global/general_text',$this->m->user_value('language'));
    $this->load->language('global/overview',$this->m->user_value('language'));
    foreach ($v_users as $row) :?>
       <aside class="col-md-2 col-sm-3 sidebar sidebar0" >
            <div class="">
                <!-- /.profile-avatar -->
                <div class="block block-user">
                    <div class="profile-avatar"> 
                  <img src="<?php $this->load->model('document/mdoc');
                   echo ($img_path = $this->mdoc->get_profile_img_path($row->regid)) ? base_url($img_path) : base_url()."assets/img/portal/default-user.png"; ?>"/> 
                  </div>
                    <button class="btn btn-link hide">
                        <a href="<?php echo site_url('akte/profile'); ?>" class="ajax-load-link"><span class="fa fa-pencil"></span></a>
                    </button>
                    <h2><?php echo $row->name; ?> <?php echo $row->surname; ?></h2>
                </div>
                <h5 class="text-muted hidden">
                      <?php
                    $specs = $this->speciality->get_assoc();
                    echo $this->m->user() && !empty($this->m->user()->specialization1) ? implode(',&nbsp;', array_map(function($v) use ($specs) {
                                                return !empty($specs[$v]) && !empty($specs[$v]->name) ? ('<span class="label label-info">' . $specs[$v]->name . '</span>') : '';
                                            }, $this->m->user()->specialization1)) : '';
                    ?>
                </h5>
                   <div class="block block-links <?php echo $block_active; ?> block-info">
                  <div class="col-head-btn">
                 <div class="dropdown"> <a data-target="#" href="<?php echo site_url('akte/feed/general'); ?>" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false" class="list-group-item ajax-feed-link recent_active <?php echo $general_active;?>"> 
<!--                         <i class="fa fa-asterisk text-primary"></i> -->
                             <?php echo $this->lang->line('overview_lang_recent_activity_title'); ?> </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li><a href="<?php echo site_url('akte/feed/general'); ?>" class="ajax-feed-link">View</a></li>
                            </ul>
                        </div>
                        </div>
                </div>
                <div class="block block-links block-info">
                    <h2 class="head">GESUNDHEIT</h2>
                    <ul class="link-list" id="feedList1" >
                        <li class="dropdown"> <a class="ajax-feed-link1" data-target="#" href="<?php echo site_url('akte/runtastic'); ?>" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false" id="runtastic_link" ><i class="fa  text-primary"><img src="<?php echo base_url('assets/mvpr110/img/runtastic.png'); ?>"/></i> <?php echo $this->lang->line('overview_lang_runtastic'); ?> <i class="fa fa-chevron-right list-group-chevron"></i> </a> </li>
                        <li class="dropdown"> <a class="ajax-feed-link1" data-target="#" href="<?php echo site_url('akte/withingsdata'); ?>" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false" id="withings_link" ><i class="fa  text-primary"><img src="<?php echo base_url('assets/mvpr110/img/Withings.png'); ?>"/></i> <?php echo $this->lang->line('overview_lang_withings'); ?> <i class="fa fa-chevron-right list-group-chevron"></i> </a> </li>
                        <li class="dropdown"> <a  class="ajax-feed-link1 <?php echo $fitbit_active;?>" data-target="#" href="<?php echo site_url('akte/fit/'); ?>" data-toggle="#" aria-haspopup="true" id="fitbit_link" role="button" aria-expanded="false"> <i class="fa  text-primary"><img src="<?php echo base_url('assets/mvpr110/img/Fitbit.png'); ?>"/></i> <?php echo $this->lang->line('overview_lang_fitbit_status_title'); ?> <i class="fa fa-chevron-right list-group-chevron"></i> </a></li>
                        <li class="dropdown"> <a  class="ajax-feed-link1 <?php echo $jawbone_active;?>" data-target="#" href="<?php echo site_url('akte/jawbone/'); ?>" data-toggle="#" aria-haspopup="true" id="jawbone_link" role="button" aria-expanded="false"> <i class="fa  text-primary"><img src="<?php echo base_url('assets/mvpr110/img/jawbone.png'); ?>"/></i> <?php echo $this->lang->line('overview_lang_jawbone_status_title'); ?> <i class="fa fa-chevron-right list-group-chevron"></i> </a></li> 
                        <li class="dropdown"> <a class="ajax-feed-link1" data-target="#" href="<?php echo site_url('akte/googlefit'); ?>" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false" id="fit_link" > <i class="fa fa-asterisk text-primary"></i> <?php echo $this->lang->line('overview_lang_fitheading'); ?> <i class="fa fa-chevron-right list-group-chevron"></i> </a> </li>
                        <li class="dropdown"> <a class="ajax-feed-link1 condition-feed <?php echo $condition_active;?>" href="<?php echo site_url('akte/condition/feed'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-smile-o text-primary"></i> <?php echo $this->lang->line('overview_lang_condition_title'); ?> <i class="fa fa-chevron-right list-group-chevron"></i> </a></li>
                        <li class="dropdown"> <a class="ajax-feed-link1 weight_bmi-feed <?php echo $weightandbmi_active;?>" data-target="#" href="<?php echo site_url('akte/vital_values/weight_bmi/feed'); ?>" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-street-view text-primary"></i> <?php echo $this->lang->line('overview_lang_blood_bmi_title'); ?> <i class="fa fa-chevron-right list-group-chevron"></i> </a></li>  
                        <li class="dropdown"> <a class="ajax-feed-link1 bloodpressure-feed <?php echo $bloodpressure_active; ?>" data-target="#" href="<?php echo site_url('akte/vital_values/blood_pressure/feed'); ?>" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-heartbeat text-primary"></i> <?php echo $this->lang->line('overview_lang_blood_pressure_title'); ?> <i class="fa fa-chevron-right list-group-chevron"></i> </a></li>
                        <li class="dropdown"> <a class="ajax-feed-link1 bloodsugar-feed <?php echo $bloodsugar_active;?>" href="<?php echo site_url('akte/vital_values/blood_sugar/feed'); ?>"  data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-tint text-primary"></i> <?php echo $this->lang->line('overview_lang_blood_sugar_title'); ?> <i class="fa fa-chevron-right list-group-chevron"></i> </a></li>
                        <li class="dropdown"> <a class="ajax-feed-link1 <?php echo $smokingstatus_active;?>" data-target="#" href="<?php echo site_url('akte/smokingstatus/feed'); ?>" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-fire text-primary"></i> <?php echo $this->lang->line('overview_lang_smoking_status_title'); ?> <i class="fa fa-chevron-right list-group-chevron"></i> </a><li>
                     </ul>
                </div>
                <div class="block block-links active block-primary">
                      <h2 class="head">MEDIZIN</h2>
                      <div class="link-list" id="feedList">
                     
<!--                        <div class="dropdown"> 
                            <a  class="list-group-item ajax-feed-link " href="<?php echo site_url('akte/feed/akte'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-book text-primary "></i> <?php echo $this->lang->line('overview_lang_record_title'); ?> <i class="fa fa-chevron-right list-group-chevron"></i>
                             <span class="badge">3</span> 
                            </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li><a href="<?php echo site_url('akte/feed/akte'); ?>" class="ajax-feed-link" >View</a></li>
                            </ul>
                        </div>-->
                        <div class="dropdown"> <a  class="list-group-item ajax-feed-link " href="<?php echo site_url('akte/vital_values/feed'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="icomoon i-chart text-primary"></i> <?php echo $this->lang->line('overview_lang_vital_signs_title'); ?> <i class="fa fa-chevron-right list-group-chevron"></i> </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li><a href="<?php echo site_url('akte/vital_values/feed'); ?>" class="ajax-feed-link" >View</a></li>
                                <li><a href="<?php echo site_url('akte/vital_values'); ?>" class="ajax-load-link">Edit</a></li>
                            </ul>
                        </div>
                    
                        <div class="dropdown"> <a  class="list-group-item ajax-feed-link diagnosis-feed" href="<?php echo site_url('akte/diagnosis/feed'); ?>"  data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-stethoscope text-primary"></i> <?php echo $this->lang->line('overview_lang_diagnosis_title'); ?> <i class="fa fa-chevron-right list-group-chevron"></i> </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li><a href="<?php echo site_url('akte/diagnosis/feed'); ?>"  class="ajax-feed-link">View</a></li>
                                <li><a href="<?php echo site_url('akte/diagnosis'); ?>" class="ajax-load-link">Edit</a></li>
                            </ul>
                        </div>
                        <div class="dropdown"> <a href="<?php echo site_url('akte/medication/feed'); ?>" class="medication-feed list-group-item ajax-feed-link " data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-table text-primary"></i> <?php echo $this->lang->line('overview_lang_medication_title'); ?> <i class="fa fa-chevron-right list-group-chevron"></i> </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li><a href="<?php echo site_url('akte/medication/feed'); ?>" class="ajax-feed-link" >View</a></li>
                                <li><a href="<?php echo site_url('akte/medication'); ?>" class="ajax-load-link" >Edit</a></li>
                            </ul>
                        </div>
                        <div class="dropdown"> <a href="<?php echo site_url('akte/vaccination/feed'); ?>" class="vaccination-feed list-group-item ajax-feed-link" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-medkit text-primary"></i> <?php echo $this->lang->line('overview_lang_blood_vaccination_title'); ?><i class="fa fa-chevron-right list-group-chevron"></i> </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li><a href="<?php echo site_url('akte/vaccination'); ?>" class="ajax-load-link" >View</a></li>
                            </ul>
                        </div>
                     
                        <div class="dropdown"> <a class="list-group-item ajax-feed-link marcumar-feed" href="<?php echo site_url('akte/vital_values/marcumar/feed'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-sun-o text-primary"></i> <?php echo $this->lang->line('overview_lang_blood_marcumar_title'); ?> <i class="fa fa-chevron-right list-group-chevron"></i> </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li><a href="<?php echo site_url('akte/vital_values/marcumar/feed'); ?>" class="ajax-feed-link">View</a></li>
                                <li><a href="<?php echo site_url('akte/vital_values/marcumar'); ?>" class="ajax-load-link">Edit</a></li>
                            </ul>
                        </div>
                        <?php if ($this->m->user_role() != M::ROLE_DOCTOR) { ?>
                         <div class="dropdown"> <a  class="list-group-item ajax-feed-link familyhistory-feed"  href="<?php echo site_url('akte/familyhistory/feed'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-users text-primary"></i> <?php echo $this->lang->line('overview_lang_family_history_status_title'); ?> <i class="fa fa-chevron-right list-group-chevron"></i> </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <li><a href="<?php echo site_url('akte/familyhistory/feed'); ?>" class="ajax-feed-link">View</a></li>
                                    <li><a href="<?php echo site_url('akte/familyhistory'); ?>" class="ajax-load-link">Edit</a></li>
                                </ul>
                         </div>
                         <div class="dropdown"> <a class="list-group-item ajax-feed-link" data-target="#" href="<?php echo site_url('akte/smokingstatus/feed'); ?>" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-fire text-primary"></i> <?php echo $this->lang->line('overview_lang_smoking_status_title'); ?> <i class="fa fa-chevron-right list-group-chevron"></i> </a>
                              <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                   <li><a href="<?php echo site_url('akte/smokingstatus/feed'); ?>" class="ajax-feed-link" >View</a></li>
                                   <li><a href="<?php echo site_url('akte/smokingstatus'); ?>" class="ajax-load-link">Edit</a></li>
                              </ul>
                         </div>
                        <?php } ?>
                        
                        <div class="dropdown"> 
                            <a  class="list-group-item ajax-feed-link bodymap-feed"  href="<?php echo site_url('akte/bodymap/feed'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> 
                                .<i class="fa fa-male text-primary"></i> 
                                <?php echo $this->lang->line('overview_lang_bodymap_title'); ?> 
                                <i class="fa fa-chevron-right list-group-chevron"></i> 
                            </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <li><a href="<?php echo site_url('akte/bodymap/feed'); ?>" class="ajax-feed-link">View</a></li>
                                    <li><a href="<?php echo site_url('akte/bodymap'); ?>" class="ajax-load-link">Edit</a></li>
                                </ul>
                         </div>

                        <div class="dropdown"> <a class="list-group-item ajax-feed-link" href="<?php echo site_url('akte/document/feed'); ?>"   data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-folder-o text-primary"></i> <?php echo $this->lang->line('overview_lang_blood_document_title'); ?>  <i class="fa fa-chevron-right list-group-chevron"></i> </a> </div>
                      <div class="dropdown"> <a class="list-group-item <?php echo (count($casehistory)>0 && !empty($casehistory))? 'ajax-feed-link':'ajax-load-link'; ?> " href="<?php echo (count($casehistory)>0 && !empty($casehistory))? site_url('akte/casehistory/feed'):site_url('akte/casehistory/index'); ?>"   data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-folder-o text-primary"></i> <?php echo $this->lang->line('overview_lang_case_history_title'); ?>  <i class="fa fa-chevron-right list-group-chevron"></i> </a> </div>
                    </div>
                </div>
                <div class="block block-links active block-primary hide">
                    <h2 class="head">TERMIN</h2>
                  
                    <div class="link-list" id="feedList">
                        <?php if ($this->m->user_role() != M::ROLE_DOCTOR) { ?>
                            <div class="dropdown"> <a  class="list-group-item ajax-load-link"  href="<?php echo site_url('termin/patient_termin'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-search text-primary"></i> Search <i class="fa fa-chevron-right list-group-chevron"></i> </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <li><a href="<?php echo site_url('termin/patient_termin/feed'); ?>" class="ajax-feed-link">View</a></li>
                                    <li><a href="<?php echo site_url('termin/patient_termin'); ?>" class="ajax-load-link">Edit</a></li>
                                </ul>
                            </div>
                           <?php } ?>
                           <?php if ($this->m->user_role() != M::ROLE_PATIENT) { ?>
                            <div class="dropdown"> <a  class="list-group-item ajax-calender-link"  href="<?php echo site_url('termin/calendar'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-calendar text-primary"></i> Calendar <i class="fa fa-chevron-right list-group-chevron"></i> </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <li><a href="<?php echo site_url('termin/calendar/feed'); ?>" class="ajax-feed-link">View</a></li>
                                    <li><a href="<?php echo site_url('termin/calendar'); ?>" class="ajax-load-link">Edit</a></li>
                                </ul>
                            </div>
                            <div class="dropdown"> <a  class="list-group-item ajax-doctortermin-link"  href="<?php echo site_url('termin/doctor_termin'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-tasks text-primary"></i> Appointment <i class="fa fa-chevron-right list-group-chevron"></i> </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <li><a href="<?php echo site_url('termin/doctor_termin/feed'); ?>" class="ajax-feed-link">View</a></li>
                                    <li><a href="<?php echo site_url('termin/doctor_termin'); ?>" class="ajax-load-link">Edit</a></li>
                                </ul>
                            </div>
                            <div class="dropdown"> <a  class="list-group-item ajax-load-link"  href="<?php echo site_url('termin/profile'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-user text-primary"></i> Profile <i class="fa fa-chevron-right list-group-chevron"></i> </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <li><a href="<?php echo site_url('termin/doctor_termin/feed'); ?>" class="ajax-feed-link">View</a></li>
                                    <li><a href="<?php echo site_url('termin/doctor_termin'); ?>" class="ajax-load-link">Edit</a></li>
                                </ul>
                            </div>
                            <div class="dropdown"> <a  class="list-group-item ajax-load-link"  href="<?php echo site_url('termin/times'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-clock-o text-primary"></i> Times <i class="fa fa-chevron-right list-group-chevron"></i> </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <li><a href="<?php echo site_url('termin/doctor_termin/feed'); ?>" class="ajax-feed-link">View</a></li>
                                    <li><a href="<?php echo site_url('termin/doctor_termin'); ?>" class="ajax-load-link">Edit</a></li>
                                </ul>
                            </div>
                        <?php } ?>
                     </div>
                </div>
<!--                <div class="block block-links block-purple">
                    <h2 class="head">SOCIAL</h2>
                    <ul class="link-list">
                        <li><a href="javascript:void(0);">View</a></li>
                    </ul>
                </div>-->
        </aside>
            
              <div class="col-md-3" style="display:none;">

              <div class="block block-user text-center">

              <div class="img">

                              <img src="<?php $this->load->model('document/mdoc');
                                echo ($img_path = $this->mdoc->get_profile_img_path($row->regid)) ? base_url($img_path) : '//placehold.it/120x120'; ?>"/></div>
                              <h2 class="block block-user text-center"><?php echo strtoupper($row->name); ?> <?php echo strtoupper($row->surname);?></h2>

              </div>

           </div>

<div class="col-md-7 content-area" id="<?php echo $scope_id = 'scope_' . random_string('alnum', 32); ?>">
  <div class="block block-blue-table" id="entry_view">
                        <div class="block block-c1">
                            <div class="" style="display:none;">
                                <div class="row">
                                    <div class="col-sm-3 col-md-3"  style="padding-left:0px !important;"><a href="javascript:;" class="btn btn-primary btn-block" data-toggle="status-input" data-status-input-target="#<?php echo $status_input_panel_data_id = 'status_input_panel_data_id' . random_string('alnum', 32); ?>" ><?php echo $this->lang->line('overview_lang_new_entry'); ?></a><br/>
                                    </div>
                                    <div class="col-sm-3 col-md-3" style="padding-left:0px !important;"><a href="javascript:;" class="btn btn-secondary btn-block" data-toggle="status-input" data-status-input-target="#<?php echo $status_input_panel_consult_id = 'status_input_panel_consult_id' . random_string('alnum', 32); ?>" ><?php echo $this->lang->line('overview_lang_consultation'); ?></a><br/>
                                    </div>
                                    <div class="col-sm-3 col-md-3" style="padding-left:0px !important;"><a href="javascript:;" class="btn btn-tertiary btn-block" data-toggle="status-input" data-status-input-target="#<?php echo $status_input_panel_termin_id = 'status_input_panel_termin_id' . random_string('alnum', 32); ?>" ><?php echo $this->lang->line('overview_lang_appointment'); ?></a><br/>
                                    </div>
                                    <div class="pull-right">
                                        <ul class="list-inline">
                                            <li><?php echo date('d-m-Y'); ?></li>
                                            <li><?php echo date('h:i') . date('a'); ?> </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 col-md-3"><a href="javascript:;" class="btn btn-default btn-block" data-toggle="status-input" data-status-input-target="#<?php echo $status_input_panel_rezept_id = 'status_input_panel_rezept_id' . random_string('alnum', 32); ?>" ><?php echo $this->lang->line('overview_lang_eprescription'); ?></a><br/>
                                    </div>
                                </div>
                            </div>
                            <div class="head" >
                                <div class="pull-right">
                                    <ul class="list-inline">
                                        <li><?php echo date('d.m.Y'); ?></li>
                                        <li><?php echo date('H:i'); ?> Uhr</li>
                                    </ul>
                                </div>
                                <h2 class="pull-left font-bold"><strong><a href="javascript:;" class="btn-block" data-toggle="status-input" data-status-input-target="#<?php echo $status_input_panel_data_id = 'status_input_panel_data_id' . random_string('alnum', 32); ?>" ><?php echo $this->lang->line('overview_lang_new_entry'); ?></a></strong></h2>
                            </div>
                            <div class="panel panel-default" id="<?php echo $status_input_panel_data_id; ?>"  >
                                <?php $status_input_data_t1_id = 'status_input_data_t1_id_' . random_string('alnum', 32); ?>
                                <?php $status_input_data_t2_id = 'status_input_data_t2_id_' . random_string('alnum', 32); ?>
                                <?php $status_input_data_t3_id = 'status_input_data_t3_id_' . random_string('alnum', 32); ?>
                                <?php $status_input_data_t4_id = 'status_input_data_t4_id_' . random_string('alnum', 32); ?>
                                <?php $status_input_data_t5_id = 'status_input_data_t5_id_' . random_string('alnum', 32); ?>
                                <?php $status_input_data_t6_id = 'status_input_data_t6_id_' . random_string('alnum', 32); ?>
                                <?php $status_input_data_t7_id = 'status_input_data_t7_id_' . random_string('alnum', 32); ?>
                                <?php $status_input_data_t8_id = 'status_input_data_t8_id_' . random_string('alnum', 32); ?>
                                <?php $status_input_data_t9_id = 'status_input_data_t8_id_' . random_string('alnum', 32); ?>                                
                                <div class="panel-heading clearfix">
                                    <div class="share-widget-types pull-left"> 
                                        <a href="#<?php echo $status_input_data_t1_id; ?>" data-toggle="tab" class="fa fa-smile-o ui-tooltip panal-widget active" title="<?php echo $this->lang->line('overview_lang_condition_title');?>"><i></i></a>
                                        <a href="#<?php echo $status_input_data_t2_id; ?>" data-toggle="tab" class="fa fa-stethoscope ui-tooltip panal-widget" title="<?php echo $this->lang->line('overview_lang_diagnosis_title');?>"><i></i></a>
                                        <a href="#<?php echo $status_input_data_t3_id; ?>" data-toggle="tab" class="fa fa-table ui-tooltip panal-widget" title="<?php echo $this->lang->line('overview_lang_medication_title');?>"><i></i></a> 
                                        <a href="#<?php echo $status_input_data_t4_id; ?>" data-toggle="tab" class="fa fa-medkit ui-tooltip panal-widget" title="<?php echo $this->lang->line('overview_lang_blood_vaccination_title');?>"><i></i></a> 
                                        <a href="#<?php echo $status_input_data_t5_id; ?>" data-toggle="tab" class="fa fa-heartbeat ui-tooltip panal-widget" title="<?php echo $this->lang->line('overview_lang_blood_pressure_title');?>"><i></i></a> 
                                        <a href="#<?php echo $status_input_data_t6_id; ?>" data-toggle="tab" class="fa fa-tint ui-tooltip panal-widget" title="<?php echo $this->lang->line('overview_lang_blood_sugar_title');?>"><i></i></a> 
                                        <a href="#<?php echo $status_input_data_t7_id; ?>" data-toggle="tab" class="fa fa-street-view ui-tooltip panal-widget" title="<?php echo $this->lang->line('overview_lang_blood_bmi_title');?>"><i></i></a> 
                                        <a href="#<?php echo $status_input_data_t8_id; ?>" data-toggle="tab" class="fa fa-area-chart ui-tooltip panal-widget" title="<?php echo $this->lang->line('overview_lang_blood_marcumar_title');?>"><i></i></a> 
                                        <a href="#<?php echo $status_input_data_t9_id; ?>" data-toggle="tab" class="fa fa-male ui-tooltip panal-widget" title=" <?php echo $this->lang->line('overview_lang_bodymap_title'); ?> "><i></i></a>                                         
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div id="<?php echo $status_input_data_tab_id = 'status_input_data_tab_id' . random_string('alnum', 32); ?>" class="tab-content">
                                        <div class="tab-pane fade in active" id="<?php echo $status_input_data_t1_id; ?>">
    <?php $this->load->view('condition/condition_entry_view', array('hide_insert' => TRUE,)); ?>
                                            <div class="pull-right" >
                                                <button class="btn btn-default btn-sm condition-submit" id="<?php echo $status_input_data_t1_id; ?>" type="submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?> </button>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="<?php echo $status_input_data_t2_id; ?>">
    <?php $this->load->view('diagnosis/diagnosis_entry_view', array('hide_insert' => TRUE,)); ?>
                                            <div class="pull-right" >
                                                <button class="btn btn-default btn-sm diagnose-submit" id="<?php echo $status_input_data_t2_id; ?>" type="submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?> </button>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="<?php echo $status_input_data_t3_id; ?>">
    <?php $this->load->view('medication/medication_entry_view', array('hide_insert' => TRUE,)); ?>
                                            <div class="pull-right" >
                                                <button class="btn btn-default btn-sm medication-submit" id="<?php echo $status_input_data_t3_id; ?>" type="submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?> </button>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="<?php echo $status_input_data_t4_id; ?>">
    <?php $this->load->view('vaccination/vaccination_entry_view', array('hide_insert' => TRUE,)); ?>
                                            <div class="pull-right" >
                                                <button class="btn btn-default btn-sm impung-submit" id="<?php echo $status_input_data_t4_id; ?>" type="submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?> </button>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="<?php echo $status_input_data_t5_id; ?>">
    <?php $this->load->view('graph/insert_view', array('hide_insert' => TRUE, 'table' => 'heart_frequency', 'entry' => (object) array('id' => 0, 'rr_sys' => '', 'rr_dia' => '', 'puls' => '',),)); ?>
                                            <div class="pull-right" >
                                                <button class="btn btn-default btn-sm bloodpressure-submit" id="<?php echo $status_input_data_t5_id; ?>" type="submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?> </button>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="<?php echo $status_input_data_t6_id; ?>">
    <?php $this->load->view('graph/insert_view', array('hide_insert' => TRUE, 'table' => 'blood_sugar', 'entry' => (object) array('id' => 0, 'bloodsugar' => '', 'HbA1C' => '',),)); ?>
                                            <div class="pull-right" >
                                                <button class="btn btn-default btn-sm bloodsugar-submit" id="<?php echo $status_input_data_t6_id; ?>" type="submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?> </button>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="<?php echo $status_input_data_t7_id; ?>">
    <?php $this->load->view('graph/insert_view', array('hide_insert' => TRUE, 'table' => 'weight_bmi', 'entry' => (object) array('id' => 0, 'size' => '', 'weight' => '', 'bmi' => '',),)); ?>
                                            <div class="pull-right" >
                                                <button class="btn btn-default btn-sm weight_bmi-submit" id="<?php echo $status_input_data_t7_id; ?>" type="submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?> </button>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="<?php echo $status_input_data_t8_id; ?>">
    <?php $this->load->view('graph/insert_view', array('hide_insert' => TRUE, 'table' => 'marcumar', 'entry' => (object) array('id' => 0, 'INR' => '', 'quick' => '', 'lower_limit' => '', 'upper_limit' => '',),)); ?>
                                            <div class="pull-right" >
                                                <button class="btn btn-default btn-sm marcumer-submit" id="<?php echo $status_input_data_t8_id; ?>" type="submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?> </button>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="<?php echo $status_input_data_t9_id; ?>">
                        <?php $this->load->view('bodymap/bodymap_entry_view', array('hide_insert' => TRUE,)); ?>
                                            <div class="pull-right" >
                                                <button class="btn btn-default btn-sm bodymap-submit" id="<?php echo $status_input_data_t9_id; ?>" type="submit">
                                                    <span class="icomoon i-file-plus-2"></span> 
                                                        <?php echo $this->lang->line('general_text_button_add'); ?> </button>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="panel-footer clearfix">

                                </div>
                            </div>
                         
                            <div class="block-foot text-right">SPEICHERN <span class="fa font24 fa-check-square-o"></span></div>
                        </div>
                    </div>
           <div id="feedContent" style="opacity: 1;">
           
           <div class="blog-list">

           <?php

             $this->load->model('modoc');

             echo $this->modoc->patientdetails($row->id);

           ?>

           </div>

           </div>
           </div>
       <?php

         endforeach;

  }
   
  else

  {

      ?>

<div class="tile m-b-10 portlet text-center">
    <span class="text-danger"><strong>Please Enter Valid Patient Id</strong></span>
</div>

          <?php }

  ?>     
<aside class="col-md-3 col-sm-12 sidebar sidebar1">
           <div class="block block-btns">
             
             <div class="mybtns-head">
          <div class="row">  <div class="col-md-6 paddhead"><a href="<?php echo site_url('akte/chat'); ?>" target="_blank" ><button class="btn btn-primary" >
             <span class="myhead-img"><img src="<?php echo base_url('assets/img/icon/video-chat-icon.png');?>" alt=""></span>
             <span class="myhead-tital"><?php echo $this->lang->line('overview_lang_chat_title');?></span></button></a></div>
             <div class="col-md-6 paddhead1"><a class="ajax-econsult-link" data-dismiss="modal" href="<?php echo site_url('akte/econsult'); ?>" > <button class="btn btn-primary" > <span class="myhead-img">
             <img src="<?php echo base_url('assets/img/icon/eConsultant.png');?>" alt="">
             </span><span class="myhead-tital"><?php echo $this->lang->line('overview_lang_blood_econsult_title'); ?></span></button></a></div>
          </div> 
          <div class="row"> 
             <div class="col-md-6 paddhead"> <a class="termin-load-link" href="<?php echo site_url('termin/patient_termin'); ?>"> <button  class="btn btn-primary" >
             <span class="myhead-img">
              <img src="<?php echo base_url('assets/img/icon/cal-icon.png');?>" alt="">
           </span>
             <span class="myhead-tital"><?php echo $this->lang->line('overview_lang_termine_title');?></span></button></a></div>
             <div class="col-md-6 paddhead1"> <a  href="<?php echo site_url('rezept/rezept_history/patient'); ?>"> <button  class="btn btn-primary" >
             <span class="myhead-img">
              <img src="<?php echo base_url('assets/img/icon/epre.png');?>" alt="">
           </span>
             <span class="myhead-tital">
                    <?php echo $this->lang->line('overview_lang_rezeptonline_title');?>
            </span></button></a></div>
<!--             <div class="col-md-6 paddhead1">
             	<button type="button" class="btn btn-primary VideoAppointment">
                    <span class="myhead-img">
                    	<img src="<?php // echo base_url('assets/img/icon/videoapp.png');?>" alt="">
					</span>
					<span class="myhead-tital"><?php // echo $this->lang->line('overview_lang_get_video');?></span>
				</button>
             </div>-->
             </div>
             </div>
             <div class="row"> 
             
<!--             <div class="col-md-6 paddhead1">
             <a class="ajax-document-link" href="<?php // echo site_url('akte/document'); ?>"   data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> 
             <button class="btn btn-primary" > <span class="myhead-img">
             <img src="<?php // echo base_url('assets/img/icon/esicknes.png');?>" alt="">
            </span><span class="myhead-tital">
                    <?php // echo $this->lang->line('overview_lang_e_sick_cert');?>
        </span></button></a></div>-->
             </div>
             </div>
            <div class="">
                <div class="block block-s1 hide">
                    <h2>ARZTKONTAKT</h2>
                    <p>Sie brauchen medizinischen Rat oder Hilfe? Sprechen Sie jetzt mit einem unserer Ãƒrzte oder vereinbaren Sie einen Termin!</p>
                    <div class="text-center"><a href="javascript:;" class="" data-toggle="status-input" data-status-input-target="#<?php echo $status_input_panel_consult_id; ?>" >
                                  <a href="<?php echo site_url('akte/chat'); ?>" target="_blank" ><button class="btn btn-default" ><span class="fa-comment1"><img src="<?php echo base_url('assets/img/logo/comment-icon.png');?>" alt=""></span> JETZT KONTAKT<br>
          AUFNEHMEN</button></a>
          </a></div>
                </div>
            </div>
      
            <?php if ($this->m->us_id()) : ?>
                <div class="block block-aktuell">
                    <!--<h5 class="content-title"><u>GewÃƒÆ’Ã‚Â¤hlt Patient</u></h5>-->
                    <div class="block-foot">
                        <?php echo $this->lang->line('overview_doctor_selected_pat');?>
                    </div>
                    <div class="list-group"> <a href="javascript:;" class="list-group-item">
                            <h3 class="pull-right"><img class="img-responsive" src="<?php $this->load->model('document/mdoc');
        echo ($img_path = $this->mdoc->get_profile_image_path($this->m->us())) ? base_url($img_path) : '//placehold.it/25x25'; ?>" style="width:25px;" width="25" /></h3>
                            <h4 class="list-group-item-heading"><?php echo $this->m->us_value('regid'); ?></h4>
                            <p class="list-group-item-text"><?php echo $this->m->us_value('academic_grade'); ?> <?php echo $this->m->us_value('name'); ?> <?php echo $this->m->us_value('surname'); ?></p>
                        </a> </div>
                    <!-- /.list-group -->
                </div>
            <?php endif; ?>
      
            <div class="block block-link hide"><a class=" btn btn-primary ajax-econsult-link" href="<?php echo site_url('akte/econsult'); ?>" > <?php echo $this->lang->line('overview_lang_blood_econsult_title'); ?> </a><span class="fa fa-angle-right"></span> </div>
            <div class="block block-link hide"><a href="<?php echo site_url('rezept/rezept_history/patient'); ?>" class="btn btn-primary"> <?php echo $this->lang->line('overview_lang_blood_epres_title'); ?> </a><span class="fa fa-angle-right"></span> </div>
<!--           <div class="block block-aktuell">
                <h2 class="head font-bold">AKTUELL</h2>
                <div class="well" >
                  <div class="">
                    <div class="pull-right"><span class="btn fa fa-calendar-o gray"></span></div>
                    <div class="pull-left font-bold gray">KALENDER ANZEIGEN</div>
                    <div class="clear"></div>
                    <div class="sidebar-calendar-block">
                        <div id="sidebar-calendar"></div>
                    </div>
                    <div class="clr"></div>
                  </div>
             fullcalendar starts
             <a class="btn btn-primary m-t-10" href="https://ihrarzt24.de/apps/ia24at">Termine</a>
              fullcalendar ends
       
                <ul class="aktuell-list font12">
                    <li>
                        <div class="aktuell-icon"><span class="fa fa-video-camera"></span></div>
                        <p class="font-bold">20. AUGUST, 16.00 UHR</p>
                        <div><a href=""accesskey="" class="font-bold">Videochat</a></div>
                        <div>Dr. Steiner, Onkologie</div>
                        <div>UniKlinik Koblenz</div>
                    </li>
                    <li>
                        <div class="aktuell-icon"><span class="fa fa-video-camera"></span></div>
                        <p class="font-bold">20. AUGUST, 16.00 UHR</p>
                        <div><a href=""accesskey="" class="font-bold">Videochat</a></div>
                        <div>Dr. Steiner, Onkologie</div>
                        <div>UniKlinik Koblenz</div>
                    </li>
                </ul>   </div>
                 <div class="block-foot"><span class="fa fa-plus"></span> TERMIN EINTRAGEN</div>
             </div>-->
            <div class="">
                <div class="block block-chart">
                    <!-- <ul class="chart-list font12">
                        <?php   
	                       /* $this->load->model('graph/mgraph');
	                        $graph_category = $this->mgraph->get_all();*/ 
                        ?>
                        <?php //if(!empty($graph_category->heart_frequency) && isset($graph_category->heart_frequency) && is_array($graph_category->heart_frequency)){ ?>
                        <li>
                            <div class="head">
                                <div class="pull-left title">PULS</div>
                                <div class="pull-left clear">
                                    <h2 style="color:#84c4c6;"  id="puls">
                                     <?php
                                    //echo $graph_category->heart_frequency[0]->puls;
                                   ?>
                                   </h2>
                                   </div>
                                <div class="clr"></div>
                            </div>
                            <div class="chart-block">
                                 <?php
                        
                         /*$this->load->view('graph/quick_graph_view', array(
                            'desc' => 'Puls','unit'=>'',  'entries' => $graph_category->heart_frequency, 'field' => 'puls', 'disable_borders' => TRUE,
                        ));*/
                       
                         ?>
                            </div>
                        </li>
                        <?php //}
                          //if(!empty($graph_category->blood_sugar) && isset($graph_category->blood_sugar) && is_array($graph_category->blood_sugar)){
                              
                         ?>
                        <li>
                            <div class="head">
                                <div class="pull-left title">BLUTZUCKER</div>
                                <div class="pull-left clear" >
                                    <h2 style="color:#9fd1dc;" id="bloodsugar">
                                    <?php
                                   
                                   //echo $graph_category->blood_sugar[0]->bloodsugar;
                                   ?>
                                     </h2>
                               </div>
                                <div class="clr"></div>
                            </div>
                            <div class="chart-block">

                                 <?php
                        /* $this->load->view('graph/quick_graph_view', array(
                            'desc' => 'Blutzucker', 'unit'=>'mg/dl', 'entries' => $graph_category->blood_sugar, 'field' => 'bloodsugar', 'disable_borders' => TRUE,
                        ));*/
                        
                                ?>
                            </div>
                        </li>
                        <?php //}
                       //if(!empty($graph_category->weight_bmi) && isset($graph_category->weight_bmi) && is_array($graph_category->weight_bmi)){
                        ?>
                        
                        <li>
                            <div class="head">
                                <div class="pull-left title">GEWICHT &amp; BMI</div>
                                <div class="pull-left clear">
                                     <h2 style="color:#ff2c58;" id="bmis">
                              <?php 
                                  
                                   //echo $graph_category->weight_bmi[0]->bmi;
                              ?>
                                </h2>
                      </div>
                                <div class="clr"></div>
                            </div>
                            <div class="chart-block">
                                <?php
                       
                        /*$this->load->view('graph/quick_graph_view', array(
                            'desc' => 'Gewicht &amp; BMI', 'unit'=>'kg/m<sup>2</sup>', 'entries' => $graph_category->weight_bmi, 'field' => 'bmi', 'disable_borders' => TRUE,
                        ));*/
                        
                                ?>  
                            </div>
                        </li>
                        <?php //} ?>
                    </ul> -->
                   
                </div>
            </div>
<!--            <div class="block block-aktuell">
                <h2 class="head font-bold">
                	<strong>
                		<?php // echo $this->lang->line('overview_lang_news');?>
                	</strong>
                </h2>
                <div class="well">
	                <div class="fb-page" data-href="https://www.facebook.com/pages/Dreamsoft4U/745515242261430" data-width="253" data-height="250" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/pages/Dreamsoft4U/745515242261430"><a href="https://www.facebook.com/pages/Dreamsoft4U/745515242261430">Dreamsoft4U</a></blockquote></div></div>
                </div>
                 /.well 
            </div>-->
            <div class="block block-aktuell">
                <div class="block-foot"> 
                    <?php echo $this->lang->line('overview_lang_health_score');?>
                </div>
                <div class="text-center well">
                    <?php
                    $this->load->view('graph/pie_chart_view', array(
                        'pie_charts' => array(
                            (object) array('value' => $this->mopat->health_score(), 'range' => 1100, 'title' => 'Health-Score', 'no_percent' => TRUE,),
                      ),
                    ));
                    ?>
                </div>
            </div>
        </aside>
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modal Title Goes Here</h4>
            </div>
            <div class="modal-body">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam facilisis dui sagittis nulla sollicitudin blandit. Nulla mollis neque felis, id mattis justo aliquam a. Proin rhoncus magna id adipiscing eleifend. Curabitur a nulla enim. Nulla facilisi.
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary" data-dismiss="modal">OK</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
 $(document).ready(function() 
    {
        $('.sidebar0 .block .head').on('click', function (){
            $('.sidebar0 .block').removeClass('active');
            $(this).parent().toggleClass('active');			
        });
    });
   $('.ajax-load-link').click(function(e) 
         {
    e.preventDefault();

          if ($(this).attr('href').indexOf('javascript:') < 0)

          $.loadUrl($(this).attr('href'), $('#content'));
    });
     $('.termin-load-link').click(function(e) 
    {
        e.preventDefault();
        if ($(this).attr('href').indexOf('javascript:') < 0){
            $("#entry_view").addClass('termin-load');
//            $('.termin-load').css("display","none");
            $.loadUrl($(this).attr('href'), $('#feedContent'));
        }
         $('html, body').animate({
                    scrollTop: $("#content").offset().top
                },1000);
    });  
       $('.ajax-econsult-link').click(function(e) 
       {
          e.preventDefault();
          if ($(this).attr('href').indexOf('javascript:') < 0)
          $.loadUrl($(this).attr('href'), $('#content'));
       });
       
       $('.ajax-document-link').click(function(e) 
       {
          e.preventDefault();
          if ($(this).attr('href').indexOf('javascript:') < 0)
          $.loadUrl($(this).attr('href'), $('#content'));
       });
     
 $('.ajax-eprescription-link').click(function(e) 
    {
        e.preventDefault();
        if ($(this).attr('href').indexOf('javascript:') < 0)
            $.loadUrl($(this).attr('href'), $('#content'));
    });
    $('.ajax-calender-link').click(function(e) 
    {
        e.preventDefault();
        if ($(this).attr('href').indexOf('javascript:') < 0)
            $.loadUrl($(this).attr('href'), $('#content'));
    });
    $('#runtastic_link').click(function(e) 
    {
        
        e.preventDefault();
       
        if ($('#feedContent').length && $(this).attr('href').indexOf('javascript:') < 0) {
            
            $.loadUrl($(this).attr('href'), $('#feedContent'));
            $('#feedContent').data('feedLoaded', $(this).attr('href')).siblings('h4.content-title').find('u').html($(this).text() + ($(this).text().indexOf('Feed') < 0 ? ' ' : '') );
        }
    });
    
    $('#withings_link').click(function(e) 
    {
        e.preventDefault();
        if ($('#feedContent').length && $(this).attr('href').indexOf('javascript:') < 0) {
            
            $.loadUrl($(this).attr('href'), $('#feedContent'));

            $('#feedContent').data('feedLoaded', $(this).attr('href')).siblings('h4.content-title').find('u').html($(this).text() + ($(this).text().indexOf('Feed') < 0 ? ' ' : '') );
        }
    });
     $('#fit_link').click(function(e) 
    {
        e.preventDefault();
        if ($('#feedContent').length && $(this).attr('href').indexOf('javascript:') < 0) {
            
            $.loadUrl($(this).attr('href'), $('#feedContent'));

            $('#feedContent').data('feedLoaded', $(this).attr('href')).siblings('h4.content-title').find('u').html($(this).text() + ($(this).text().indexOf('Feed') < 0 ? ' ' : '') );
        }
    });
   
     var scroll=0;
     $('.ajax-feed-link').off('click', '**').click(function(e) 
    {
        
            if ($('#entry_view').hasClass('termin-load')) {
                
               $('#entry_view').removeClass("termin-load");
            }

       e.preventDefault();
        <?php if(!empty($active_url))
         {
        ?>
         $(this).toggleClass('active',true).parent().siblings().children('.active').toggleClass('active',  false);
         $.loadUrl($('#feedList .dropdown .active').attr('href'), $('#feedContent'));
        <?php 
           
         } else
         { 
        ?>
            $(this).toggleClass('active',true).parent().siblings().children('.active').toggleClass('active',  false);
            $.loadUrl($(this).attr('href'), $('#feedContent')); 
        <?php
         } 
        ?>
            if(window.scroll==2)
            {
                $('html, body').animate({
                    scrollTop: $("#feedContent").offset().top
                },1000);
            }
            $('#feedContent').data('feedLoaded', $(this).attr('href')).siblings('h4.content-title').find('u').html($(this).text() + ($(this).text().indexOf('Feed') < 0 ? ' ' : '') );
            if(window.scroll==1)
            {
                window.scroll++;
            }	
         
        }).each(function() 
        {
           if ($('#feedContent').length && $(this).attr('href').indexOf('javascript:') < 0) {
            window.scroll=1;
           <?php if(empty($active_url)) {?>
            $(this).click();
            <?php }else { ?>
           $('#feedList .dropdown .active').click();
            <?php } ?>
            return false;
        }
    });
    
    $('.ajax-feed-link1').click(function(e) 
    {
           if ($('#entry_view').hasClass('termin-load')) {
               $('#entry_view').removeClass("termin-load");
            }
       
         e.preventDefault();
       
         $(this).toggleClass('active',true).parent().siblings().children('.active').toggleClass('active',  false);
         $.loadUrl($('#feedList1 .dropdown .active').attr('href')+'?id=purple', $('#feedContent'));
        
            if(window.scroll==2)
            {
                $('html, body').animate({
                    scrollTop: $("#feedContent").offset().top
                },1000);
            }
            $('#feedContent').data('feedLoaded', $(this).attr('href')).siblings('h4.content-title').find('u').html($(this).text() + ($(this).text().indexOf('Feed') < 0 ? ' ' : '') );
            if(window.scroll==1)
            {
                window.scroll++;
            }	
         
        });
    


/*** this script for upper div of  patient data entery on the patient of the doctor panel of the patient ******/
    $.pageSetup($('#<?php echo $scope_id; ?>'));
    function active_feed_link(){
       
      if($('.ajax-feed-link.active').length <=0){
          $('#feedList a.ajax-feed-link').first().click();
      }
  else{
      $('.ajax-feed-link.active').click();
  }
    }
   var $statusInputs = $('[data-toggle="status-input"][data-status-input-target]').each(function() 
    {
        var $target = $($(this).attr('data-status-input-target')),
        $statusInput = $(this);
        $statusInput.off('click', '**').click(function() {
            $statusInputs.not($statusInput).each(function() {
                $($(this).attr('data-status-input-target')).slideUp('slow');
            });
            if ($target && $target.length) {
                if ($target.is(':hidden')) {
                    $target.slideDown('slow');
                } else {
                    $target.slideUp('slow');
                }
            }
        });

        if ($target && $target.length) {

            $target.find('.form-group').each(function() {
                var $formGroup = $(this);
                $formGroup.add($formGroup.find('input, textarea, select, label')).bind('click focus', function() {
                    $formGroup.next().next(':hidden').slideDown('slow').insertAfter($formGroup).filter(':nth-last-child(2)').next().slideUp();
                });
            }).hide().filter(':first-of-type').show().after(
            $('<div />').addClass('form-group').append(
            $('<div />').addClass('col-md-offset-3 col-md-9').append(
        )
        )
        );
            /***use for condition entry validation***/
            $target.find('.panel-body .condition-submit').click(function(e) {
                if($('#title_name0').val()==0)
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie Beschwerden Detail..!');
                    $('#myModal').modal({});
                    return false;
                }
                var $forms = $('.panel-body').find('.tab-pane.active form');
                $forms.length ? $($forms[0]).ajaxSubmit({
                   beforeSubmit:function(){
                         var image_path = $.baseUrl+'assets/img/loading.png';
                        $("body").append('<div id="loadingDiv"><img class="star" src="'+image_path+'" /></div>');
                    },
                    success: function() {
                       //active_feed_link();
                       //$("form")[0].reset();
                        $("#loadingDiv").remove();
                        //$('.ajax-feed-link.active').click();
                        $(".block-links").removeClass('active');
                        $(".condition-feed").closest(".block-links").addClass('active')
                        $(".condition-feed").click();
                        
                        $("form")[0].reset();
                    }
                }) : '';
            });
            /***end here***/
            /***use for diagnose entry validation***/
            $target.find('.panel-body .diagnose-submit').click(function(e) {
                if($('#disease_name0').val()==0)
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie eine gÃƒÂ¼ltige Diagnose Detail ..!');
                    $('#myModal').modal({});
                    return false;
                }
                var $forms = $('.panel-body').find('.tab-pane.active form');
                $forms.length ? $($forms[0]).ajaxSubmit({
                    beforeSubmit:function(){
                         var image_path = $.baseUrl+'assets/img/loading.png';
                        $("body").append('<div id="loadingDiv"><img class="star" src="'+image_path+'" /></div>');
                    },
                    success: function() {
                       //active_feed_link();
                       //$("form")[1].reset();
                        $("#loadingDiv").remove();
                        //$('.ajax-feed-link.active').click();
                        $(".block-links").removeClass('active');
                        $(".diagnosis-feed").closest(".block-links").addClass('active')
                        $(".diagnosis-feed").click();
                        $("form")[1].reset();
                    }
                }) : '';
            });
            /***end here***/
            /***use for medication entry validation***/
            $target.find('.panel-body .medication-submit').click(function(e) {
                if($('#name0').val()==0)
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie eine gÃƒÂ¼ltige Medikamente Detail ..!');
                    $('#myModal').modal({});
                    return false;
                }
                var $forms = $('.panel-body').find('.tab-pane.active form');
               
                $forms.length ? $($forms[0]).ajaxSubmit({
                    beforeSubmit:function(){
                         var image_path = $.baseUrl+'assets/img/loading.png';
                        $("body").append('<div id="loadingDiv"><img class="star" src="'+image_path+'" /></div>');
                    },
                    success: function() {
						$("#loadingDiv").remove();
                        //$('.ajax-feed-link.active').click();
                        $(".block-links").removeClass('active');
                        $(".medication-feed").closest(".block-links").addClass('active')
                        $(".medication-feed").click();
                        $("form")[2].reset();
					}
                }) : '';
            });
            /***end here***/
            /***use for medication entry validation***/
            $target.find('.panel-body .impung-submit').click(function(e) {
                if($('#Handelsname0').val()==0)
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie eine gÃƒÂ¼ltige Impfung Detail ..!');
                    $('#myModal').modal({});
                    return false;
                }
                var $forms = $('.panel-body').find('.tab-pane.active form');
                $forms.length ? $($forms[0]).ajaxSubmit({
                    beforeSubmit:function(){
                         var image_path = $.baseUrl+'assets/img/loading.png';
                        $("body").append('<div id="loadingDiv"><img class="star" src="'+image_path+'" /></div>');
                    },
                    success: function() {
						$("#loadingDiv").remove();
                      	//$('.ajax-feed-link.active').click();
                      	$(".block-links").removeClass('active');
                      	$(".vaccination-feed").closest(".block-links").addClass('active')
                      	$(".vaccination-feed").click();
                      	$("form")[3].reset();
		           }
                }) : '';
            });
            /***end here***/
            /***use for blood pressure entry validation***/
            $target.find('.panel-body .bloodpressure-submit').click(function(e) {
                if($('#rr_sys0').val()==0)
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie eine gÃƒÂ¼ltige Blutdruck Detail ..!');
                    $('#myModal').modal({});
                    return false;
                }
                
                if(isNaN(parseFloat($('#rr_sys0').val())))
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie eine gÃƒÂ¼ltige RR systolisch Wert ..!');
                    $('#myModal').modal({});
                    $('#rr_sys0').focus();
                    return false;
                }
                if(isNaN(parseFloat($('#rr_dia0').val())))
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie eine gÃƒÂ¼ltige RR diastolisch Wert ..!');
                    $('#myModal').modal({});
                    $('#rr_dia0').focus();
                    return false;
                }
                if(isNaN(parseFloat($('#puls0').val())))
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie eine gÃƒÂ¼ltige puls Wert ..!');
                    $('#myModal').modal({});
                    $('#puls0').focus();
                    return false;
                }
                var $forms = $('.panel-body').find('.tab-pane.active form');
                $forms.length ? $($forms[0]).ajaxSubmit({
                    beforeSubmit:function(){
                         var image_path = $.baseUrl+'assets/img/loading.png';
                        $("body").append('<div id="loadingDiv"><img class="star" src="'+image_path+'" /></div>');
                    },
                    success: function() {
		              $("#loadingDiv").remove();
                      //$('.ajax-feed-link.active').click();
                      $(".block-links").removeClass('active');
                      $(".bloodpressure-feed").closest(".block-links").addClass('active')
                      $(".bloodpressure-feed").click();
                      $("form")[4].reset();
					}
                }) : '';
            });
            /***end here***/
            /***use for blood sugar entry validation***/
            $target.find('.panel-body .bloodsugar-submit').click(function(e) {
                if($('#bloodsugar0').val()==0)
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie eine gÃƒÂ¼ltige Blutzucker Detail ..!');
                    $('#myModal').modal({});
                    return false;
                }
                if(isNaN(parseFloat($('#bloodsugar0').val())))
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie eine gÃƒÂ¼ltige Blutzuckerwert Wert ..!');
                    $('#myModal').modal({});
                 
                    return false;
                }
                if(isNaN(parseFloat($('#HbA1C0').val())))
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie eine gÃƒÂ¼ltige HbA1C Wert ..!');
                    $('#myModal').modal({});
                    return false;   
                }
                var $forms = $('.panel-body').find('.tab-pane.active form');
                $forms.length ? $($forms[0]).ajaxSubmit({
                    beforeSubmit:function(){
                         var image_path = $.baseUrl+'assets/img/loading.png';
                        $("body").append('<div id="loadingDiv"><img class="star" src="'+image_path+'" /></div>');
                    },
                    success: function() {
		              $("#loadingDiv").remove();
                      //$(".sidebar0").find(".ajax-feed-link.active").click();
                      //$('.ajax-feed-link.active').click();
                      //$('.ajax-feed-link.active').click();
                      $(".block-links").removeClass('active');
                      $(".bloodsugar-feed").closest(".block-links").addClass('active')
                      $(".bloodsugar-feed").click();
                      $("form")[5].reset();
					}
                }) : '';
            });
            /***end here***/
            /***use for weight_bmi entry validation***/
            $target.find('.panel-body .weight_bmi-submit').click(function(e) {
                if($('#size').val()==0)
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie eine gÃƒÂ¼ltige Gewicht und bmi Detail ..!');
                    $('#myModal').modal({});
                    return false;
                }
                if(isNaN(parseFloat($('#size').val())))
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie eine gÃƒÂ¼ltige HÃƒÂ¶he Wert ..!');
                    $('#myModal').modal({});
                    return false;
                }
                if(isNaN(parseFloat($('#weight').val())))
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie eine gÃƒÂ¼ltige Gewicht Wert ..!');
                    $('#myModal').modal({});
                    return false;
                }
                var $forms = $('.panel-body').find('.tab-pane.active form');
                $forms.length ? $($forms[0]).ajaxSubmit({
					beforeSubmit:function(){
                      	var image_path = $.baseUrl+'assets/img/loading.png';
                        $("body").append('<div id="loadingDiv"><img class="star" src="'+image_path+'" /></div>');
                    },
					success: function() {
		               	$("#loadingDiv").remove();
                      	//$('.ajax-feed-link.active').click();
                      	$(".block-links").removeClass('active');
                      	$(".weight_bmi-feed").closest(".block-links").addClass('active')
                      	$(".weight_bmi-feed").click();
						$("form")[6].reset();
                    }
                }) : '';
            });
            /***end here***/
            /***use for marcumer entry validation***/
            $target.find('.panel-body .marcumer-submit').click(function(e){
                if($('#INR0').val()==0)
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie eine gÃƒÂ¼ltige marcumer Detail .. !');
                    $('#myModal').modal({});
                    return false;
                }
                if(parseFloat($('#INR0').val()) < parseFloat(1) || parseFloat($('#INR0').val()) > parseFloat(4.5) )
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('INR should be between 1 to 4.5...!');
                    $('#myModal').modal({});
                    return false;   
                }
              
                if($('#quick0').val() == 0 || parseFloat($('#quick0').val()) < parseFloat(10) || parseFloat($('#quick0').val()) > parseFloat(40))
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Quick(%) should be between 10 to 40...!');
                    $('#myModal').modal({});
                    return false;   
                }
                var $forms = $('.panel-body').find('.tab-pane.active form');
                $forms.length ? $($forms[0]).ajaxSubmit({
		        	beforeSubmit:function(){
                    	var image_path = $.baseUrl+'assets/img/loading.png';
                        $("body").append('<div id="loadingDiv"><img class="star" src="'+image_path+'" /></div>');
                    },
					success: function() {
						$("#loadingDiv").remove();
                      	//$('.ajax-feed-link.active').click();
                      	$(".block-links").removeClass('active');
                      	$(".marcumar-feed").closest(".block-links").addClass('active')
                      	$(".marcumar-feed").click();
			            $("form")[7].reset();
                    }
                }) : '';
            });
            /***end here***/
  
  			/***use for family history entry validation***/
            $target.find('.panel-body .familyhistory-submit').click(function(e){
                if($('#Disease_name0').val()==0)
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie Familiengeschichte Details ..!');
                    $('#myModal').modal({});
                    return false;
                }
                var $forms = $('.panel-body').find('.tab-pane.active form');
                $forms.length ? $($forms[0]).ajaxSubmit({
					beforeSubmit:function(){
                    	var image_path = $.baseUrl+'assets/img/loading.png';
                        $("body").append('<div id="loadingDiv"><img class="star" src="'+image_path+'" /></div>');
                    },
					success: function() {
		            	$("#loadingDiv").remove();
                      	//$('.ajax-feed-link.active').click();
                      	$(".block-links").removeClass('active');
                      	$(".familyhistory-feed").closest(".block-links").addClass('active')
                      	$(".familyhistory-feed").click();
                      	$("form")[8].reset();
					}
                }) : '';
            });
            /***end here***/
            
          $target.find('.panel-body .bodymap-submit').click(function(e){
                var $forms = $('.panel-body').find('.tab-pane.active form');
                $forms.length ? $($forms[0]).ajaxSubmit({
                    beforeSubmit:function(){
                         var image_path = $.baseUrl+'assets/img/loading.png';
                        $("body").append('<div id="loadingDiv"><img class="star" src="'+image_path+'" /></div>');
                    },
                    success: function() {
                        $("#loadingDiv").remove();
	                    $(".block-links").removeClass('active');
                            $(".bodymap-feed").closest(".block-links").addClass('active')
	                    $(".bodymap-feed").click();
                       	$("form")[8].reset();
                    }
                }) : '';
            });
            
  
//            $target.find('.panel-heading .btn-submit').click(function(e) {
//              
//                var $forms = $(this).parent().parent().siblings('.panel-body').find('.tab-pane.active form');
//                $forms.length ? $($forms[0]).ajaxSubmit({
//                    success: function() {
//                       active_feed_link();
//                    }
//                }) : '';
//            });
//            
//            $target.find('.panel-footer .btn-submit').click(function(e) {
//                var $forms = $(this).parent().parent().siblings('.panel-body').find('.tab-pane.active form');
//                $forms.length ? $($forms[0]).ajaxSubmit({
//                    success: function() {
//                        active_feed_link();
//                    }
//                }) : '';
//            });
        }
    });
    $(function()
    {
    	$('.VideoAppointment').hover(function() {
            $(this).find(".myhead-tital").text("Available Soon");
    	}, function() {
    		$(this).find(".myhead-tital").text("<?php echo $this->lang->line('overview_lang_get_video');?>");
        });
      $("input[name='atc_code']").each(function() {
            var $atc = $(this);
            $atc.autocomplete({
                source: $.siteUrl + "/akte/autocomplete/atc_by_code",
                minLength: 1,
                select: function(event, ui){
                    $atc.closest("form").find("input").each(function(){
                        if($(this).attr('name')=='substance')
                            $(this).val(ui.item.substance);
                    });
                }
            });
        });
        
        $("input[name='substance']").each(function() {
            var $substance = $(this);
            $substance.autocomplete({
                source: $.siteUrl + "/akte/autocomplete/atc_by_name",
                minLength: 1,
                select: function(event, ui){
                    $substance.closest("form").find("input").each(function(){
                        if($(this).attr('name')=='atc_code')
                            $(this).val(ui.item.atc);
                    });
                }
            });
        });
        
         /****
                Autocomplete functions used for Diagnosis Page
              
         ****/
        $("input[name='icd_code']").each(function() {
            var $icd = $(this);

            $icd.autocomplete({

                source: $.siteUrl + "/akte/autocomplete/icd_by_code",
                minLength: 1,

                select: function(event, ui){
                    $icd.closest("form").find("input").each(function(){
                        if($(this).attr('name')=='disease_name')
                            $(this).val(ui.item.diagnosis);
                    });
                }
            });
        });
        $("input[name='disease_name']").each(function() {
            var $diagnosis = $(this);

            $diagnosis.autocomplete({
                source: $.siteUrl + "/akte/autocomplete/icd_by_name",
                minLength: 1,
                maxHeight: 15,
                select: function(event, ui){
                    $diagnosis.closest("form").find("input").each(function(){
                        if($(this).attr('name')=='icd_code')
                            $(this).val(ui.item.icd);
                    });
                }
            });

        });
        
        //Styling for the autocomplete widgets with maximum height and scrollbar
        $(".ui-autocomplete").css({"color":"white","max-Height":"250px","overflow-y":"auto","overflow-x":"hidden"});             
    $('.panal-widget').click(function(e) {
        $('.panal-widget').removeClass('active');
        var $this = $(this);
        if (!$this.hasClass('active')) {
            $this.addClass('active');
        }
        e.preventDefault();
    });      
    });
</script>
<script>
    
    $('.fa-calendar-o').on('click', function()
    {
        $(".sidebar-calendar-block").toggleClass('sidebar-calendar1');
        
    });
    $(document).ready(function(){
		$("#label_befindlichkeit").click();
	});
    $(document).ready(function(){
    var date = new Date();
      var d = date.getDate();
      var m = date.getMonth();
      var y = date.getFullYear();

      $('#sidebar-calendar').fullCalendar({
        editable: false,
          events: [],
          header: {
            left: 'title'
          },dayClick: function(date, jsEvent, view) {
              date = date.format();
              $.ajax({
                url:$.siteUrl+'/akte/overview/getPatientReservation',
                data:{'date':date},
                type:'POST',
                beforeSend:function(html){
                    var image_path = '../assets/img/process.gif';
                    $("#reservation").html("<center><img src='"+image_path+"' /></center>");
                },
                success:function(html){
                   $("#reservation").html(html);
                   //$(".sidebar-calendar-block").toggleClass('sidebar-calendar1');
                }
              });
            // change the day's background color just for fun
            $(".fc-today").removeClass("fc-today");
            $(this).addClass('fc-today');
        }
    });
  });
    </script>
    <script src="<?php echo base_url('assets/vendor/fullcalendar-2.3.1/fullcalendar.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/timelinetermin.js'); ?>"></script>


<!--end here --->
<style>
   .scrollit-my1 tr{cursor:pointer;}
  .termin-load{display:none;}
  .page-title{display:none;}
   #sidebar-calendar{clear:both;padding:15px 0; font-size:12px;}
   #sidebar-calendar .fc-border-separate{background: transparent;box-shadow:0 0 0px;}
   #sidebar-calendar  .fc-border-separate th{background: rgba(0,0,0,0.1);}
   .sidebar-calendar-block{height: 1px;overflow:hidden;width: 100%;}
   .sidebar-calendar1{height: auto;}
   #content.container > h2.page-title{display:none;}
   #content.container > h2.page-title{display:none;}
   #content.container .main_container{padding-top:20px;}
   #content.container .main_container > .container{padding-right:30px;padding-left:0px;}
   #footer .container > p{margin:0px;}
   .block > h2.title{font-family: 'Open Sans', 'Trebuchet MS', arial, sans-serif;font-size:22px;}
   .poll-block{min-height:67px;}
   .col-head-btn .list-group-item:first-child{ border-radius:0}
 .col-head-btn  a.list-group-item.active, a.list-group-item.active:hover, a.list-group-item.active:focus{ border:0;}
</style>
