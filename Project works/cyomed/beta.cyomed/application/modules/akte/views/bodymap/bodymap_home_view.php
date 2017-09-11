<?php
  $entry = !empty($entry) ? $entry : array(
    'id' => 0,
  );
//  print_r($entry);die;
  $entry = (object)$entry;
  $insert = empty($entry->id);
  $this->load->language('global/general_text',$this->m->user_value('language'));
  $this->load->language('patients/all_access', $this->m->user_value('language'));
  $this->load->language('pwidgets/bodymap', $this->m->user_value('language'));
?>

<div class="blog-block blog-blue">
 <div class="date-block"><div class="date-meta"><?php echo date('d',strtotime($entry->date_added));?>. <span><?php echo date('M',strtotime($entry->date_added));?></span></div></div>
  <div class="blog-text blog-text-val">
    <?php if (!empty($static)) : ?>
      <h2 class="title blue font_type1 uprCase"><?php echo $this->lang->line('patients_body_map'); ?></h2>
    <article>     
      <div class="blog-img">
           <?php if(!empty($entry->files)):?>
           <?php foreach ($entry->files as $file) : ?>
                   <a href="<?php echo base_url($this->mdoc->get_file_path($file)); ?>" target="_blank" class="<?php echo Ui::$bs_tname == 'sa103' ? 'text-white' : ''; ?>">
                    <?php if (in_array(strtolower($file->document_extension), array('jpg', 'png', 'jpeg', 'gif', 'tif', ))) : ?>
                      <?php if (file_exists($this->mdoc->get_file_path($file))) : ?>
                        <img src="<?php echo base_url('assets/php/image_php/image_php.php'); ?>?width=165&height=118&cropratio=10:9&image=<?php echo base_url($this->mdoc->get_file_path($file)); ?>" width="100%" />
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
        <?php endforeach;
        else:?>
          
              <img src="<?php echo base_url('assets/img/portal/no-image.jpg'); ?>" alt="">
      <?php endif;?>
      </div>
  	<?php endif; ?>
          
     <div class="row">
          <div class="col-md-6 m-b-10">
            <div class="col-md-6">
            
           <label> <?php echo $this->lang->line('pain_type'); ?>  </label> 
            </div>
           <div class="col-md-6">
           <p class="form-val"><?php echo !empty($entry->pain_type) ? form_prep($entry->pain_type) :$this->lang->line('patients_body_map_none'); ?></p>
           </div>
        </div>
        <div class="col-md-6 m-b-10">
             <div class="col-md-6">
            
           <label> <?php echo $this->lang->line('pain_intensity'); ?> </label> 
            </div>
           <div class="col-md-6">
           <p class="form-val"><?php echo !empty($entry->pain_intensity) ? form_prep($entry->pain_intensity):$this->lang->line('patients_body_map_none'); ?></p>
           </div>
           
        </div>
             <div class="col-md-6 m-b-10">
             <div class="col-md-6">
            
           <label> <?php echo $this->lang->line('qualities'); ?> </label> 
            </div>
           <div class="col-md-6">
           <p class="form-val"><?php echo !empty($entry->qualities) ? form_prep($entry->qualities) :$this->lang->line('patients_body_map_none');?></p>
           </div>
           
        </div>
<!--         <p class="form-val clr"><em><b><?php // echo $this->lang->line('qualities'); ?></b></em>: <?php // echo !empty($entry->qualities) ? form_prep($entry->qualities) : ''; ?></p>-->
  
    </div>
<!--    <div class="category"><?php // echo $this->lang->line('pain_type'); ?></div>
    <div class="short-desc"><?php // echo !empty($entry->pain_type) ? form_prep($entry->pain_type) : ''; ?></div>
    <div class="category"><?php // echo $this->lang->line('pain_intensity'); ?></div>
    <div class="short-desc"><?php // echo !empty($entry->pain_intensity) ? form_prep($entry->pain_intensity) : ''; ?></div>-->
          <div class="row">
        <div class="col-md-6">
           
            <p class="form-val"><b><?php echo $this->lang->line('date_from'); ?>:</b> <?php echo !empty($entry->date_from) ? date('d.m.Y', strtotime($entry->date_from)) : ''; ?></p>
        </div>
        <div class="col-md-6">
            <p class="form-val"><b><?php echo $this->lang->line('time_from'); ?>:</b> <?php echo !empty($entry->time_from) ? date('d.m.Y', strtotime($entry->time_from)) : ''; ?></p>
        </div>
    </div>
    <p class="form-val multi-select-val clr">
        </p>
    <?php if ($this->m->user_role() == M::ROLE_PATIENT) : ?>
    <?php $this->load->language('patients/all_access', $this->m->user_value('language')); ?>
    <p>
    	<label class="radio-inline"><input type="checkbox"  value="1" id="access1_<?php echo $entry->id; ?>" name="access" <?php echo isset($entry->access_permission) && $entry->access_permission == '1' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"' ?> /> <?php echo $this->lang->line('patients_all_accesss_my_doctor'); ?></label>
        <label class="radio-inline"><input type="checkbox" value="2" id="access2_<?php echo $entry->id; ?>" name="access" <?php echo isset($entry->access_permission) && $entry->access_permission == '2' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"' ?> /> <?php echo $this->lang->line('patients_all_accesss_all_doctor'); ?> </label>
        <label class="radio-inline"><input type="checkbox"value="0" id="access0_<?php echo $entry->id; ?>" name="access" <?php echo isset($entry->access_permission) && $entry->access_permission == '0' ? 'checked="checked"' : ''; ?> <?php echo empty($static) ? '' : 'disabled="disabled" readonly="readonly"' ?> /> <?php echo $this->lang->line('patients_all_access_private_mode'); ?></label>
        
        <?php if (empty($static)) : ?>
        <em class="help-block font12"><span style="color:red;">*</span><?php echo $this->lang->line('patients_all_access_selection_info'); ?></em>
        <?php endif; ?>
    </p>
    <?php endif; ?>

</article>
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

  </div><a href="<?php echo site_url('/akte/bodymap/index/'.$entry->id); ?>" class="ajax-bodymap-link<?php echo $entry->id; ?>">
      Details</a>&nbsp;<span class="fa fa-chevron-right fa-right"></span>
</div>

</div>

 </div>

   <script type="text/javascript">

        $('.ajax-bodymap-link<?php echo $entry->id; ?>').click(function(e) 
        {
          e.preventDefault();
          if ($(this).attr('href').indexOf('javascript:') < 0)

          $.loadUrl($(this).attr('href'), $('#content'));

         });

  </script>
  
  
  <script>
   

    $('article').readmore({speed: 500});
  </script>
    