<?php
  $entry = !empty($entry) ? $entry : array(
    'id' => 0,
  );
  $entry = (object)$entry;
  $insert = empty($entry->id);
  //loading languages
  $this->load->language('global/general_text',$this->m->user_value('language'));
  $this->load->language('patients/home',$this->m->user_value('language'));
?>

<form class="form-horizontal"   id="condition-form" role="form" method="post" action="<?php echo site_url('akte/condition/'.( !empty($insert) ? 'insert' : ('update/'.$entry->id) ) ); ?>" enctype="multipart/form-data" <?php echo !empty($readonly) ? 'data-readonly="readonly"' : ''; ?> <?php echo !empty($disabled) ? 'data-disabled="disabled"' : ''; ?> >
  <input type="hidden" name="id" value="<?php echo $entry->id ?>" />
  <?php if (!empty($static)) : ?>
  <div class="form-group m-b-5">
      <h3 class="col-sm-3 control-label">
        <?php echo $this->lang->line('patients_home_page_title'); ?>
      </h3> 
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
       ?> <?php  echo $this->lang->line('general_on');?> <?php echo date('d. M .Y',strtotime($entry->date_added));?>
       <?php } ?>
      </span>
  </div>
  <?php endif; ?>
  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>" >
    <label id="label_befindlichkeit" for="befindlichkeit<?php echo $entry->id; ?>" class="col-sm-3 text-white"><?php echo $this->lang->line('patients_home_complaint_scale'); ?></label>
    <div class="col-md-6 col-sm-6 col-xs-10">
      <?php if (empty($static)) : ?>
	    <input type="text" class="input-slider2" name="befindlichkeit" 
                   id="befindlichkeit<?php echo $entry->id; ?>" 
                   value="<?php echo $entry->befindlichkeit!="" ? $entry->befindlichkeit : 0; ?>" 
                   data-slider-value="<?php echo $entry->befindlichkeit!='' ? $entry->befindlichkeit : 0; ?>" 
                   data-slider-min="0" data-slider-max="10" data-slider-step="1" 
                   data-slider-id='befindlichkeit<?php echo $entry->id; ?>Slider' <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> />
      <?php else: ?>
        <div class="progress">
          <div class="progress-bar progress-bar-primary" 
               role="progressbar" aria-valuenow="<?php echo ($entry->befindlichkeit!="")? $entry->befindlichkeit * 10 : 0; ?>" aria-valuemin="0"
               aria-valuemax="100" style="width: <?php echo ($entry->befindlichkeit!="") ? $entry->befindlichkeit * 10 : 0; ?>%">
            <span class="sr-only">
                <?php echo $entry->befindlichkeit!="" ? $entry->befindlichkeit * 10 : 0; ?>% <?php echo $this->lang->line('patients_home_complaint_scale'); ?> (primary)
            </span>
          </div>
        </div>
      <?php endif; ?>
    </div>
    <?php /* if($entry->befindlichkeit=="")
        { ?>
        <div name="emotion" class="col-md-1 col-sm-2 col-xs-2 emotion">
            <img  class="pull-right" src="<?php echo base_url('assets/img/emotion/1.png'); ?>" emotion='0'>
       </div>
    <?php }*/ ?>
    <?php for($i=0;$i<11;$i++):?>   
     <div class ="col-md-1 col-sm-2 col-xs-2 emotion" name="emotion" >
    <?php if($entry->befindlichkeit!="" ): ?>
                <?php if ($entry->befindlichkeit==$i && $entry->befindlichkeit!=0  ):?>           
              <img src="<?php echo base_url('assets/img/emotion/'.$i.'.png'); ?>" class="pull-right" emotion='<?php echo $i; ?>'>
            
              <?php elseif($i==0 && $entry->befindlichkeit==$i ):?>
            <img src="<?php echo base_url('assets/img/emotion/1.png'); ?>" class="pull-right"    emotion='0'>
              <?php else:?>    
            <img src="<?php echo base_url('assets/img/emotion/'.$i.'.png'); ?>" class="pull-right" style="display: none;" emotion='<?php echo $i; ?>'>
                <?php endif;?>
    <?php  elseif($i==0): ?>
        <img src="<?php  echo base_url('assets/img/emotion/1.png'); ?>" class="pull-right"  emotion='0'>
    <?php else:?> 
        <img src="<?php echo base_url('assets/img/emotion/'.$i.'.png'); ?>" class="pull-right" style="display: none;" emotion='<?php echo $i; ?>'>
    <?php endif;?>
     </div>
      <?php endfor;?> 
       <div class="clear"></div>
  </div>
  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>" >
    <label for="title_name<?php $entry->id; ?>" class="col-sm-3 control-label text-white"><?php echo $this->lang->line('patients_home_complaints'); ?></label>
    <div class="col-sm-9">
      <?php if (empty($static)) : ?>
        <input type="text" class="form-control" name="title_name" id="title_name<?php echo $entry->id; ?>" value="<?php echo !empty($entry->title) ? $entry->title : ''; ?>" placeholder="<?php echo $this->lang->line('patients_home_complaints'); ?>" required />
      <?php else: ?>
        <p class="form-control-static"><?php echo !empty($entry->title) ? $entry->title : ''; ?></p>
      <?php endif; ?>
    </div>
  </div>
  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>" >
    <label for="condition<?php $entry->id; ?>" class="col-sm-3 control-label text-white"><?php echo $this->lang->line('patients_home_condition_detail'); ?></label>
    <div class="col-sm-9">
      <?php if (empty($static)) : ?>
        <textarea class="form-control" rows="5" name="condition" id="condition<?php echo $entry->id; ?>" placeholder="<?php echo $this->lang->line('patients_home_condition_detail'); ?>" ><?php echo !empty($entry->description) ? $entry->description : ''; ?></textarea>
      <?php else: ?>
        <p class="form-control-static" style="word-break: break-all;"><?php echo !empty($entry->description) ? $entry->description : ''; ?></p>
      <?php endif; ?>
    </div>
  </div>
  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?> flt" >
    <label for="" class="col-sm-3 control-label text-white">
      <?php echo $this->lang->line('patients_home_entry_date'); ?>
    </label>
    <div class="col-sm-3">
      <?php if (empty($static)) : ?>
        <div class="input-icon datetime-pick date-only">
          <input type="text" class="form-control input-sm" name="document_date" data-format="dd.MM.yyyy" id="document_date<?php echo $entry->id; ?>" value="<?php echo date('d.m.Y', !empty($entry->document_date) ? strtotime($entry->document_date) : time()); ?>" placeholder="<?php echo $this->lang->line('patients_home_entry_date'); ?>" />
          <span class="add-on">
            <i class="fa fa-calendar"></i>
          </span>
        </div>
      <?php else: ?>
        <p class="form-control-static"><?php echo date('d.m.Y', !empty($entry->document_date) ? strtotime($entry->document_date) : time()); ?></p>
      <?php endif; ?>
    </div>
    <label for="" class="col-sm-1 control-label text-white">
      <?php echo $this->lang->line('patients_home_entry_time'); ?>
    </label>
    <div class="col-sm-3">
      <?php if (empty($static)) : ?>
        <div class="input-icon datetime-pick time-only">
          <input type="text" class="form-control input-sm" name="document_time" data-format="hh:mm:ss" id="document_time<?php echo $entry->id; ?>" value="<?php echo !empty($entry->document_time) ? $entry->document_time : date('H:i:s', time()); ?>" placeholder="<?php echo $this->lang->line('patients_home_entry_time'); ?>" />
          <span class="add-on">
            <i class="fa fa-clock-o"></i>
          </span>
        </div>
      <?php else: ?>
        <p class="form-control-static"><?php echo !empty($entry->document_time) ? $entry->document_time : date('H:i:s', time()); ?></p>
      <?php endif; ?>
    </div>
  </div>
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
                  <a href="<?php echo site_url('akte/condition/remove_file/'.$file->entry_id); ?>">
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
  <?php if ($this->m->user_role() == M::ROLE_PATIENT) : ?>
    <?php $this->load->language('patients/all_access', $this->m->user_value('language')); ?>
    <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>" >
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
  <div class="form-group <?php echo empty($static) ? '' : 'm-b-5'; ?>" >
    <div class="col-sm-12 text-right">
      <?php if (isset($insert) && $insert && empty($hide_insert)) : ?>
        <button class="btn btn-alt btn-lg" type="submit"><span class="icomoon i-file-plus-2"></span> <?php echo $this->lang->line('general_text_button_add'); ?></button>
      <?php endif; ?>
      <?php if (isset($update_btn) && $update_btn && empty($hide_insert)) : ?>
        <button class="btn btn-alt btn-lg" type="submit"><span class="icomoon i-loop-4"></span> <?php echo $this->lang->line('general_text_button_update'); ?></button>
      <?php endif; ?>
      <?php if (isset($emergency_btn) && $emergency_btn && empty($hide_insert)) : ?>
        <button class="btn btn-alt btn-lg" type="button" data-submit-location="<?php echo site_url('akte/condition/emergency/'.$entry->id); ?>" ><span class="icomoon i-aid"></span>
          <?php echo $this->lang->line('pwidget_diagnosis_emergency_button'); ?>
        </button>
      <?php endif; ?>
      <?php if (isset($confirm_btn) && $confirm_btn && empty($hide_insert)) : ?>
        <button class="btn btn-alt btn-lg" type="button" data-submit-location="<?php echo site_url('akte/condition/confirm/'.$entry->id); ?>" ><span class="icomoon i-signup"></span>
          <?php echo $this->lang->line('pwidget_diagnosis_confirmed_button'); ?>
        </button>
      <?php endif; ?>
      <?php if (isset($archive_btn) && $archive_btn && empty($hide_insert)) : ?>
        <button class="btn btn-alt btn-lg" type="button" data-submit-location="<?php echo site_url('akte/condition/archive/'.$entry->id); ?>" ><span class="icomoon i-drawer-3"></span> 
         <?php echo $this->lang->line('pwidget_diagnosis_archieve_button'); ?>
        </button>
      <?php endif; ?>
      <?php if (isset($delete_btn) && $delete_btn && empty($hide_insert)) : ?>
        <button class="btn btn-alt btn-lg" type="button" data-submit-location="<?php echo site_url('akte/condition/archive/'.$entry->id); ?>" ><span class="icomoon i-remove-2"></span> 
          <?php echo $this->lang->line('general_text_button_delete'); ?>
        </button>
      <?php endif; ?>
    </div>
  </div>
</form>
<?php if(!empty($static))
{?>
<div class="read-more"><a href="<?php echo site_url('/akte/condition'); ?>" class="ajax-load-link">Details</a>&nbsp;<span class="fa fa-chevron-right fa-right"></span></div>
<?php
}
?>

<script type="text/javascript">
	var slider = new Slider("#befindlichkeit<?php echo $entry->id; ?>", {
		formatter: function(value) {
			return value;
		}
	});

</script>
<script type="text/javascript">
  $(function() {
    $("#befindlichkeit<?php echo $entry->id; ?>").slider().off('slide').on('change', function(slideStop){
        
		$(this).closest(".form-group").find("img").each(function(){{
                  $(this).hide();
                
                    if(parseInt($(this).attr('emotion'))===parseInt(slideStop.value.newValue)){
                            $(this).show();
                    }
                    
               }
    });
	});

    $('input[type="file"]').change(function(){
        var file = $('input[type="file"]').val();
        var exts = ['jpg','png','jpeg','gif','tif','doc','pdf','docx','odt','txt','ppt','xls','xlsx'];
        // first check if file field has any value
        if ( file ) {
          // split file name at dot
          var get_ext = file.split('.');
          // reverse name to check extension
          get_ext = get_ext.reverse();
          // check file type is valid as given in 'exts' array
          if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
            //alert( 'Allowed extension!' );
          } else {
            alert( 'Invalid file! You can upload jpg, png, jpeg, gif, tif, doc, pdf, docx, odt, txt, ppt, xls, xlsx only.');
          }
        }
	});
  }); 
 </script>
 <style>
  	.col-md-1 {
    	width: 10%;
	}   
	.input-slider2 .slider-selection {
		background: #BABABA;
	}
	.slider.slider-horizontal {
		width: 100%;
	}
        .tooltip-inner{
            margin-top: -23px !important;
        }
</style>
