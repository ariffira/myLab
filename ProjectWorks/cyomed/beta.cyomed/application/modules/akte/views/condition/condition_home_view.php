<?php
 $entry = !empty($entry) ? $entry : array(
    'id' => 0,
  );
  $entry = (object)$entry;
  $insert = empty($entry->id);
  $this->load->language('global/general_text',$this->m->user_value('language'));
  $this->load->language('patients/home',$this->m->user_value('language'));
?>
 <div class="blog-block blog-cyan">
 <div class="date-block"><div class="date-meta"><?php echo date('d',strtotime($entry->document_date));?>. <span><?php echo date('M',strtotime($entry->document_date));?></span></div></div>
  <div class="blog-text blog-text-val">
          
<?php
if (!empty($static)) : ?>
    <h2 class="title cyan1 font_type1 uprCase"><?php echo $this->lang->line('patients_home_page_title'); ?></h2>
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
          <img src="<?php echo base_url('assets/img/portal/no-image.jpg'); ?>" alt="">
      <?php endif; ?>
    </div>
   <?php endif; ?>
   <div class="category"><?php echo !empty($entry->title) ? $entry->title : ''; ?></div>
   <div class="short-desc"><?php echo !empty($entry->description) ? $entry->description : ''; ?></div>
   <div class="row condition-val clr <?php //echo empty($static) ? '' : 'm-b-0'; ?>" >
        <div class="col-sm-10 col-xs-9">
          <?php if (empty($static)) : ?>
            <input type="text" class="input-slider" name="befindlichkeit" id="befindlichkeit<?php echo $entry->id; ?>" value="<?php echo !empty($entry->befindlichkeit) ? $entry->befindlichkeit : 0; ?>" data-slider-value="<?php echo !empty($entry->befindlichkeit) ? $entry->befindlichkeit : 0; ?>" data-slider-min="0" data-slider-max="10" data-slider-step="1" <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> />
          <?php else: ?>
            <div class="progress progress-sm m-b-0">
              <div class="progress-bar progress-bar-<?php echo !empty($entry->befindlichkeit) ? ($entry->befindlichkeit <= 4 ? 'success' : ($entry->befindlichkeit <= 6 ? 'warning' : 'danger') ) : 'primary'; ?>" role="progressbar" aria-valuenow="<?php echo !empty($entry->befindlichkeit) ? $entry->befindlichkeit * 10 : 0; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo !empty($entry->befindlichkeit) ? $entry->befindlichkeit * 10 : 0; ?>%">
                <span class="sr-only"><?php echo !empty($entry->befindlichkeit) ? $entry->befindlichkeit * 10 : 0; ?>% <?php echo $this->lang->line('patients_home_complaint_scale'); ?> (primary)</span>
              </div>
            </div>
          <?php endif; ?>
        </div>
      <?php for($i=0;$i<=10;$i++):?>   
        <?php //if($entry->befindlichkeit):?>
          <?php 
            if ($entry->befindlichkeit==$i):
              switch ($entry->befindlichkeit) {
                case 0:
                    $img_src = base_url('assets/img/emotion/1.png');
                    break;
                case 10:
                    $img_src = base_url('assets/img/emotion/9.png');
                    break;
                default:
                    $img_src = base_url('assets/img/emotion/'.$i.'.png');
                    break;
              }
          ?>
            <div class ="col-md-1 col-sm-2 col-xs-3" name="emotion" style="margin-top:-10px;">
              <img src="<?php echo $img_src; ?>" class="pull-right" emotion='<?php echo $i; ?>'>
            </div>
          <?php //elseif($entry->befindlichkeit==0 && $i==0):?>
          <!--<div class ="col-sm-2 col-xs-3" name="emotion" style="margin-top:-10px;">
            <img src="<?php //echo base_url('assets/img/emotion/1.png'); ?>" class="pull-right" emotion='1'>
          </div>-->
          <?php //elseif($entry->befindlichkeit==10 && $i==10):?>
          <!--<div class ="col-sm-2 col-xs-3" name="emotion" style="margin-top:-10px;">
            <img src="<?php //echo base_url('assets/img/emotion/9.png'); ?>" class="pull-right" emotion='9'>
          </div>-->
          <?php //else:?>
          <!--<div class ="col-sm-2 col-xs-3" name="emotion" style="margin-top:-10px;">
            <img src="<?php //echo base_url('assets/img/emotion/'.$i.'.png'); ?>" class="pull-right" style="display: none;" emotion='<?php echo $i; ?>'>
          </div>-->
          <?php endif;?>
        <?php //else:?>
          <!--<div class ="col-sm-2 col-xs-3" name="emotion" style="margin-top:-10px;">
            <img src="<?php //echo base_url('assets/img/emotion/'.$i.'.png'); ?>" class="pull-right" style="display: none;" emotion='<?php echo $i; ?>'>
          </div> -->   
        <?php //endif;?>
      <?php endfor;?>
  </div>
  <div class="row">
  	<div class="col-md-6"><?php echo $this->lang->line('patients_home_entry_date'); ?>: <?php echo date('d.m.Y', !empty($entry->document_date) ? strtotime($entry->document_date) : time()); ?></div>
    <div class="col-md-6"><?php echo $this->lang->line('patients_home_entry_time'); ?>: <?php echo !empty($entry->document_time) ? $entry->document_time : date('H:i:s', time()); ?></div>
  </div>
   
   
    <div class="form form-horizontal hidden">
   <div class="form-group form-group1 <?php //echo empty($static) ? '' : 'm-b-0'; ?>" >
    <label for="befindlichkeit<?php echo $entry->id; ?>" class="col-sm-5 text-white"><?php echo $this->lang->line('patients_home_complaint_scale'); ?></label>
    <div class="col-sm-5 col-xs-9">
      <?php if (empty($static)) : ?>
        <input type="text" class="input-slider" name="befindlichkeit" id="befindlichkeit<?php echo $entry->id; ?>" value="<?php echo !empty($entry->befindlichkeit) ? $entry->befindlichkeit : 0; ?>" data-slider-value="<?php echo !empty($entry->befindlichkeit) ? $entry->befindlichkeit : 0; ?>" data-slider-min="0" data-slider-max="10" data-slider-step="1" <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"'; ?> />
      <?php else: ?>
        <div class="progress progress-sm m-b-0">
          <div class="progress-bar progress-bar-<?php echo !empty($entry->befindlichkeit) ? ($entry->befindlichkeit <= 4 ? 'success' : ($entry->befindlichkeit <= 6 ? 'warning' : 'danger') ) : 'primary'; ?>" role="progressbar" aria-valuenow="<?php echo !empty($entry->befindlichkeit) ? $entry->befindlichkeit * 10 : 0; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo !empty($entry->befindlichkeit) ? $entry->befindlichkeit * 10 : 0; ?>%">
            <span class="sr-only"><?php echo !empty($entry->befindlichkeit) ? $entry->befindlichkeit * 10 : 0; ?>% <?php echo $this->lang->line('patients_home_complaint_scale'); ?> (primary)</span>
          </div>
        </div>
      <?php endif; ?>
    </div>
      <?php for($i=1;$i<10;$i++):?>   
        <?php if(!empty($entry->befindlichkeit)&&$entry->befindlichkeit):?>
          <?php if ($entry->befindlichkeit==$i && $i != 0 && $i != 10):?>
            <div class ="col-sm-2 col-xs-3" name="emotion" style="margin-top:-10px;">
              <img src="<?php echo base_url('assets/img/emotion/'.$i.'.png'); ?>" class="pull-right" emotion='<?php echo $i; ?>'>
            </div>
          <?php elseif($entry->befindlichkeit==0):?>
          <div class ="col-sm-2 col-xs-3" name="emotion" style="margin-top:-10px;">
            <img src="<?php echo base_url('assets/img/emotion/1.png'); ?>" class="pull-right" emotion='1'>
          </div>
          <?php elseif($entry->befindlichkeit==10):?>
          <div class ="col-sm-2 col-xs-3" name="emotion" style="margin-top:-10px;">
            <img src="<?php echo base_url('assets/img/emotion/9.png'); ?>" class="pull-right" emotion='9'>
          </div>
          <?php else:?>
          <div class ="col-sm-2 col-xs-3" name="emotion" style="margin-top:-10px;">
            <img src="<?php echo base_url('assets/img/emotion/'.$i.'.png'); ?>" class="pull-right" style="display: none;" emotion='<?php echo $i; ?>'>
          </div>
          <?php endif;?>
        <?php else:?>
          <div class ="col-sm-2 col-xs-3" name="emotion" style="margin-top:-10px;">
            <img src="<?php echo base_url('assets/img/emotion/'.$i.'.png'); ?>" class="pull-right" style="display: none;" emotion='<?php echo $i; ?>'>
          </div>    
        <?php endif;?>
      <?php endfor;?>
  </div>
  
  <div class="form-group form-group1 <?php //echo empty($static) ? '' : 'm-b-0'; ?>" >
    <label for="title_name<?php $entry->id; ?>" class="col-sm-5 "><?php echo $this->lang->line('patients_home_complaints'); ?></label>
    <div class="col-sm-7">
      <?php if (empty($static)) : ?>
        <input type="text" class="form-control" name="title_name" id="title_name<?php echo $entry->id; ?>" value="<?php echo !empty($entry->title) ? $entry->title : ''; ?>" placeholder="<?php echo $this->lang->line('patients_home_complaints'); ?>" required />
      <?php else: ?>
        <p class="form-control-static"><?php echo !empty($entry->title) ? $entry->title : ''; ?></p>
      <?php endif; ?>
    </div>
  </div>
  <div class="form-group form-group1 <?php //echo empty($static) ? '' : 'm-b-0'; ?>" >
    <label for="condition<?php $entry->id; ?>" class="col-sm-5 "><?php echo $this->lang->line('patients_home_condition_detail'); ?></label>
    <div class="col-sm-7">
      <?php if (empty($static)) : ?>
        <textarea class="form-control" rows="5" name="condition" id="condition<?php echo $entry->id; ?>" placeholder="<?php echo $this->lang->line('patients_home_condition_detail'); ?>" ><?php echo !empty($entry->description) ? $entry->description : ''; ?></textarea>
      <?php else: ?>
        <p class="form-control-static" style="word-break: break-all;"><?php echo !empty($entry->description) ? $entry->description : ''; ?></p>
      <?php endif; ?>
    </div>
  </div>
  <div class="form-group <?php //echo empty($static) ? '' : 'm-b-0'; ?>" >
    <label for="document_date<?php echo $entry->id; ?>" class="col-sm-3">
      <?php echo $this->lang->line('patients_home_entry_date'); ?>
    </label>
    <div class="col-sm-4">
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
</div>
  <div class="form-group <?php //echo empty($static) ? '' : 'm-b-0'; ?>" >
    <label for="document_time<?php echo $entry->id; ?>" class="col-sm-3">
      <?php echo $this->lang->line('patients_home_entry_time'); ?>
    </label>
    <div class="col-sm-4">
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
  <div style="display:none" class="form-group <?php //echo empty($static) ? '' : 'm-b-0'; ?>" >
    <label for="document_upload<?php echo $entry->id; ?>" class="col-sm-3">
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
                    <?php $file->document_extension = strtolower($file->document_extension); if (in_array(strtolower($file->document_extension), array('jpg', 'png', 'jpeg', 'gif', 'tif', ))) : ?>
                      <?php if (file_exists($this->mdoc->get_file_path($file))) : ?>
                        <img src="<?php echo base_url('assets/php/image_php/image_php.php'); ?>?width=66&height=138&cropratio=10:9&image=<?php echo base_url($this->mdoc->get_file_path($file)); ?>" />
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
                <td class="text-center" style="vertical-align:middle;">
                  <a href="<?php echo site_url('akte/document/edit/'.$file->id); ?>">
                    <span class="icomoon i-pencil-6 icon16" style="<?php echo Ui::$bs_tname == 'sa103' ? 'color:white;' : ''; ?>"></span>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
        </p>
      <?php endif; ?>
    </div>
  </div>
    </div>
    </article>
  <?php if(!empty($static))
   {
  ?>
   <div class="read-more"> <span class="pull-left ">
      <span  class="font-format font12">
         <?php if(!empty($entry->added_by))
         {
            echo $this->lang->line('general_addedby');
             ?>
          <em><?php echo ($entry->user_role=='role_doctor')? 'Doctor':'Patient';?> 
          <?php $res=$this->m->user_details($entry->added_by,$entry->user_role); 
           echo $res->name."&nbsp;".$res->regid; 
       ?></em> <?php  echo $this->lang->line('general_on');?> <?php echo date('d. M .Y',strtotime($entry->date_added));?>
       <?php } ?>
      </span>
   </span><a href="<?php echo site_url('/akte/condition/index/'.$entry->id); ?>" class="ajax-condition-link<?php echo $entry->id; ?>">Details</a>&nbsp;<span class="fa fa-chevron-right fa-right"></span></div>
  <?php
   }
  ?>
    </div>
    </div>
<script type="text/javascript">
        $('.ajax-condition-link<?php echo $entry->id; ?>').click(function(e) 
         {
          e.preventDefault();
          if ($(this).attr('href').indexOf('javascript:') < 0)
          $.loadUrl($(this).attr('href'), $('#content'));
         });
</script>

<script>
   $('article').readmore({speed: 500});
</script>
<style>
	.short-desc {
		word-wrap: break-word;
	}
</style>