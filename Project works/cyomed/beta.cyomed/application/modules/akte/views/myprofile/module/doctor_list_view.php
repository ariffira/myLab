<?php $this->load->language('patients/my_doctors', $this->m->user_value('language')); ?>

<form class="form" action="<?php echo site_url('akte/access/update'); ?>" method="post">
  <input type="hidden" name="batch" value="<?php echo random_string('alnum', 32); ?>" />

  <div class="table-responsive overflow">
    <table class="table tile">
      <thead>
        <tr>
          <th>
            <?php echo $this->lang->line('patients_my_doctors_id'); ?>
          </th>
          <th>
            <?php echo $this->lang->line('patients_my_doctors_name'); ?>
          </th>
          <th>
            <?php echo $this->lang->line('patients_my_doctors_last_name'); ?>  
          </th>
          <th>
           <?php echo $this->lang->line('patients_my_doctors_city'); ?> 
          </th>
          <?php if (!isset($hide_update) || !$hide_update) : ?>
            <th>
              <?php echo $this->lang->line('patients_my_doctors_access_permission'); ?> 
            </th>
          <?php endif; ?>
          <?php if (!isset($hide_delete) || !$hide_delete) : ?>
            <th>
              <?php echo $this->lang->line('patients_my_doctors_remove'); ?> 
            </th>
          <?php endif; ?>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; foreach ($doctors as $row ) : ?>
          <tr>
            <td>
              <div class="form-group">
                <label><?php echo isset($row->doctor_id) ? $row->doctor_id : $row->regid; ?></label>
              </div>
            </td>
            <td>
              <div class="form-group">
                <label><?php echo $row->name; ?></label>
              </div>
            </td>
            <td>
              <div class="form-group">
                <label><?php echo $row->surname; ?></label>
              </div>
            </td>
            <td>
              <div class="form-group">
                <label><?php echo $row->city; ?></label>
              </div>
            </td>
            <?php if (!isset($hide_update) || !$hide_update) : ?>
              <td>
                <div class="checkbox m-0 m-b-5">
                  <label>
                    <input type="checkbox" value="1" id="inputMyDoctorAccess<?php echo $row->id; ?>" name="access[<?php echo $row->id; ?>]" <?php echo $row->access_rights == 1 ? "checked=checked" : ""; ?> />
                  </label>
                </div>
              </td>
            <?php endif; ?>
            <?php if (!isset($hide_delete) || !$hide_delete) : ?>
              <td>
                <button class="btn btn-alt btn-xs" type="button" data-submit-location="<?php echo site_url('akte/access/delete/'.$row->id); ?>" ><span class="icomoon i-remove-2"></span> <?php echo $this->lang->line('patients_my_doctors_remove'); ?></button>
              </td>
            <?php endif; ?>
          </tr>
        <?php $i++; endforeach; ?>
      </tbody>
    </table>
  </div>

  <div class="form-group">
    <div class="col-sm-12 text-right">
      <?php if (!isset($hide_delete) || !$hide_delete) : ?>
        <button class="btn btn-alt btn-xs" ><span class="icomoon i-remove-2"></span> <?php echo $this->lang->line('patients_my_doctors_remove'); ?></button>
      <?php endif; ?>
      <?php if (!isset($hide_update) || !$hide_update) : ?>
        <button class="btn btn-alt btn-xs" ><span class="icomoon i-loop-4"></span>
         <?php echo $this->lang->line('general_text_button_update'); ?>
      </button>
      <?php endif; ?>
    </div>
  </div>
</form>