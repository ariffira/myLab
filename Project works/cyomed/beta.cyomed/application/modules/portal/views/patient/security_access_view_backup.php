<div class="tab-content text-left">
    <div class="login_container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-block">
                   <div class="logo"><img src="<?php echo base_url('assets/img/logo/secure-logo.png'); ?>" alt="Cyomed"/></div>
                 <form class="form-horizontal" role="form" id="registrationForm" action="<?php echo site_url('portal/patient/forgot/security_response'); ?>" method="post">
                    <!-- Question -->
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-6 pull-left text-left control-label">1. Select Security Question<span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                           <select class="form-control" name="security_question_id[]" id="inputquestion" required >
                              <?php foreach ($data as $key=>$value){?>
                             <option value="<?php echo $value->id;?>"><?php echo $value->question;?></option>
                             <?php } ?>
                           </select>
                        </div>
                    </div>
                     <!-- Answer -->
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 pull-left text-left control-label">Answer<span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="answer[]" id="inputAnswer" value="" title="" placeholder="Enter your answer.." required />
                        </div>
                    </div>
                      <!-- Question -->
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-6 pull-left text-left control-label">2. Select Security Question<span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                           <select class="form-control" name="security_question_id[]" id="inputquestion" required >
                              <?php foreach ($data as $key=>$value){?>
                             <option value="<?php echo $value->id;?>"><?php echo $value->question;?></option>
                             <?php } ?>
                           </select>
                        </div>
                    </div>
                     <!-- Answer -->
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 pull-left text-left control-label">Answer<span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="answer[]" id="inputAnswer" value="" title="" placeholder="Enter your answer.." required />
                        </div>
                    </div>
                      <!-- Question -->
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-6 pull-left text-left control-label">3. Select Security Question<span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                           <select class="form-control" name="security_question_id[]" id="inputquestion" required >
                              <?php foreach ($data as $key=>$value){?>
                             <option value="<?php echo $value->id;?>"><?php echo $value->question;?></option>
                             <?php } ?>
                           </select>
                        </div>
                    </div>
                     <!-- Answer -->
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 pull-left text-left control-label">Answer<span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="answer[]" id="inputAnswer" value="" title="" placeholder="Enter your answer.." required />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-2">
                            <button role="button" class="btn btn-purple btn-lg btn-full font-bold uprCase" type="submit" style="margin-bottom:15px;" data-loading-text="Changing Password...">
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
