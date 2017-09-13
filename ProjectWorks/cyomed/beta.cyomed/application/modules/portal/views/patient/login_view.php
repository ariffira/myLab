<?php
if(isset($p) && $p){
  $p_email = set_value('email');
  $p_password = set_value('password');
}else{
  $p_email = '';
  $p_password = '';  
}
?> 
<div class="form form-horizontal"> 
  <form class="form-horizontal" action="<?php echo site_url('portal/patient/login/page/post'.(isset($r) && isset($c) && $r && $c ? ('?r='.rawurlencode($r).'&c='.rawurlencode($c)) : '')); ?>" method="post" enctype="application/x-www-form-urlencoded"> 
    <div class="form-group">                                    
      <div class="col-md-12">                                        
        <div class="uprCase font12 font-bold">
          <?php echo $this->lang->line('login_lang_user_email');?>
        </div>   
        <input type="email" class="form-control" name="email" id="inputEmail" value="<?php echo $p_email; ?>" placeholder="<?php echo $this->lang->line('login_lang_user_email');?>" required/>   
<!--                   <div class="text-right font12">
                  Ich habe meinen Login-Namen / E-Mail-Adresse 
                     <a href="<?php echo site_url('portal/patient/forgot/email_reset'); ?>">
                     vergessen
                     </a>
                   </div>   -->                                  
                 </div>                                
               </div>                                
               <div class="form-group">                        
                 <div class="col-md-12">            
                  <div class="uprCase font12 font-bold">
                    <?php echo $this->lang->line('login_lang_user_pass');?>
                  </div>       
                  <input type="password" class="form-control" name="password" id="inputPassword" value="<?php echo $p_password; ?>" placeholder="<?php echo $this->lang->line('login_lang_user_pass');?>" required/> 
                  <div class="text-right font12">
                    <?php echo $this->lang->line('login_lang_user_pass_forget');?>
                    <a href="<?php echo site_url('portal/patient/forgot/pass_reset?p'); ?>">
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
                <div class="col-md-8 control-label">                                  
                  <!--<label class="checkbox"><input type="checkbox" value="">
                  Keep me sign in</label>-->                                 
                </div>                               
              </div>     
            </form>
          </div> 
          <hr>
          <div>
            <?php echo $this->lang->line('login_lang_not_reg_text');?>
            <a href="<?php echo site_url('portal/both/register/page?p'); ?>">
              <?php echo $this->lang->line('login_lang_reg_link');?>
            </a>   
          </div>
