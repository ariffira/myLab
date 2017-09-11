<?php 
	if(!isset($regtype) && !empty($regtype))
	{
		$regtype = 'p';
	}
?>
<div class="logo">
  <img src="<?php echo base_url('assets/img/logo/logo.png'); ?>" alt="Cyomed"/>
</div>

<div class="row m-b-10" style="padding-top:20px;">
  <div class="col-md-2">
  </div>
  <div class="col-md-8">
    <div class="portlet">
    <h4 class="portlet-title"><u>
      <?php echo $this->lang->line('reg_part_success_title');?>
    </u></h4>
      <div class="portlet-body">
        <h5>
           <?php echo $this->lang->line('reg_part_success_confirm');?>
        </h5>
        <div class="progress">
         <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
           100%
         </div>
       </div>
       <div class="help-block">
        <!-- Button trigger modal -->
        <a href="<?php echo site_url().'/portal/both/login/page?'.$regtype; ?>" target="_parent">
          <button type="button" role="button" class="btn btn-danger">
            <?php echo $this->lang->line('reg_part_confirm_link');?> 
          </button>
        </a>
      </div>
    </div>

  </div>


</div>
<div class="col-md-2">
</div>
</div>


