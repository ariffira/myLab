<div class="table-responsive">
<table class="table table-hover table-bordered">
<thead>
  <tr>
    <th><?php echo $this->lang->line('pwidgets_id');?></th>
    <th><?php echo $this->lang->line('pwidgets_Handelsname');?></th>
    <th><?php echo $this->lang->line('pwidgets_drug');?></th>
    <th><?php echo $this->lang->line('pwidgets_atc_code');?></th> 
    <th><?php echo $this->lang->line('pwidgets_packsize');?></th>
    <th><?php echo $this->lang->line('pwidgets_status');?></th>
    <th><i class="sa-top-message"></i><?php echo $this->lang->line('pwidgets_comments');?></th>
    <th><i class="icomoon i-mail-4"></i></th>
  </tr>
</thead>

<tbody>
  <?php $i=1; foreach ($data as $row) : ?>
  <tr>
  	<td>
      <a href="<?php echo smart_site_url('rezept/rezept/select_rezept?rezept_id='.$row->id);?>"><?php echo $i;?></a>      
    </td>
    <td>
       <?php echo $row->Handelsname;?>
	  </td>
    <td>
       <?php echo $row->drug;?>
    </td>
	  <td>
       <?php echo $row->atc_code;?>
	  </td>
	  <td>
	   <?php echo $row->packsize;?>
	  </td>
    <td>
       <?php 
       if($row->status == 0) { 
        echo $this->lang->line('epres_not_send');
       }
       elseif($row->status == 1)
        echo $this->lang->line('epres_unchecked');
       elseif($row->status == 2)
        echo $this->lang->line('epres_checked');
      elseif($row->status == 3)
        echo $this->lang->line('epres_accepted');
      elseif($row->status == 4)
        echo $this->lang->line('epres_not_accepted');
       ?>
	  </td>
    <td>
     <?php echo isset($row->doc_comments) && $row->doc_comments ? $row->doc_comments : $this->lang->line('no_msg');;?>
    </td>
  </tr>
  <?php $i++; endforeach; ?>
</tbody>

</table>
</div>
