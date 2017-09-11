<?php
if(isset($d) && $d){
  $d_email = set_value('email');
  $d_password = set_value('password');
}else{
  $d_email = '';
  $d_password = '';  
}
?>
<div class="form form-horizontal">   
  <form class="form-horizontal" action="<?php echo site_url('portal/doctor/login/page/post'.(isset($r) && isset($c) && $r && $c ? ('?r='.rawurlencode($r).'&c='.rawurlencode($c)) : '')); ?>" method="post" enctype="application/x-www-form-urlencoded"> 
    <div class="form-group">                                    
      <div class="col-md-12">                                       
        <div class="uprCase font12 font-bold">
          <?php echo $this->lang->line('login_lang_user_email');?>
        </div>
        <input type="email" class="form-control" name="email" id="inputEmail" value="<?php echo $d_email; ?>" placeholder="<?php echo $this->lang->line('login_lang_user_email');?>" required/> 
               <!-- <div class="text-right font12">
               Ich habe meinen Login-Namen / E-Mail-Adresse
                <a href="<?php echo site_url('portal/doctor/forgot/email_reset'); ?>">
                vergessen
                </a>
              </div> -->                                    
            </div>                               
          </div>                                
          <div class="form-group">                                    
            <div class="col-md-12">         
              <div class="uprCase font12 font-bold">
                <?php echo $this->lang->line('login_lang_user_pass');?>
              </div>                                   
              <input type="password" class="form-control" name="password" id="inputPassword" value="<?php echo $d_password; ?>" placeholder="<?php echo $this->lang->line('login_lang_user_pass');?>" required/>                                        
              <div class="text-right font12">
                <?php echo $this->lang->line('login_lang_user_pass_forget');?>
                <a href="<?php echo site_url('portal/doctor/forgot/pass_reset'); ?>">
                  <?php echo $this->lang->line('login_lang_user_pass_forget_link');?>
                </a>
              </div>                                   
            </div>                                
          </div>                                
          <div class="form-group">                                   
           <div class="col-md-4">                                     
             <button class="btn btn-purple btn-lg btn-full font-bold uprCase">
              <?php echo $this->lang->line('login_lang_button');?>
            </button>  
          </div>                                
        </div>        
      </form>
    </div> 
    <hr>
    <div>
      <?php echo $this->lang->line('login_lang_not_reg_text');?>
      <a href="<?php echo site_url('portal/both/register/page?d'); ?>" >
        <?php echo $this->lang->line('login_lang_reg_link');?>
      </a>
    </div>
                  <!--<div class="row"> 
                   <div class="col-sm-12 col-xs-12">        
                   <div class="row">      
                   <div class="col-md-offset-4 col-md-4 alert alert-info text-center">      
                     Noch nicht registriert? <a href="<?php echo site_url('portal/both/register/page?d'); ?>" style="margin-left:15px;"><strong>Hier registrieren.</strong></a>      </div>    </div>    <div class="row">      <div class="col-md-12">        &nbsp;      </div>    </div>    <form class="form-horizontal" action="<?php echo site_url('portal/doctor/login/page/post'.(isset($r) && isset($c) && $r && $c ? ('?r='.rawurlencode($r).'&c='.rawurlencode($c)) : '')); ?>" method="post" enctype="application/x-www-form-urlencoded">      <div class="form-group">        <label for="inputEmail" class="col-sm-4 control-label">           <span  class="icomoon i-envelop"></span>           E-Mail-Adresse</label>        <div class="col-sm-4">          <input type="email" class="form-control" name="email" id="inputEmail" value="<?php echo set_value('email'); ?>" placeholder="E-Mail-Adresse" required/>          <p class="help-block">Ich habe meinen Login-Namen / E-Mail-Adresse <a href="<?php echo site_url('portal/doctor/forgot/email_reset'); ?>">vergessen</a></p>        </div>      </div>      <div class="form-group">        <label for="inputPassword" class="col-sm-4 control-label">          <span  class="icomoon  i-lock-3"></span>          Passwort        </label>        <div class="col-sm-4">          <input type="password" class="form-control" name="password" id="inputPassword" value="<?php echo set_value('password'); ?>" placeholder="Passwort" required/>          <p class="help-block">Ich habe mein Passwort <a href="<?php echo site_url('portal/doctor/forgot/pass_reset'); ?>">vergessen</a></p>        </div>      </div>      <div class="form-group">        <div class="col-sm-offset-4 col-sm-4">          <div class="checkbox">           <label>            <input type="checkbox"> Angemeldet bleiben           </label>          </div>        </div>      </div>      <div class="form-group">        <div class="col-sm-offset-4 col-sm-2">          <button role="button" class="btn btn-success btn-block" type="submit" style="margin-bottom:15px;">Anmelden</button>        </div>        <div class="col-sm-2">          <button role="button" class="btn btn-danger btn-block" type="reset" style="margin-bottom:15px;">Zurücksetzen</button>        </div>      </div>    </form>  </div>  </div>-->