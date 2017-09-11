<fieldset class="form-horizontal">

  <div class="form-group">
    <label for="inputCardholder" class="col-sm-4 control-label">Cardholder <span class="text-danger">*</span></label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="inputCardholder" name="cardholder" value="<?php echo $this->mod->user_value('abc'); ?>" placeholder="Cardholder" required />
    </div>
  </div>
  <div class="form-group">
    <label for="inputCardType" class="col-sm-4 control-label">Card Type <span class="text-danger">*</span></label>
    <div class="col-sm-8">
      <select class="form-control" id="inputCardType" name="cardtype" required>
        <option value="V">Visa</option>
        <option value="M">MasterCard</option>
        <option value="A">American Express</option>
        <option value="D">Diners</option>
        <option value="J">JCB</option>
        <option value="O">Maestro International</option>
        <option value="U">Maestro UK</option>
        <option value="C">Discover</option>
        <option value="B">Carte Bleue</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputCardPAN" class="col-sm-4 control-label">Card PAN <span class="text-danger">*</span></label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="inputCardPAN" name="cardpan" value="<?php echo $this->mod->user_value('abc'); ?>" placeholder="Card PAN" required />
    </div>
  </div>
  <div class="form-group">
    <label for="inputExpireMonth" class="col-sm-4 control-label">Expire Month <span class="text-danger">*</span></label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="inputExpireMonth" name="expiremonth" value="<?php echo $this->mod->user_value('abc'); ?>" placeholder="Expire Month" required />
    </div>
  </div>
  <div class="form-group">
    <label for="inputExpireYear" class="col-sm-4 control-label">Expire Year <span class="text-danger">*</span></label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="inputExpireYear" name="expireyear" value="<?php echo $this->mod->user_value('abc'); ?>" placeholder="Expire Year" required />
    </div>
  </div>
  <div class="form-group">
    <label for="inputCardCVC2" class="col-sm-4 control-label">Card CVC2 <span class="text-danger">*</span></label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="inputCardCVC2" name="cardcvc2" value="<?php echo $this->mod->user_value('abc'); ?>" placeholder="Card CVC2" required />
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-6 text-left">
      
    </div>
    <div class="col-sm-6 text-right">
      <button type="button" class="btn btn-primary" data-target="#tablistChangePackage" data-toggle="tabNext" >Weiter <span class="icomoon i-arrow-right-2"></span></button>
    </div>
  </div>

</fieldset>