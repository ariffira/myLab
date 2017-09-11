<?php
  $data = !empty($data) ? $data : array(
    'id' => 0,
  );

  $data = (object)$data;

  $insert = empty($data->id);

?>
<?php //echo $id; ?>
<div class="row" style="padding-top:10px;">
  <div class="col-md-12">
   <h4>Willkommen beim Online Versceibungsmodel fuer Medikamente von Cyomed</h4>
   <h3>Gewuenchte(s) Medikament(e)</h3>
  </div>
</div>


<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('eprescription/epres/update/'.$data->id); ?>" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $data->id ?>" />
<div class="row">
 <div class="col-md-6">

 <!-- Followup -->
  <div class="form-group">
    <label for="inputfollow_up<?php echo $data->id; ?>" class="col-sm-4 control-label">Folgerezept/Followup <span class="text-danger">*</span></label>
    <div class="col-sm-6">
      <select type="text" class="select" name="follow_up" id="inputfollow_up">
        <option value="yes"  <?php echo $data->follow_up == 'Ja' ?  'selected="selected"' : ''; ?> >Ja</option>
        <option value="no" <?php echo $data->follow_up == 'no' ? 'selected="selected"' : ''; ?> >Nein</option>
      </select>
    </div>
  </div>

 <!-- Handelsname -->
  <div class="form-group">
    <label for="inputHandelsname<?php echo $data->id; ?>" class="col-sm-4 control-label">Handelsname <span class="text-danger">*</span></label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="Handelsname" id="inputHandelsname<?php echo $data->id; ?>" value="<?php echo $data->Handelsname; ?>" placeholder="Handelsname"  />
    </div>
  </div>

 <!-- Drug -->
  <div class="form-group">
    <label for="inputdrug<?php echo $data->id; ?>" class="col-sm-4 control-label">Wirkstoffbezeinung <span class="text-danger">*</span></label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="drug" id="inputdrug<?php echo $data->id; ?>" value="<?php echo $data->drug; ?>" placeholder="drug"  />
    </div>
  </div>

  <!-- Atc -->
  <div class="form-group">
    <label for="atc_code<?php echo $data->id; ?>" class="col-sm-4 control-label">
      ATC code(falls bekannt)
    </label>
    <div class="col-sm-6">
     <input type="text" class="form-control" name="atc_code" id="atc_code<?php echo $data->id; ?>" value="<?php echo $data->atc_code; ?>" placeholder="" />
    </div>
  </div>

  <!-- packsize -->
  <div class="form-group">
    <label for="inputpacksize<?php echo $data->id; ?>" class="col-sm-4 control-label">
      Packungsgroesse
    </label>
    <div class="col-sm-6">
      <input type="text" class="form-control" name="packsize" id="inputpacksize<?php echo $data->id; ?>" value="<?php echo $data->packsize; ?>" placeholder=""/>
    </div>
  </div>

  <!-- PZN -->
  <div class="form-group">
    <label for="pzn<?php echo $data->id; ?>" class="col-sm-4 control-label">
      PZN
    </label>
    <div class="col-sm-6">
      <input type="text" class="form-control" name="pzn" id="pzn<?php echo $data->id; ?>" value="" placeholder="" disabled/>
    </div>
    <div class="col-sm-2">
       <button class="btn btn-primary" type="submit" disabled>Von packung scannen</button>
    </div>
  </div>

  <!-- manufacturer -->
  <div class="form-group">
    <label for="inputmanufacturer<?php echo $data->id; ?>" class="col-sm-4 control-label">
      Hersteller/manufacturer
    </label>
    <div class="col-sm-6">
      <input type="text" class="form-control" name="manufacturer" id="inputmanufacturer<?php echo $data->id; ?>" value="<?php echo $data->manufacturer; ?>" placeholder="manufacturer" />
    </div>
  </div>

  <!-- recent complains/problems -->
  <div class="col-md-12">
   <h4>Aktuelle Beschwerden (falls vorhanden)</h4>
  </div>
  <div class="form-group">
    <label for="comments<?php echo $data->id; ?>" class="col-sm-4 control-label">
    </label>
    <div class="col-sm-8">
      <textarea class="form-control" rows="5" name="comments" id="comments<?php echo $data->id; ?>" placeholder="Aktuelle Beschwerden (falls vorhanden)/ recent problems(if any)" ><?php echo $data->comments; ?></textarea>
    </div>
  </div>

  <div class="col-md-12">
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-4">
          <button role="button" class="btn btn-success btn-block" type="submit" style="margin-bottom:15px;">Korrigieren/update</button>
        </div>
        <div class="col-sm-4">
          <!--will go next part of the eprescription as questions -->
          <a href="<?php echo site_url('ePrescription/sickness_view'); ?>" class="btn btn-danger" role="button">Fortfahren/continue</a>
        </div>
      </div>
  </div>



 </div>
</div>  


</form>

<script>
    $.pageSetup($('#content'));
</script>