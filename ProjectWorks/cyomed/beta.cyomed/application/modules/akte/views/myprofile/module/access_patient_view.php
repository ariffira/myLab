<?php 
  if(!empty($v_users))
  {
      foreach ($v_users as $row) :?>
            <div class="col-md-3">
                       <div class="block block-user text-center">
                        <div class="img">
                              <img src="<?php $this->load->model('document/mdoc');
                              echo ($img_path = $this->mdoc->get_profile_img_path($row->regid)) ? base_url($img_path) : '//placehold.it/120x120'; ?>"/></div>
                               
                                <h2><?php echo strtoupper($row->name); ?> <?php echo strtoupper($row->surname);?></h2>
                        </div>
           </div>
           <div class="col-md-9">
           <div class="block block-c2">
            <div class="blog-list">
             <?php
                   $this->load->model('modoc');
                   echo $this->modoc->patientdetails($row->id);
             ?>
          </div>
          </div>
     </div>
</div>
       <?php
         endforeach;
  }
  else
  {
      ?>
<div class="tile m-b-10 portlet text-center">
     <span class="text-danger"><strong>Please Enter Valid Patient Id</strong></span>
</div>
          <?php }
  ?>     
