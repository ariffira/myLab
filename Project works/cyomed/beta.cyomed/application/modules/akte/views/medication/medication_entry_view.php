<?php
  if(isset($entry)){
    $entry->taken_time = !empty($entry) ? explode(',', $entry->taken_time):'';
  }
  $entry = !empty($entry) ? $entry : array(
    'id' => 0,
    'taken_time' => '',
  );
  $entry = (object)$entry;
  $insert = empty($entry->id);
  $this->load->language('global/general_text',$this->m->user_value('language'));
  $this->load->language('pwidgets/medication', $this->m->user_value('language'));
?>
<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('akte/medication/'.( !empty($insert) ? 'insert' : ('update/'.$entry->id) ) ); ?>" enctype="multipart/form-data" <?php echo !empty($readonly) ? 'data-readonly="readonly"' : ''; ?> <?php echo !empty($disabled) ? 'data-disabled="disabled"' : ''; ?> >
  <input type="hidden" name="id" value="<?php echo $entry->id ?>" />
   <?php if (!empty($static)) : ?>
    <div class="form-group m-b-5">
      <h3 class="col-sm-3 control-label">Medikamente</h3>
    </div>
     <div style="clear:both;" class="form-group m-b-5">
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
   <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <label for="name<?php echo $entry->id; ?>" class="col-md-3 col-sm-4 control-label text-white">
      <?php echo $this->lang->line('pwidget_medication_name'); ?>
    </label>
    <div class="col-md-9 col-sm-8">
      <?php if (empty($static)) : ?>
        <input type="text" class="form-control" name="name" id="name<?php echo $entry->id; ?>" value="<?php echo !empty($entry->name) ? form_prep($entry->name) : ''; ?>" placeholder="<?php echo $this->lang->line('pwidget_medication_name'); ?>" />
      <?php else : ?>
        <p class="form-control-static"><?php echo !empty($entry->name) ? $entry->name : ''; ?></p>
      <?php endif; ?>
    </div>
  </div>
  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <label for="atc_code<?php echo $entry->id; ?>" class="col-md-3 col-sm-4 control-label text-white">
     <?php echo $this->lang->line('pwidget_medication_atc_code'); ?>
    </label>
    <div class="col-md-9 col-sm-8">
      <?php if (empty($static)) : ?>
        <input type="text" class="form-control" name="atc_code" id="atc_code<?php echo $entry->id; ?>" value="<?php echo !empty($entry->atc_code) ? form_prep($entry->atc_code) : ''; ?>" placeholder="<?php echo $this->lang->line('pwidget_medication_atc_code'); ?>" />
      <?php else : ?>
        <p class="form-control-static"><?php echo !empty($entry->atc_code) ? $entry->atc_code : ''; ?></p>
      <?php endif; ?>
    </div>
  </div>
  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <label for="substance<?php echo $entry->id; ?>" class="col-md-3 col-sm-4 control-label text-white">
      <?php echo $this->lang->line('pwidget_medication_substance'); ?>
    </label>
    <div class="col-md-9 col-sm-8">
      <?php if (empty($static)) : ?>
        <input type="text" class="form-control" name="substance" id="substance<?php echo $entry->id; ?>" value="<?php echo !empty($entry->substance) ? form_prep($entry->substance) : ''; ?>" placeholder="<?php echo $this->lang->line('pwidget_medication_substance'); ?>" />
      <?php else : ?>
        <p class="form-control-static"><?php echo !empty($entry->substance) ? $entry->substance : ''; ?></p>
      <?php endif; ?>
    </div>
  </div>

  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <label for="dose_rate<?php echo $entry->id; ?>" class="col-md-3 col-sm-4 control-label text-white">
     <?php echo $this->lang->line('pwidget_medication_dose_rate'); ?>
    </label>
    <div class="col-md-9 col-sm-8">
      <?php if (empty($static)) : ?>
        <input type="text" class="form-control" name="dose_rate" id="dose_rate<?php echo $entry->id; ?>" value="<?php echo !empty($entry->dose_rate) ? form_prep($entry->dose_rate) : ''; ?>" placeholder="<?php echo $this->lang->line('pwidget_medication_dose_rate'); ?>" />
      <?php else : ?>
        <p class="form-control-static"><?php echo !empty($entry->dose_rate) ? $entry->dose_rate : ''; ?></p>
      <?php endif; ?>
    </div>
  </div>

  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <label class="col-md-3 col-sm-4 control-label text-white">
     <?php echo $this->lang->line('pwidget_medication_taking_title'); ?>
    </label>
    <div class="col-md-9 col-sm-8">
      <div class="checkbox">
        <label>
          <div class="checkbox_box">
            <input type="checkbox" value="1" id="taking_regularly<?php echo $entry->id; ?>" name="taking_regularly" <?php echo !empty($entry->taking_regularly) ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> />
            <label for="taking_regularly<?php echo $entry->id; ?>"></label>
            <div class="text-white">
             <?php echo $this->lang->line('pwidget_medication_taking_regularly'); ?>
            </div>
          </div>
        </label>
      </div>
      <div class="checkbox">
        <label>
          <div class="checkbox_box">
            <input type="checkbox" value="1" id="taking_needed<?php echo $entry->id; ?>" name="taking_needed" <?php echo !empty($entry->taking_needed) ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> />
            <label for="taking_needed<?php echo $entry->id; ?>"></label>
            <div class="text-white">
              <?php echo $this->lang->line('pwidget_medication_taking_needed'); ?>
            </div>
          </div>
        </label>
      </div>
    </div>
  </div>

  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <label for="taken_time<?php echo $entry->id; ?>" class="col-md-3 col-sm-4 control-label text-white">
      <?php echo $this->lang->line('pwidget_medication_times_taken'); ?>
    </label>
    <div class="col-sm-8">
    <?php if (empty($static)) : ?>
      <select  data-placeholder="<?php echo $this->lang->line('pwidget_medication_taken_time'); ?>"  type="text" name="taken_time[]" id="taken_time<?php echo $entry->id; ?>" class="tag-select" multiple="multiple">
        <?php for($i=0;$i<24;$i++):?>
          <?php for($j=0;$j<60;$j=$j+5):?>
            <option value="<?php echo (($i<10)?'0'.$i:$i).(($j<10)?'0'.$j:$j);?>"  <?php echo $entry->taken_time && ((($i<10)?'0'.$i:$i).(($j<10)?'0'.$j:$j) == $entry->taken_time || is_array($entry->taken_time) && in_array((($i<10)?'0'.$i:$i).(($j<10)?'0'.$j:$j), $entry->taken_time) ) ? 'selected="selected"' : '' ?>><?php echo (($i<10)?'0'.$i:$i).':'.(($j<10)?'0'.$j:$j);?></option>
          <?php endfor; ?>
        <?php endfor; ?>
        <!-- <option value='1'><?php echo $this->lang->line('pwidget_medication_once'); ?></option>
        <option value='2'><?php echo $this->lang->line('pwidget_medication_twice'); ?></option>
        <option value='3'><?php echo $this->lang->line('pwidget_medication_three_times'); ?></option>
        <option value='4'><?php echo $this->lang->line('pwidget_medication_four_times'); ?></option>
        <option value='5'><?php echo $this->lang->line('pwidget_medication_five_times'); ?></option>
        <option value='6'><?php echo $this->lang->line('pwidget_medication_six_times'); ?></option> -->
      </select>
      <?php else:?>
        <p class="form-control-static">
          <?php for($i=0;$i<24;$i++):?>
            <?php for($j=0;$j<60;$j=$j+5):?>
              <?php echo $entry->taken_time && ((($i<10)?'0'.$i:$i).(($j<10)?'0'.$j:$j) == $entry->taken_time || is_array($entry->taken_time) && in_array((($i<10)?'0'.$i:$i).(($j<10)?'0'.$j:$j), $entry->taken_time) ) ? (($i<10)?'0'.$i:$i).':'.(($j<10)?'0'.$j:$j).', ' : "" ?>
            <?php endfor; ?>
          <?php endfor; ?>
        </p>
      <?php endif; ?>
    </div>
  </div>
<!--
  <?php if (empty($static) || !empty($entry->taken_morning)) : ?>
    <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
      <label class="col-md-3 col-sm-4 control-label text-white" for="morning<?php echo $entry->id; ?>">
        <?php echo $this->lang->line('pwidget_medication_morning'); ?>
      </label>
      <div class="col-sm-1">
        <div class="checkbox-inline">
         <label>
            <div class="checkbox_box">
              <input type="checkbox" value="1" id="morning<?php echo $entry->id; ?>" name="morning" <?php echo !empty($entry->taken_morning) ? 'checked="checked"' : ''; ?> data-toggle-toggle="#morning_time<?php echo $entry->id; ?>Slider, #morning_time<?php echo $entry->id; ?>Help" <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?>  />
              <label for="morning<?php echo $entry->id; ?>"></label>
              <div></div>
            </div>
          </label>
        </div>
      </div>
      <div class="col-sm-4">
        <?php if (empty($static)) : ?>
          <div class="input-icon datetime-pick time-only">
            <input type="text" class="form-control input-sm" data-format="hh:mm" name="morning_time" id="morning_time<?php echo $entry->id; ?>" value="<?php echo !empty($entry->taken_morning_time) ? $entry->taken_morning_time : '07:00'; ?>" />
            <span class="add-on">
              <i class="fa fa-clock-o"></i>
            </span>
          </div>
        <?php else: ?>
          <p class="form-control-static"><?php echo !empty($entry->taken_morning_time) ? $entry->taken_morning_time : ''; ?></p>
        <?php endif; ?>
      </div>
    </div>
  <?php else: ?>
  <?php endif; ?>

  <?php if (empty($static) || !empty($entry->taken_lunch)) : ?>
    <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
      <label class="col-md-3 col-sm-4 control-label text-white" for="lunch<?php echo $entry->id; ?>">
        <?php echo $this->lang->line('pwidget_medication_noon'); ?>
      </label>
      <div class="col-sm-1">
        <div class="checkbox-inline">
          <label>
            <div class="checkbox_box">
              <input type="checkbox" value="1" id="lunch<?php echo $entry->id; ?>" name="lunch" <?php echo !empty($entry->taken_lunch) ? 'checked="checked"' : ''; ?> data-toggle-toggle="#lunch_time<?php echo $entry->id; ?>Slider, #lunch_time<?php echo $entry->id; ?>Help" <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?>  />
              <label for="lunch<?php echo $entry->id; ?>"></label>
              <div></div>
            </div>
          </label>
        </div>
      </div>
      <div class="col-sm-4">
        <?php if (empty($static)) : ?>
          <div class="input-icon datetime-pick time-only">
            <input type="text" class="form-control input-sm" data-format="hh:mm" name="lunch_time" id="lunch_time<?php echo $entry->id; ?>" value="<?php echo !empty($entry->taken_lunch_time) ? $entry->taken_lunch_time : '12:00'; ?>" />
            <span class="add-on">
              <i class="fa fa-clock-o"></i>
            </span>
          </div>
        <?php else: ?>
          <p class="form-control-static"><?php echo !empty($entry->taken_lunch_time) ? $entry->taken_lunch_time : ''; ?></p>
        <?php endif; ?>
      </div>
    </div>
  <?php else: ?>
  <?php endif; ?>

  <?php if (empty($static) || !empty($entry->taken_evening)) : ?>
    <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
      <label class="col-md-3 col-sm-4 control-label text-white" for="evening<?php echo $entry->id; ?>">
        <?php echo $this->lang->line('pwidget_medication_evening'); ?>
      </label>
      <div class="col-sm-1">
        <div class="checkbox-inline">
          <label>
            <div class="checkbox_box">
              <input type="checkbox" value="1" id="evening<?php echo $entry->id; ?>" name="evening" <?php echo !empty($entry->taken_evening) ? 'checked="checked"' : ''; ?> data-toggle-toggle="#evening_time<?php echo $entry->id; ?>Slider, #evening_time<?php echo $entry->id; ?>Help" <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?>  />
              <label for="evening<?php echo $entry->id; ?>"></label>
              <div></div>
            </div>
          </label>
        </div>
      </div>
      <div class="col-sm-4">
        <?php if (empty($static)) : ?>
          <div class="input-icon datetime-pick time-only">
            <input type="text" class="form-control input-sm" data-format="hh:mm" name="evening_time" id="evening_time<?php echo $entry->id; ?>" value="<?php echo !empty($entry->taken_evening_time) ? $entry->taken_evening_time : '18:00'; ?>" />
            <span class="add-on">
              <i class="fa fa-clock-o"></i>
            </span>
          </div>
        <?php else: ?>
          <p class="form-control-static"><?php echo !empty($entry->taken_evening_time) ? $entry->taken_evening_time : ''; ?></p>
        <?php endif; ?>
      </div>
    </div>
  <?php else: ?>
  <?php endif; ?>

  <?php if (empty($static) || !empty($entry->taken_night)) : ?>
    <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
      <label class="col-sm-3 control-label  text-white" for="night<?php echo $entry->id; ?>">
        <?php echo $this->lang->line('pwidget_medication_night'); ?>
      </label>
      <div class="col-sm-1">
        <div class="checkbox-inline">
          <label>
            <div class="checkbox_box">
              <input type="checkbox" value="1" id="night<?php echo $entry->id; ?>" name="night" <?php echo !empty($entry->taken_night) ? 'checked="checked"' : ''; ?> data-toggle-toggle="#night_time<?php echo $entry->id; ?>Slider, #night_time<?php echo $entry->id; ?>Help" <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?>  />
              <label for="night<?php echo $entry->id; ?>"></label>
              <div></div>
            </div>
          </label>
        </div>
      </div>
      <div class="col-sm-4">
        <?php if (empty($static)) : ?>
          <div class="input-icon datetime-pick time-only">
            <input type="text" class="form-control input-sm" data-format="hh:mm" name="night_time" id="night_time<?php echo $entry->id; ?>" value="<?php echo !empty($entry->taken_night_time) ? $entry->taken_night_time : '22:00'; ?>" />
            <span class="add-on">
              <i class="fa fa-clock-o"></i>
            </span>
          </div>
        <?php else: ?>
          <p class="form-control-static"><?php echo !empty($entry->taken_night_time) ? $entry->taken_night_time : ''; ?></p>
        <?php endif; ?>
      </div>
    </div>
  <?php else: ?>
  <?php endif; ?>
-->
  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <label for="repeating_periods<?php echo $entry->id; ?>" class="col-md-3 col-sm-4 control-label text-white">
      <?php echo $this->lang->line('pwidget_medication_repeating_periods'); ?>
    </label>
    <div class="col-md-9 col-sm-8">
      <?php if (empty($static)) : ?>
        <select type="text" name="repeating_periods" id="repeating_periods<?php echo $entry->id; ?>" class="select" >
          <option value="">
            <?php echo $this->lang->line('pwidget_medication_set_period'); ?>
          </option>
          <option value="Daily" <?php echo !empty($entry->repeating_periods) && $entry->repeating_periods == 'Daily' ? 'selected="selected"' : ''; ?> >
            <?php echo $this->lang->line('pwidget_medication_daily'); ?>
          </option>
          <option value="Every 2 day" <?php echo !empty($entry->repeating_periods) && $entry->repeating_periods == 'Every 2 day' ? 'selected="selected"' : ''; ?> >
            <?php echo $this->lang->line('pwidget_medication_every_2_day'); ?>
          </option>
          <option value="Every 3 day" <?php echo !empty($entry->repeating_periods) && $entry->repeating_periods == 'Every 3 day' ? 'selected="selected"' : ''; ?> >
           <?php echo $this->lang->line('pwidget_medication_every_3_day'); ?>
          </option>
          <option value="Every 4 day" <?php echo !empty($entry->repeating_periods) && $entry->repeating_periods == 'Every 4 day' ? 'selected="selected"' : ''; ?> >
            <?php echo $this->lang->line('pwidget_medication_every_4_day'); ?>
          </option>
          <option value="Weekly" <?php echo !empty($entry->repeating_periods) && $entry->repeating_periods == 'Weekly' ? 'selected="selected"' : ''; ?> >
            <?php echo $this->lang->line('pwidget_medication_weekly'); ?>
          </option>
          <option value="Monthly" <?php echo !empty($entry->repeating_periods) && $entry->repeating_periods == 'Monthly' ? 'selected="selected"' : ''; ?> >
           <?php echo $this->lang->line('pwidget_medication_monthly'); ?>
          </option>
        </select>
      <?php else : ?>
        <p class="form-control-static">
          <?php echo !empty($entry->repeating_periods) && $entry->repeating_periods == 'Daily' ? $this->lang->line('pwidget_medication_daily') : ''; ?>
          <?php echo !empty($entry->repeating_periods) && $entry->repeating_periods == 'Every 2 day' ? $this->lang->line('pwidget_medication_every_2_day') : ''; ?>
          <?php echo !empty($entry->repeating_periods) && $entry->repeating_periods == 'Every 3 day' ? $this->lang->line('pwidget_medication_every_3_day') : ''; ?>
          <?php echo !empty($entry->repeating_periods) && $entry->repeating_periods == 'Every 4 day' ? $this->lang->line('pwidget_medication_every_4_day') : ''; ?>
          <?php echo !empty($entry->repeating_periods) && $entry->repeating_periods == 'Weekly' ? $this->lang->line('pwidget_medication_weekly') : ''; ?>
          <?php echo !empty($entry->repeating_periods) && $entry->repeating_periods == 'Monthly' ? $this->lang->line('pwidget_medication_monthly') : ''; ?>
        </p>
      <?php endif; ?>
    </div>
  </div>

  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <label class="col-md-3 col-sm-4 control-label text-white" for="prescribed<?php echo $entry->id; ?>" style="word-break: break-all;">
      <?php echo $this->lang->line('pwidget_medication_prescribed'); ?>
    </label>
    <div class="col-md-9 col-sm-8">
      <div class="checkbox">
        <label>
          <input type="checkbox" value="1" id="prescribed<?php echo $entry->id; ?>" name="prescribed" <?php echo !empty($entry->prescribed) && $entry->prescribed ? 'checked="checked"' : ''; ?> <?php echo $this->m->user_role() == M::ROLE_PATIENT ? 'disabled="disabled"' : ''; ?> />
        </label>
      </div>
    </div>
  </div>

  <?php if (!empty($entry->prescribed) || $insert) : ?>

    <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
      <label for="" class="col-md-3 col-sm-4 control-label text-white">
       <?php echo $this->lang->line('pwidget_medication_since'); ?>
      </label>
      <div class="col-sm-3">
        <?php if (empty($static)): ?>
          <div class="input-icon datetime-pick date-only">
            <input type="text" class="form-control input-sm" name="since" id="sinceedit<?php echo $entry->id; ?>" value="<?php echo date("d.m.Y", !empty($entry->taken_since) ? strtotime($entry->taken_since) : time()); ?>" placeholder="<?php echo $this->lang->line('pwidget_medication_since'); ?>" />
            <span class="add-on">
              <i class="sa-plus fa fa-calendar"></i>
            </span>
          </div>
        <?php else : ?>
          <p class="form-control-static"><?php echo !empty($entry->taken_since) ? date("d.m.Y", strtotime($entry->taken_since)) : ''; ?></p>
        <?php endif; ?>
      </div>
      <label for="" class="col-sm-1 control-label text-white">
        <?php echo $this->lang->line('pwidget_medication_until'); ?>
      </label>
      <div class="col-sm-3">
        <?php if (empty($static)): ?>
          <div class="input-icon datetime-pick date-only">
            <input type="text" class="form-control input-sm" name="bis_to" id="bis_to<?php echo $entry->id; ?>" value="<?php echo date("d.m.Y", !empty($entry->bis_to) ? strtotime($entry->bis_to) : time()); ?>" placeholder="<?php echo $this->lang->line('pwidget_medication_until'); ?>" />
            <span class="add-on">
              <i class="sa-plus fa fa-calendar"></i>
            </span>
          </div>
        <?php else : ?>
          <p class="form-control-static"><?php echo !empty($entry->bis_to) ? date("d.m.Y", strtotime($entry->bis_to)) : ''; ?></p>
        <?php endif; ?>
      </div>
    </div>

    <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
      <label for="" class="col-md-3 col-sm-4 control-label text-white">
        <?php echo $this->lang->line('pwidget_medication_document_date'); ?>
      </label>
      <div class="col-md-9 col-sm-8">
        <?php if (empty($static)): ?>
          <div class="input-icon datetime-pick date-only">
            <input type="text" class="form-control input-sm" name="document_date" data-format="dd.MM.yyyy" id="document_date<?php echo $entry->id; ?>" value="<?php echo date('d.m.Y', !empty($entry->document_date) ? strtotime($entry->document_date) : time()); ?>" placeholder="<?php echo $this->lang->line('patients_home_entry_date'); ?>" />
            <span class="add-on">
              <i class="sa-plus fa fa-calendar"></i>
            </span>
          </div>
        <?php else : ?>
          <p class="form-control-static"><?php echo !empty($entry->document_date) ? date('d.m.Y', strtotime($entry->document_date)) : ''; ?></p>
        <?php endif; ?>
      </div>
    </div>
  <?php else: ?>
    <input type="hidden" id="document_date" name="document_date" value="<?php echo !empty($entry->document_date) ? date('d.m.Y', strtotime($entry->document_date)) : ''; ?>">
  <?php endif; ?>
    
<div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>" style="clear:both">
    <label for="document_upload<?php echo $entry->id; ?>" class="col-sm-3 control-label text-white">
      <?php echo $this->lang->line('patients_home_file_upload'); ?>
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
                  <a href="<?php echo site_url('akte/medication/remove_file/'.$file->entry_id); ?>">
                    <span class="icomoon i-remove-2 icon16" style="<?php echo Ui::$bs_tname == 'sa103' ? 'color:white;' : ''; ?>"></span>
                  </a>
                </td>
<!--                <td class="text-center" style="vertical-align:middle;">
                  <a href="<?php echo site_url('akte/document/edit/'.$file->id); ?>">
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
            <?php echo $this->lang->line('patients_home_file_upload_help'); ?>
          </small>
        </p>
      <?php endif; ?>
    </div>
  </div>

  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <label for="comments<?php $entry->id; ?>" class="col-md-3 col-sm-4 control-label text-white">
      <?php echo $this->lang->line('pwidget_medication_comments'); ?>
    </label>
    <div class="col-md-9 col-sm-8">
      <?php if (empty($static)) : ?>
        <textarea class="form-control" rows="5" name="comments" id="comments<?php echo $entry->id; ?>" placeholder="<?php echo $this->lang->line('pwidget_medication_comments'); ?>" ><?php echo !empty($entry->comments) ? $entry->comments : ''; ?></textarea>
      <?php else: ?>
        <p class="form-control-static" style="word-break: break-all;"><?php echo !empty($entry->comments) ? $entry->comments : ''; ?></p>
      <?php endif; ?>
    </div>
  </div>

  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <label class="col-sm-3 control-label  text-white">
      <?php echo $this->lang->line('pwidget_medication_usage'); ?>
    </label>
    <div class="col-md-9 col-sm-8">
      <div class="checkbox-inline">
        <label>
          <div class="checkbox_box">
            <input type="checkbox" value="1" id="iv<?php echo $entry->id; ?>" name="iv" <?php echo !empty($entry->iv) && $entry->iv == '1' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?>  />
            <label for="iv<?php echo $entry->id; ?>"></label>
            <div class="text-white">
              i.v
            </div>
          </div>
        </label>
      </div>
      <div class="checkbox-inline">
        <label>
          <div class="checkbox_box">
            <input type="checkbox" value="1" id="po<?php echo $entry->id; ?>" name="po" <?php echo !empty($entry->po) && $entry->po == '1' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?>  />
            <label for="po<?php echo $entry->id; ?>"></label>
            <div class="text-white">
              p.o
            </div>
          </div>
        </label>
      </div>
      <div class="checkbox-inline">
        <label>
          <div class="checkbox_box">
            <input type="checkbox" value="1" id="sc<?php echo $entry->id; ?>" name="sc" <?php echo !empty($entry->sc) && $entry->sc == '1' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?>  />
            <label for="sc<?php echo $entry->id; ?>"></label>
            <div class="text-white">
              s.c
            </div>
          </div>
        </label>
      </div>
      <div class="checkbox-inline">
        <label>
          <div class="checkbox_box">
            <input type="checkbox" value="1" id="im<?php echo $entry->id; ?>" name="im" <?php echo !empty($entry->im) && $entry->im == '1' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?>  />
            <label for="im<?php echo $entry->id; ?>"></label>
            <div class="text-white">
              i.m
            </div>
          </div>
        </label>
      </div>
      <p class="help-block">
        <?php echo $this->lang->line('pwidget_medication_usage_help'); ?>
      </p>
    </div>
  </div>

  <?php if ($this->m->user_role() == M::ROLE_PATIENT) : ?>
    <?php $this->load->language('patients/all_access', $this->m->user_value('language')); ?>
    <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
      <label class="col-md-3 col-sm-4 control-label text-white" style="word-break: break-all;">
        <?php echo $this->lang->line('patients_all_access_page_title'); ?>
      </label>
      <div class="col-md-9 col-sm-8">
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

  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>">
    <div class="col-sm-12 text-right">
    
      <?php if (isset($insert) && $insert && empty($hide_insert)) : ?>
        <button class="btn btn-alt btn-lg" type="submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?></button>

      <?php if ($this->m->user_role() == M::ROLE_DOCTOR) : ?>
          <button class="btn btn-alt btn-lg" type="button" onClick="ddanalysis(substance<?php echo $entry->id; ?>.value,name<?php echo $entry->id; ?>.value)" ><span class="icomoon i-search"></span> 
            Analysis
          </button>
      <?php endif; ?>

      <?php endif; ?>
     

      <?php if (isset($update_btn) && $update_btn && empty($hide_insert)) : ?>
        <button class="btn btn-alt btn-lg" type="submit"><span class="icomoon i-loop-4"></span> <?php echo $this->lang->line('general_text_button_update'); ?></button>
      <?php endif; ?>

      <?php if (isset($emergency_btn) && $emergency_btn && empty($hide_insert)) : ?>
        <button class="btn btn-alt btn-lg" type="button" data-submit-location="<?php echo site_url('akte/medication/emergency/'.$entry->id); ?>" ><span class="icomoon i-aid"></span>
          <?php echo $this->lang->line('pwidget_diagnosis_emergency_button'); ?>
        </button>
      <?php endif; ?>

      <?php if (isset($confirm_btn) && $confirm_btn && empty($hide_insert)) : ?>
        <button class="btn btn-alt btn-lg" type="button" data-submit-location="<?php echo site_url('akte/medication/confirm/'.$entry->id); ?>" ><span class="icomoon i-signup"></span>
          <?php echo $this->lang->line('pwidget_diagnosis_confirmed_button'); ?>
        </button>
      <?php endif; ?>

      <?php if (isset($archive_btn) && $archive_btn && empty($hide_insert)) : ?>
        <button class="btn btn-alt btn-lg" type="button" data-submit-location="<?php echo site_url('akte/medication/archive/'.$entry->id); ?>" ><span class="icomoon i-drawer-3"></span> 
         <?php echo $this->lang->line('pwidget_diagnosis_archieve_button'); ?>
        </button>
      <?php endif; ?>

      <?php if (isset($delete_btn) && $delete_btn && empty($hide_insert)) : ?>
        <button class="btn btn-alt btn-lg" type="button" data-submit-location="<?php echo site_url('akte/medication/archive/'.$entry->id); ?>" ><span class="icomoon i-remove-2"></span> 
          <?php echo $this->lang->line('general_text_button_delete'); ?>
        </button>
      <?php endif; ?>

    </div>
  </div>

</form>

<?php if(!empty($static))
{?>
<div class="read-more"><a href="<?php echo site_url('/akte/medication'); ?>" class="ajax-medication-link">Details</a>&nbsp;<span class="fa fa-chevron-right fa-right"></span></div>
<?php }
?>
