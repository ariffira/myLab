<?php (!isset($p) || !$p) && (!isset($d) || !$d) ? ($p = TRUE) : NULL; ?>
<?php isset($r) && isset($c) && $r && $c ? ($pass_data = array('r' => $r, 'c' => $c,)) : ($pass_data = array()); 
?>
<div class="tab-content text-left">
    <div class="login_container">
      <div class="logo"><img src="<?php echo base_url('assets/img/logo/logo.png'); ?>" alt="Cyomed"/></div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-block">
                    
                    
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading1" role="tab" id="headingOne">
      <div class="panel-title">
        <?php 
        if(isset($p) && isset($d)){ 
            if($p)
            $patient_tab = 'in';
            else
            $patient_tab = '';
            
            if($d)
            $doctor_tab = 'in';
            else
            $doctor_tab = '';
            
            
        }else{ 
            $patient_tab = 'in';
            $doctor_tab = '';
        }
        ?>
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#patientLogin" aria-expanded="false" aria-controls="collapseOne">
            <i class="fa fa-user" style="font-size: 24px; margin-right: 10px;"></i>&nbsp;<?php echo $this->lang->line('login_lang_user_pat');?> <?php echo $this->lang->line('login_lang_user_login');?>
        </a>
      </div>
    </div>
    <div id="patientLogin" class="panel-collapse collapse <?php echo $patient_tab; ?>" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
                <?php
  if (!empty($alert) && $p) : ?>
      <div class="text-danger" style="text-align:center">
                <?php echo $alert; ?>
            </div>
      <?php endif; ?>   
         <?php $this->load->view('patient/login_view', $pass_data); ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <div class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#doctorLogin" aria-expanded="false" aria-controls="collapseTwo">
            <i class="fa fa-user-md" style="font-size: 24px; margin-right: 10px;"></i>&nbsp;<?php echo $this->lang->line('login_lang_user_doc');?> <?php echo $this->lang->line('login_lang_user_login');?>
        </a>
      </div>
    </div>
    <div id="doctorLogin" class="panel-collapse collapse <?php echo $doctor_tab; ?>" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
         <?php
  if (!empty($alert) && $d) : ?>
      <div class="text-danger" style="text-align:center">
                <?php echo $alert; ?>
            </div>
      <?php endif; ?>  
        <?php $this->load->view('doctor/login_view', $pass_data); ?>
      </div>
    </div>
  </div>

</div>
                    
                 <!--   <div role="tabpanel">
                        
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li class="<?php echo isset($p) && $p ? 'active' : ''; ?>"></li>
                            <li class="<?php echo isset($d) && $d ? 'active' : ''; ?>"></li>
                        </ul>
                        
                        <div class="tab-content">
                                <?php if (!empty($alert)) : ?>
    <div class="row m-5">
        <div class="">

            <div class="text-danger" style="text-align:center">
                <?php echo $alert; ?>
            </div>

        </div>
    </div>
<?php endif; ?>
                            <div class="tab-pane fade <?php echo isset($p) && $p ? 'in active' : ''; ?>" id="">
                              
                            </div>

                            <div class="tab-pane fade <?php echo isset($d) && $d ? 'in active' : ''; ?>" id="">
                               
                            </div>
                        </div>
                    </div>
                    
                    -->
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .login-block .panel-heading{background-color: #004db6 !important; padding:10px; color:#fff!important}
    .login-block .panel-heading a:hover{ color:#fff!important; text-decoration: none;}
    .login-block .panel-heading a:focus{ outline: none;text-decoration: none;}
    .login-block .panel-body{ border: 0; padding:10px }
    .login-block .collapse.in{ border: 0}
      .login-block .panel-default{ border: 1px solid #dddde6}
      .login-block .panel-group{ margin-bottom: 0}
      .login-block .panel-title a{ font-size: 15px; font-weight: bold; text-transform: uppercase; text-align: center}
    .login-block .panel-title{ text-align: center}
    .login-block .panel-heading1{background-color: #AFDCDF !important; padding:10px; color:#fff!important}
    .login-block .panel-heading1 a:hover, .login-block .panel-heading1 a:focus{ color:#fff!important; text-decoration: none; outline: none; text-shadow:1px 0px 1px rgba(0, 0, 0, 0.5);}    
    </style>
    