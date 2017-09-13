<?php
$this->load->language('pwidgets/rezept',$this->m->user_value('language'));
?>
<form class="form-horizontal" action="" method="post">
  <input type="hidden" name="batch" value="<?php echo random_string('alnum', 32); ?>" />
    <div class="table-responsive">
      <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th><?php echo $this->lang->line('pwidgets_id');?></th>
          <th>Patient ID</th>
          <th><?php echo $this->lang->line('pwidgets_Handelsname');?></th>
          <th><?php echo $this->lang->line('pwidgets_drug');?></th>
          <th><?php echo $this->lang->line('pwidgets_atc_code');?></th> 
          <th><?php echo $this->lang->line('pwidgets_packsize');?></th>
          <th><?php echo $this->lang->line('pwidgets_status');?></th>
        </tr>
      </thead>
      
      <tbody>
        <?php $i=1; foreach ($data as $row) :  
            if($row->patient_id!=""){
            $patientdetails=$this->m->user_details($row->patient_id);
            }
            ?>
        <tr>
          <td>
           <?php echo $i;?>
          </td>
          <td>
             <?php echo count((array)$patientdetails>0)?$patientdetails->name." ".$patientdetails->surname: $row->patient_id;?>
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
             <?php if($row->status == 1):?> 
                <button type='submit' data-submit-location="<?php echo smart_site_url('rezept/rezept/select_rezept?rezept_id='.$row->id);?>" ><i>Ungeprüft</i></button>
              <?php elseif($row->status == 2):?> 
                <button type='submit' data-submit-location="<?php echo smart_site_url('rezept/rezept/select_rezept?rezept_id='.$row->id);?>" ><i>Geprüft</i></button>
              <?php elseif($row->status == 3):?> 
                <button type='submit' data-submit-location="<?php echo smart_site_url('rezept/rezept/select_rezept?rezept_id='.$row->id);?>" ><i>Akzeptiert</i></button>
              <?php elseif($row->status == 4):?> 
                <button type='submit' data-submit-location="<?php echo smart_site_url('rezept/rezept/select_rezept?rezept_id='.$row->id);?>" ><i>nicht akzeptiert</i></button>
              <?php else: 
                echo "Keine Rezeptpflichtige Anwendungen";
              endif;?>
        </td>
        </tr>
        <?php $i++; endforeach; ?>
      </tbody>
      
      </table>
    </div>
</form>