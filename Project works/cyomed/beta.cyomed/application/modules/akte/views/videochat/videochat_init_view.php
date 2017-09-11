<div id="videochat" class="modal fade videochat-modal-sm">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">My Contact List</h4>
            </div>
            <div class="modal-body p-l-20 p-r-20 ">
                <?php $i = 1; foreach ($v_users as $row ) : ?>
                <div class="row" style="border-bottom: 1px solid #DDD; padding-top: 5px;padding-bottom: 5px;">
                    <div class="col-xs-3" >
                        <form class="" method="post" action="<?php echo site_url('akte/videochat/callsend'); ?>" enctype="multipart/form-data">
                            <input type="hidden" name="conferenceid"  value= "<?php echo $row->regid; ?>" />
                            <input type="hidden" name="conferenceto"  value= "<?php echo $row->regid; ?>" />
                            <input type="hidden" name="sessionid"  value= "<?php echo $row->surname; ?>" />
                            <button type="submit" class="btn btn-success" ><i class="fa fa-phone fa-lg"></i> </button>
                        </form>
                    </div>
                     <div class="col-xs-9" style="padding-top: 5px;padding-bottom: 5px;" >  
                        <h5><?php echo $row->name; ?><?php echo $row->surname; ?></h5>    
                    </div>
                </div>
                
                <?php $i++; endforeach; ?>  
 

              
          </div>
      </div> 
  </div>
</div>






  <!-- Use this to load the modal necessary for loading and closing the modal-->
  <script type="text/javascript">
   $('#videochat').modal('show');
</script>