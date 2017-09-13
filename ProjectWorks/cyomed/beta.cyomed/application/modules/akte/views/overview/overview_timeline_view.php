<?php
if(isset($_REQUEST['check']))
{
  $check=$_REQUEST['check'];
}
else
{
   $check=""; 
}
    $diagnose_active="";
    $condition_active="";
    $vaccination_active="";
    $medication_active="";
    $active_url="";
    $vital_values_active="";
    $bloodpressure_active="";
    $bloodsugar_active="";
    $weightandbmi_active="";
    $marcumar_active="";
    $familyhistory_active="";
    $smokingstatus_active="";
    $akte_active="";
    $general_active="";
    $active_default="active";
    $case_active="";
    switch($check)
    {
        case 'diagnosis':
            $active_url = site_url('akte/diagnosis/feed');
            $diagnose_active="active";
            break;
        
        case 'condition':
            $active_url = site_url('akte/condition/feed');
            $condition_active="active";
            $block_active="active";
            $active_default="";
            break;
        
        case 'vaccination':
            $active_url = site_url('akte/vaccination/feed');
            $vaccination_active="active";
            break;
        
        case 'medication':
            $active_url = site_url('akte/medication/feed');
            $medication_active="active";
            break;
        
        case 'vital_values':
            $active_url =site_url('akte/vital_values/feed');
            $vital_values_active="active";
            break;
        
        case 'bloodpressure':
            $active_url =site_url('akte/vital_values/blood_pressure/feed');
            $bloodpressure_active="active";
            $block_active="active";
            $active_default="";
            break;
        
        case 'bloodsugar' :
            $active_url =site_url('akte/vital_values/blood_sugar/feed');
            $bloodsugar_active="active";
            $block_active="active";
            $active_default="";
            break;
            
        case 'weightandbmi':
             $active_url =site_url('akte/vital_values/weight_bmi/feed');
             $weightandbmi_active="active";
             $block_active="active";
            $active_default="";
             break;
        
       case 'marcumar':
             $active_url =site_url('akte/vital_values/marcumar/feed');
             $marcumar_active="active";
             break;
       case 'familyhistory' :
             $active_url =site_url('akte/familyhistory/feed');
             $familyhistory_active="active";
             
             break;
        case 'bodymap' :
             $active_url =site_url('akte/bodymap/feed');
             $bodymap_active="active";
             break;
//       case 'econsult' :
//             $active_url =site_url('akte/econsult/feed');
//             $econsult_active="active";
//             break;
       case 'smokingstatus' :
             $active_url =site_url('akte/smokingstatus/feed');
             $smokingstatus_active="active";
             $block_active="active";
             $active_default="";
             break;
       case 'akte' :
             $active_url =site_url('akte/feed/akte');
             $akte_active="active";
             break;
       case 'general' :
             $active_url =site_url('akte/feed/general');
             $general_active="active";
             break;
       case 'runtastic':
             $active_url =site_url('akte/runtastic');
             $runtastic_active="active";
             break;
       case 'withingsdata':
             $active_url =site_url('akte/withingsdata');
             $withingsdata_active="active";
             break;
        case 'fit':
             $active_url =site_url('akte/fit');
             $fitbit_active="active";
             break;
        case 'casehistory':
             $active_url =site_url('akte/casehistory/feed');
             $case_active="active";
             break;
        default:
            break;
   } 
   /**Profile Completeness***/
   $profilestatus = $this->m->getprofiledata();
   /*** End Here***/
   
if ($this->m->user_role() != M::ROLE_DOCTOR) 
{
    $this->load->model('document/mdoc');
    $img_path = $this->mdoc->get_profile_image_path();
 ?>
 <div class="row" id="<?php echo $scope_id = 'scope_' . random_string('alnum', 32); ?>">
      	<aside class="col-md-2 col-sm-3 sidebar sidebar0" >
            <div class="">
                <!-- /.profile-avatar -->
                <div class="block block-user">
                    <div class="profile-avatar"> <img src="<?= (isset($img_path) && file_exists($img_path)) ? base_url($img_path) : base_url() . "assets/img/portal/default-user.png"; ?>" class="profile-avatar-img thumbnail" alt="Profile Image"> </div>
                    <button class="btn btn-link ajax-profiles-link" href="<?php echo site_url('akte/profile'); ?>" class="">
                        <a ><span class="fa fa-pencil"></span></a>
                    </button>
                    <h2><?php echo $this->m->user_value('academic_grade'); ?> <?php echo $this->m->user_value('name'); ?> <?php echo $this->m->user_value('surname'); ?></h2>
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
						<!--<i class="fa fa-asterisk text-primary"></i> -->
                        <?php echo $this->lang->line('overview_lang_recent_activity_title'); ?>  </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <li><a href="<?php echo site_url('akte/feed/general'); ?>" class="ajax-feed-link">View</a></li>
                        </ul>
                  </div>
                 </div>
                </div>
                <div class="block block-links <?php echo $block_active; ?> block-info">
                    <h2 class="head">
                        <?php echo $this->lang->line('overview_lang_health_title');?>
                    </h2>
                     <ul class="link-list" id="feedList1">
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
                <div class="block block-links <?php echo $active_default;?> block-primary">
                    <h2 class="head">
                        <?php echo $this->lang->line('overview_lang_medicine_title');?>
                    </h2>
                    <div class="link-list" id="feedList">
                       
						<!--
							<div class="dropdown"> 
		                        <a  class="list-group-item ajax-feed-link <?php echo $akte_active;?>" href="<?php echo site_url('akte/feed/akte'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-book text-primary "></i> <?php echo $this->lang->line('overview_lang_record_title'); ?> <i class="fa fa-chevron-right list-group-chevron"></i>
		                        </a>
		                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
		                            <li><a href="<?php echo site_url('akte/feed/akte'); ?>" class="ajax-feed-link" >View</a></li>
		                        </ul>
		                    </div>
						-->
                        <div class="dropdown"> <a  class="list-group-item ajax-feed-link <?php echo $vital_values_active;?>" href="<?php echo site_url('akte/vital_values/feed'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="icomoon i-chart text-primary"></i> <?php echo $this->lang->line('overview_lang_vital_signs_title'); ?> <i class="fa fa-chevron-right list-group-chevron"></i> </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li><a href="<?php echo site_url('akte/vital_values/feed'); ?>" class="ajax-feed-link" >View</a></li>
                                <li><a href="<?php echo site_url('akte/vital_values'); ?>" class="ajax-load-link">Edit</a></li>
                            </ul>
                        </div>
                      
                        <div class="dropdown"> <a  class="list-group-item ajax-feed-link diagnosis-feed <?php echo $diagnose_active;?>" href="<?php echo site_url('akte/diagnosis/feed'); ?>"  data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-stethoscope text-primary"></i> <?php echo $this->lang->line('overview_lang_diagnosis_title'); ?> <i class="fa fa-chevron-right list-group-chevron"></i> </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li><a href="<?php echo site_url('akte/diagnosis/feed'); ?>"  class="ajax-feed-link">View</a></li>
                                <li><a href="<?php echo site_url('akte/diagnosis'); ?>" class="ajax-load-link">Edit</a></li>
                            </ul>
                        </div>
                        <div class="dropdown"> <a href="<?php echo site_url('akte/medication/feed'); ?>" class="medication-feed list-group-item ajax-feed-link <?php echo $medication_active;?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-table text-primary"></i> <?php echo $this->lang->line('overview_lang_medication_title'); ?> <i class="fa fa-chevron-right list-group-chevron"></i> </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li><a href="<?php echo site_url('akte/medication/feed'); ?>" class="ajax-feed-link" >View</a></li>
                                <li><a href="<?php echo site_url('akte/medication'); ?>" class="ajax-load-link" >Edit</a></li>
                            </ul>
                        </div>
                        <div class="dropdown"> <a href="<?php echo site_url('akte/vaccination/feed'); ?>" class="vaccination-feed list-group-item ajax-feed-link <?php echo $vaccination_active;?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-medkit text-primary"></i> <?php echo $this->lang->line('overview_lang_blood_vaccination_title'); ?><i class="fa fa-chevron-right list-group-chevron"></i> </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li><a href="<?php echo site_url('akte/vaccination/feed'); ?>" class="ajax-load-link" >View</a></li>
                            </ul>
                        </div>
                        <div class="dropdown"> <a class="list-group-item ajax-feed-link marcumar-feed <?php echo $marcumar_active;?>" href="<?php echo site_url('akte/vital_values/marcumar/feed'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-sun-o text-primary"></i> <?php echo $this->lang->line('overview_lang_blood_marcumar_title'); ?> <i class="fa fa-chevron-right list-group-chevron"></i> </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li><a href="<?php echo site_url('akte/vital_values/marcumar/feed'); ?>" class="ajax-feed-link">View</a></li>
                                <li><a href="<?php echo site_url('akte/vital_values/marcumar'); ?>" class="ajax-load-link">Edit</a></li>
                            </ul>
                        </div>
                        <?php if ($this->m->user_role() != M::ROLE_DOCTOR) { ?>
                            <div class="dropdown"> <a class="list-group-item ajax-feed-link familyhistory-feed <?php echo $familyhistory_active;?>"  href="<?php echo site_url('akte/familyhistory/feed'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-users text-primary"></i> <?php echo $this->lang->line('overview_lang_family_history_status_title'); ?> <i class="fa fa-chevron-right list-group-chevron"></i> </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <li><a href="<?php echo site_url('akte/familyhistory/feed'); ?>" class="ajax-feed-link">View</a></li>
                                    <li><a href="<?php echo site_url('akte/familyhistory'); ?>" class="ajax-load-link">Edit</a></li>
                                </ul>
                            </div>
                         <?php } ?>
                            <div class="dropdown"> <a class="list-group-item ajax-feed-link bodymap-feed <?php echo $bodymap_active;?>"  href="<?php echo site_url('akte/bodymap/feed'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-male text-primary"></i> <?php echo $this->lang->line('overview_lang_bodymap_title'); ?> <i class="fa fa-chevron-right list-group-chevron"></i> </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <li><a href="<?php echo site_url('akte/bodymap/feed'); ?>" class="ajax-feed-link">View</a></li>
                                    <li><a href="<?php echo site_url('akte/bodymap'); ?>" class="ajax-load-link">Edit</a></li>
                                </ul>
                            </div>   
<!--                            <div class="dropdown"> <a class="list-group-item ajax-feed-link eonsult-feed <?php echo $econsult_active;?>"  href="<?php echo site_url('akte/econsult/feed'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-male text-primary"></i> <?php echo $this->lang->line('overview_lang_econsult_title'); ?> <i class="fa fa-chevron-right list-group-chevron"></i> </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <li><a href="<?php echo site_url('akte/econsult/feed'); ?>" class="ajax-feed-link">View</a></li>
                                    <li><a href="<?php echo site_url('akte/econsult'); ?>" class="ajax-load-link">Edit</a></li>
                                </ul>
                            </div>                                                                                                  -->
                         <div class="dropdown"> <a class="list-group-item ajax-feed-link " href="<?php echo site_url('akte/document/feed'); ?>"   data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-folder-o text-primary"></i> <?php echo $this->lang->line('overview_lang_blood_document_title'); ?>  <i class="fa fa-chevron-right list-group-chevron"></i> </a> </div>
                         <div class="dropdown"> <a class="list-group-item ajax-feed-link <?php echo $case_active;?>" href="<?php echo site_url('akte/casehistory/feed'); ?>"   data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-folder-o text-primary"></i> <?php echo $this->lang->line('overview_lang_case_history_title'); ?>  <i class="fa fa-chevron-right list-group-chevron"></i> </a> </div>
                    </div>
                </div>
                <div class="block block-links active block-primary hide">
                    <h2 class="head">TERMIN</h2>
                    <div class="link-list" id="feedList">
                        <?php if ($this->m->user_role() != M::ROLE_DOCTOR) { ?>
                            <div class="dropdown"> <a  class="list-group-item termin-load-link <?php echo $familyhistory_active;?>"  href="<?php echo site_url('termin/patient_termin'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-search text-primary"></i> Search <i class="fa fa-chevron-right list-group-chevron"></i> </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <li><a href="<?php echo site_url('termin/patient_termin/feed'); ?>" class="ajax-feed-link">View</a></li>
                                    <li><a href="<?php echo site_url('termin/patient_termin'); ?>" class="ajax-load-link">Edit</a></li>
                                </ul>
                            </div>
                        <?php } ?>
                        <?php if ($this->m->user_role() != M::ROLE_PATIENT) { ?>
                            <div class="dropdown"> <a  class="list-group-item ajax-calender-link <?php echo $familyhistory_active;?>"  href="<?php echo site_url('termin/calendar'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-calendar text-primary"></i> Calendar <i class="fa fa-chevron-right list-group-chevron"></i> </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <li><a href="<?php echo site_url('termin/calendar/feed'); ?>" class="ajax-feed-link">View</a></li>
                                    <li><a href="<?php echo site_url('termin/calendar'); ?>" class="ajax-load-link">Edit</a></li>
                                </ul>
                            </div>
                            <div class="dropdown"> <a  class="list-group-item ajax-doctortermin-link <?php echo $familyhistory_active;?>"  href="<?php echo site_url('termin/doctor_termin'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-tasks text-primary"></i> Appointment <i class="fa fa-chevron-right list-group-chevron"></i> </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <li><a href="<?php echo site_url('termin/doctor_termin/feed'); ?>" class="ajax-feed-link">View</a></li>
                                    <li><a href="<?php echo site_url('termin/doctor_termin'); ?>" class="ajax-load-link">Edit</a></li>
                                </ul>
                            </div>
                            <div class="dropdown"> <a  class="list-group-item ajax-load-link <?php echo $familyhistory_active;?>"  href="<?php echo site_url('termin/profile'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-user text-primary"></i> Profile <i class="fa fa-chevron-right list-group-chevron"></i> </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <li><a href="<?php echo site_url('termin/doctor_termin/feed'); ?>" class="ajax-feed-link">View</a></li>
                                    <li><a href="<?php echo site_url('termin/doctor_termin'); ?>" class="ajax-load-link">Edit</a></li>
                                </ul>
                            </div>
                            <div class="dropdown"> <a  class="list-group-item ajax-load-link <?php echo $familyhistory_active;?>"  href="<?php echo site_url('termin/times'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"> <i class="fa fa-clock-o text-primary"></i> Times <i class="fa fa-chevron-right list-group-chevron"></i> </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <li><a href="<?php echo site_url('termin/doctor_termin/feed'); ?>" class="ajax-feed-link">View</a></li>
                                    <li><a href="<?php echo site_url('termin/doctor_termin'); ?>" class="ajax-load-link">Edit</a></li>
                                </ul>
                            </div>
                        <?php } ?>
                        
                    </div>
                </div>
				<!--                
					<div class="block block-links block-purple">
	                    <h2 class="head">
	                        <?php // echo $this->lang->line('overview_lang_social_title');?>
	                    </h2>
	                    <ul class="link-list">
	                        <li>
	                            <a href="javascript:void(0);">
	                              <?php // echo $this->lang->line('overview_lang_view_title');?>
	                            </a>
	                        </li>
	                    </ul>
	                </div>
	            -->
	        </div>
	        <div class="rsb"></div>
        </aside>


        <div class="col-md-7 col-sm-9 content-area">
            
            <div id="videoContent" class="block-c1" style="margin-bottom:0px;"></div>
            
            <div class="block block-c1 termin-load" id="entry_view">

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
                  <!-- <textarea class="form-control share-widget-textarea" rows="3" placeholder="Share what you've been up to..." tabindex="1"></textarea> -->
                    <?php $status_input_data_t1_id = 'status_input_data_t1_id_' . random_string('alnum', 32); ?>
                    <?php $status_input_data_t2_id = 'status_input_data_t2_id_' . random_string('alnum', 32); ?>
                    <?php $status_input_data_t3_id = 'status_input_data_t3_id_' . random_string('alnum', 32); ?>
                    <?php $status_input_data_t4_id = 'status_input_data_t4_id_' . random_string('alnum', 32); ?>
                    <?php $status_input_data_t5_id = 'status_input_data_t5_id_' . random_string('alnum', 32); ?>
                    <?php $status_input_data_t6_id = 'status_input_data_t6_id_' . random_string('alnum', 32); ?>
                    <?php $status_input_data_t7_id = 'status_input_data_t7_id_' . random_string('alnum', 32); ?>
                    <?php $status_input_data_t8_id = 'status_input_data_t8_id_' . random_string('alnum', 32); ?>
                    <?php $status_input_data_t9_id = 'status_input_data_t9_id_' . random_string('alnum', 32); ?>
                    <?php $status_input_data_t10_id = 'status_input_data_t10_id_' . random_string('alnum', 32); ?>
                    <div class="panel-heading clearfix">
                        <div class="share-widget-types pull-left"> 
                            <a href="#<?php echo $status_input_data_t1_id; ?>" data-toggle="tab" class="fa fa-smile-o ui-tooltip panal-widget active" title="<?php echo $this->lang->line('overview_lang_condition_title');?>"><i></i></a> 
                            <a href="#<?php echo $status_input_data_t5_id; ?>" data-toggle="tab" class="fa fa-heartbeat ui-tooltip panal-widget" title="<?php echo $this->lang->line('overview_lang_blood_pressure_title');?>"><i></i></a> 
                            <a href="#<?php echo $status_input_data_t7_id; ?>" data-toggle="tab" class="fa fa-street-view ui-tooltip panal-widget" title="<?php echo $this->lang->line('overview_lang_blood_bmi_title');?>"><i></i></a> 
                            <a href="#" data-toggle="tab" class="fa fa-upload ui-tooltip" title="<?php echo $this->lang->line('overview_lang_file_upload');?>"><i></i></a>                             
                        </div>
                        <div class="pull-right dropdown entrydrop" ><a href=""  data-toggle="dropdown"><i class="fa fa-plus"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dLabel">
                            <div class="dropdiv">
                            <a href="#<?php echo $status_input_data_t2_id; ?>" data-toggle="tab" class="fa fa-stethoscope ui-tooltip panal-widget" title="<?php echo $this->lang->line('overview_lang_diagnosis_title');?>"><i></i></a> 
                            <a href="#<?php echo $status_input_data_t3_id; ?>" data-toggle="tab" class="fa fa-table ui-tooltip panal-widget" title="<?php echo $this->lang->line('overview_lang_medication_title');?>"><i></i></a> 
                            <a href="#<?php echo $status_input_data_t4_id; ?>" data-toggle="tab" class="fa fa-medkit ui-tooltip panal-widget" title="<?php echo $this->lang->line('overview_lang_blood_vaccination_title');?>"><i></i></a> 
                            <a href="#<?php echo $status_input_data_t6_id; ?>" data-toggle="tab" class="fa fa-tint ui-tooltip panal-widget" title="<?php echo $this->lang->line('overview_lang_blood_sugar_title');?>"><i></i></a> 
                            <a href="#<?php echo $status_input_data_t8_id; ?>" data-toggle="tab" class="fa fa-area-chart ui-tooltip panal-widget" title="<?php echo $this->lang->line('overview_lang_blood_marcumar_title');?>"><i></i></a> 
                            <a href="#<?php echo $status_input_data_t9_id; ?>" data-toggle="tab" class="fa fa-users ui-tooltip panal-widget" title="<?php echo $this->lang->line('overview_lang_family_history_status_title');?>"><i></i></a> 
                            <a href="#<?php echo $status_input_data_t10_id; ?>" data-toggle="tab" class="fa fa-male ui-tooltip panal-widget" title="<?php echo $this->lang->line('overview_lang_bodymap_title');?>"><i></i></a> 
<?php /*                             
                            <a href="#<?php echo $status_input_data_t6_id; ?>" data-toggle="tab" class="fa fa-tint ui-tooltip panal-widget" title="<?php echo $this->lang->line('overview_lang_blood_sugar_title');?>"><i></i></a> 
                            <a href="#<?php echo $status_input_data_t7_id; ?>" data-toggle="tab" class="fa fa-street-view ui-tooltip panal-widget" title="<?php echo $this->lang->line('overview_lang_blood_bmi_title');?>"><i></i></a> 
                            <a href="#<?php echo $status_input_data_t8_id; ?>" data-toggle="tab" class="fa fa-area-chart ui-tooltip panal-widget" title="<?php echo $this->lang->line('overview_lang_blood_marcumar_title');?>"><i></i></a> 
                            <a href="#<?php echo $status_input_data_t9_id; ?>" data-toggle="tab" class="fa fa-users ui-tooltip panal-widget" title="<?php echo $this->lang->line('overview_lang_family_history_status_title');?>"><i></i></a> 
                            <a href="#<?php echo $status_input_data_t10_id; ?>" data-toggle="tab" class="fa fa-male ui-tooltip panal-widget" title="<?php echo $this->lang->line('overview_lang_bodymap_title');?>"><i></i></a> 
*/?>                            
                            </div>
                        </div>
                        </div>
                     </div>
                    <div class="panel-body">
                        <div id="<?php echo $status_input_data_tab_id = 'status_input_data_tab_id' . random_string('alnum', 32); ?>" class="tab-content">
                            <div class="tab-pane fade in active" id="<?php echo $status_input_data_t1_id; ?>">
                                <?php $this->load->view('condition/condition_entry_view', array('hide_insert' => TRUE,)); ?>
                                <div class="pull-right" >
                                    <button class="btn btn-default btn-sm condition-submit" id="<?php // echo $status_input_data_t1_id; ?>" type="submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?> </button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="<?php echo $status_input_data_t2_id; ?>">
                                <?php $this->load->view('diagnosis/diagnosis_entry_view', array('hide_insert' => TRUE,)); ?>
                                <div class="pull-right" >
                                    <button class="btn btn-default btn-sm diagnose-submit" id="<?php // echo $status_input_data_t2_id; ?>" type="submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?> </button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="<?php echo $status_input_data_t3_id; ?>">
                                <?php $this->load->view('medication/medication_entry_view', array('hide_insert' => TRUE,)); ?>
                                <div class="pull-right" >
                                    <button class="btn btn-default btn-sm medication-submit" id="<?php // echo $status_input_data_t3_id; ?>" type="submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?> </button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="<?php echo $status_input_data_t4_id; ?>">
                                <?php $this->load->view('vaccination/vaccination_entry_view', array('hide_insert' => TRUE,)); ?>
                                <div class="pull-right" >
                                    <button class="btn btn-default btn-sm impung-submit" id="<?php // echo $status_input_data_t4_id; ?>" type="submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?> </button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="<?php echo $status_input_data_t5_id; ?>">
                                <?php $this->load->view('graph/insert_view', array('hide_insert' => TRUE, 'table' => 'heart_frequency', 'entry' => (object) array('id' => 0, 'rr_sys' => '', 'rr_dia' => '', 'puls' => '',),)); ?>
                                <div class="pull-right" >
                                    <button class="btn btn-default btn-sm bloodpressure-submit" id="<?php // echo $status_input_data_t5_id; ?>" type="submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?> </button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="<?php echo $status_input_data_t6_id; ?>">
                                <?php $this->load->view('graph/insert_view', array('hide_insert' => TRUE, 'table' => 'blood_sugar', 'entry' => (object) array('id' => 0, 'bloodsugar' => '', 'HbA1C' => '',),)); ?>
                                <div class="pull-right" >
                                    <button class="btn btn-default btn-sm bloodsugar-submit" id="<?php // echo $status_input_data_t6_id; ?>" type="submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?> </button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="<?php echo $status_input_data_t7_id; ?>">
                                <?php $this->load->view('graph/insert_view', array('hide_insert' => TRUE, 'table' => 'weight_bmi', 'entry' => (object) array('id' => 0, 'size' => '', 'weight' => '', 'bmi' => '',),)); ?>
                                <div class="pull-right" >
                                    <button class="btn btn-default btn-sm weight_bmi-submit" id="<?php // echo $status_input_data_t7_id; ?>" type="submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?> </button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="<?php echo $status_input_data_t8_id; ?>">
                                <?php $this->load->view('graph/insert_view', array('hide_insert' => TRUE, 'table' => 'marcumar', 'entry' => (object) array('id' => 0, 'INR' => '', 'quick' => '', 'lower_limit' => '', 'upper_limit' => '',),)); ?>
                                <div class="pull-right" >
                                    <button class="btn btn-default btn-sm marcumer-submit" id="<?php // echo $status_input_data_t8_id; ?>" type="submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?> </button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="<?php echo $status_input_data_t9_id; ?>">
                                <?php $this->load->view('familyhistory/familyhistory_entry_view', array('hide_insert' => TRUE,)); ?>
                                <div class="pull-right" >
                                    <button class="btn btn-default btn-sm familyhistory-submit" id="<?php // echo $status_input_data_t9_id; ?>" type="submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?> </button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="<?php echo $status_input_data_t10_id; ?>">
                                <?php $this->load->view('bodymap/bodymap_entry_view', array('hide_insert' => TRUE,)); ?>
                                <div class="pull-right" >
                                    <button class="btn btn-default btn-sm bodymap-submit" id="<?php // echo $status_input_data_t10_id; ?>" type="submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer clearfix">

                    </div>
                </div>
                <div class="panel panel-default" id="<?php echo $status_input_panel_consult_id; ?>" style="display:none;" >
                  <!-- <textarea class="form-control share-widget-textarea" rows="3" placeholder="Share what you've been up to..." tabindex="1"></textarea> -->
                    <?php $status_input_consult_t1_id = 'status_input_consult_t1_id_' . random_string('alnum', 32); ?>
                    <?php $status_input_consult_t2_id = 'status_input_consult_t2_id_' . random_string('alnum', 32); ?>
                    <?php $status_input_consult_t3_id = 'status_input_consult_t3_id_' . random_string('alnum', 32); ?>
                    <div class="panel-heading clearfix">
                        <div class="share-widget-types pull-left"> <a href="#<?php echo $status_input_consult_t1_id; ?>" data-toggle="tab" class="fa fa-keyboard-o ui-tooltip" title="Consult"><i></i></a> </div>
                        <div class="share-widget-types pull-left"> <a href="<?php echo smart_site_url('akte/videochat'); ?>"  class="ajax-nav-links fa fa-video-camera ui-tooltip" title="Video"><i></i></a> </div>
                        <div class="share-widget-types pull-left"> <a href="#<?php echo $status_input_consult_t3_id; ?>" data-toggle="tab" class="fa fa-phone ui-tooltip" title="Call"><i></i></a> </div>
                     </div>
                    <div class="panel-body">
                        <div id="<?php echo $status_input_consult_tab_id = 'status_input_consult_tab_id' . random_string('alnum', 32); ?>" class="tab-content">
                            <div class="tab-pane fade in active" id="<?php echo $status_input_consult_t1_id; ?>">
                                <?php //$this->load->view('econsult/econsult_entry_view', array('hide_insert' => TRUE,)); ?>
                            </div>
                            <div class="tab-pane fade" id="<?php echo $status_input_consult_t2_id; ?>"> </div>
                            <div class="tab-pane fade" id="<?php echo $status_input_consult_t3_id; ?>"> </div>
                        </div>
                    </div>
                    <div class="panel-footer clearfix">
                       <div class="pull-right">
                            <button class="btn btn-primary btn-sm btn-submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?> </button>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default" id="<?php echo $status_input_panel_termin_id; ?>" style="display:none;" >
                  <!-- <textarea class="form-control share-widget-textarea" rows="3" placeholder="Share what you've been up to..." tabindex="1"></textarea> -->
                    <?php $status_input_termin_t1_id = 'status_input_termin_t1_id_' . random_string('alnum', 32); ?>
                    <?php $status_input_termin_t2_id = 'status_input_termin_t2_id_' . random_string('alnum', 32); ?>
                    <?php $status_input_termin_t3_id = 'status_input_termin_t3_id_' . random_string('alnum', 32); ?>
                    <div class="panel-heading clearfix">
                        <div class="share-widget-types pull-left"> <a href="#<?php echo $status_input_termin_t1_id; ?>" data-toggle="tab" class="fa fa-keyboard-o ui-tooltip" title="termin"><i></i></a> </div>
                        <div class="share-widget-types pull-left"> <a href="#<?php echo $status_input_termin_t2_id; ?>" data-toggle="tab" class="fa fa-video-camera ui-tooltip ajax-nav-link" title="Video"><i></i></a> </div>
                        <div class="share-widget-types pull-left"> <a href="#<?php echo $status_input_termin_t3_id; ?>" data-toggle="tab" class="fa fa-phone ui-tooltip" title="Call"><i></i></a> </div>
                        <div class="pull-right"> </div>
                    </div>
                    <div class="panel-body">
                        <div id="<?php echo $status_input_termin_tab_id = 'status_input_termin_tab_id' . random_string('alnum', 32); ?>" class="tab-content">
                            <div class="tab-pane fade in active" id="<?php echo $status_input_termin_t1_id; ?>">
                                <!--<iframe src="https://ihrarzt24.de/apps/ia24at/index.php/search_result" width="100%" height="100%" name="iframe_termin" style="border:none; min-height:560px;"></iframe>-->
                            </div>
                            <div class="tab-pane fade" id="<?php echo $status_input_termin_t2_id; ?>"> </div>
                            <div class="tab-pane fade" id="<?php echo $status_input_termin_t3_id; ?>"> </div>
                        </div>
                    </div>
                    
                </div>
                <div class="panel panel-default" id="<?php echo $status_input_panel_rezept_id; ?>" style="display:none;" >
                  <!-- <textarea class="form-control share-widget-textarea" rows="3" placeholder="Share what you've been up to..." tabindex="1"></textarea> -->
                    <?php $status_input_rezept_t1_id = 'status_input_rezept_t1_id_' . random_string('alnum', 32); ?>
                    <?php $status_input_rezept_t2_id = 'status_input_rezept_t2_id_' . random_string('alnum', 32); ?>
                    <?php $status_input_rezept_t3_id = 'status_input_rezept_t3_id_' . random_string('alnum', 32); ?>
                    <div class="panel-heading clearfix">
                        <div class="share-widget-types pull-left"> <a href="#<?php echo $status_input_rezept_t1_id; ?>" data-toggle="tab" class="fa fa-keyboard-o ui-tooltip" title="rezept"><i></i></a> </div>
                        <div class="share-widget-types pull-left"> <a href="#<?php echo $status_input_rezept_t2_id; ?>" data-toggle="tab" class="fa fa-video-camera ui-tooltip" title="Video"><i></i></a> </div>
                        <div class="share-widget-types pull-left"> <a href="#<?php echo $status_input_rezept_t3_id; ?>" data-toggle="tab" class="fa fa-phone ui-tooltip" title="Call"><i></i></a> </div>
                        <div class="pull-right"> </div>
                    </div>
                    <div class="panel-body">
                        <div id="<?php echo $status_input_rezept_tab_id = 'status_input_rezept_tab_id' . random_string('alnum', 32); ?>" class="tab-content">
                            <div class="tab-pane fade in active" id="<?php echo $status_input_rezept_t1_id; ?>"> </div>
                            <div class="tab-pane fade" id="<?php echo $status_input_rezept_t2_id; ?>"> </div>
                            <div class="tab-pane fade" id="<?php echo $status_input_rezept_t3_id; ?>"> </div>
                        </div>
                    </div>
                    <div class="panel-footer clearfix">
                        <div class="share-widget-types pull-left"> <a href="#<?php echo $status_input_rezept_t1_id; ?>" data-toggle="tab" class="fa fa-keyboard-o ui-tooltip" title="rezept"><i></i></a> </div>
                        <div class="share-widget-types pull-left"> <a href="#<?php echo $status_input_rezept_t2_id; ?>" data-toggle="tab" class="fa fa-video-camera ui-tooltip" title="Video"><i></i></a> </div>
                        <div class="share-widget-types pull-left"> <a href="#<?php echo $status_input_rezept_t3_id; ?>" data-toggle="tab" class="fa fa-phone ui-tooltip" title="Call"><i></i></a> </div>
                        <div class="pull-right"> </div>
                    </div>
                </div>
                <div class="block-foot text-right">
                    <?php echo $this->lang->line('overview_lang_save');?>
                     <span class="fa font24 fa-check-square-o"></span></div>
            </div>
            <!-- <h4 class="content-title"><u>
            <?php echo $this->lang->line('overview_lang_recent_activity_title'); ?> 
                  </u></h4>-->
            <div id="feedContent">
            </div>
            <br class="visible-xs">
            <br class="visible-xs">
        </div>
        <aside class="col-md-3 col-sm-12 sidebar sidebar1">


            <div class="block block-btns"> 
                <div class="mybtns-head">
                    <div class="row">  
                        <div class="col-md-6 paddhead">
                            <a class="ajax-video-link" href="<?php echo site_url('video/service_call'); ?>">
                                <button class="btn btn-primary" > 
                                    <span class="myhead-img">
                                        <img src="<?php echo base_url('assets/img/icon/video-chat-icon.png');?>" alt="">
                                    </span>
                                    <span class="myhead-tital"><?php echo $this->lang->line('overview_lang_chat_title'); ?></span>
                                </button>
                            </a>
                        </div>
                        <div class="col-md-6 paddhead1">
                            <a class="ajax-econsult-link" data-dismiss="modal" href="<?php echo site_url('akte/econsult'); ?>" > 
                                <button class="btn btn-primary" > 
                                    <span class="myhead-img">
                                        <img src="<?php echo base_url('assets/img/icon/eConsultant.png');?>" alt="">
                                    </span>
                                    <span class="myhead-tital"><?php echo $this->lang->line('overview_lang_blood_econsult_title'); ?></span>
                                </button>
                            </a>
                        </div>
                    </div> 
                    <div class="row">     
                        <div class="col-md-6 paddhead"> 
                            <a class="termin-load-link" href="<?php echo site_url('termin/patient_termin'); ?>"> 
                                <button  class="btn btn-primary" >
                                    <span class="myhead-img">
                                        <img src="<?php echo base_url('assets/img/icon/cal-icon.png');?>" alt="">
                                    </span>
                                    <span class="myhead-tital"><?php echo $this->lang->line('overview_lang_termine_title');?></span>
                                </button>
                            </a>
                        </div>
                        <div class="col-md-6 paddhead1">
                            <a  href="<?php echo site_url('rezept'); ?>">
                                <button  class="btn btn-primary" >
                                    <span class="myhead-img">
                                        <img src="<?php echo base_url('assets/img/icon/epre.png');?>" alt="">
                                    </span>
                                <span class="myhead-tital"><?php echo $this->lang->line('overview_lang_rezeptonline_title');?></span>
                                </button>
                            </a>
                        </div>
<!--                        <div class="col-md-6 paddhead1">
                            <a href=""> 
                                <button class="btn btn-primary" >
                                    <span class="myhead-img">
                                        <img src="<?php echo base_url('assets/img/icon/videoapp.png');?>" alt="">
                                    </span>
                                    <span class="myhead-tital"><?php echo $this->lang->line('overview_lang_get_video');?></span>
                                </button>
                            </a>
                        </div>-->
                    </div>
                    <div class="row"> 
                        
<!--                        <div class="col-md-6 paddhead1">
                            <a href="<?php echo site_url('akte/document'); ?>">
                                <button class="btn btn-primary" >
                                    <span class="myhead-img">
                                        <img src="<?php echo base_url('assets/img/icon/esicknes.png');?>" alt="">
                                    </span>
                                    <span class="myhead-tital"><?php echo $this->lang->line('overview_lang_e_sick_cert');?></span>
                                </button>
                            </a>
                        </div>-->
                    </div>
                </div>

            </div>
                        <?php if ($this->m->us_id()) : ?>
                <div class="block block-aktuell">
                  <div class="block-foot">
                    <?php echo $this->lang->line('overview_doctor_selected_pat');?>
                </div>
                    <div class="list-group"> <a href="javascript:;" class="list-group-item">
                            <h3 class="pull-right"><img class="img-responsive" src="<?php $this->load->model('document/mdoc');
        echo ($img_path = $this->mdoc->get_profile_image_path($this->m->us())) ? base_url($img_path) : '//placehold.it/25x25'; ?>" style="width:25px;" width="25" /></h3>
                            <h4 class="list-group-item-heading"><?php echo $this->m->us_value('regid'); ?></h4>
                            <p class="list-group-item-text"><?php echo $this->m->us_value('academic_grade'); ?> <?php echo $this->m->us_value('name'); ?> <?php echo $this->m->us_value('surname'); ?></p>
                        </a> </div>
                </div>
    <?php endif; ?>
            <div class="block block-aktuell">
                <h2 class="head font-bold">
                    <?php echo $this->lang->line('overview_lang_current_title');?>
                </h2>
                <div class="well" style=" padding:0">
                <div class="head1">
                    <div class="pull-right"><span class="btn fa fa-calendar-o gray"></span></div>
<!--                    <div class="pull-left font-bold gray">
                    <?php // echo $this->lang->line('overview_lang_calendar_title');?>
                    </div>-->
                    <div class="sidebar-calendar-block sidebar-calendar1">
                        <div id="sidebar-calendar"></div>
                    </div>
                    <div class="clr"></div>
                </div>
                <ul class="aktuell-list font12" id="reservation">
                 <?php
                 	foreach($latest_reservation as $l_reservation){
                 ?>   
                    <li>
                        <div class="aktuell-icon"><span></span></div>
                        <p class="font-bold">
                        	<?php 
                        		echo date("d.F Y, h:i",strtotime($l_reservation->start)); 
                        		if($l_reservation->accept==0)
                        			echo " (Pending)";
                        		elseif($l_reservation->accept==1)
                        			echo " (Confirmed)";
                        		elseif($l_reservation->accept==0)
                        			echo " (Cancelled)";
                        		else 
                        			echo "";
                        	 ?>
                        </p>
                        <div><a href=""accesskey="" class="font-bold"></a></div>
                        <div>Dr. <?php echo $l_reservation->doctor->name.' '.$l_reservation->doctor->surname; ?> </div>
                        <div><?php echo $l_reservation->doctor->city.", ".$l_reservation->doctor->region; ?></div>
                    </li>
                 <?php }?>    
                </ul>
                </div>
            
            </div>
            <div class="block block-aktuell">
            <div class="block  ">
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
            </div>
        </aside>
    </div>
<?php
}
else {
    /* Doctor Dash Board */
    $this->load->model('document/mdoc');
    $img_path = $this->mdoc->get_profile_image_path();
    ?>
     <div class="main_container">
    	<div class="container">
            
            
    <div class="row" id="<?php echo $scope_id = 'scope_' . random_string('alnum', 32); ?>">
        <section class="col-md-9 col-sm-12 content-area">
            <div class="row row1">
                <div class="col-md-6">
                     <div class="block block-theme1 block-blue-table">
                        <h2 class="title">
                               <?php echo $this->lang->line('overview_lang_eprescription');?> 
                        </h2>
                        <div class="table-responsive" style="height:194px;">
                            <table class="table table-condensed" id="id-tbl" >
                                <thead>
                                    <tr>
                                        <th width="30%">
                                           <?php echo $this->lang->line('overview_doctor_prof_patient');?>
                                             <b class="caret"></b></th>
                                        <th width="25%" nowrap>
                                           <?php echo $this->lang->line('overview_rezept_medicine');?>
                                             <b class="caret"></b></th>
                                        <th width="30%" nowrap>
                                           <?php echo $this->lang->line('overview_rezept_tradename');?>
                                             <b class="caret"></b></th>
                                        <th width="15%">
                                           <?php echo $this->lang->line('overview_rezept_status');?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
	                                <?php 
	                                foreach($rezeptdata as $key=>$value)
	                                {
	                                    if($value->status == 0)
	                                    {
	                                        $status='OPEN';
	                                    }
	                                    else
	                                    {
	                                      $status='DONE';  
	                                    }
	                                ?>
	                                    <tr>
                                                <td width="25%" title="<?php echo $value->patient_id; ?>"><?php echo substr($value->patient_id, 0,20); ?></td>
	                                        <td width="25%" title="<?php echo $value->drug; ?>"><?php echo substr($value->drug,0,12); ?></td>
	                                        <td width="25%" title="<?php echo $value->Handelsname; ?>"><?php echo substr($value->Handelsname,0,15);?></td>
	                                        <td width="25%" title="<?php echo $status; ?>"><?php echo $status;?></td>
	                                    </tr>
	                                    
	                               <?php
	                               	}
	                               ?>
                               </tbody>
                            </table>
                        </div>
                        <div class="foot"><a href="<?php echo site_url('rezept'); ?>">
                            <?php echo $this->lang->line('overview_lang_see_all');?>
                             <span class="fa fa-angle-right pull-right"></span></a></div>
                    </div>
                     <div class="block block-theme1 block-cyan-chart">
                            	<h2 class="title">
                                   <?php echo "Neueste Termine";?>
                                </h2>
                         <div class="chart-block" id="doc_reservation">
                            <table class="table table-hover" id="id-tbl" >
                                <thead>
                                    <tr> 
                                        <th width="25%">
                                           <?php echo $this->lang->line('patients_home_date');?>
                                             <b class="caret"></b></th>
                                        <th width="25%" nowrap>
                                           <?php echo $this->lang->line('patients_home_entry_time');?>
                                             <b class="caret"></b></th>
                                        <th width="25%" nowrap>
                                           <?php echo $this->lang->line('overview_doctor_prof_patient');?>
                                             <b class="caret"></b></th>
                                        <th width="25%" nowrap>
                                           <?php echo "Action";?>
                                             <b class="caret"></b></th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
		                                foreach($latest_doc_reservation as $l_doc_reservation) {
		                            ?>
		                                    <tr>
		                                        <td width="25%"><?php echo date("d-m-Y",strtotime($l_doc_reservation->start)); ?></td>
		                                        <td width="25%"><?php echo date("h:i",strtotime($l_doc_reservation->start)); ?></td>
		                                        <td width="25%"><?php echo $l_doc_reservation->first_name.' '.$l_doc_reservation->last_name;?></td>
		                                        <td width="25%">
		                                            <input type="hidden" name="reserv_id" id="reserv_id" value="<?php echo $l_doc_reservation->id;?>" />
		                                            <button class="btn btn-success" id="accept_reservation_button" onclick="acceptResv('<?php echo $l_doc_reservation->id;?>');" ia-action="reservation-action" data-action="accept"><span class="icomoon i-checkmark-circle-2"></span></button>
		                                            <div style="float:right;padding-top:10px;width:32px;" id="loading_<?php echo $l_doc_reservation->id;?>"></div>
		                                        </td>
		                                    </tr>
		                                    
		                            <?php
		                               }
		                            ?>
                               </tbody>
                            </table>
                         </div>
                                <div class="foot"><a href="<?php echo site_url('termin/doctor/termin'); ?>">
                                    <?php echo $this->lang->line('overview_lang_details');?>
                                     <span class="fa fa-angle-right pull-right"></span></a></div>
                     </div>
                </div>
                    <div class="col-md-6">
                    <div class="block block-theme1 block-purple-table">
                        <h2 class="title">
                            <?php echo $this->lang->line('cyomed_patient_recent');?>
                        </h2>
                        <div class="table-responsive" style="height:194px;">
                            <table class="table table-hover" id="id-tb1">
                                <thead>
                                    <tr>
                                        <th width="40%">
                                           <?php echo $this->lang->line('overview_doctor_prof_patient');?>
                                            <b class="caret"></b></th>
                                        <th width="35%">
                                           <?php echo $this->lang->line('overview_doctor_prof_doctor');?>
                                            <b class="caret"></b></th>
                                        <th width="25%">
                                           <?php echo $this->lang->line('overview_doctor_prof_visit_date');?>
                                             <b class="caret"></b></th>
                                    </tr>
                                </thead>
                                <tbody>
                               		<?php
	                                     foreach($profilevisit as $key=>$value) { 
	                                        ?>
	
	                                    <tr href="<?php echo site_url('akte/myprofile');?>" hrefhome="<?php echo base_url('akte/overview/timeline'); ?>" regid="<?php echo $value->regid; ?>" class="ajax-patient-links">
                                                <td width="40%" title="<?php echo ucwords($value->name.' '.$value->surname); ?>"><?php echo substr(ucwords($value->name.' '.$value->surname),0,25); ?></td>
                                                <td width="35%" title="<?php echo ucwords($value->doctor_name.' '.$value->doctor_surname); ?>"><?php echo substr(ucwords($value->doctor_name.' '.$value->doctor_surname),0,18); ?></td>
                                                <td width="25%" title="<?php echo date('d.m.Y',strtotime($value->visit_date));?>"><?php echo date('d.m.Y',strtotime($value->visit_date));?></td>
	                                    </tr>
	                                    <?php 
	                                    }
	                               ?>
                                  </tbody>
                            </table>
                        </div>
                        <div class="foot">&nbsp;</div>
                    </div>
                         <div class="block block-theme1 block-blue-poll">
                            	<h2 class="title">
                            <?php echo $this->lang->line('overview_lang_profile_completeness');?>
                                </h2>
                                <div class="poll-block">
                                    <!--<img src="<?php echo base_url('assets/img/portal/poll.png'); ?>" alt="">-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="chart-head">
                                                <?php echo $this->lang->line('overview_lang_profile_complete_text');?>
                                            </div>
                                            <div id="progressbar"></div>                                               
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top:12px;">
                                        <div class="col-md-8" style="margin-bottom:51px;">
                                            <br /><br />
                                            zu <span class="blue font24" id="profileprogress">30%</span> vollstading
                                        </div>
                                        <div class="col-md-4">
                                         <?php
                                         $img_path = $this->mdoc->get_profile_image_path();
                                        
                                         ?>
                                          <img style="background:#bababa; border-radius:100%; min-height: 80px; min-width: 60px;" src="<?php echo ($img_path) ? base_url($img_path) : base_url()."assets/img/portal/default-user.png"; ?>"/> 
                                        </div>
                                    </div>
                                </div>
                                <div class="foot"><a href="<?php echo site_url('akte/profile');?>" class="load_profile">
                                    <?php echo $this->lang->line('overview_lang_profile_complete_now');?>
                                     <span class="fa fa-angle-right pull-right"></span></a></div>
                         </div>
                    </div>
                </div>
            
                 <div class="row row1">
                    	<div class="col-md-12">
                             <div class="block block-theme1 block-cyan-chart">
                            	<h2 class="title">ALLE TERMINE
                                    <a href="<?php echo site_url('/termin/doctor/plugin'); ?>" class="ajax-plugin-link"><span class="fa fa-link pull-right"></span></a> <span></span>
                                    <a href="<?php echo site_url('/termin/doctor/settings'); ?>" class="ajax-calendar-link"><span class="fa fa-cog pull-right"></span></a><span></span>
                                    <a href="<?php echo site_url('/termin/doctor/termin'); ?>" class="ajax-termin-link"><span class="fa fa-envelope pull-right"></span></a> <span></span>
                                </h2>
                                <div class="cal-block">
                                	<div id="termin" class="row">
                                        <div class="col-md-4"><div id='calendar1'></div></div>
                                        <div class="col-md-8"><div id='calendar2'></div></div>
                                    </div>
                                </div>

                                <div class="foot"><a href="<?php echo site_url('/termin/doctor/calendar'); ?>" class="ajax-calendar-link<?php echo $entry->id; ?>"><?php echo $this->lang->line('overview_lang_details');?><span class="fa fa-angle-right pull-right"></span></a></div>
                                
                            </div>
                        </div>
                 </div>
        </section>
        <aside class="col-md-3 col-sm-12 sidebar sidebar1">
          
            <div class="block block-btns">
             
             <div class="mybtns-head">
          <div class="row">  <div class="col-md-6 paddhead"><a href="<?php echo site_url('akte/chat'); ?>" target="_blank" ><button class="btn btn-primary" >
             <span class="myhead-img"><img src="<?php echo base_url('assets/img/icon/video-chat-icon.png');?>" alt=""></span>
             <span class="myhead-tital"><?php echo $this->lang->line('overview_lang_chat_title');?></span></button></a></div>
             <div class="col-md-6 paddhead1"><a class="ajax-econsult-link" data-dismiss="modal" href="<?php echo site_url('akte/alleconsult'); ?>" > <button class="btn btn-primary" > <span class="myhead-img">
             <img src="<?php echo base_url('assets/img/icon/eConsultant.png');?>" alt="">
             </span><span class="myhead-tital"><?php echo $this->lang->line('overview_lang_blood_econsult_title'); ?></span></button></a></div>
          </div> 
          <div class="row"> 
             <div class="col-md-6 paddhead"> <a class="ajax-calender-link" href="<?php echo site_url('termin/doctor/calendar'); ?>"> <button  class="btn btn-primary" >
             <span class="myhead-img">
              <img src="<?php echo base_url('assets/img/icon/cal-icon.png');?>" alt="">
           </span>
             <span class="myhead-tital"><?php echo $this->lang->line('overview_lang_termine_title');?></span></button></a></div>
             <div class="col-md-6 paddhead1"> <a  href="<?php echo site_url('rezept'); ?>"> <button  class="btn btn-primary" >
             <span class="myhead-img">
              <img src="<?php echo base_url('assets/img/icon/epre.png');?>" alt="">
           </span>
             <span class="myhead-tital">
               <?php echo $this->lang->line('overview_lang_rezeptonline_title');?>
            </span></button></a></div>
<!--             <div class="col-md-6 paddhead1"><a href=""> <button class="btn btn-primary" > <span class="myhead-img">
             <img src="<?php // echo base_url('assets/img/icon/videoapp.png');?>" alt="">
            </span><span class="myhead-tital">
               <?php // echo $this->lang->line('overview_lang_get_video');?>
            </span></button></a></div>-->
             </div>
             </div>
             <div class="row"> 
             
<!--             <div class="col-md-6 paddhead1"><a href=""> <button class="btn btn-primary" > <span class="myhead-img">
             <img src="<?php // echo base_url('assets/img/icon/esicknes.png');?>" alt="">
            </span><span class="myhead-tital">
               <?php // echo $this->lang->line('overview_lang_e_sick_cert');?>
        </span></button></a></div>-->
             </div>
             </div>
            
             
            <div class="row">
                 <div class="col-md-12 col-sm-12">
               <div class="block block-aktuell block-news">
                <h2 class="head font-bold">
                  <?php echo $this->lang->line('overview_patient_today');?>
                </h2>
                <ul class="aktuell-list font12" style="height: 201px;overflow: auto;">
                 <?php
                  $this->load->Model('Speciality');
                  
                 foreach($accepted_doc_reservation as $a_doc_reservation){ ?>   
                    <li>
                        <div class="font16 font-bold"><?php echo date("h:i",strtotime($a_doc_reservation->start)); ?> UHR</div>
                        <p class="font12"><span class="font-bold">PATIENT</span>: <?php echo $a_doc_reservation->patient->name.' '.$a_doc_reservation->patient->surname; ?></p>
                        <div>
                           <?php 
                           if($a_doc_reservation->treatment!=0){
                            echo $this->Speciality->getByCode($a_doc_reservation->treatment); 
                           }
                           ?>
                        </div>
                        
                    </li>
                 <?php }?>  
                </ul>
                <div class="block-foot"> <a  class="block-foot ajax-calender-link "  style="padding:0" href="<?php echo site_url('termin/doctor/termin'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false"><span class="fa fa-plus"></span> TERMIN EINTRAGEN</a></div>
            </div>
          
<!--                <div class="block block-aktuell">
                	<h2 class="head font-bold">
                		<strong>
	                		<?php // echo $this->lang->line('overview_lang_news');?>
	                	</strong>
	                </h2>
	                <div class="well">
		                <div class="fb-page" data-href="https://www.facebook.com/pages/Dreamsoft4U/745515242261430" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false" data-show-posts="true" data-height="280">
                                    <div class="fb-xfbml-parse-ignore">
                                        <blockquote cite="https://www.facebook.com/pages/Dreamsoft4U/745515242261430">
                                            <a href="https://www.facebook.com/pages/Dreamsoft4U/745515242261430">Dreamsoft4U</a></blockquote>
                                    </div></div>
	                </div>
	                 /.well 
            	</div>-->
           <?php if ($this->m->us_id()) : ?>
                <div class="block block-aktuell">
                    <div class="head font-bold">
                    <?php echo $this->lang->line('overview_doctor_selected_pat');?>
                    </div>
                    <div class="list-group"> <a href="<?php echo site_url('akte/myprofile');?>" hrefhome="<?php echo base_url('akte/overview/timeline'); ?>" regid="<?php echo $this->m->us_value('regid'); ?>" class="ajax-patient-links list-group-item">
                            <h3 class="pull-right"><img class="img-responsive" src="<?php $this->load->model('document/mdoc');
                            echo ($img_path = $this->mdoc->get_profile_image_path($this->m->us())) ? base_url($img_path) : '//placehold.it/25x25'; ?>" style="width:25px;" width="25" /></h3>
                            <h4 class="list-group-item-heading"><?php echo $this->m->us_value('regid'); ?></h4>
                            <p class="list-group-item-text"><?php echo $this->m->us_value('academic_grade'); ?> <?php echo $this->m->us_value('name'); ?> <?php echo $this->m->us_value('surname'); ?></p>
                        </a> </div>
                    <!-- /.list-group -->
                </div>
           
    <?php endif; ?>          
           <?php  if ($this->m->user_role() != M::ROLE_DOCTOR) { ?>         
            <div class="block block-aktuell">
                <div class="block-foot"> 
                <?php echo $this->lang->line('overview_lang_health_score');?> 
                </div>
                <div class="text-center well">
                    <?php
                    $this->load->view('graph/pie_chart_view', array(
                        'pie_charts' => array(
                            (object) array('value' => $this->mopat->health_score(),'range' => 1100, 'title' => 'Health-Score', 'no_percent' => TRUE,),
                        ),
                    ));
                    ?>
                </div>
            </div>
           <?php }?>       
                 </div>
            </div>
        </aside>
    </div>
  </div>
</div>
    <?php
}
?>
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

<?php
    $appointment_array =array();
    foreach($all_reservation as $all){
        $appointment_array[] = date('Y-m-d',strtotime($all->start));
    } 
   
?>
<script type="text/javascript">
    $(document).ready(function() 
    {
     $("#progressbar").progressbar({
      value: <?php echo $profilestatus;?>
     });
     $("#profileprogress").html('<?php echo $profilestatus;?>%');
       $('.sidebar0 .block .head').on('click', function (){
            $('.sidebar0 .block').removeClass('active');
            $(this).parent().toggleClass('active');			
        });
    });
</script>
<script type="text/javascript">
    $.pageSetup($('#<?php echo $scope_id; ?>'));
    $(document).ready(function() {
        
        $(document).on('click', '.dropdown-menu', function (e) {
            $(this).parent().hasClass('open') && e.stopPropagation(); // This replace if conditional.
        }); 
    });
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
		            $('<div />').addClass('col-md-offset-3 col-md-9').append()
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
                if($('#disease_name0').val()=="")
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie eine gÃltige Diagnose Detail ..!');
                    $('#myModal').modal({});
                    return false;
                }
                if($('#icd_code0').val()=="")
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie eine gÃltige Diagnose Detail ..!');
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
                    $('.modal-body').html('Bitte geben Sie eine gÃltige Medikamente Detail ..!');
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
                    $('.modal-body').html('Bitte geben Sie eine gÃltige Impfung Detail ..!');
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
                    $('.modal-body').html('Bitte geben Sie eine gÃltige Blutdruck Detail ..!');
                    $('#myModal').modal({});
                    return false;
                }
                
                if(isNaN(parseFloat($('#rr_sys0').val())))
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie eine gÃltige RR systolisch Wert ..!');
                    $('#myModal').modal({});
                    $('#rr_sys0').focus();
                    return false;
                }
                if(isNaN(parseFloat($('#rr_dia0').val())))
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie eine gÃltige RR diastolisch Wert ..!');
                    $('#myModal').modal({});
                    $('#rr_dia0').focus();
                    return false;
                }
                if(isNaN(parseFloat($('#puls0').val())))
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie eine gÃltige puls Wert ..!');
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
                    $('.modal-body').html('Bitte geben Sie eine gÃltige Blutzucker Detail ..!');
                    $('#myModal').modal({});
                    return false;
                }
                if(isNaN(parseFloat($('#bloodsugar0').val())))
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie eine gÃltige Blutzuckerwert Wert ..!');
                    $('#myModal').modal({});
                 
                    return false;
                }
                if(isNaN(parseFloat($('#HbA1C0').val())))
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie eine gÃltige HbA1C Wert ..!');
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
            $target.find('.panel-body .weight_bmi-submit').click(function(e) 
            {
                if($('#size').val()==0)
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie eine gÃltige Gewicht und bmi Detail ..!');
                    $('#myModal').modal({});
                    return false;
                }
                if(isNaN(parseFloat($('#size').val())))
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie eine gÃltige HÃƒÆ’Ã‚Â¶he Wert ..!');
                    $('#myModal').modal({});
                    return false;
                }
                if(isNaN(parseFloat($('#weight').val())))
                {
                    $('.modal-title').html('Alert');
                    $('.modal-body').html('Bitte geben Sie eine gÃltige Gewicht Wert ..!');
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
                    $('.modal-body').html('Bitte geben Sie eine gÃltige marcumer Detail .. !');
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
//            
//  			/***use for body map entry validation***/
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
//  			/***use for econsult entry validation***/
            $target.find('.panel-body .econsult-submit').click(function(e){

                var $forms = $('.panel-body').find('.tab-pane.active form');
                $forms.length ? $($forms[0]).ajaxSubmit({
                    beforeSubmit:function(){
                         var image_path = $.baseUrl+'assets/img/loading.png';
                        $("body").append('<div id="loadingDiv"><img class="star" src="'+image_path+'" /></div>');
                    },
                    success: function() {
                        $("#loadingDiv").remove();
	                    $(".block-links").removeClass('active');
                            $(".econsult-feed").closest(".block-links").addClass('active')
	                    $(".econsult-feed").click();
                       	$("form")[8].reset();
                    }
                }) : '';
            });

//            
//            /***end here***/
            
//            $target.find('.panel-heading .btn-submit').click(function(e) {
//              
//                var $forms = $(this).parent().parent().siblings('.panel-body').find('.tab-pane.active form');
//                $forms.length ? $($forms[0]).ajaxSubmit({
//                    success: function() {
//                        $('.ajax-feed-link.active').click();
//                    }
//                }) : '';
//            });
//            
//            $target.find('.panel-footer .btn-submit').click(function(e) {
//                var $forms = $(this).parent().parent().siblings('.panel-body').find('.tab-pane.active form');
//                $forms.length ? $($forms[0]).ajaxSubmit({
//                    success: function() {
//                        $('.ajax-feed-link.active').click();
//                    }
//                }) : '';
//            });
        }
    });

      /*--------------------------------------------------------
        Ajax feed link
        -----------------------------------------------------------*/
       var scroll=0;
       $('.ajax-feed-link1').click(function(e) 
       {
           if ($('#entry_view').hasClass('termin-load')) {
               $('#entry_view').removeClass("termin-load");
            }
         e.preventDefault();
         <?php if(!empty($active_url))
         {
         ?>
         $(this).closest("aside.sidebar0").find(".ajax-feed-link1.active").toggleClass('active',  false);
         $(this).toggleClass('active',true);
//         $(this).toggleClass('active',true).parent().siblings().children('.active').toggleClass('active',  false);
         $.loadUrl($('#feedList1 .dropdown .active').attr('href')+'?id=purple', $('#feedContent'));
         <?php 
         } else
         { 
         ?>
         $(this).closest("aside.sidebar0").find(".ajax-feed-link1.active").toggleClass('active',  false);
         $(this).toggleClass('active',true);
//            $(this).toggleClass('active',true).parent().siblings().children('.active').toggleClass('active',  false);
            $.loadUrl($(this).attr('href')+'?id=purple', $('#feedContent')); 
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
        });
        
        
        
    $('.ajax-feed-link').off('click', '**').click(function(e) 
    {   
        
            if ($('#entry_view').hasClass('termin-load')) {
                
               $('#entry_view').removeClass("termin-load");
            }
        e.preventDefault();
        <?php if(!empty($active_url))
         {
        ?>
         $(this).closest("aside.sidebar0").find(".ajax-feed-link.active").toggleClass('active',  false);
         $(this).toggleClass('active',true);
         
//         $(this).toggleClass('active',true).parent().siblings().children('.active').toggleClass('active',  false);
         $.loadUrl($('#feedList .dropdown .active').attr('href'), $('#feedContent'));
        <?php 
           
         } else
         { 
        ?>

            $(this).closest("aside.sidebar0").find(".ajax-feed-link.active").toggleClass('active',  false);
            $(this).toggleClass('active',true);
            
//             $(this).toggleClass('active',true).parent().siblings().children('.active').toggleClass('active',  false);
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

    $('.ajax-video-link').click(function(e){
        e.preventDefault();
        if($('#videoContent').text()===''){
          $.ajax({
                url: $(this).attr('href')
            })
            .done(function(html){
                $('#videoContent').hide();
                $('#videoContent').append(html);
                $('#videoContent').slideDown('slow');
            })
        }
        else{
            $('#videoContent').slideUp();
            $('#videoContent').text('');
        }
        
        //$.loadUrl($(this).attr('href'),$('#videoContent'));
    });
</script>
<script type="text/javascript">
    $(function(){
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
        //Styling for the autocomplete widgets with maximum height and scrollbar
        $(".ui-autocomplete").css({"color":"white","max-Height":"250px","overflow-y":"auto","overflow-x":"hidden"});
});
</script>
<script type="text/javascript">
    $('.ajax-load-link').click(function(e) 
    {
        e.preventDefault();
        if ($(this).attr('href').indexOf('javascript:') < 0)
            $.loadUrl($(this).attr('href'), $('#content'));
    });
     $('.ajax-profiles-link').click(function(e) 
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
            $('#videoContent').css("display","none");
            $.loadUrl($(this).attr('href'), $('#feedContent'));
           $("#videoContent").text(''); 
        }
         $('html, body').animate({
                    scrollTop: $("#content").offset().top
                },1000);
    });
    
    $('.load_profile').click(function(e) 
    {
        e.preventDefault();
        if ($(this).attr('href').indexOf('javascript:') < 0)
            $.loadUrl($(this).attr('href'), $('#content'));
    });
    $('.ajax-doctortermin-link').click(function(e) 
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
    $('.ajax-document-link').click(function(e) 
    {
        e.preventDefault();
        if ($(this).attr('href').indexOf('javascript:') < 0)
            $.loadUrl($(this).attr('href'), $('#content'));
    });
    $('.ajax-econsult-link').click(function(e) 
    {
        e.preventDefault();
        $('.modal-backdrop').remove();
        $('#VideoChatModal').modal('hide');
        if ($(this).attr('href').indexOf('javascript:') < 0)
            $.loadUrl($(this).attr('href'), $('#content'));
        
    });
    $('.ajax-eprescription-link').click(function(e) 
    {
        e.preventDefault();
        if ($(this).attr('href').indexOf('javascript:') < 0)
            $.loadUrl($(this).attr('href'), $('#content'));
    });
    $('.fa-calendar-o').on('click', function()
    {
        $(".sidebar-calendar-block").toggleClass('sidebar-calendar1');
    });
    $(function()
    {
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
        // $(".ui-autocomplete").addClass("select");
    });
           
    $('.panal-widget').click(function(e) {
        $('.panal-widget').removeClass('active');
        var $this = $(this);
        if (!$this.hasClass('active')) {
            $this.addClass('active');
        }
        e.preventDefault();
    });      

  
    

 
        
</script>
<!-- script for termine calender -->
<script src="<?php echo base_url('assets/vendor/fullcalendar-2.3.1/fullcalendar.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/timelinetermin.js'); ?>"></script>
<!--end here --->
<style>
    .entrydrop a .fa-plus{ padding-top: 8px;padding-right: 25px;}
    .entrydrop .tooltip{ margin-top:-20px!important; top:20px!important; position: absolute!important}
    .entrydrop .dropdiv{ padding:0 4px 0 10px;}
     .entrydrop .dropdown-menu{min-width:35px; background: #CBE3E4 }
    .entrydrop .dropdiv a{ display: block;
    color: #aaa;
    padding: 6px 0;
    text-align: center;
    font-size: 17px;
    margin-left: 0px;}
  .scrollit-my1 tr{cursor:pointer;}
  .termin-load{display:none;}
  .page-title{display:none;}
  #sidebar-calendar .fc-content-skeleton .fc-past.fc-day-number{
        opacity: .3;
    }
</style>
<script type="text/javascript">
  $(function() {
	$('.VideoAppointment').hover(function() {
        $(this).find(".myhead-tital").text("Available Soon");
	}, function() {
		$(this).find(".myhead-tital").text("<?php echo $this->lang->line('overview_lang_get_video');?>");
    });

	$("input[name='befindlichkeit']").each(function(){
         $(this).on('slide',function(slideStop){
            $(this).closest(".form-group").find("img").each(function(){
            $(this).hide();
            if($(this).attr('emotion')==slideStop.value)
              $(this).show();
            
          });
        });
    });
      

      var appointment_array =  [<?php echo '"'.implode('","', $appointment_array).'"' ?>];
      var date = new Date();
      var d = date.getDate();
      var m = date.getMonth();
      var y = date.getFullYear();
    $('#sidebar-calendar').fullCalendar({
        editable: false,
        events: [],
        header: {
          left: 'title'
        },
        viewDisplay   : function(view) {
        var now = new Date(); 
        var end = new Date();
        end.setMonth(now.getMonth() + 11); //Adjust as needed

        var cal_date_string = view.start.getMonth()+'/'+view.start.getFullYear();
        var cur_date_string = now.getMonth()+'/'+now.getFullYear();
        var end_date_string = end.getMonth()+'/'+end.getFullYear();

        if(cal_date_string == cur_date_string) { jQuery('.fc-button-prev').addClass("fc-state-disabled"); }
        else { jQuery('.fc-button-prev').removeClass("fc-state-disabled"); }

        if(end_date_string == cal_date_string) { jQuery('.fc-button-next').addClass("fc-state-disabled"); }
        else { jQuery('.fc-button-next').removeClass("fc-state-disabled"); }
      },
        dayClick: function(date, jsEvent, view) {
            var myDate = new Date();
            var renderDate=new Date(date);
            var myDate = new Date(myDate.toDateString());
            var renderDate=new Date(renderDate.toDateString());  
            
           if (renderDate.valueOf()>=myDate.valueOf()  && !($(this).hasClass("fc-other-month"))) {
                date = date.format();
                $.ajax({
                  url:$.siteUrl+'/akte/overview/getPatientReservation',
                  data:{'date':date},
                  type:'POST',
                  beforeSend:function(html){
                      var image_path = "<?php echo base_url('assets/img/process.gif')?>";
                      $("#reservation").html("<center><img src='"+image_path+"' /></center>");
                  },
                  success:function(html){
                     $("#reservation").html(html);
                  }
                });
            
            
             // change the day's background color just for fun
            $("#sidebar-calendar").find(".fc-today").removeClass("fc-today");
            //$(this).addClass('fc-today');
            $(jsEvent.target).addClass("fc-state-highlight");
            //$(jsEvent.target).addClass("fc-today"); 
        } else{
            return false;
         }    
            
    },
    dayRender: function(date, cell)
        {
            var cdate = new Date(date);
            var c_date = cdate.getDate();
            if(c_date < 10){
               var c_date = '0'+c_date;
            }
            var c_month = cdate.getMonth()+1;
            if(c_month < 10){
               var c_month = '0'+c_month;
            }
            var c_year = cdate.getFullYear();
            var full_date = c_year+'-'+c_month+'-'+c_date;
            
            if((jQuery.inArray(full_date, appointment_array) != -1) && c_month){ 
               $('#sidebar-calendar .fc-day-number[data-date="' + full_date + '"]').css('color', "#fff !important");
               cell.css("background-color", "#093A80");  
            }

        }
      });
    
  });            
  
  
  $('.ajax-patient-links').click(function(e) {
         
        if($(this).attr('regid'))
         {
           e.preventDefault();
           var URL=$(this).attr('href')+'/view/'+$(this).attr('regid');
           if ($(this).attr('href').indexOf('javascript:') < 0)
           $.loadUrl(URL, $('#content'));
           }
           else
           {
           alert("Please Enter Patient Id");
           e.preventDefault();
           var URL=$(this).attr('hrefhome');
           if ($(this).attr('hrefhome').indexOf('javascript:') < 0)
           $.loadUrl(URL, $('#content'));   
           }
  });
  	$(document).ready(function(){
		$("#label_befindlichkeit").click();
	});
 </script>

