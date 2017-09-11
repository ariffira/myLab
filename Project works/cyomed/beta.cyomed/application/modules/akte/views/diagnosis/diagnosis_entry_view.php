<?php
  $entry = !empty($entry) ? $entry : array(
    'id' => 0,
  );

  $entry = (object)$entry;

  $insert = empty($entry->id);

  $this->load->language('pwidgets/diagnosis', $this->m->user_value('language'));
  $this->load->language('global/general_text', $this->m->user_value('language'));

?>

<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('akte/diagnosis/'.( !empty($insert) ? 'insert' : ('update/'.$entry->id) ) ); ?>" enctype="multipart/form-data" <?php echo !empty($readonly) ? 'data-readonly="readonly"' : ''; ?> <?php echo !empty($disabled) ? 'data-disabled="disabled"' : ''; ?> >
  <input type="hidden" name="id" value="<?php echo $entry->id ?>" />

  <?php if (isset($entry->entry_from)) : ?>
    <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
      <?php if ($entry->entry_from == 0) : ?>
        <h3 class="col-sm-3 control-label">
         <?php echo $this->lang->line('pwidget_diagnosis_diagnosis'); ?>
        </h3>
      <?php elseif ($entry->entry_from == 1) : ?>
        <h3 class="col-sm-3 control-label">
         <?php echo $this->lang->line('pwidget_diagnosis_travel_diagnosis'); ?>  
        </h3>
      <?php endif; ?>
    </div>
  <div class="form-group m-b-5">
      <span  class="font-format">
         <?php if(!empty($entry->added_by))
         {
            echo $this->lang->line('general_addedby');
             ?>
          <?php echo ($entry->user_role=='role_doctor')? 'Doctor':'Patient';?> 
          <?php $res=$this->m->user_details($entry->added_by,$entry->user_role); 
           echo $res->name."&nbsp;".$res->regid; 
       ?> <?php echo $this->lang->line('general_on');?> <?php echo date('d. M .Y',strtotime($entry->date_added));?>
       <?php } ?>
      </span>
  </div>
  <?php endif; ?>

  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>" style="clear:both;" >
    <label for="disease_name<?php echo $entry->id; ?>" class="col-sm-3 control-label text-white">
      <?php echo $this->lang->line('pwidget_diagnosis_diagnosis'); ?>
    </label>
    <div class="col-sm-9">
      <?php if (empty($static)) : ?>
        <input type="text" class="form-control" name="disease_name" id="disease_name<?php echo $entry->id; ?>"  value="<?php echo !empty($entry->title) ? form_prep($entry->title) : ''; ?>" placeholder=" <?php echo $this->lang->line('pwidget_diagnosis_diagnosis'); ?> " required/>
      <?php else: ?>
        <p class="form-control-static"><?php echo !empty($entry->title) ? $entry->title : ''; ?></p>
      <?php endif; ?>
    </div>
  </div>

  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <label for="icd_code<?php echo $entry->id; ?>" class="col-sm-3 control-label text-white">
      <?php echo $this->lang->line('pwidget_diagnosis_icd_code');  ?>
    </label>
    <div class="col-sm-9">
      <?php if (empty($static)) : ?>
        <input type="text" class="form-control" name="icd_code" id="icd_code<?php echo $entry->id; ?>"  value="<?php echo !empty($entry->icd_code) ? form_prep($entry->icd_code) : ''; ?>" placeholder=" <?php echo $this->lang->line('pwidget_diagnosis_icd_code'); ?>" />
      <?php else: ?>
        <p class="form-control-static"><?php echo !empty($entry->icd_code) ? $entry->icd_code : ''; ?></p>
      <?php endif; ?>
    </div>
  </div>

  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <label for="condition<?php echo $entry->id; ?>" class="col-sm-3 control-label text-white">
      <?php echo $this->lang->line('pwidget_diagnosis_extra_diagnosis'); ?>
    </label>
    <div class="col-sm-9">
      <?php if (empty($static)) : ?>
        <textarea class="form-control" rows="5" name="condition" id="condition<?php echo $entry->id; ?>" placeholder=" <?php echo $this->lang->line('pwidget_diagnosis_extra_diagnosis'); ?>" ><?php echo !empty($entry->description) ? form_prep($entry->description) : ''; ?></textarea>
      <?php else: ?>
        <p class="form-control-static" style="word-break: break-all;"><?php echo !empty($entry->description) ? $entry->description : ''; ?></p>
      <?php endif; ?>
    </div>
  </div>
 <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <label for="" class="col-sm-3 control-label text-white">
      <?php echo $this->lang->line('pwidget_diagnosis_diagnosis_date'); ?>
    </label>
    <div class="col-sm-9">
      <?php if (empty($static)) : ?>
        <div class="input-icon datetime-pick date-only">
          <input type="text" class="form-control input-sm" name="document_date" data-format="dd.MM.yyyy" id="document_date<?php echo $entry->id; ?>" value="<?php echo date('d.m.Y', !empty($entry->document_date) ? strtotime($entry->document_date) : time()); ?>" placeholder="<?php echo $this->lang->line('pwidget_diagnosis_diagnosis_date'); ?>" />
          <span class="add-on">
            <i class="fa fa-calendar"></i>
          </span>
        </div>
      <?php else: ?>
        <p class="form-control-static"><?php echo date('d.m.Y', !empty($entry->document_date) ? strtotime($entry->document_date) : time()); ?></p>
      <?php endif; ?>
    </div>
  </div>

  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <label for="document_upload<?php echo $entry->id; ?>" class="col-sm-3 control-label text-white">
      <?php echo $this->lang->line('pwidget_diagnosis_file_upload'); ?>
    </label>
    <div class="col-sm-9">

      <?php if (empty($static)) : ?>
        <input type="file" name="document_upload" id="document_upload<?php echo $entry->id; ?>" class="form-control input-sm" />
      <?php endif; ?>

      <?php if (isset($entry->files) && is_array($entry->files) && count($entry->files) > 0) : ?>
        <p class="help-block">
          <table class="tile table table-condensed table-striped">
            <?php foreach ($entry->files as $file) : ?>
              <tr>
                <td class="text-center" style="vertical-align:middle;">
                  <a href="<?php echo base_url($this->mdoc->get_file_path($file)); ?>" target="_blank" class="<?php echo Ui::$bs_tname == 'sa103' ? 'text-white' : ''; ?>">
                    <?php if (in_array(strtolower($file->document_extension), array('jpg', 'png', 'jpeg', 'gif', 'tif', ))) : ?>
                      <?php if (file_exists($this->mdoc->get_file_path($file))) : ?>
                        <img src="<?php echo base_url('assets/php/image_php/image_php.php'); ?>?width=66&height=138&cropratio=10:9&image=<?php echo base_url($this->mdoc->get_file_path($file)); ?>" />
                      <?php else : ?>
                        <span class="icomoon icon32 i-image-2"></span>
                      <?php endif; ?>
                    <?php endif; ?>
                    <?php if (strtolower($file->document_extension) == 'pdf') : ?>
                      <span class="icomoon icon32 i-file-pdf"></span>
                    <?php endif; ?>
                    <?php if (strtolower($file->document_extension) == 'doc' || strtolower($file->document_extension) == 'docx') : ?>
                      <span class="icomoon icon32 i-file-word"></span>
                    <?php endif; ?>
                    <?php if (strtolower($file->document_extension) == 'odt') : ?>
                      <span class="icomoon icon32 i-files"></span>
                    <?php endif; ?>
                  </a>
                </td>
                <td class="text-center" style="vertical-align:middle;">
                  <a href="<?php echo base_url($this->mdoc->get_file_path($file)); ?>" target="_blank" class="<?php echo Ui::$bs_tname == 'sa103' ? 'text-white' : ''; ?>">
                    <?php echo Ui::$bs_tname == 'sa103' ? $this->ui->title->options('class', 'page-title')->content($file->document_caption)->output() : ''; ?>
                    <?php echo Ui::$bs_tname == 'mvpr110' ? $file->document_caption : ''; ?>
                  </a>
                </td>
                <td class="text-center" style="vertical-align:middle;">
                  <a href="<?php echo site_url('akte/diagnosis/remove_file/'.$file->entry_id); ?>">
                    <span class="icomoon i-remove-2 icon16" style="<?php echo Ui::$bs_tname == 'sa103' ? 'color:white;' : ''; ?>"></span>
                  </a>
                </td>
<!--                <td class="text-center" style="vertical-align:middle;">
                  <a href="<?php // echo site_url('akte/document/edit/'.$file->id); ?>">
                    <span class="icomoon i-pencil-6 icon16" style="<?php echo Ui::$bs_tname == 'sa103' ? 'color:white;' : ''; ?>"></span>
                  </a>
                </td>-->
              </tr>
            <?php endforeach; ?>
          </table>
        </p>
      <?php endif; ?>

      <?php if (empty($static)) : ?>
        <p class="help-block">
          <small>
            <?php echo $this->lang->line('pwidget_diagnosis_file_type'); ?>
          </small>
        </p>
      <?php endif; ?>
    </div>
  </div>

  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <label for="allergy<?php echo $entry->id; ?>" class="col-sm-3 control-label text-white">
      <?php echo $this->lang->line('pwidget_diagnosis_allergey_check'); ?>
    </label>
    <div class="col-sm-9">
      <div class="radio-inline">
        <label>
          <input type="checkbox" value="1" id="allergy<?php echo $entry->id; ?>" name="allergy" <?php echo !empty($entry->allergy) && $entry->allergy == '1' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> />
          <?php echo $this->lang->line('pwidget_diagnosis_allergey_check'); ?>
        </label>
      </div>
    </div>
  </div>

  <?php if ($this->m->user_role() == M::ROLE_PATIENT) : ?>
    <?php $this->load->language('patients/all_access', $this->m->user_value('language')); ?>
    <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
      
        
        <label class="col-sm-3 control-label text-white">
        <?php echo $this->lang->line('patients_all_access_page_title'); ?>
      </label>
      <div class="col-sm-9">
        <div class="radio-inline">
          <label>
            <input type="radio" value="1" id="access1_<?php echo $entry->id; ?>" name="access" <?php echo isset($entry->access_permission) && $entry->access_permission == '1' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> />
            <?php echo $this->lang->line('patients_all_accesss_my_doctor'); ?>
          </label>
        </div>
        <div class="radio-inline">
          <label>
            <input type="radio" value="2" id="access2_<?php echo $entry->id; ?>" name="access" <?php echo isset($entry->access_permission) && $entry->access_permission == '2' ? 'checked="checked"' :($insert)?'checked="checked"':""; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> />
            <?php echo $this->lang->line('patients_all_accesss_all_doctor'); ?> 
          </label>
        </div>
        <div class="radio-inline">
          <label>
            <input type="radio" value="0" id="access0_<?php echo $entry->id; ?>" name="access" <?php echo isset($entry->access_permission) && $entry->access_permission == '0' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> />
            <?php echo $this->lang->line('patients_all_access_private_mode'); ?>
          </label>
        </div>
        <?php if (empty($static)) : ?>
          <p class="help-block">
            <span style="color:red;">*</span>
            <?php echo $this->lang->line('patients_all_access_selection_info'); ?>
          </p>
        <?php endif; ?>
      </div>
    </div>
  <?php endif; ?>
  <?php if (!empty($entry->entry_from) || $insert) : ?>

    <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
      <label for="entry_from<?php echo $entry->id; ?>" class="col-sm-3 control-label text-white">
        Reisediagnose
      </label>
      <div class="col-sm-9">
        <div class="radio-inline">
          <label>
            <input type="checkbox" value="1" id="entry_from<?php echo $entry->id; ?>" name="entry_from" <?php echo !empty($entry->entry_from) && $entry->entry_from == '1' ? 'checked="checked"' : ''; ?> data-toggle="toggle" data-toggle-target="#countryGroup<?php echo $entry->id; ?>, #startDateGroup<?php echo $entry->id; ?>, #endDateGroup<?php echo $entry->id; ?>" <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> />
            Reisediagnose
          </label>
        </div>
      </div>
    </div>

    <div class="form-group form-group-no-hide" id="countryGroup<?php echo $entry->id; ?>">
      <label for="country<?php echo $entry->id; ?>" class="col-sm-3 control-label  text-white">
         <?php echo $this->lang->line('pwidget_diagnosis_travel_country'); ?>
      </label>
      <div class="col-sm-9">
        <?php if (empty($static)) : ?>
          <select type="text" name="country" id="country<?php echo $entry->id; ?>" class="select" >
            <option value="">
              <?php echo $this->lang->line('pwidget_diagnosis_travel_country_choose'); ?>
            </option>
            <?php foreach ($this->country->get()->result() as $c) : ?>
              <option value="<?php echo $c->id; ?>" <?php echo !empty($entry->country_id) && $c->id == $entry->country_id ? 'selected="selected"' : '' ?> > <?php echo $c->country_name; ?></option>
            <?php endforeach; ?>
          </select>
        <?php else: ?>
          <p class="form-control-static">
            <?php foreach ($this->country->get()->result() as $c) : ?>
              <?php echo !empty($entry->country_id) && $c->id == $entry->country_id ? $c->country_name : ''; ?>
            <?php endforeach; ?>
          </p>
        <?php endif; ?>
      </div>
    </div>

    <div class="form-group" id="startDateGroup<?php echo $entry->id; ?>">
      <label for="" class="col-sm-3 control-label  text-white">
        <?php echo $this->lang->line('pwidget_diagnosis_travel_begin'); ?>
      </label>
      <div class="col-sm-9">
        <?php if (empty($static)) : ?>
          <div class="input-icon datetime-pick diagnosis_startdate">
            <input type="text" class="form-control input-sm" name="start_date" data-format="dd.MM.yyyy" id="start_date<?php echo $entry->id; ?>" value="<?php echo date('d.m.Y', !empty($entry->document_date) ? strtotime($entry->document_date) : time()); ?>  " placeholder="<?php echo $this->lang->line('pwidget_diagnosis_diagnosis_date'); ?>" />
            <span class="add-on">
              <i class="fa fa-calendar"></i>
            </span>
          </div>
        <?php else: ?>
          <p class="form-control-static"><?php echo date('d.m.Y', !empty($entry->start_date) ? strtotime($entry->start_date) : time()); ?></p>
        <?php endif; ?>
      </div>
    </div>

    <div class="form-group" id="endDateGroup<?php echo $entry->id; ?>">
      <label for="" class="col-sm-3 control-label  text-white">
        <?php echo $this->lang->line('pwidget_diagnosis_travel_end'); ?>
      </label>
      <div class="col-sm-9">
        <?php if (empty($static)) : ?>
          <div class="input-icon datetime-pick diagnosis_enddate">
            <input type="text" class="form-control input-sm" name="end_date" data-format="dd.MM.yyyy" id="end_date<?php echo $entry->id; ?>" value="" placeholder="<?php echo $this->lang->line('pwidget_diagnosis_diagnosis_date'); ?>" />
            <span class="add-on">
              <i class="fa fa-calendar"></i>
            </span>
          </div>
        <?php else: ?>
          <p class="form-control-static"><?php echo date('d.m.Y', !empty($entry->end_date) ? strtotime($entry->end_date) : time()); ?></p>
        <?php endif; ?>
      </div>
    </div>

  <?php endif; ?>

 

  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <div class="col-sm-12 text-right">
    
      <?php if (isset($insert) && $insert && empty($hide_insert)) : ?>
        <button class="btn btn-alt btn-lg" type="submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?></button>
      <?php endif; ?>

      <?php if (isset($update_btn) && $update_btn && empty($hide_insert)) : ?>
        <button class="btn btn-alt btn-lg" type="submit"><span class="icomoon i-loop-4"></span> <?php echo $this->lang->line('general_text_button_update'); ?></button>
      <?php endif; ?>

      <?php if (isset($emergency_btn) && $emergency_btn && empty($hide_insert)) : ?>
        <button class="btn btn-alt btn-lg" type="button" data-submit-location="<?php echo site_url('akte/diagnosis/emergency/'.$entry->id); ?>" ><span class="icomoon i-aid"></span>
          <?php echo $this->lang->line('pwidget_diagnosis_emergency_button'); ?>
        </button>
      <?php endif; ?>

      <?php if (isset($confirm_btn) && $confirm_btn && empty($hide_insert)) : ?>
        <button class="btn btn-alt btn-lg" type="button" data-submit-location="<?php echo site_url('akte/diagnosis/confirm/'.$entry->id); ?>" ><span class="icomoon i-signup"></span>
          <?php echo $this->lang->line('pwidget_diagnosis_confirmed_button'); ?>
        </button>
      <?php endif; ?>

      <?php if (isset($archive_btn) && $archive_btn && empty($hide_insert)) : ?>
        <button class="btn btn-alt btn-lg" type="button" data-submit-location="<?php echo site_url('akte/diagnosis/archive/'.$entry->id); ?>" ><span class="icomoon i-drawer-3"></span> 
         <?php echo $this->lang->line('pwidget_diagnosis_archieve_button'); ?>
        </button>
      <?php endif; ?>
      <!--
      <?php if (isset($delete_btn) && $delete_btn && empty($hide_insert)) : ?>
        <button class="btn btn-alt btn-lg" type="button" data-submit-location="<?php echo site_url('akte/diagnosis/delete/'.$entry->id); ?>" ><span class="icomoon i-remove-2"></span> 
          <?php echo $this->lang->line('general_text_button_delete'); ?>
        </button>
      <?php endif; ?>
    -->
    </div>
  </div>
</form>
<?php if(!empty($static))
{?>
 <div class="read-more"><div class="pull-left">
      <span  class="font-format font12">
        <?php if(!empty($entry->added_by))
         {
          echo $this->lang->line('general_addedby');
         ?>
         <?php echo ($entry->user_role=='role_doctor')? 'Doctor':'Patient';?> 

          <?php $res=$this->m->user_details($entry->added_by,$entry->user_role); 

           echo $res->name."&nbsp;".$res->regid; 

       ?> <?php echo $this->lang->line('general_on');?> <?php echo date('d. M .Y',strtotime($entry->date_added));?>

       <?php } ?>

      </span>

  </div><div class="pull-left">
      <span  class="font-format font12">
        <?php if(!empty($entry->added_by))
         {
          echo $this->lang->line('general_addedby');
         ?>
         <?php echo ($entry->user_role=='role_doctor')? 'Doctor':'Patient';?> 

          <?php $res=$this->m->user_details($entry->added_by,$entry->user_role); 

           echo $res->name."&nbsp;".$res->regid; 

       ?> <?php echo $this->lang->line('general_on');?> <?php echo date('d. M .Y',strtotime($entry->date_added));?>

       <?php } ?>

      </span>

  </div><a href="<?php echo site_url('/akte/diagnosis'); ?>" class="ajax-load-link">Details</a>&nbsp;<span class="fa fa-chevron-right fa-right"></span></div>
<?php }
?>
<script>
   
</script>