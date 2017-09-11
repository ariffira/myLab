
   <div class="portlet">
   <h3 class="block-title">
      <?php echo $this->lang->line('epres_personal_info');?>
   </h3>
    <div class="table-responsive overflow">
        <table class="table table-bordered table-hover tile">
            <tbody>
                <?php foreach ($patient as $key=>$value):?> 
                    <tr>
                        <td><h6><?php echo $this->lang->line('pwidgets_my_account_'.$key);?></h6></td>
                        <td><?php echo $value;?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>

    <h3 class="block-title">
      <?php echo $this->lang->line('epres_sum_info_title');?>
    </h3>
    <div class="table-responsive overflow">
        <table class="table table-bordered table-hover tile">
            <tbody>
                <?php foreach ($eprescription as $key=>$value):?> 
                    <tr>
                        <td><h6><?php echo $this->lang->line('pwidgets_'.$key);?></h6></td>
                        <td><?php echo $value;?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>

    <h3 class="block-title">
      <?php echo $this->lang->line('epres_question_title');?>
    </h3>
    <div class="table-responsive overflow">
        <table class="table table-bordered table-hover tile">
            <tbody>
                <?php foreach ($answers as $key=>$value):?> 
                    <tr>
                        <td><?php echo $value['question']; ?></td>
                        <td><?php echo $value['answer']; ?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>


<?php if ($this->m->user_role() == M::ROLE_DOCTOR):?>  
  <form class="form-horizontal" role="form" method="post" action="<?php echo site_url('rezept/rezept/accept/'); ?>" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $eprescription['id']; ?>" />
  <input type="hidden" name="email" value="<?php echo $patient['email']; ?>" />

    
    <div class="table-responsive overflow">
        <table class="table table-bordered table-hover tile">
            <tbody>
                    <tr>
                        <td>
                          <label for="doc_comments" class="col-sm-4 control-label">
                          </label>
                          <div class="col-sm-12">
                           <textarea class="form-control" rows="5" name="doc_comments" id="doc_comments" placeholder="<?php echo $this->lang->line('epres_doc_cmnts');?>" ></textarea>
                          </div>  
                        </td>
                    </tr>
            </tbody>
        </table>
    </div>


    <div class="col-md-12">
      <div class="form-group">
        <div class="col-sm-4">
          <a href="<?php echo smart_site_url('rezept/pdfget/summary_pdf/'.$eprescription['id']); ?>" class="btn btn-danger" role="button">
            <span class="fa fa-file-pdf-o"></span> 
            PDF
          </a>
        </div>
        <div class="col-sm-4">
          <button role="button" class="btn btn-success btn-block" type="submit" style="margin-bottom:15px;">
            <span class="fa fa-thumbs-up"></span> 
             <?php echo $this->lang->line('epres_btn_accept');?>
          </button>
        </div>
        <div class="col-sm-4">
          <a href="<?php echo smart_site_url('rezept/rezept/not_accept/'.$eprescription['id']); ?>" class="btn btn-danger" role="button">
            <span class="fa fa-thumbs-down"></span> 
             <?php echo $this->lang->line('epres_btn_not_accept');?>
          </a>
        </div>
      </div>
  </div>
<div class="clear"></div> 
 </div>
</div> 

</div> 
</form>


<?php endif;?>

<?php if ($this->m->user_role() == M::ROLE_PATIENT):?>  
    <a href="<?php echo smart_site_url('rezept/pdfget/summary_pdf/'.$eprescription['id']); ?>" class="btn btn-danger" role="button"><span class="fa fa-file-pdf-o "></span> Pdf</a>

    <a href="<?php echo smart_site_url('rezept/rezept/all_check/'.$eprescription['id']); ?>" class="btn btn-danger" role="button"><span class="fa fa-forward"></span>Fortfahren</a>
<?php endif;?>