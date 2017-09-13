<?php
  $entry = !empty($entry) ? $entry : array(
    'id' => 0,
  );
  $entry = (object)$entry;
  $insert = empty($entry->id);
  $this->load->language('global/general_text',$this->m->user_value('language'));
  $this->load->language('patients/family_history', $this->m->user_value('language'));
 
?>
 <div class="blog-block blog-blue">
 <div class="date-block"><div class="date-meta"><?php echo date('d',strtotime($entry->effective_time));?>. <span><?php echo date('M',strtotime($entry->effective_time));?></span></div></div>
  <div class="blog-text">
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
	    <p class="form-control-static">
        <?php
        	switch ($entry->gender) {
        		case 'M': 	echo "Male"; break;
        		case 'F': 	echo "Female"; break;
        		case 'O': 	echo "Other"; break;
        		default: 	echo '';break;
        	}
		?>
		</p>
    </div>
  </div>
  
  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <label for="document_date<?php echo $entry->id; ?>" class="col-sm-3 control-label text-white">
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
    <label for="date<?php echo $entry->id; ?>" class="col-sm-3 control-label text-white">
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
	  if (empty($entry->relation_to_patient)&& empty($static)): ?>
     <select id="relationtopatient"  name="relationtopatient" data-val-required="Select Relationship" data-val="true">
<option value='0'>-Select Relationship-</option>
<option value="child">child</option>
<option value="adopted child">adopted child</option>
<option value="adopted daughter">adopted daughter</option>
<option value="adopted son">adopted son</option>
<option value="child in-law">child in-law</option>
<option value="daughter in-law">daughter in-law</option>
<option value="son in-law">son in-law</option>
<option value="foster child">foster child</option>
<option value="foster daughter">foster daughter</option>
<option value="foster son">foster son</option>
<option value="natural child">natural child</option>
<option value="natural daughter">natural daughter</option>
<option value="natural son">natural son</option>
<option value="step child">step child</option>
<option value="stepdaughter">stepdaughter</option>
<option value="stepson">stepson</option>
<option value="grandchild">grandchild</option>
<option value="granddaughter">granddaughter</option>
<option value="grandson">grandson</option>
<option value="Grandparent">Grandparent</option>
<option value="Grandfather">Grandfather</option>
<option value="Grandmother">Grandmother</option>
<option value="great grandparent">great grandparent</option>
<option value="great grandfather">great grandfather</option>
<option value="great grandmother">great grandmother</option>
<option value="niece/nephew">niece/nephew</option>
<option value="nephew">nephew</option>
<option value="niece">niece</option>
<option value="Parent">Parent</option>
<option value="natural parent">natural parent</option>
<option value="natural father">natural father</option>
<option value="natural mother">natural mother</option>
<option value="parent in-law">parent in-law</option>
<option value="father-in-law">father-in-law</option>
<option value="mother-in-law">mother-in-law</option>
<option value="step parent">step parent</option>
<option value="stepfather">stepfather</option>
<option value="stepmother">stepmother</option>
<option value="Father">Father</option>
<option value="Mother">Mother</option>
<option value="Sibling">Sibling</option>
<option value="half-sibling">half-sibling</option>
<option value="half-brother">half-brother</option>
<option value="half-sister">half-sister</option>
<option value="natural sibling">natural sibling</option>
<option value="natural brother">natural brother</option>
<option value="natural sister">natural sister</option>
<option value="sibling in-law">sibling in-law</option>
<option value="brother-in-law">brother-in-law</option>
<option value="sister-in-law">sister-in-law</option>
<option value="step sibling">step sibling</option>
<option value="stepbrother">stepbrother</option>
<option value="stepsister">stepsister</option>
<option value="Brother">Brother</option>
<option value="Sister">Sister</option>
<option value="significant other">significant other</option>
<option value="spouse">spouse</option>
<option value="husband">husband</option>
<option value="wife">wife</option>
<option value="aunt">aunt</option>
<option value="cousin">cousin</option>
<option value="domestic partner">domestic partner</option>
<option value="Roomate">Roomate</option>
<option value="uncle">uncle</option>
<option value="unrelated friend">unrelated friend</option>
<option value="neighbor">neighbor</option>
</select>
      <?php else : ?>
        <p class="form-control-static"><?php echo !empty($entry->relation_to_patient) ? $entry->relation_to_patient : '-'; ?></p>
      <?php endif; ?>
    </div>
  </div>
  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <label for="date<?php echo $entry->id; ?>" class="col-sm-3 control-label text-white">
      <?php echo $this->lang->line('patients_familyhistroy_dateofdeath'); ?>
    </label>
    <div class="col-sm-9">
      <?php if (empty($static)): ?>
        <div class="input-icon datetime-pick date-only">
          <input type="text" class="form-control input-sm" name="dateofdeath" data-format="dd.MM.yyyy" id="date<?php echo $entry->id; ?>" value="<?php echo !empty($entry->dateofdeath) ? date('d.m.Y',strtotime($entry->dateofdeath)) : ''; ?>" placeholder="<?php echo $this->lang->line('patients_familyhistroy_dateofdeath'); ?>" />
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
<div class="read-more"><a href="<?php echo site_url('/akte/familyhistory/index/'.$entry->id); ?>" class="ajax-load-link<?php echo $entry->id ?>">Details</a>&nbsp;<span class="fa fa-chevron-right fa-right"></span></div>
<?php }
?>
</div>
 </div>
    <script type="text/javascript">
   $('.ajax-load-link<?php echo $entry->id ?>').click(function(e) 
         {
            
          e.preventDefault();
          if ($(this).attr('href').indexOf('javascript:') < 0)
          $.loadUrl($(this).attr('href'), $('#content'));
           
          
       });
 </script>