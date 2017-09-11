<div class="tab-content text-left">
    <div class="login_container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-block">
                   <div class="logo"><img src="<?php echo base_url('assets/img/logo/secure-logo.png'); ?>" alt="Cyomed"/></div>
                    <div class="red">Ihr Passwort ist 90 Tage alt, Setzen Sie Ihr Passwort ein.</div>   
                    <form class="form-horizontal" role="form" name="change_pass_form" id="registrationForm" action="<?php echo site_url('portal/patient/forgot/forcechange_password'); ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo  isset($id)?$id:''?>">
                    <input readonly="readonly" type="hidden" class="form-control" name="password3" id="inputPassword3" title="Please enter the old password which sent to your email."  placeholder="Old Password" value="<?php echo  isset($password)?$password:''?>" required />
                    <!-- Password Temporary -->
<!--                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-4 control-label">Old Password <span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <input readonly="readonly" type="password" class="form-control" name="password3" id="inputPassword3" title="Please enter the old password which sent to your email."  placeholder="Old Password" value="<?php // echo  isset($password)?$password:''?>" required />
                        </div>
                    </div>-->
                    
                    <!-- Password New -->
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-4 control-label">New Password<span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control" name="password" id="inputPassword" value="" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers." required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="New Password" required />
                        </div>
                    </div>
                    <!-- Password repeat -->
                    <div class="form-group">
                        <label for="inputPassword2" class="col-sm-4 control-label" style="white-space:nowrap;">Confirm Password<span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control" name="password2" id="inputPassword2" title="Please enter the same Password as above." required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Confirm Password" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-2">
                            <button role="button" class="btn btn-purple btn-lg btn-full font-bold uprCase" type="submit" style="margin-bottom:15px;" onclick="return validate()" data-loading-text="Changing Password...">
                                Submit
                            </button>
                        </div>

                    </div>

                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function validate(){
        
    
    if($("#inputPassword").val()=="")
    {
      alert("Please enter new password.");
      return false;
    }
    
    else if($("#inputPassword2").val()=="")
    {
      alert("Please enter match password.");
      return false;
    }
    
    else if ($("#inputPassword").val()!=$("#inputPassword2").val()){
        alert("Password did't match");
      return false;
    }
    return true;
 
        
    }
    $(document).ready(function(){
    });
</script>