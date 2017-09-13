<fieldset class="">

  <div class="form-group">
    <label for="inputAccountHolder">Kontoinhaber <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="inputAccountHolder" name="account_holder" value="<?php echo $this->mod->user_value('payment_account_holder'); ?>" placeholder="Kontoinhaber" required />
  </div>
  <div class="form-group">
    <label for="inputBankName">Name der Bank <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="inputBankName" name="bank_name" value="<?php echo $this->mod->user_value('payment_bank_name'); ?>" placeholder="Name der Bank" required />
  </div>
  <div class="form-group">
    <label for="inputAccountNumber">Kontonummer / IBAN <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="inputAccountNumber" name="account_number" value="<?php echo $this->mod->user_value('payment_account_number'); ?>" placeholder="Kontonummer / IBAN" required />
  </div>
  <div class="form-group">
    <label for="inputBankCode">BLZ / BIC <span class="text-danger">*</span></label>
    <input type="number" class="form-control" id="inputBankCode" name="bank_code" value="<?php echo $this->mod->user_value('payment_bank_code'); ?>" placeholder="BLZ / BIC" required />
  </div>
  <div class="form-group">
    <div class="col-sm-6 text-left">
      
    </div>
    <div class="col-sm-6 text-right">
      <button type="button" class="btn btn-primary" data-target="#tablistChangePackage" data-toggle="tabNext" >Weiter <span class="icomoon i-arrow-right-2"></span></button>
    </div>
  </div>

</fieldset>