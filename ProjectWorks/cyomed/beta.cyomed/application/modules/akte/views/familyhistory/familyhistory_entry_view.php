<?php
  $entry = !empty($entry) ? $entry : array(
    'id' => 0,
  );
  $entry = (object)$entry;
  $insert = empty($entry->id);
  $this->load->language('global/general_text',$this->m->user_value('language'));
  $this->load->language('patients/family_history', $this->m->user_value('language'));
 
?>
<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('akte/familyhistory/'.( !empty($insert) ? 'insert' : ('update/'.$entry->id) ) ); ?>" enctype="multipart/form-data" <?php echo !empty($readonly) ? 'data-readonly="readonly"' : ''; ?> <?php echo !empty($disabled) ? 'data-disabled="disabled"' : ''; ?> >
  <input type="hidden" name="id" value="<?php echo $entry->id ?>" />

  <?php if (!empty($static)) : ?>
    <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?> m-b-5">
      <h3 class="col-sm-3 control-label">
      <?php echo $this->lang->line('patients_familymember'); ?>
      </h3>
    </div>
  <?php endif; ?>

  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <label for="Handelsname<?php $entry->id; ?>" class="col-sm-3 control-label text-white"> 
      <?php echo $this->lang->line('patients_familyhistory_diseasename'); ?>
    </label>
    <div class="col-sm-9">
      <?php if (empty($static)): ?>
        <input type="text" class="form-control" name="disease_name" id="Disease_name<?php echo $entry->id; ?>" value="<?php echo !empty($entry->disease_name) ? form_prep($entry->disease_name) : ''; ?>" placeholder="<?php echo $this->lang->line('patients_familyhistory_diseasename'); ?>" required />
      <?php else : ?>
        <p class="form-control-static">
          <?php echo !empty($entry->disease_name) ? form_prep($entry->disease_name) : ''; ?> 
        </p>
      <?php endif; ?>
    </div>
  </div>

   <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <label for="symptoms<?php $entry->id; ?>" class="col-sm-3 control-label text-white"> 
      <?php echo $this->lang->line('patients_familyhistory_gender'); ?>
    </label>
    <div class="col-sm-9">
       
      <select  name="gender" id="gender<?php echo $entry->id; ?>"  data-placeholder="Gender" class="form-control input-sm">
        <option value="M"  >
          <?php echo $this->lang->line('patients_gender_male'); ?>
        </option>
        <option value="F" <?php echo ($entry->gender=='F')? 'selected="selected"' : ''; ?> >
          <?php echo $this->lang->line('patients_gender_female'); ?>
        </option>
         <option value="O" <?php echo ($entry->gender=='O') ? 'selected="selected"' : ''; ?> >
          <?php echo $this->lang->line('patients_gender_other'); ?>
        </option>
      </select>
        <?php

//        else
//        {
//            if($entry->gender=='M')
//            {
//                echo "Male";
//            }
//            elseif($entry->gender=='F')
//            {
//              echo "Female";  
//            }
//            elseif($entry->gender=='O')
//            {
//              echo "Other";  
//            }
//        }        
?>
    </div>
  </div>
  
  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>" style="clear:both;">
    <label class="col-sm-3 control-label text-white">
      <?php echo $this->lang->line('patients_familyhistory_dob'); ?>
    </label>
    <div class="col-sm-9">
      <?php if (empty($static)): ?>
        <div class="input-icon datetime-pick date-only">
          <input type="text" class="form-control input-sm" name="dateofbirth" data-format="dd.MM.yyyy" id="document_date<?php echo $entry->id; ?>" value="<?php echo date('d.m.Y', !empty($entry->dob) ? strtotime($entry->dob) : time()); ?>" placeholder="<?php echo $this->lang->line('patients_vaccination_card_date'); ?>" />
          <span class="add-on">
            <i class="sa-plus fa fa-calendar"></i>
          </span>
        </div>
      <?php else : ?>
        <p class="form-control-static"><?php echo !empty($entry->dob) ? date('d.m.Y', strtotime($entry->dob)) : ''; ?></p>
      <?php endif; ?>
    </div>
  </div>


  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <label class="col-sm-3 control-label text-white">
      <?php echo $this->lang->line('patients_familyhistroy_effectivetime'); ?>
    </label>
    <div class="col-sm-9">
      <?php if (empty($static)): ?>
        <div class="input-icon datetime-pick date-only">
          <input type="text" class="form-control input-sm" name="effecitvetime" data-format="dd.MM.yyyy" id="date<?php echo $entry->id; ?>" value="<?php echo date('d.m.Y', !empty($entry->effective_time) ? strtotime($entry->effective_time) : time()); ?>" placeholder="<?php echo $this->lang->line('patients_vaccination_card_reminder_on'); ?>" />
          <span class="add-on">
            <i class="sa-plus fa fa-calendar"></i>
          </span>
        </div>
      <?php else : ?>
        <p class="form-control-static"><?php echo !empty($entry->effective_time) ? date('d.m.Y', strtotime($entry->effective_time)) : ''; ?></p>
      <?php endif; ?>
    </div>
  </div>

 

  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <label for="Praxis<?php $entry->id; ?>" class="col-sm-3 control-label text-white"> 
      <?php echo $this->lang->line('patients_familyhistory_relationtopatient'); ?>
    </label>
    <div class="col-sm-9">
	
      <?php
$relation=      array("child","adopted child","adopted daughter","adopted son","child in-law","daughter in-law","son in-law","foster child","foster daughter","foster son","natural child","natural daughter","natural son","step child","stepdaughter","stepson","grandchild","granddaughter","grandson","Grandparent","Grandfather","Grandmother","great grandparent","great grandfather","great grandmother","niece/nephew","nephew","niece","Parent","natural parent","natural father","natural mother","parent in-law","father-in-law","mother-in-law","step parent","stepfather","stepmother","Father","Mother","Sibling","half-sibling","half-brother","half-sister","natural sibling","natural brother","natural sister","sibling in-law","brother-in-law","sister-in-law","step sibling","stepbrother","stepsister","Brother","Sister","significant other","spouse","husband","wife","aunt","cousin","domestic partner","Roomate","uncle","unrelated friend","neighbor");
//	  if (empty($entry->relation_to_patient)&& empty($static)): ?>
     <select id="relationtopatient"  name="relationtopatient" data-val-required="Select Relationship" data-val="true" class="select">
         <option value='0'>-Select Relationship-</option>
         <?php foreach($relation as $value) {
         echo "<option value='".$value."'".(($entry->relation_to_patient==$value)? "selected='selected'" : '').">$value</option>";
           
         }
?>
  
</select>
      <?php // else : ?>
<!--        <p class="form-control-static"><?php // echo !empty($entry->relation_to_patient) ? $entry->relation_to_patient : '-'; ?></p>-->
      <?php // endif; ?>
    </div>
  </div>
  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <label class="col-sm-3 control-label text-white">
      <?php echo $this->lang->line('patients_familyhistroy_dateofdeath'); ?>
    </label>
    <div class="col-sm-9">
      <?php if (empty($static)): ?>
        <div class="input-icon datetime-pick date-only">
          <input type="text" class="form-control input-sm" name="dateofdeath" data-format="dd.MM.yyyy" id="date<?php echo $entry->id; ?>" value="<?php echo  !empty($entry->dateofdeath) ? date('d.m.Y',strtotime($entry->dateofdeath)) : ''; ?>" placeholder="<?php echo $this->lang->line('patients_familyhistroy_dateofdeath'); ?>" />
          <span class="add-on">
            <i class="sa-plus fa fa-calendar"></i>
          </span>
        </div>
      <?php else : 
	 ?>
        <p class="form-control-static"><?php echo ($entry->dateofdeath!='0000-00-00 00:00:00') ? date('d.m.Y', strtotime($entry->dateofdeath)) : '-'; ?></p>
      <?php endif; ?>
    </div>
  </div>

  
  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <div class="col-sm-12 text-right">
    
      <?php if (!empty($insert) && $insert && empty($hide_insert)) : ?>
        <button class="btn btn-alt btn-lg" type="submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?></button>
      <?php endif; ?>

      <?php if (!empty($update_btn) && $update_btn && empty($hide_insert)) : ?>
        <button class="btn btn-alt btn-lg" type="submit"><span class="icomoon i-loop-4"></span> <?php echo $this->lang->line('general_text_button_update'); ?></button>
      <?php endif; ?>

      <?php if (!empty($confirm_btn) && $confirm_btn && empty($hide_insert)) : ?>
        <button class="btn btn-alt btn-lg" type="button" data-submit-location="<?php echo site_url('akte/vaccination/confirm/'.$entry->id); ?>" ><span class="icomoon i-signup"></span>
          <?php echo $this->lang->line('pwidget_diagnosis_confirmed_button'); ?>
        </button>
      <?php endif; ?>

      <?php if (!empty($delete_btn) && $delete_btn && empty($hide_insert)) : ?>
        <button class="btn btn-alt btn-lg" type="button" data-submit-location="<?php echo site_url('akte/vaccination/delete/'.$entry->id); ?>" ><span class="icomoon i-remove-2"></span> 
          <?php echo $this->lang->line('general_text_button_delete'); ?>
        </button>
      <?php endif; ?>
    </div>
  </div>

</form>
<?php if(!empty($static))
{?>
<div class="read-more"><a href="<?php echo site_url('/akte/familyhistory'); ?>" class="ajax-load-link">Details</a>&nbsp;<span class="fa fa-chevron-right fa-right"></span></div>
<?php }
?>
    <script type="text/javascript">
   $('.ajax-load-link').click(function(e) 
         {
            
          e.preventDefault();
          if ($(this).attr('href').indexOf('javascript:') < 0)
          $.loadUrl($(this).attr('href'), $('#content'));
           
          
       });
 </script>