
<?php $this->load->language('patients/my_doctors', $this->m->user_value('language')); ?>
<?php $this->load->language('global/general_text', $this->m->user_value('language')); ?>
<?php $this->load->language('pwidgets/my_account', $this->m->user_value('language')); ?>

<form class="form" action="<?php echo site_url('doctors/my_patients/select'); ?>" method="post">
  <input type="hidden" name="batch" value="<?php echo random_string('alnum', 32); ?>" />
  
  <div class="table-responsive overflow">
    <table class="table tile">
      <thead>
        <tr>
          <th>
          <?php echo $this->lang->line('patients_my_pat_id');?>
          </th>
          <th>
          <?php echo $this->lang->line('pwidgets_my_account_first_name');?>
          </th>
          <th>
          <?php echo $this->lang->line('pwidgets_my_account_last_name');?>
          </th>
          <th>
          <?php echo $this->lang->line('pwidgets_my_account_city');?>
          </th>
          <th>
          <?php echo $this->lang->line('patients_my_doctors_access_permission');?>
          </th>
          <th>
            <?php echo $this->lang->line('my_pat_details_action');?>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; if (!empty($patients) && is_array($patients) && count($patients) > 0) : foreach ($patients as $row ) : ?>
          <tr>
            <td>
              <?php echo isset($row->regid) ? $row->regid : ''; ?>
            </td>
            <td>
              <?php echo $row->name; ?>
            </td>
            <td>
              <?php echo $row->surname; ?>
            </td>
            <td>
              <?php echo $row->city; ?>
            </td>
            <td>

              <div class="checkbox m-0 m-b-5">
                <label>
                  <input type="checkbox" value="1" id="inputMyDoctorAccess<?php echo $row->id; ?>" name="access[<?php echo $row->id; ?>]" <?php echo $row->access_rights == 1 ? "checked=checked" : ""; ?> disabled="disabled" readonly="readonly" />
                </label>
              </div>
                
            </td>
            <td>
              <button class="btn btn-alt btn-xs" type="button" data-submit-location="<?php echo site_url('akte/access/insert/'.$row->regid); ?>" >
                <span class="icomoon i-enter"></span> 
                <?php echo $this->lang->line('general_text_button_choose_patient'); ?>
              </button>
                 <button class="btn btn-alt btn-xs" type="button" data-submit-location="<?php echo site_url('akte/access/view/'.$row->regid); ?>" >
                <span class="icomoon i-enter"></span> 
                <?php echo $this->lang->line('general_text_button_view_patient'); ?>
              </button>
             <!-- <a href="<?php echo site_url('akte/access'); ?>" class="sa-side-photos ajax-nav-links active">
                    <?php echo $this->lang->line('general_text_button_view_patient'); ?></a>-->
            </td>
          </tr>
        <?php $i++; endforeach; endif; ?>
      </tbody>
    </table>
  </div>

</form>