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
      <div class="profile-avatar text-center">
      <img src="<?php $this->load->model('document/mdoc');
                              echo ($img_path = $this->mdoc->get_profile_img_path($row->regid)) ? base_url($img_path) : '//placehold.it/120x120'; ?>"/></div>
                               
                <h2><?php echo strtoupper($row->name); ?> <?php echo strtoupper($row->surname);?></h2>                
            </div>
       
</div>
           <div class="block block-link"><a class="btn btn-info" href="">GESUNDHEIT</a></div>
           
<!--<ul class="icons-list">
            <li><i class="icon-li fa fa-envelope"></i> <?php echo $this->m->user_value('email'); ?></li>
            <li><i class="icon-li fa fa-globe"></i> <?php echo $this->m->user_value('website'); ?></li>
            <li><i class="icon-li fa fa-map-marker"></i> <?php echo $this->m->user_value('zip'); ?> <?php echo $this->m->user_value('city'); ?><?php echo in_array($k = $this->m->user_value('country'), array_keys($c = $this->country->get_assoc('id'))) ? (', '.$c[$k]->country_name) : ''; ?></li>
          </ul>-->
 <div class="list-group" id="feedList">
           <div class="dropdown open" >
                    <a style="background: #093a80;color: #FFF;" style="border:0px;"data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false" class="list-group-item">
                    
                    MEDIZIN
                    
                    </a> 
                   
            </div>

            <div class="dropdown">
                    <a data-target="#" href="<?php echo site_url('akte/feed/general'); ?>" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false" class="list-group-item ajax-feed-link">
                    <i class="fa fa-asterisk text-primary"></i> 
                    <?php echo $this->lang->line('overview_lang_recent_activity_title'); ?> 
                    <i class="fa fa-chevron-right list-group-chevron"></i>
                    </a> 
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li><a href="<?php echo site_url('akte/feed/general'); ?>" class="ajax-feed-link">View</a></li>
                    </ul>
            </div>
     
            <div class="dropdown">
                    <a  class="list-group-item ajax-feed-link" href="<?php echo site_url('akte/feed/akte'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false">
                    <i class="fa fa-book text-primary"></i> 
                    <?php echo $this->lang->line('overview_lang_record_title'); ?> 

                    <i class="fa fa-chevron-right list-group-chevron"></i>
                    <!-- <span class="badge">3</span> -->
                    </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li><a href="<?php echo site_url('akte/feed/akte'); ?>" class="ajax-feed-link" >View</a></li>
                    </ul>
            </div>
            

            
          <div class="dropdown">
            <a  class="list-group-item ajax-feed-link" href="<?php echo site_url('akte/vital_values/feed'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false">
              <i class="icomoon i-chart text-primary"></i> 
              <?php echo $this->lang->line('overview_lang_vital_signs_title'); ?> 

              <i class="fa fa-chevron-right list-group-chevron"></i>
            </a> 
               <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li><a href="<?php echo site_url('akte/vital_values/feed'); ?>" class="ajax-feed-link" >View</a></li>
                        <li><a href="<?php echo site_url('akte/vital_values'); ?>" class="ajax-load-link">Edit</a></li>
                    </ul>
          </div>
         <div class="dropdown">
            <a  class="list-group-item ajax-feed-link" href="<?php echo site_url('akte/condition/feed'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false">
              <i class="fa fa-smile-o text-primary"></i>
              <?php echo $this->lang->line('overview_lang_condition_title'); ?> 
              <i class="fa fa-chevron-right list-group-chevron"></i>
            </a> 
              <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li><a href="<?php echo site_url('akte/condition/feed'); ?>" class="ajax-feed-link">View</a></li>
                        <li><a href="<?php echo site_url('akte/condition'); ?>" class="ajax-load-link">Edit</a></li>
                    </ul>
         </div>
       <div class="dropdown">
            <a  class="list-group-item ajax-feed-link" href="<?php echo site_url('akte/diagnosis/feed'); ?>"  data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false">
              <i class="fa fa-stethoscope text-primary"></i> 
              <?php echo $this->lang->line('overview_lang_diagnosis_title'); ?> 

              <i class="fa fa-chevron-right list-group-chevron"></i>
            </a> 
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li><a href="<?php echo site_url('akte/diagnosis/feed'); ?>"  class="ajax-feed-link">View</a></li>
                        <li><a href="<?php echo site_url('akte/diagnosis'); ?>" class="ajax-load-link">Edit</a></li>
                    </ul>
       </div>
       <div class="dropdown">
            <a href="<?php echo site_url('akte/medication/feed'); ?>" class="list-group-item ajax-feed-link" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false">
              <i class="fa fa-table text-primary"></i> 
              <?php echo $this->lang->line('overview_lang_medication_title'); ?> 

              <i class="fa fa-chevron-right list-group-chevron"></i>
            </a> 
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li><a href="<?php echo site_url('akte/medication/feed'); ?>" class="ajax-feed-link" >View</a></li>
                        <li><a href="<?php echo site_url('akte/medication'); ?>" class="ajax-load-link" >Edit</a></li>
                    </ul>
           </div>
           <div class="dropdown">
            <a href="<?php echo site_url('akte/vaccination');?>" class="list-group-item ajax-load-link" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false">
              <i class="fa fa-medkit text-primary"></i> 
              Imfung
              <i class="fa fa-chevron-right list-group-chevron"></i>
            </a> 
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li><a href="<?php echo site_url('akte/vaccination'); ?>" class="ajax-load-link" >View</a></li>
            </ul>
           </div>
            <!-- <a href="javascript:;" class="list-group-item ajax-feed-link">
              <i class="fa fa-medkit text-primary"></i> Impfung

              <i class="fa fa-chevron-right list-group-chevron"></i>
            </a>  -->
         <div class="dropdown">
            <a class="list-group-item ajax-feed-link" href="<?php echo site_url('akte/vital_values/blood_pressure/feed'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false">
              <i class="fa fa-heartbeat text-primary"></i> 
              <?php echo $this->lang->line('overview_lang_blood_pressure_title'); ?> 

              <i class="fa fa-chevron-right list-group-chevron"></i>
            </a> 
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li><a href="<?php echo site_url('akte/vital_values/blood_pressure/feed'); ?>" class="ajax-feed-link" >View</a></li>
                        <li><a href="<?php echo site_url('akte/vital_values/blood_pressure'); ?>" class="ajax-load-link">Edit</a></li>
                    </ul>
 </div>
 <div class="dropdown">
            <a  class="list-group-item ajax-feed-link" href="<?php echo site_url('akte/vital_values/blood_sugar/feed'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false">
              <i class="fa fa-tint text-primary"></i> 
              <?php echo $this->lang->line('overview_lang_blood_sugar_title'); ?> 

              <i class="fa fa-chevron-right list-group-chevron"></i>
            </a> 
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li><a href="<?php echo site_url('akte/vital_values/blood_sugar/feed'); ?>" class="ajax-feed-link" >View</a></li>
                        <li><a href="<?php echo site_url('akte/vital_values/blood_sugar'); ?>" class="ajax-load-link">Edit</a></li>
            </ul>
 </div>
 <div class="dropdown">
            <a  class="list-group-item ajax-feed-link" href="<?php echo site_url('akte/vital_values/weight_bmi/feed'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false">
              <i class="fa fa-street-view text-primary"></i> 
              <?php echo $this->lang->line('overview_lang_blood_bmi_title'); ?> 

              <i class="fa fa-chevron-right list-group-chevron"></i>
            </a> 
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li><a href="<?php echo site_url('akte/vital_values/weight_bmi/feed'); ?>" class="ajax-feed-link">View</a></li>
                        <li><a href="<?php echo site_url('akte/vital_values/weight_bmi'); ?>" class="ajax-load-link">Edit</a></li>
           </ul>
 </div>
 <div class="dropdown">
            <a class="list-group-item ajax-feed-link" href="<?php echo site_url('akte/vital_values/marcumar/feed'); ?>" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false">
              <i class="fa fa-area-chart text-primary"></i> 
              <?php echo $this->lang->line('overview_lang_blood_marcumar_title'); ?> 
              <i class="fa fa-chevron-right list-group-chevron"></i>
            </a> 
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li><a href="<?php echo site_url('akte/vital_values/marcumar/feed'); ?>" class="ajax-feed-link">View</a></li>
                        <li><a href="<?php echo site_url('akte/vital_values/marcumar'); ?>" class="ajax-load-link">Edit</a></li>
                    </ul>
 </div>
   
            <?php if($this->m->user_role() != M::ROLE_DOCTOR){?>
        <div class="dropdown">
             <a  class="list-group-item" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false">
              <i class="fa fa-area-chart text-primary"></i> 
              <?php echo $this->lang->line('overview_lang_family_history_status_title'); ?> 

              <i class="fa fa-chevron-right list-group-chevron"></i>
            </a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li><a href="<?php echo site_url('akte/familyhistory/feed'); ?>" class="ajax-feed-link">View</a></li>
                        <li><a href="<?php echo site_url('akte/familyhistory'); ?>" class="ajax-load-link">Edit</a></li>
            </ul>
        </div>
        <div class="dropdown">
             <a class="list-group-item" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false">
              <i class="fa fa-area-chart text-primary"></i> 
              <?php echo $this->lang->line('overview_lang_smoking_status_title'); ?> 
              <i class="fa fa-chevron-right list-group-chevron"></i>
            </a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li><a href="<?php echo site_url('akte/smokingstatus/feed'); ?>" class="ajax-feed-link" >View</a></li>
                        <li><a href="<?php echo site_url('akte/smokingstatus'); ?>" class="ajax-load-link">Edit</a></li>
            </ul>
        </div>
            <?php }?>
         <div class="dropdown">
             <a href="<?php echo site_url('akte/document'); ?>"  class="list-group-item ajax-load-link" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false">
              <i class="fa fa-area-chart text-primary"></i> 
              Documents
              <i class="fa fa-chevron-right list-group-chevron"></i>
            </a>
            
        </div>
       <div class="dropdown">
             <a href="<?php echo site_url('akte/econsult'); ?>"  class="list-group-item ajax-load-link" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false">
              <i class="fa fa-area-chart text-primary"></i> 
              eConsult
              <i class="fa fa-chevron-right list-group-chevron"></i>
            </a>
            
        </div>
         <div class="dropdown">
            <a class="list-group-item" data-target="#" data-toggle="#" aria-haspopup="true" role="button" aria-expanded="false">
              <i class="fa fa-area-chart text-primary"></i> 
               Eprescription
              <i class="fa fa-chevron-right list-group-chevron"></i>
            </a> 
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li><a href="<?php echo site_url('rezept'); ?>" class="ajax-load-link">Online Rezept</a></li>
                        
                    </ul>
 </div>  

        </div>
           <div class="block block-link"><a class="btn btn-info btn-purple" href="">SOCIAL</a></div>
 </aside>
<div class="col-md-7 col-sm-9 content-area">
    <div class="block block-c1">
      <div class="" style="display:none;">
        <div class="row">
          <div class="col-sm-3 col-md-3"  style="padding-left:0px !important;"><a href="javascript:;" class="btn btn-primary btn-block" data-toggle="status-input" data-status-input-target="#<?php echo $status_input_panel_data_id = 'status_input_panel_data_id'.random_string('alnum', 32); ?>" ><?php echo $this->lang->line('overview_lang_new_entry'); ?></a><br/>
          </div>
          <div class="col-sm-3 col-md-3" style="padding-left:0px !important;"><a href="javascript:;" class="btn btn-secondary btn-block" data-toggle="status-input" data-status-input-target="#<?php echo $status_input_panel_consult_id = 'status_input_panel_consult_id'.random_string('alnum', 32); ?>" ><?php echo $this->lang->line('overview_lang_consultation'); ?></a><br/>
          </div>
          <div class="col-sm-3 col-md-3" style="padding-left:0px !important;"><a href="javascript:;" class="btn btn-tertiary btn-block" data-toggle="status-input" data-status-input-target="#<?php echo $status_input_panel_termin_id = 'status_input_panel_termin_id'.random_string('alnum', 32); ?>" ><?php echo $this->lang->line('overview_lang_appointment'); ?></a><br/>
          </div>
          <div class="pull-right">
            <ul class="list-inline">
              <li><?php echo date('d-m-Y'); ?></li>
              <li><?php echo date('h:i').date('a'); ?> </li>
            </ul>
          </div>
          <div class="col-sm-6 col-md-3"><a href="javascript:;" class="btn btn-default btn-block" data-toggle="status-input" data-status-input-target="#<?php echo $status_input_panel_rezept_id = 'status_input_panel_rezept_id'.random_string('alnum', 32); ?>" ><?php echo $this->lang->line('overview_lang_eprescription'); ?></a><br/>
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
        <h2 class="pull-left font-bold"><strong><a href="javascript:;" class="btn-block" data-toggle="status-input" data-status-input-target="#<?php echo $status_input_panel_data_id = 'status_input_panel_data_id'.random_string('alnum', 32); ?>" ><?php echo $this->lang->line('overview_lang_new_entry'); ?></a></strong></h2>
      </div>
      <div class="panel panel-default" id="<?php echo $status_input_panel_data_id; ?>"  >
        <!-- <textarea class="form-control share-widget-textarea" rows="3" placeholder="Share what you've been up to..." tabindex="1"></textarea> -->
        <?php $status_input_data_t1_id = 'status_input_data_t1_id_'.random_string('alnum', 32); ?>
        <?php $status_input_data_t2_id = 'status_input_data_t2_id_'.random_string('alnum', 32); ?>
        <?php $status_input_data_t3_id = 'status_input_data_t3_id_'.random_string('alnum', 32); ?>
        <?php $status_input_data_t4_id = 'status_input_data_t4_id_'.random_string('alnum', 32); ?>
        <?php $status_input_data_t5_id = 'status_input_data_t5_id_'.random_string('alnum', 32); ?>
        <?php $status_input_data_t6_id = 'status_input_data_t6_id_'.random_string('alnum', 32); ?>
        <?php $status_input_data_t7_id = 'status_input_data_t7_id_'.random_string('alnum', 32); ?>
        <?php $status_input_data_t8_id = 'status_input_data_t8_id_'.random_string('alnum', 32); ?>
        <div class="panel-heading clearfix">
          <div class="share-widget-types pull-left"> <a href="#<?php echo $status_input_data_t1_id; ?>" data-toggle="tab" class="fa fa-smile-o ui-tooltip" title="Befinden"><i></i></a> <a href="#<?php echo $status_input_data_t2_id; ?>" data-toggle="tab" class="fa fa-stethoscope ui-tooltip" title="Diagnosen"><i></i></a> <a href="#<?php echo $status_input_data_t3_id; ?>" data-toggle="tab" class="fa fa-table ui-tooltip" title="Medikamente"><i></i></a> <a href="#<?php echo $status_input_data_t4_id; ?>" data-toggle="tab" class="fa fa-medkit ui-tooltip" title="Impfung"><i></i></a> <a href="#<?php echo $status_input_data_t5_id; ?>" data-toggle="tab" class="fa fa-heartbeat ui-tooltip" title="Blutdruck"><i></i></a> <a href="#<?php echo $status_input_data_t6_id; ?>" data-toggle="tab" class="fa fa-tint ui-tooltip" title="Blutzucker"><i></i></a> <a href="#<?php echo $status_input_data_t7_id; ?>" data-toggle="tab" class="fa fa-street-view ui-tooltip" title="Gewicht &amp; BMI"><i></i></a> <a href="#<?php echo $status_input_data_t8_id; ?>" data-toggle="tab" class="fa fa-area-chart ui-tooltip" title="Marcumar"><i></i></a> </div>
          <!-- <div class="pull-right">
                <button class="btn btn-primary btn-sm btn-submit"><span class="icomoon i-file-plus-2"></span> HinzufÃ¼gen</button>
              </div>-->
        </div>
        <div class="panel-body">
          <div id="<?php echo $status_input_data_tab_id = 'status_input_data_tab_id'.random_string('alnum', 32); ?>" class="tab-content">
            <div class="tab-pane fade in active" id="<?php echo $status_input_data_t1_id; ?>">
              <?php $this->load->view('condition/condition_entry_view', array('hide_insert' => TRUE, )); ?>
            </div>
            <div class="tab-pane fade" id="<?php echo $status_input_data_t2_id; ?>">
              <?php $this->load->view('diagnosis/diagnosis_entry_view', array('hide_insert' => TRUE, )); ?>
            </div>
            <div class="tab-pane fade" id="<?php echo $status_input_data_t3_id; ?>">
              <?php $this->load->view('medication/medication_entry_view', array('hide_insert' => TRUE, )); ?>
            </div>
            <div class="tab-pane fade" id="<?php echo $status_input_data_t4_id; ?>">
              <?php $this->load->view('vaccination/vaccination_entry_view', array('hide_insert' => TRUE, )); ?>
            </div>
            <div class="tab-pane fade" id="<?php echo $status_input_data_t5_id; ?>">
              <?php $this->load->view('graph/insert_view', array('hide_insert' => TRUE,'table'=>'heart_frequency', 'entry' => (object)array('id' => 0, 'rr_sys' => '', 'rr_dia' => '', 'puls' => '',  ), )); ?>
            </div>
            <div class="tab-pane fade" id="<?php echo $status_input_data_t6_id; ?>">
              <?php $this->load->view('graph/insert_view', array('hide_insert' => TRUE,'table'=>'blood_sugar','entry' => (object)array('id' => 0, 'bloodsugar' => '', 'HbA1C' => '', ), )); ?>
            </div>
            <div class="tab-pane fade" id="<?php echo $status_input_data_t7_id; ?>">
              <?php $this->load->view('graph/insert_view', array('hide_insert' => TRUE,'table'=>'weight_bmi', 'entry' => (object)array('id' => 0, 'size' => '', 'weight' => '', 'bmi' => '', ), )); ?>
            </div>
            <div class="tab-pane fade" id="<?php echo $status_input_data_t8_id; ?>">
              <?php $this->load->view('graph/insert_view', array('hide_insert' => TRUE,'table'=>'marcumar', 'entry' => (object)array('id' => 0, 'INR' => '', 'quick' => '', 'lower_limit' => '', 'upper_limit' => '', ), )); ?>
            </div>
          </div>
        </div>
        <div class="panel-footer clearfix">
          <!--
              <div class="share-widget-types pull-left">
                <a href="#<?php echo $status_input_data_t1_id; ?>" data-toggle="tab" class="fa fa-smile-o ui-tooltip" title="Befinden"><i></i></a>
                <a href="#<?php echo $status_input_data_t2_id; ?>" data-toggle="tab" class="fa fa-stethoscope ui-tooltip" title="Diagnosen"><i></i></a>
                <a href="#<?php echo $status_input_data_t3_id; ?>" data-toggle="tab" class="fa fa-table ui-tooltip" title="Medikamente"><i></i></a>
                <a href="#<?php echo $status_input_data_t4_id; ?>" data-toggle="tab" class="fa fa-medkit ui-tooltip" title="Impfung"><i></i></a>
                <a href="#<?php echo $status_input_data_t5_id; ?>" data-toggle="tab" class="fa fa-heartbeat ui-tooltip" title="Blutdruck"><i></i></a>
                <a href="#<?php echo $status_input_data_t6_id; ?>" data-toggle="tab" class="fa fa-tint ui-tooltip" title="Blutzucker"><i></i></a>
                <a href="#<?php echo $status_input_data_t7_id; ?>" data-toggle="tab" class="fa fa-street-view ui-tooltip" title="Gewicht &amp; BMI"><i></i></a>
                <a href="#<?php echo $status_input_data_t8_id; ?>" data-toggle="tab" class="fa fa-area-chart ui-tooltip" title="Marcumar"><i></i></a>
              </div>  
              -->
          <div class="pull-right">
            <button class="btn btn-default btn-sm btn-submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?> </button>
          </div>
        </div>
      </div>
      <div class="panel panel-default" id="<?php echo $status_input_panel_consult_id; ?>" style="display:none;" >
        <!-- <textarea class="form-control share-widget-textarea" rows="3" placeholder="Share what you've been up to..." tabindex="1"></textarea> -->
        <?php $status_input_consult_t1_id = 'status_input_consult_t1_id_'.random_string('alnum', 32); ?>
        <?php $status_input_consult_t2_id = 'status_input_consult_t2_id_'.random_string('alnum', 32); ?>
        <?php $status_input_consult_t3_id = 'status_input_consult_t3_id_'.random_string('alnum', 32); ?>
        <div class="panel-heading clearfix">
          <div class="share-widget-types pull-left"> <a href="#<?php echo $status_input_consult_t1_id; ?>" data-toggle="tab" class="fa fa-keyboard-o ui-tooltip" title="Consult"><i></i></a> </div>
          <div class="share-widget-types pull-left"> <a href="<?php echo smart_site_url('akte/videochat'); ?>"  class="ajax-nav-links fa fa-video-camera ui-tooltip" title="Video"><i></i></a> </div>
          <div class="share-widget-types pull-left"> <a href="#<?php echo $status_input_consult_t3_id; ?>" data-toggle="tab" class="fa fa-phone ui-tooltip" title="Call"><i></i></a> </div>
          <!--<div class="pull-right">
                <button class="btn btn-primary btn-sm btn-submit"><span class="icomoon i-file-plus-2"></span> HinzufÃ¼gen</button>
              </div> -->
        </div>
        <div class="panel-body">
          <div id="<?php echo $status_input_consult_tab_id = 'status_input_consult_tab_id'.random_string('alnum', 32); ?>" class="tab-content">
            <div class="tab-pane fade in active" id="<?php echo $status_input_consult_t1_id; ?>">
              <?php $this->load->view('econsult/econsult_entry_view', array('hide_insert' => TRUE, )); ?>
            </div>
            <div class="tab-pane fade" id="<?php echo $status_input_consult_t2_id; ?>"> </div>
            <div class="tab-pane fade" id="<?php echo $status_input_consult_t3_id; ?>"> </div>
          </div>
        </div>
        <div class="panel-footer clearfix">
          <!-- <div class="share-widget-types pull-left">
                <a href="#<?php echo $status_input_consult_t1_id; ?>" data-toggle="tab" class="fa fa-keyboard-o ui-tooltip" title="Consult"><i></i></a>
              </div>
              <div class="share-widget-types pull-left">
                <a href="#<?php echo $status_input_consult_t2_id; ?>" data-toggle="tab" class="fa fa-video-camera ui-tooltip" title="Video"><i></i></a>
              </div>
              <div class="share-widget-types pull-left">
                <a href="#<?php echo $status_input_consult_t3_id; ?>" data-toggle="tab" class="fa fa-phone ui-tooltip" title="Call"><i></i></a>
              </div> -->
          <div class="pull-right">
            <button class="btn btn-primary btn-sm btn-submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?> </button>
          </div>
        </div>
      </div>
      <div class="panel panel-default" id="<?php echo $status_input_panel_termin_id; ?>" style="display:none;" >
        <!-- <textarea class="form-control share-widget-textarea" rows="3" placeholder="Share what you've been up to..." tabindex="1"></textarea> -->
        <?php $status_input_termin_t1_id = 'status_input_termin_t1_id_'.random_string('alnum', 32); ?>
        <?php $status_input_termin_t2_id = 'status_input_termin_t2_id_'.random_string('alnum', 32); ?>
        <?php $status_input_termin_t3_id = 'status_input_termin_t3_id_'.random_string('alnum', 32); ?>
        <div class="panel-heading clearfix">
          <div class="share-widget-types pull-left"> <a href="#<?php echo $status_input_termin_t1_id; ?>" data-toggle="tab" class="fa fa-keyboard-o ui-tooltip" title="termin"><i></i></a> </div>
          <div class="share-widget-types pull-left"> <a href="#<?php echo $status_input_termin_t2_id; ?>" data-toggle="tab" class="fa fa-video-camera ui-tooltip ajax-nav-link" title="Video"><i></i></a> </div>
          <div class="share-widget-types pull-left"> <a href="#<?php echo $status_input_termin_t3_id; ?>" data-toggle="tab" class="fa fa-phone ui-tooltip" title="Call"><i></i></a> </div>
          <div class="pull-right"> </div>
        </div>
        <div class="panel-body">
          <div id="<?php echo $status_input_termin_tab_id = 'status_input_termin_tab_id'.random_string('alnum', 32); ?>" class="tab-content">
            <div class="tab-pane fade in active" id="<?php echo $status_input_termin_t1_id; ?>">
              <iframe src="https://ihrarzt24.de/apps/ia24at/index.php/search_result" width="100%" height="100%" name="iframe_termin" style="border:none; min-height:560px;"></iframe>
            </div>
            <div class="tab-pane fade" id="<?php echo $status_input_termin_t2_id; ?>"> </div>
            <div class="tab-pane fade" id="<?php echo $status_input_termin_t3_id; ?>"> </div>
          </div>
        </div>
        <!-- <div class="panel-footer clearfix">
              <div class="share-widget-types pull-left">
                <a href="#<?php echo $status_input_termin_t1_id; ?>" data-toggle="tab" class="fa fa-keyboard-o ui-tooltip" title="termin"><i></i></a>
              </div>
              <div class="share-widget-types pull-left">
                <a href="#<?php echo $status_input_termin_t2_id; ?>" data-toggle="tab" class="fa fa-video-camera ui-tooltip" title="Video"><i></i></a>
              </div>
              <div class="share-widget-types pull-left">
                <a href="#<?php echo $status_input_termin_t3_id; ?>" data-toggle="tab" class="fa fa-phone ui-tooltip" title="Call"><i></i></a>
              </div>

              <div class="pull-right">
                
              </div>
            </div> -->
      </div>
      <div class="panel panel-default" id="<?php echo $status_input_panel_rezept_id; ?>" style="display:none;" >
        <!-- <textarea class="form-control share-widget-textarea" rows="3" placeholder="Share what you've been up to..." tabindex="1"></textarea> -->
        <?php $status_input_rezept_t1_id = 'status_input_rezept_t1_id_'.random_string('alnum', 32); ?>
        <?php $status_input_rezept_t2_id = 'status_input_rezept_t2_id_'.random_string('alnum', 32); ?>
        <?php $status_input_rezept_t3_id = 'status_input_rezept_t3_id_'.random_string('alnum', 32); ?>
        <div class="panel-heading clearfix">
          <div class="share-widget-types pull-left"> <a href="#<?php echo $status_input_rezept_t1_id; ?>" data-toggle="tab" class="fa fa-keyboard-o ui-tooltip" title="rezept"><i></i></a> </div>
          <div class="share-widget-types pull-left"> <a href="#<?php echo $status_input_rezept_t2_id; ?>" data-toggle="tab" class="fa fa-video-camera ui-tooltip" title="Video"><i></i></a> </div>
          <div class="share-widget-types pull-left"> <a href="#<?php echo $status_input_rezept_t3_id; ?>" data-toggle="tab" class="fa fa-phone ui-tooltip" title="Call"><i></i></a> </div>
          <div class="pull-right"> </div>
        </div>
        <div class="panel-body">
          <div id="<?php echo $status_input_rezept_tab_id = 'status_input_rezept_tab_id'.random_string('alnum', 32); ?>" class="tab-content">
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
      <div class="block-foot text-right">SPEICHERN <span class="fa font24 fa-check-square-o"></span></div>
    </div>
</div>
    <div class="col-md-3" style="display:none;">
              <div class="block block-user text-center">
              <div class="img">
                              <img src="<?php $this->load->model('document/mdoc');
                              echo ($img_path = $this->mdoc->get_profile_img_path($row->regid)) ? base_url($img_path) : '//placehold.it/120x120'; ?>"/></div>
                               
                                <h2 class="block block-user text-center"><?php echo strtoupper($row->name); ?> <?php echo strtoupper($row->surname);?></h2>
              </div>
           </div>
           <div class="col-md-9">
           <div class="block block-c2">
           <div class="blog-list">
           <?php
             $this->load->model('modoc');
             echo $this->modoc->patientdetails($row->id);
           ?>
           </div>
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

<script type="text/javascript">
    $(document).ready(function() {
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

        var $statusInputs = $('[data-toggle="status-input"][data-status-input-target]').each(function() {
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
                /*  $('<button />').click(function() {
                    $(this).closest('.form-group').next('.form-group:hidden').slideDown('slow');
                    $(this).closest('.form-group').insertAfter($(this).closest('.form-group').next('.form-group'));
                    $(this).closest('.form-group').filter(':last-child').slideUp();
                  }).addClass('btn btn-xs btn-secondary').attr('type', 'button').append($('<span />').addClass('fa fa-arrow-down')).append(' Mehr')*/
                )
              )
            );

            $target.find('.panel-heading .btn-submit, .panel-footer .btn-submit').click(function(e) {
              var $forms = $(this).parent().parent().siblings('.panel-body').find('.tab-pane.active form');
              $forms.length ? $($forms[0]).ajaxSubmit({
                success: function() {
                  $('.ajax-feed-link.active').click();
                },
              }) : '';
            });

          }

        });

        /* --------------------------------------------------------
        Ajax feed link
        -----------------------------------------------------------*/
        $('.ajax-feed-link').off('click', '**').click(function(e) {
       
          e.preventDefault();
          if ($('#feedContent').length && $(this).attr('href').indexOf('javascript:') < 0) {
            $(this).toggleClass('active', true).siblings().toggleClass('active',  false);

            $.loadUrl($(this).attr('href'), $('#feedContent'));

            $('#feedContent').data('feedLoaded', $(this).attr('href')).siblings('h4.content-title').find('u').html($(this).text() + ($(this).text().indexOf('Feed') < 0 ? ' ' : '') );
          }
        }).each(function() {
          if ($('#feedContent').length && $(this).attr('href').indexOf('javascript:') < 0) {
            $(this).click();
            return false;
          }
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
        
         
         $('#runtastic_link').click(function(e) {
          e.preventDefault();
          if ($('#feedContent').length && $(this).attr('href').indexOf('javascript:') < 0) {
            
            $.loadUrl($(this).attr('href'), $('#feedContent'));

            $('#feedContent').data('feedLoaded', $(this).attr('href')).siblings('h4.content-title').find('u').html($(this).text() + ($(this).text().indexOf('Feed') < 0 ? ' ' : '') );
          }
        });
         $('.fa-calendar-o').on('click', function(){
             $(".sidebar-calendar-block").toggleClass('sidebar-calendar1');
             //$('#sidebar-calendar').toggle();
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
        </script>