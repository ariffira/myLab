<?php 

 $this->ui->feed_item->base_init();

?>
<?php

  $this->load->language('global/general_text',$this->m->user_value('language'));
  $this->load->language('patients/smoking', $this->m->user_value('language'));

?>

<div class="block block-c2">

<div class='blog-list block-dis'>
 <div class="blog-block blog-cyan ">

 <div class="blog-text">
    <h2 class="title uprCase">
      <a href="">
      <?php echo $this->lang->line('smoking_heading_title'); ?>
      </a>
    </h2>
    <div class="row">
        <div class="col-md-12 marg-smok">
            <div class=" <?php echo empty($static) ? 'p-r-20' : ''; ?>">
            <label for="smoking<?php $entries->id; ?>"> 
                
            </label>
            <?php $smoking_status_array = array(
                '1' => $this->lang->line('chews_tobacco'),
                '3' => $this->lang->line('cigar_smoker'),
                '6' => $this->lang->line('former_smoker'),
                '7' => $this->lang->line('never_smoked'),
                '4' => $this->lang->line('passive_smoker'),
                '2' => $this->lang->line('snuff_user'),
                '5' => $this->lang->line('smoking_daily'),
                '8' => $this->lang->line('smoker_current_status_unknown'),
                '9' => $this->lang->line('unknown_if_ever_smoked')
            ); ?>
            &nbsp;<span style=""><?php echo $smoking_status_array[$entries->smoking_status]; ?></span>
            </div>
        </div>
    </div>
  
    <div class="read-more">

      <a href="<?php echo site_url('akte/smokingstatus'); ?>" class="ajax-load-link">
        Details
      </a>&nbsp;<span class="fa fa-chevron-right fa-right"></span>
    </div>
       

  </div>
 </div>
</div>

<script type="text/javascript">
   $('.ajax-load-link').click(function(e) 
         {
            
          e.preventDefault();
          if ($(this).attr('href').indexOf('javascript:') < 0)
          $.loadUrl($(this).attr('href'), $('#content'));
                     
       });
    $.pageSetup($('#feedContent'));
</script>
<style>
.block-dis .blog-block::before{ border:0}
.block-dis .blog-block{ padding-left:0}
.marg-smok{ padding-bottom:10px; padding-top:10px;}
</style>