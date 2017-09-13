
<div class="row" style="padding-top:10px;">
  <div class="col-md-12">
   <h4>Willkommen beim Online Verschreibungsmodel für Medikamente von Cyomed</h4>
   <h3>Gewuenchte(s) Medikament(e)</h3>
  </div>
</div>



<div class="col-md-12">
    
</div>

<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('eprescription/epres/insert'); ?>" >

<div class="row">
 <div class="col-md-6">

 <!-- Followup -->
  <div class="form-group">
    <label for="inputfollow_up" class="col-sm-4 control-label">Folgerezept/Followup <span class="text-danger">*</span></label>
    <div class="col-sm-6">
      <select type="text" class="select " name="follow_up" id="inputfollow_up">
        <option value="yes">Ja</option>
        <option value="no" >Nein</option>
      </select>
    </div>
  </div>

 <!-- Handelsname -->
  <div class="form-group">
    <label for="inputHandelsname" class="col-sm-4 control-label">Handelsname <span class="text-danger">*</span></label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="Handelsname" id="inputHandelsname" value="<?php echo set_value('Handelsname'); ?>" placeholder="Handelsname"  />
    </div>
  </div>

 <!-- Drug -->
  <div class="form-group">
    <label for="inputdrug" class="col-sm-4 control-label">Wirkstoffbezeinung <span class="text-danger">*</span></label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="drug" id="inputdrug" value="<?php echo set_value('drug'); ?>" placeholder="drug"  />
    </div>
  </div>

  <!-- Atc -->
  <div class="form-group">
    <label for="atc_code" class="col-sm-4 control-label">
      ATC code(falls bekannt)
    </label>
    <div class="col-sm-6">
      <input type="text" class="form-control" name="atc_code" id="atc_code" value="" placeholder="" />
    </div>
  </div>

  <!-- packsize -->
  <div class="form-group">
    <label for="inputpacksize" class="col-sm-4 control-label">
      Packungsgroesse
    </label>
    <div class="col-sm-6">
      <input type="text" class="form-control" name="packsize" id="inputpacksize" value="<?php echo set_value('packsize'); ?>" placeholder=""/>
    </div>
  </div>

  <!-- PZN -->
  <div class="form-group">
    <label for="pzn" class="col-sm-4 control-label">
      PZN
    </label>
    <div class="col-sm-6">
      <input type="text" class="form-control" name="pzn" id="pzn" value="" placeholder="" disabled/>
    </div>
    <div class="col-sm-2">
       <button class="btn btn-primary" type="submit" disabled>Von packung scannen</button>
    </div>
  </div>

  <!-- manufacturer -->
  <div class="form-group">
    <label for="inputmanufacturer" class="col-sm-4 control-label">
      Hersteller/manufacturer
    </label>
    <div class="col-sm-6">
      <input type="text" class="form-control" name="manufacturer" id="inputmanufacturer" value="<?php echo set_value('manufacturer'); ?>" placeholder="manufacturer" />
    </div>
  </div>

  <!-- recent complains/problems -->
  <div class="col-md-12">
   <h4>Aktuelle Beschwerden (falls vorhanden)</h4>
  </div>
  <div class="form-group">
    <label for="comments" class="col-sm-4 control-label">
    </label>
    <div class="col-sm-8">
      <textarea class="form-control" rows="5" name="comments" id="comments" placeholder="Aktuelle Beschwerden (falls vorhanden)/ recent problems(if any)" ></textarea>
    </div>
  </div>

  <div class="col-md-12">
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-2">
          <button role="button" class="btn btn-success btn-block" type="submit" style="margin-bottom:15px;">submit</button>
        </div>
        <div class="col-sm-2">
          <button role="button" class="btn btn-danger btn-block" type="reset" style="margin-bottom:15px;">reset</button>
        </div>
      </div>
  </div>



 </div>
</div>  


</form>