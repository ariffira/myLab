<fieldset class="fs-elv" data-fs-val="<?php echo $validation_name = random_string('alnum', 16); ?>">

  <script type="text/javascript">
    function <?php echo $validation_name; ?>()
    {
      var fs = $('fieldset.fs-elv');
      if (!fs || !fs.length) {
        return false;
      }
      if (fs.find('#inputAccountNumber').val().length || fs.find('#inputBankCode').val().length) {
        fs.find('#inputIBAN').prop('required', false);
        fs.find('#inputAccountNumber').prop('required', true);
        fs.find('#inputBankCode').prop('required', true);
      } else {
        fs.find('#inputIBAN').prop('required', true);
        fs.find('#inputAccountNumber').prop('required', false);
        fs.find('#inputBankCode').prop('required', false);
      }
    }
  </script>

  <div class="form-group">
    <label for="inputBankCountry">Bank Country <span class="text-danger">*</span></label>
    <select class="form-control" id="inputBankCountry" name="bankcountry" required>
      <?php foreach ($this->country->get_assoc() as $code => $row) : ?>
        <option value="<?php echo $code ?>" <?php echo $code == 'DE' ? 'selected="selected" style="background-color:#5bc0de;color:white;"' : 'disabled="disabled"' ; ?> ><?php echo $row->country_name; ?> / <?php echo $code; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label for="inputIBAN">IBAN <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="inputIBAN" name="iban" value="<?php echo $this->mod->user_value('abc'); ?>" placeholder="IBAN" />
    <small class="text-danger">
      <strong>International Bank Account Number</strong><br/>
      If both (BBAN and IBAN) are submitted, IBAN is splitted into BBAN and processed. BBAN parameters are ignored.
    </small>
  </div>
  <div class="form-group">
    <label for="inputBIC">BIC <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="inputBIC" name="bic" value="<?php echo $this->mod->user_value('abc'); ?>" placeholder="BIC" />
  </div>
  <div class="form-group">
    <label for="inputAccountNumber">Account Number(BBAN) <span class="text-danger">*</span></label>
    <input type="number" class="form-control" id="inputAccountNumber" name="bankaccount" value="<?php echo $this->mod->user_value('abc'); ?>" placeholder="Account Number(BBAN)" />
    <small class="help-block">
      <strong>DE only</strong> - IBAN / BIC can be calculated automatically by Bank Code / Account Number
    </small>
  </div>
  <div class="form-group">
    <label for="inputBankCode">Bank Code <span class="text-danger">*</span></label>
    <input type="number" class="form-control" id="inputBankCode" name="bankcode" value="<?php echo $this->mod->user_value('abc'); ?>" placeholder="Bank Code" />
    <small class="help-block">
      <strong>DE only</strong> - IBAN / BIC can be calculated automatically by Bank Code / Account Number
    </small>
  </div>
  <div class="form-group">
    <label for="inputAccountHolder">Account Holder <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="inputAccountHolder" name="bankaccountholder" value="<?php echo $this->mod->user_value('abc'); ?>" placeholder="Account Holder" />
  </div>
  <div class="form-group">
    <div class="col-sm-6 text-left">
      
    </div>
    <div class="col-sm-6 text-right">
      <button type="button" class="btn btn-primary" data-target="#tablistChangePackage" data-toggle="tabNext" >Weiter <span class="icomoon i-arrow-right-2"></span></button>
    </div>
  </div>

</fieldset>