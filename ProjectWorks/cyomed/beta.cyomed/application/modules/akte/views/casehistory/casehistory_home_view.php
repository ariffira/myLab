<?php
 $entry = !empty($entry) ? $entry : array(
    'id' => 0,
  );
  $entry = (object)$entry;
  $insert = empty($entry->id);
  $this->load->language('global/general_text',$this->m->user_value('language'));
  $this->load->language('patients/home',$this->m->user_value('language'));
?>
 <div class="blog-block blog-blue">
 <div class="date-block"><div class="date-meta"><?php echo date('d',strtotime($entry->date_added));?>. <span><?php echo date('M',strtotime($entry->date_added));?></span></div></div>
  <div class="blog-text blog-text-val">
          
<?php
//print_r($entry);die;
if (!empty($static)) : ?>
    <h2 class="title blue font_type1 uprCase"><?php echo $this->lang->line('patients_home_new_case_title'); ?></h2>
    <div class="clr"></div>
     <article>
    <div class="blog-img">
         <img src="<?php echo base_url('assets/img/portal/no-image.jpg'); ?>" alt="">
        <?php /* if(!empty($entry->files)):?>
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
      <?php endif; */?>
    </div>
   <?php endif; ?>
          <?php if(!empty($entry->doctor_id))
         {
              $res=$this->m->user_details($entry->doctor_id,'role_doctor');
          }
          ?>
<!--   <div class="category"><?php echo !empty($entry->title) ? $entry->title : ''; ?></div>-->
   <div class="category">Anamnesebogen Arztbesuch 
        <?php if(!empty($res) && isset($res) && is_object($res))
         {
            echo  'Dr. '.$res->name;
        }
       ?>
      </div>
   <div class="short-desc"> Visit <?php echo  ($entry->date_added>$entry->date_modified) ? date('d.m.Y-h:i',strtotime($entry->date_added) ):date('d.m.Y-h:i',strtotime($entry->date_modified) ) ; ?></div>
   <div class="row condition-val clr <?php //echo empty($static) ? '' : 'm-b-0'; ?>" >
        <div class="col-sm-10 col-xs-9">
         
        </div>
     
  </div>
  
   
   
    
    </article>
  <?php if(!empty($static))
   {
  ?>
   <div class="read-more"> <span class="pull-left ">
      <span  class="font-format font12">
         <?php if(!empty($res) && isset($res) && is_object($res))
         {
            echo $this->lang->line('general_addedby');
             ?>
          <em>Doctor
          <?php // $res=$this->m->user_details($entry->doctor_id,'role_doctor'); 
           echo $res->name."&nbsp;".$res->regid; 
       ?></em> <?php  echo $this->lang->line('general_on');?> <?php echo date('d. M .Y',strtotime($entry->date_added));?>
       <?php } ?>
      </span>
   </span><a href="<?php echo site_url('/akte/casehistory/index/'.$entry->id); ?>" class="ajax-case-link<?php echo $entry->id; ?>">Details</a>&nbsp;<span class="fa fa-chevron-right fa-right"></span></div>
  <?php
   }
  ?>
    </div>
    </div>
<script type="text/javascript">
        $('.ajax-case-link<?php echo $entry->id; ?>').click(function(e) 
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