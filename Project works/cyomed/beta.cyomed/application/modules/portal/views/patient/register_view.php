
<div class="row" style="padding-top:10px;">

  <div class="col-xs-12 col-sm-12 col-md-12">

    <div class="col-xs-12 col-sm-6 col-md-6">
    <?php $alert = isset($alert) && $alert ? $alert : $this->session->flashdata('page_alert'); ?>

    <?php if (is_string($alert) && $alert) : $alert = array('text' => $alert, ); endif; ?>

    <?php if (is_array($alert)) : ?>

      <?php foreach ($alert as $key => $value) : ?>

        <?php if (!is_numeric($key)) : $value = $alert; endif; ?>

        <div class="alert alert-danger">

          <?php echo isset($value['text']) && $value['text'] ? $value['text'] : 'Fehler aufgetreten.'; ?>

        </div>

        <?php if (!is_numeric($key)) : break; endif; ?>

      <?php endforeach; ?>

    <?php endif; ?>
    </div> 

    <div class="col-xs-12 col-sm-6 col-md-6">
    <div class="alert alert-info pull-right" style="background:#033782;">
        <?php echo $this->lang->line('reg_lang_login_info');?>
        <a href="<?php echo site_url('portal/both/login/page?p'); ?>" style="color:#fff;text-transform:uppercase;"><strong>
          <?php echo $this->lang->line('reg_lang_login_link');?>
      </strong></a></div>
    </div>
    
  </div>

</div>


<form class="form-horizontal" role="form" id="registrationForm" action="<?php echo site_url('portal/patient/register/page/post'.(isset($r) && isset($c) && $r && $c ? ('?r='.rawurlencode($r).'&c='.rawurlencode($c)) : '')); ?>" method="post" enctype="application/x-www-form-urlencoded">

  <div class="row m-b-20">

    <div class="col-md-6">

      <!-- Email -->

      <div class="form-group">

        <label for="inputEmail" class="col-sm-4 control-label">
          <?php echo $this->lang->line('reg_lang_email');?>
           <span class="text-danger">*</span></label>

        <div class="col-sm-8">

          <input type="email" class="form-control" name="email" id="inputEmail" value="<?php echo set_value('email'); ?>" placeholder="E-Mail-Adresse" required />

        </div>

      </div>

      <!-- First Name -->

      <div class="form-group">

        <label for="inputFirstName" class="col-sm-4 control-label">
          <?php echo $this->lang->line('reg_lang_f_name');?>
           <span class="text-danger">*</span></label>

        <div class="col-sm-8">

          <input type="text" class="form-control" name="first_name" id="inputFirstName" value="<?php echo set_value('first_name'); ?>" placeholder="Vorname" maxlength="50" required />

        </div>

      </div>

      <!-- Last Name -->

      <div class="form-group">

        <label for="inputLastName" class="col-sm-4 control-label">
          <?php echo $this->lang->line('reg_lang_l_name');?>
           <span class="text-danger">*</span></label>

        <div class="col-sm-8">

          <input type="text" class="form-control" name="last_name" id="inputLastName" value="<?php echo set_value('last_name'); ?>" placeholder="Nachname" maxlength="50" required />

        </div>

      </div>

      <!-- Gender -->

      <div class="form-group">

        <label for="inputGender" class="col-sm-4 control-label">
          <?php echo $this->lang->line('reg_lang_user_sex');?>
           <span class="text-danger">*</span></label>

        <div class="col-sm-8">

          <select class="select form-control" name="gender" id="inputGender">

            <option value="1" <?php echo set_select('gender', '1'); ?> >
                <?php echo $this->lang->line('reg_lang_user_male');?>
            </option>

            <option value="2" <?php echo set_select('gender', '2'); ?> >
                <?php echo $this->lang->line('reg_lang_user_female');?>
            </option>

          </select>

        </div>

      </div>

      <!-- Birthday -->

      <div class="form-group">

        <label for="inputBirthday" class="col-sm-4 control-label">
           <?php echo $this->lang->line('reg_lang_user_birthdate');?>
           <span class="text-danger">*</span></label>

        <div class="input-icon col-sm-8 birth birthdate-pick birth-date">
        

        <input type="text" class="form-control input-sm" name="birthday" id="inputBirthday" value="<?php echo set_value('birthday'); ?>"  placeholder="DD.MM.YYYY" data-format="dd.MM.yyyy" required />
        <span class="add-on "> <i class="fa fa-calendar icon-calendar"></i></span>
        </div>

      </div>

      <!-- Password -->

      <div class="form-group">

        <label for="inputPassword" class="col-sm-4 control-label">
          <?php echo $this->lang->line('reg_lang_pass');?>
           <span class="text-danger">*</span></label>

        <div class="col-sm-8">

          <input type="password" class="form-control" name="password" id="inputPassword" value="<?php echo set_value('password'); ?>" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers." required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[^\s]{6,}" placeholder="Passwort" required />

        </div>

      </div>

      <!-- Password repeat -->

      <div class="form-group">

        <label for="inputPassword2" class="col-sm-4 control-label">
          <?php echo $this->lang->line('reg_lang_pass_repeat');?>
           <span class="text-danger">*</span></label>

        <div class="col-sm-8">

          <input type="password" class="form-control" name="password2" id="inputPassword2" title="Please enter the same Password as above." required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Passwort wiederholen" required />

        </div>

      </div>

    </div>

    <div class="col-md-6">

      <!-- Mobile -->

      <div class="form-group">

        <label for="inputMobile" class="col-sm-4 control-label">
          <?php echo $this->lang->line('reg_lang_mobile');?>
        </label>

        <div class="col-sm-8">

          <input type="tel" class="form-control numeric" minlength="10" maxlength="15" title="Mobile number must be between 10 to 15 characters long."  name="mobile" value="<?php echo set_value('mobile'); ?>" id="inputMobile" placeholder="Handynummer">

        </div>

      </div>



      <!-- Telephone -->

      <div class="form-group">

        <label for="inputTelephone" class="col-sm-4 control-label">
          <?php echo $this->lang->line('reg_lang_telephone');?>
        </label>

        <div class="col-sm-8">

          <input type="tel" class="form-control numeric" minlength="10" maxlength="15" title="Telephone number must be between 10 to 15 characters long."  name="telephone" value="<?php echo set_value('telephone'); ?>" id="inputTelephone" placeholder="Telefonnummer">

        </div>

      </div>



      <!-- Fax -->

      <div class="form-group">

        <label for="inputFax" class="col-sm-4 control-label">
          <?php echo $this->lang->line('reg_lang_fax');?>
        </label>

        <div class="col-sm-8">

          <input type="tel" class="form-control numeric" minlength="10" maxlength="15" title="Fax number must be between 10 to 15 characters long." name="fax" value="<?php echo set_value('fax'); ?>" id="inputFax" placeholder="Faxnummer">

        </div>

      </div>



      <!-- Street -->

      <div class="form-group">

        <label for="inputStreet" class="col-sm-4 control-label">
          <?php echo $this->lang->line('reg_lang_address');?>
        </label>

        <div class="col-sm-8">

          <input type="text" class="form-control" name="street" value="<?php echo set_value('street'); ?>" id="inputStreet" placeholder="Straße und Hausnummer">

        </div>

      </div>

      <div class="form-group">

        <label for="inputStreetAdditional" class="col-sm-4 control-label">
          <?php echo $this->lang->line('reg_lang_address_extra');?>
        </label>

        <div class="col-sm-8">

          <input type="text" class="form-control" name="street_additional" value="<?php echo set_value('street_additional'); ?>" id="inputStreetAdditional" placeholder="Adresszusatz">

        </div>

      </div>



      <!-- Postal code -->

      <div class="form-group">

        <label for="inputPostalCode" class="col-sm-4 control-label">
          <?php echo $this->lang->line('reg_lang_plz');?>
        </label>

        <div class="col-sm-8">

          <input type="text" class="form-control numeric" name="postal_code" value="<?php echo set_value('postal_code'); ?>" id="inputPostalCode" placeholder="PLZ" min="01000" max="99999" maxlength="5">

        </div>

      </div>



      <!-- Locality -->

      <div class="form-group">

        <label for="inputLocality" class="col-sm-4 control-label">
          <?php echo $this->lang->line('reg_lang_state');?>
        </label>

        <div class="col-sm-8">

          <input type="text" class="form-control" name="locality" value="<?php echo set_value('locality'); ?>" id="inputLocality" placeholder="Stadt">

        </div>

      </div>



      <!-- Region -->

      <div class="form-group">

        <label for="inputRegion" class="col-sm-4 control-label">
          <?php echo $this->lang->line('reg_lang_city');?>
        </label>

        <div class="col-sm-8">

          <input type="text" class="form-control" name="region" value="<?php echo set_value('region'); ?>" id="inputRegion" placeholder="Region">

        </div>

      </div>



      <!-- Country -->

      <div class="form-group">

        <label for="inputCountry" class="col-sm-4 control-label">
          <?php echo $this->lang->line('reg_lang_land');?>
        </label>

        <div class="col-sm-8">

          <input type="text" class="form-control" name="country" value="<?php echo set_value('country'); ?>" id="inputCountry" placeholder="Land">

        </div>

      </div>



    </div>

  </div>



  <div class="row">

    <div class="col-md-12">

      <div class="tile">

        <div class="tile-title">
          <?php echo $this->lang->line('reg_lang_sys_info');?>
        </div>

        <div class="p-10">

          <div class="row">

            <div class="col-md-6">

              <h5>
                 <?php echo $this->lang->line('reg_lang_sys_service');?>
              </h5>

              <div class="help-block">

                <!-- Button trigger modal -->

                <button type="button" role="button" class="btn btn-full font-bold uprCase" <?php echo $this->moterm->modal_attr('serviceContractPatient'); ?> style="background: #a5d8da;" >
                 <?php echo $this->lang->line('reg_lang_sys_service_click');?>
                </button>

              </div>

            </div>

            <div class="col-md-6">

              <h5>
                 <?php echo $this->lang->line('reg_lang_sys_privacy');?>
              </h5>

              <div class="help-block">

                <!-- Button trigger modal -->

                <button type="button" role="button" class="btn btn-full font-bold uprCase" <?php echo $this->moterm->modal_attr('privacyPatient'); ?> style="background: #a5d8da;" >

                 <?php echo $this->lang->line('reg_lang_sys_service_click');?>

                </button>

              </div>

            </div>

          </div>

          <div class="row">

            <div class="col-md-12">

<!--              <div class="checkbox">-->
<div class="">
              
<input type="checkbox" name="terms" id="terms" value="1" <?php echo set_checkbox('terms', '1'); ?> >
                  <span class="text-danger">*</span>
                  
                  
                    <?php echo $this->lang->line('reg_lang_sys_agree');?>

               

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>



  <div class="row">
 <p class="help-block col-sm-12 p-l-20"><span class="text-danger">
            <?php echo $this->lang->line('reg_lang_sys_warn');?>
        </span></p>
    <div class="col-md-8 col-md-offset-2">

      <div class="form-group">

       

        <div class="col-sm-offset-4 col-sm-2">

          <button role="button" class="btn btn-lg btn-full font-bold uprCase" type="submit" style="margin-bottom:15px; background:#acadd3;">
              <b><?php echo $this->lang->line('reg_lang_submit');?></b>
          </button>

        </div>
        <div class="col-sm-2">
          <button role="button" class="btn btn-lg btn-full font-bold uprCase" onclick="location.href='<?php echo site_url("") ?>';" type="reset" style="margin-bottom:15px; margin-left:25px; background: #a5d8da;">
             <?php echo $this->lang->line('reg_lang_reset');?>
          </button>

        </div>

      </div>

    </div>

  </div>



</form>

<style>

 input[type=checkbox],
  input[type=radio]{
    opacity:1;
}
.input-icon .add-on { left:16px}
</style>
