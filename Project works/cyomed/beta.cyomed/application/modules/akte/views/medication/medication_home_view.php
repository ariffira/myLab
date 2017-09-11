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

<div class="blog-block blog-blue">
  <div class="date-block">
    <div class="date-meta"><?php echo date('d',strtotime($entry->document_date));?>. <span><?php echo date('M',strtotime($entry->document_date));?></span></div>
  </div>
  <div class="blog-text blog-text-val"> 
    <h2 class="title blue font_type1 uprCase">Medikamente</h2>
    <div class="clr"></div>
    <article>
    <div class="blog-img">
                <?php if(!empty($entry->files)):?>
          <?php foreach ($entry->files as $file) : ?>
                    <a href="<?php echo base_url($this->mdoc->get_file_path($file)); ?>" target="_blank" class="<?php echo Ui::$bs_tname == 'sa103' ? 'text-white' : ''; ?>">
                    <?php 
                      $file->document_extension = strtolower($file->document_extension);
                     if (in_array($file->document_extension, array('jpg', 'png', 'jpeg', 'gif', 'tif', ))) : ?>
                      <?php if (file_exists($this->mdoc->get_file_path($file))) : ?>
                        <img src="<?php echo base_url('assets/php/image_php/image_php.php'); ?>?width=165&height=118&cropratio=10:9&image=<?php echo base_url($this->mdoc->get_file_path($file)); ?>" width="100%"/>
                      <?php else : ?>
                        <span class="icomoon icon32 i-image-2"></span>
                      <?php endif; ?>
                    <?php endif; ?>
                    <?php if ($file->document_extension == 'pdf') : ?>
                      <span class="icomoon icon32 i-file-pdf"></span>
                    <?php endif; ?>
                    <?php if ($file->document_extension == 'doc' || $file->document_extension == 'docx') : ?>
                      <span class="icomoon icon32 i-file-word"></span>
                    <?php endif; ?>
                    <?php if ($file->document_extension == 'xls' || $file->document_extension == 'xlsx') : ?>
                      <span class="icomoon icon32 i-file-excel"></span>
                    <?php endif; ?>
                    <?php if ($file->document_extension == 'txt') : ?>
                      <span class="icomoon icon32 i-file-pdf"></span>
                    <?php endif; ?>
                    <?php if ($file->document_extension == 'odt') : ?>
                      <span class="icomoon icon32 i-files"></span>
                    <?php endif; ?>
                  </a>
          <?php endforeach; 
        else:?>
        <img src="<?php echo base_url('assets/img/portal/medication.png'); ?>" width="118" height="118" alt="">
              <?php endif; ?>
    </div>
    <div class="category"><?php echo !empty($entry->name) ? $entry->name : ''; ?></div>
    <div class="short-desc"><?php echo !empty($entry->substance) ? $entry->substance : ''; ?></div>
    <p class="form-val clr"><em><?php echo $this->lang->line('pwidget_medication_dose_rate'); ?>: <?php echo !empty($entry->dose_rate) ? $entry->dose_rate : ''; ?></em></p>
    <div class="row">
        <div class="col-md-6">
            <p class="form-val"><?php echo $this->lang->line('pwidget_medication_atc_code'); ?>: <?php echo !empty($entry->atc_code) ? $entry->atc_code : ''; ?></p>
        </div>
        <div class="col-md-6">
            <p class="form-val"><?php echo $this->lang->line('pwidget_medication_times_taken'); ?>: <?php for($i=0;$i<24;$i++):?> <?php for($j=0;$j<60;$j=$j+5):?> <?php echo $entry->taken_time && ((($i<10)?'0'.$i:$i).(($j<10)?'0'.$j:$j) == $entry->taken_time || is_array($entry->taken_time) && in_array((($i<10)?'0'.$i:$i).(($j<10)?'0'.$j:$j), $entry->taken_time) ) ? (($i<10)?'0'.$i:$i).':'.(($j<10)?'0'.$j:$j).', ' : "" ?> <?php endfor; ?> <?php endfor; ?></p>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-6"><?php echo $this->lang->line('pwidget_medication_repeating_periods'); ?>: <?php echo !empty($entry->repeating_periods) && $entry->repeating_periods == 'Daily' ? $this->lang->line('pwidget_medication_daily') : ''; ?> <?php echo !empty($entry->repeating_periods) && $entry->repeating_periods == 'Every 2 day' ? $this->lang->line('pwidget_medication_every_2_day') : ''; ?> <?php echo !empty($entry->repeating_periods) && $entry->repeating_periods == 'Every 3 day' ? $this->lang->line('pwidget_medication_every_3_day') : ''; ?> <?php echo !empty($entry->repeating_periods) && $entry->repeating_periods == 'Every 4 day' ? $this->lang->line('pwidget_medication_every_4_day') : ''; ?> <?php echo !empty($entry->repeating_periods) && $entry->repeating_periods == 'Weekly' ? $this->lang->line('pwidget_medication_weekly') : ''; ?> <?php echo !empty($entry->repeating_periods) && $entry->repeating_periods == 'Monthly' ? $this->lang->line('pwidget_medication_monthly') : ''; ?>
        </div>
        <div class="col-md-6">
        	<label>
                <input type="checkbox" value="1" id="prescribed<?php echo $entry->id; ?>" name="prescribed" <?php echo !empty($entry->prescribed) && $entry->prescribed ? 'checked="checked"' : ''; ?> <?php echo $this->m->user_role() == M::ROLE_PATIENT ? 'disabled="disabled"' : ''; ?> />
                <?php echo $this->lang->line('pwidget_medication_prescribed'); ?>
            </label>
        </div>
    </div>
    <p class="form-val"><?php echo $this->lang->line('pwidget_medication_comments'); ?>: <?php echo !empty($entry->comments) ? $entry->comments : ''; ?></p>    
    <p class="form-val">
    	<label class="checkbox-inline"><input type="checkbox" value="1" id="taking_regularly<?php echo $entry->id; ?>" name="taking_regularly" <?php echo !empty($entry->taking_regularly) ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> /> <?php echo $this->lang->line('pwidget_medication_taking_regularly'); ?>
        </label>
        <label class="checkbox-inline"><input type="checkbox" value="1" id="taking_needed<?php echo $entry->id; ?>" name="taking_needed" <?php echo !empty($entry->taking_needed) ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> /> <?php echo $this->lang->line('pwidget_medication_taking_needed'); ?>
        </label>
    </p>    
    <p class="form-val">
    	<label class="checkbox-inline"><input type="checkbox" value="1" id="iv<?php echo $entry->id; ?>" name="iv" <?php echo !empty($entry->iv) && $entry->iv == '1' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?>  /> i.v
        </label>
        <label class="checkbox-inline"><input type="checkbox" value="1" id="po<?php echo $entry->id; ?>" name="po" <?php echo !empty($entry->po) && $entry->po == '1' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?>  /> p.o
        </label>
        <label class="checkbox-inline"><input type="checkbox" value="1" id="sc<?php echo $entry->id; ?>" name="sc" <?php echo !empty($entry->sc) && $entry->sc == '1' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?>  /> s.c
        </label>
        <label class="checkbox-inline"><input type="checkbox" value="1" id="im<?php echo $entry->id; ?>" name="im" <?php echo !empty($entry->im) && $entry->im == '1' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?>  /> i.m
        </label>
        <em class="help-block font12"><?php echo $this->lang->line('pwidget_medication_usage_help'); ?></em>
    </p>
    <?php if ($this->m->user_role() == M::ROLE_PATIENT) : ?>
    <?php $this->load->language('patients/all_access', $this->m->user_value('language')); ?>
    <p class="form-val">
    	<label class="radio-inline"><input type="checkbox" value="1" id="access1_<?php echo $entry->id; ?>" name="access" <?php echo isset($entry->access_permission) && $entry->access_permission == '1' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> /> <?php echo $this->lang->line('patients_all_accesss_my_doctor'); ?></label>
        <label class="radio-inline"><input type="checkbox" value="2" id="access2_<?php echo $entry->id; ?>" name="access" <?php echo isset($entry->access_permission) && $entry->access_permission == '2' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> /> <?php echo $this->lang->line('patients_all_accesss_all_doctor'); ?></label>
        <label class="radio-inline"><input type="checkbox" value="0" id="access0_<?php echo $entry->id; ?>" name="access" <?php echo isset($entry->access_permission) && $entry->access_permission == '0' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> /> <?php echo $this->lang->line('patients_all_access_private_mode'); ?> </label>
		<?php if (empty($static)) : ?>
        <em class="help-block font12"><span style="color:red;">*</span> <?php echo $this->lang->line('patients_all_access_selection_info'); ?></em>
        <?php endif; ?>
    </p>    
    <?php endif; ?>
    
    <div class="form form-horizontal hidden">
      <div class="form-group form-group1">
       
        <div class="col-md-7">
          <?php if (!empty($static)) : ?>
          <?php endif; ?>
        </div>
      </div>
      <div class="form-group form-group1 <?php //echo empty($static) ? '' : 'm-b-0'; ?>">
        <label for="name<?php echo $entry->id; ?>" class="category col-md-5"> <?php echo $this->lang->line('pwidget_medication_name'); ?> </label>
        <div class="col-sm-7">
          <p class="form-control-static"><?php echo !empty($entry->name) ? $entry->name : ''; ?></p>
        </div>
      </div>
      <div class="form-group form-group1 <?php //echo empty($static) ? '' : 'm-b-0'; ?>">
        <label for="atc_code<?php echo $entry->id; ?>" class="category col-md-5"> <?php echo $this->lang->line('pwidget_medication_atc_code'); ?> </label>
        <div class="col-sm-7">
          <p class="form-control-static"><?php echo !empty($entry->atc_code) ? $entry->atc_code : ''; ?></p>
        </div>
      </div>
      <div class="form-group form-group1 <?php //echo empty($static) ? '' : 'm-b-0'; ?>">
        <label for="substance<?php echo $entry->id; ?>" class="category col-md-5"> <?php echo $this->lang->line('pwidget_medication_substance'); ?> </label>
        <div class="col-sm-7">
          <p class="form-control-static"><?php echo !empty($entry->substance) ? $entry->substance : ''; ?></p>
        </div>
      </div>
      <div class="form-group <?php //echo empty($static) ? '' : 'm-b-0'; ?>">
        <label for="dose_rate<?php echo $entry->id; ?>" class="category col-md-3"> <?php echo $this->lang->line('pwidget_medication_dose_rate'); ?> </label>
        <div class="col-sm-9">
          <p class="form-control-static"><?php echo !empty($entry->dose_rate) ? $entry->dose_rate : ''; ?></p>
        </div>
      </div>
      <div class="form-group <?php //echo empty($static) ? '' : 'm-b-0'; ?>">
        <label class=" col-md-3"> <?php echo $this->lang->line('pwidget_medication_taking_title'); ?> </label>
        <div class="col-sm-9">
          <div class="checkbox">
            <label>
            <div class="checkbox_box">
              <input type="checkbox" value="1" id="taking_regularly<?php echo $entry->id; ?>" name="taking_regularly" <?php echo !empty($entry->taking_regularly) ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> />
              <label for="taking_regularly<?php echo $entry->id; ?>"></label>
              <div class="text-white"> <?php echo $this->lang->line('pwidget_medication_taking_regularly'); ?> </div>
            </div>
            </label>
          </div>
          <div class="checkbox">
            <label>
            <div class="checkbox_box">
              <input type="checkbox" value="1" id="taking_needed<?php echo $entry->id; ?>" name="taking_needed" <?php echo !empty($entry->taking_needed) ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> />
              <label for="taking_needed<?php echo $entry->id; ?>"></label>
              <div class="text-white"> <?php echo $this->lang->line('pwidget_medication_taking_needed'); ?> </div>
            </div>
            </label>
          </div>
        </div>
      </div>
      <div class="form-group <?php //echo empty($static) ? '' : 'm-b-0'; ?>">
        <label for="taken_time<?php echo $entry->id; ?>" class="category col-md-3"> <?php echo $this->lang->line('pwidget_medication_times_taken'); ?> </label>
        <div class="col-sm-9">
          <p class="form-control-static">
            <?php for($i=0;$i<24;$i++):?>
            <?php for($j=0;$j<60;$j=$j+5):?>
            <?php echo $entry->taken_time && ((($i<10)?'0'.$i:$i).(($j<10)?'0'.$j:$j) == $entry->taken_time || is_array($entry->taken_time) && in_array((($i<10)?'0'.$i:$i).(($j<10)?'0'.$j:$j), $entry->taken_time) ) ? (($i<10)?'0'.$i:$i).':'.(($j<10)?'0'.$j:$j).', ' : "" ?>
            <?php endfor; ?>
            <?php endfor; ?>
          </p>
        </div>
      </div>
      <div class="form-group <?php //echo empty($static) ? '' : 'm-b-0'; ?>">
        <label for="repeating_periods<?php echo $entry->id; ?>" class="category col-md-3"> <?php echo $this->lang->line('pwidget_medication_repeating_periods'); ?> </label>
        <div class="col-sm-9">
          <p class="form-control-static"> <?php echo !empty($entry->repeating_periods) && $entry->repeating_periods == 'Daily' ? $this->lang->line('pwidget_medication_daily') : ''; ?> <?php echo !empty($entry->repeating_periods) && $entry->repeating_periods == 'Every 2 day' ? $this->lang->line('pwidget_medication_every_2_day') : ''; ?> <?php echo !empty($entry->repeating_periods) && $entry->repeating_periods == 'Every 3 day' ? $this->lang->line('pwidget_medication_every_3_day') : ''; ?> <?php echo !empty($entry->repeating_periods) && $entry->repeating_periods == 'Every 4 day' ? $this->lang->line('pwidget_medication_every_4_day') : ''; ?> <?php echo !empty($entry->repeating_periods) && $entry->repeating_periods == 'Weekly' ? $this->lang->line('pwidget_medication_weekly') : ''; ?> <?php echo !empty($entry->repeating_periods) && $entry->repeating_periods == 'Monthly' ? $this->lang->line('pwidget_medication_monthly') : ''; ?> </p>
        </div>
      </div>
      <div class="form-group <?php //echo empty($static) ? '' : 'm-b-0'; ?>">
        <label class=" col-md-3" for="prescribed<?php echo $entry->id; ?>" style="word-break: break-all;"> <?php echo $this->lang->line('pwidget_medication_prescribed'); ?> </label>
        <div class="col-sm-9">
          <div class="checkbox">
            <label>
            <input type="checkbox" value="1" id="prescribed<?php echo $entry->id; ?>" name="prescribed" <?php echo !empty($entry->prescribed) && $entry->prescribed ? 'checked="checked"' : ''; ?> <?php echo $this->m->user_role() == M::ROLE_PATIENT ? 'disabled="disabled"' : ''; ?> />
            </label>
          </div>
        </div>
      </div>
      <div class="form-group <?php //echo empty($static) ? '' : 'm-b-0'; ?>">
        <label for="comments<?php $entry->id; ?>" class="category col-md-3"> <?php echo $this->lang->line('pwidget_medication_comments'); ?> </label>
        <div class="col-sm-9 m">
          <?php if (empty($static)) : ?>
          <textarea class="form-control" rows="5" name="comments" id="comments<?php echo $entry->id; ?>" placeholder="<?php echo $this->lang->line('pwidget_medication_comments'); ?>" ><?php echo !empty($entry->comments) ? $entry->comments : ''; ?></textarea>
          <?php else: ?>
          <p class="form-control-static" style="word-break: break-all;"><?php echo !empty($entry->comments) ? $entry->comments : ''; ?></p>
          <?php endif; ?>
        </div>
      </div>
      <div class="form-group <?php //echo empty($static) ? '' : 'm-b-0'; ?>">
        <label class=" col-md-3"> <?php echo $this->lang->line('pwidget_medication_usage'); ?> </label>
        <div class="col-sm-9">
          <div class="checkbox-inline">
            <label>
            <div class="checkbox_box">
              <input type="checkbox" value="1" id="iv<?php echo $entry->id; ?>" name="iv" <?php echo !empty($entry->iv) && $entry->iv == '1' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?>  />
              <label for="iv<?php echo $entry->id; ?>"></label>
              <div class="text-white"> i.v </div>
            </div>
            </label>
          </div>
          <div class="checkbox-inline">
            <label>
            <div class="checkbox_box">
              <input type="checkbox" value="1" id="po<?php echo $entry->id; ?>" name="po" <?php echo !empty($entry->po) && $entry->po == '1' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?>  />
              <label for="po<?php echo $entry->id; ?>"></label>
              <div class="text-white"> p.o </div>
            </div>
            </label>
          </div>
          <div class="checkbox-inline">
            <label>
            <div class="checkbox_box">
              <input type="checkbox" value="1" id="sc<?php echo $entry->id; ?>" name="sc" <?php echo !empty($entry->sc) && $entry->sc == '1' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?>  />
              <label for="sc<?php echo $entry->id; ?>"></label>
              <div class="text-white"> s.c </div>
            </div>
            </label>
          </div>
          <div class="checkbox-inline">
            <label>
            <div class="checkbox_box">
              <input type="checkbox" value="1" id="im<?php echo $entry->id; ?>" name="im" <?php echo !empty($entry->im) && $entry->im == '1' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?>  />
              <label for="im<?php echo $entry->id; ?>"></label>
              <div class="text-white"> i.m </div>
            </div>
            </label>
          </div>
          <p class="help-block"> <?php echo $this->lang->line('pwidget_medication_usage_help'); ?> </p>
        </div>
      </div>
      <?php if ($this->m->user_role() == M::ROLE_PATIENT) : ?>
      <?php $this->load->language('patients/all_access', $this->m->user_value('language')); ?>
      <div class="form-group <?php //echo empty($static) ? '' : 'm-b-0'; ?>">
        <label class=" col-md-3" style="word-break: break-all;"> <?php echo $this->lang->line('patients_all_access_page_title'); ?> </label>
        <div class="col-sm-9">
          <div class="radio-inline">
            <label>
            <input type="checkbox" value="1" id="access1_<?php echo $entry->id; ?>" name="access" <?php echo isset($entry->access_permission) && $entry->access_permission == '1' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> />
            <?php echo $this->lang->line('patients_all_accesss_my_doctor'); ?> </label>
          </div>
          <div class="radio-inline">
            <label>
            <input type="checkbox" value="2" id="access2_<?php echo $entry->id; ?>" name="access" <?php echo isset($entry->access_permission) && $entry->access_permission == '2' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> />
            <?php echo $this->lang->line('patients_all_accesss_all_doctor'); ?> </label>
          </div>
          <div class="radio-inline">
            <label>
            <input type="checkbox" value="0" id="access0_<?php echo $entry->id; ?>" name="access" <?php echo isset($entry->access_permission) && $entry->access_permission == '0' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> />
            <?php echo $this->lang->line('patients_all_access_private_mode'); ?> </label>
          </div>
          <?php if (empty($static)) : ?>
          <p class="help-block"> <span style="color:red;">*</span> <?php echo $this->lang->line('patients_all_access_selection_info'); ?> </p>
          <?php endif; ?>
        </div>
      </div>
      <?php endif; ?>
    </div>
    </article>
    <?php if(!empty($static))
{
?>
    <div class="read-more">   <div class="pull-left"> <span  class="font-format font12">
      <?php if(!empty($entry->added_by))
            {
             echo $this->lang->line('general_addedby');
            ?>
      <em><?php echo ($entry->user_role=='role_doctor')? 'Doctor':'Patient';?>
      <?php $res=$this->m->user_details($entry->added_by,$entry->user_role); 
           echo $res->name."&nbsp;".$res->regid; 
       ?>
      </em> <?php echo $this->lang->line('general_on');?> <?php echo date('d. M .Y',strtotime($entry->date_added));?>
      <?php } ?>
      </span> </div><a href="<?php echo site_url('/akte/medication/index/'.$entry->id); ?>" class="ajax-medication-link<?php echo $entry->id; ?>">Details</a>&nbsp;<span class="fa fa-chevron-right fa-right"></span></div>
    <?php
}
?>
  </div>
</div>
<script>
$('.ajax-medication-link<?php echo $entry->id; ?>').click(function(e) 
    {
          e.preventDefault();
          if ($(this).attr('href').indexOf('javascript:') < 0)
          $.loadUrl($(this).attr('href'), $('#content'));
    });
</script>
<script>
   $('article').readmore({speed: 500});
</script>