
<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('eprescription/doctors/epres/accept/'); ?>" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $eprescription['id'] ?>" />
  <input type="hidden" name="email" value="<?php echo $patient['email'] ?>" />
	<h3 class="block-title">Patient Infomation</h3>
	<div class="table-responsive overflow">
        <table class="table table-bordered table-hover tile">
        	<tbody>
        		<?php foreach ($patient as $key=>$value):?> 
        			<tr>
        				<td><?php echo $key;?></td>
                        <td><?php echo $value;?></td>
                    </tr>
                <?php endforeach;?>
			</tbody>
        </table>
    </div>

	<h3 class="block-title">Rezept Information</h3>
    <div class="table-responsive overflow">
        <table class="table table-bordered table-hover tile">
        	<tbody>
        		<?php foreach ($eprescription as $key=>$value):?> 
        			<tr>
        				<td><?php echo $key;?></td>
                        <td><?php echo $value;?></td>
                    </tr>
                <?php endforeach;?>
			</tbody>
        </table>
    </div>

	<h3 class="block-title">Fragebogen</h3>
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

    <h3 class="block-title">Kommentare</h3>
    <div class="table-responsive overflow">
        <table class="table table-bordered table-hover tile">
            <tbody>
                    <tr>
                        <td>
                          <label for="doc_comments" class="col-sm-4 control-label">
                          </label>
                          <div class="col-sm-12">
                           <textarea class="form-control" rows="5" name="doc_comments" id="doc_comments" placeholder="Your advice about eprescription" ></textarea>
                          </div>  
                        </td>
                    </tr>
            </tbody>
        </table>
    </div>


    <div class="col-md-12">
      <div class="form-group">
        <div class="col-sm-4">
          <a href="#" class="btn btn-danger" role="button"><span class="fa fa-file-pdf-o"></span> PDF</a>
        </div>
        <div class="col-sm-4">
          <button role="button" class="btn btn-success btn-block" type="submit" style="margin-bottom:15px;"><span class="fa fa-thumbs-up"></span> Akzeptieren</button>
        </div>
        <div class="col-sm-4">
          <a href="<?php echo site_url('eprescription/doctors/epres/not_accept/'.$eprescription['id']); ?>" class="btn btn-danger" role="button"><span class="fa fa-thumbs-down"></span> Nicht Akzeptieren</a>
        </div>
      </div>
  </div>

 </div>
</div>  

</form>