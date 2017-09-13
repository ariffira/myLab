<div id="videochat" class="modal fade videochat-modal-sm">

    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">

  <?php $i = 1;
                foreach ($v_users as $row) : ?>             
<div style="float:right;">
   <a href="<?php echo site_url('akte/pdfget/getprofiledetail/'.$row->regid);?>" class="btn btn-default">Pdf</a> 
   &nbsp; 
   <a data-dismiss="modal" aria-hidden="true" class="btn btn-default">Close</a>
</div>
                <h4 class="modal-title">
          <?php echo $this->lang->line('my_pat_details');?>
                     </h4>
</div>
 <div class="modal-body p-l-20 p-r-20 ">
             <div class="row" style="border-bottom: 1px solid #DDD; padding-top: 5px;padding-bottom: 5px;">
                        <div class="col-xs-3" style="float:left;"><img class="profile-pic img-responsive" src="<?php $this->load->model('document/mdoc');
                    echo ($img_path = $this->mdoc->get_profile_img_path($row->regid)) ? base_url($img_path) : '//placehold.it/120x120'; ?>"/></div>
                        <div class="col-xs-9" style="padding-top: 5px;padding-bottom: 5px;" >  
                            <label><?php echo $this->lang->line('pwidgets_my_account_first_name');?></label><?php echo $row->name; ?><?php echo $row->surname; ?> <br/>
                            <label><?php echo $this->lang->line('pwidgets_my_account_id');?></label><?php echo $row->regid; ?><br/>
                            <label><?php echo $this->lang->line('my_pat_age');?></label><?php echo $this->m->get_Age_difference($row->dob,date("Y-m-d"));?><br/>
                            <label><?php echo $this->lang->line('pwidgets_my_account_email');?></label><?php echo $row->email; ?><br/>
                            <label><?php echo $this->lang->line('pwidgets_my_account_city');?></label><?php echo $row->city; ?><br/>
                            <label><?php echo $this->lang->line('pwidgets_my_account_mobile_number');?></label><?php echo $row->mobile; ?><br/>
                            <label><?php echo $this->lang->line('pwidgets_my_account_telephone_number');?></label><?php echo $row->telephone; ?><br/>
                        </div>
                        <div style="clear:both;"></div>
                        <div>
                            <?php
                            $this->load->model('modoc');
                            echo $this->modoc->mypatientdetails($row->id);
                            ?>
                        </div>
                    </div>
          <?php $i++;
          endforeach; ?>  
            </div>
            <div>

            </div>
        </div> 
    </div>
</div>
