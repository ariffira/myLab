
  <div class="col-md-12">
  <div class="box">

    <form class="form-horizontal" method="post" action="<?php echo site_url('admin/email/update_settings'); ?>">
      <div class="box-header with-border">
        <h4 class="box-title">Email settings</h4>
      </div>

      <div class="box-body form-group">
        <label for="emailSettingsProtocol" class="col-sm-2 control-label">Protocol</label>
        <div class="col-sm-2">
          <select id="emailSettingsProtocol" class="form-control" name="email_protocol" >
            <option value="smtp" <?php echo $this->mod->dy_config->email_protocol == 'smtp' ? 'selected="selected"' : ''; ?> >smtp</option>
            <option value="mail" <?php echo $this->mod->dy_config->email_protocol == 'mail' ? 'selected="selected"' : ''; ?> >mail</option>
            <option value="sendmail" <?php echo $this->mod->dy_config->email_protocol == 'sendmail' ? 'selected="selected"' : ''; ?> >sendmail</option>
          </select>
        </div>
        <label for="emailSettingsPort" class="col-sm-1 control-label">Port</label>
        <div class="col-sm-3">
          <input id="emailSettingsPort" class="form-control" placeholder="Port" type="number" name="email_smtp_port" value="<?php echo form_prep($this->mod->dy_config->email_smtp_port); ?>" />
        </div>
        <label for="emailSettingsMailType" class="col-sm-1 control-label">Type</label>
        <div class="col-sm-3">
          <select id="emailSettingsMailType" class="form-control" name="email_mailtype" >
            <option value="html" <?php echo $this->mod->dy_config->email_mailtype == 'html' ? 'selected="selected"' : ''; ?> >html</option>
            <option value="text" <?php echo $this->mod->dy_config->email_mailtype == 'text' ? 'selected="selected"' : ''; ?> >text</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="emailSettingsHost" class="col-sm-2 control-label">Host</label>
        <div class="col-sm-10">
          <input id="emailSettingsHost" class="form-control" placeholder="Host" type="text" name="email_smtp_host" value="<?php echo form_prep($this->mod->dy_config->email_smtp_host); ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="emailSettingsUsername" class="col-sm-2 control-label">Username</label>
        <div class="col-sm-10">
          <input id="emailSettingsUsername" class="form-control" placeholder="Username" type="text" name="email_smtp_user" value="<?php echo form_prep($this->mod->dy_config->email_smtp_user); ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="emailSettingsPassword" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
          <input id="emailSettingsPassword" class="form-control" placeholder="Password" type="password" name="email_smtp_pass" value="<?php echo form_prep($this->mod->dy_config->email_smtp_pass); ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="emailSettingsFrom" class="col-sm-2 control-label">Sender Address</label>
        <div class="col-sm-10">
          <input id="emailSettingsFrom" class="form-control" placeholder="Sender Address" type="text" name="email_sender_address" value="<?php echo form_prep($this->mod->dy_config->email_sender_address); ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="emailSettingsSender" class="col-sm-2 control-label">Sender Name</label>
        <div class="col-sm-10">
          <input id="emailSettingsSender" class="form-control" placeholder="Sender Name" type="text" name="email_sender_name" value="<?php echo form_prep($this->mod->dy_config->email_sender_name); ?>" />
        </div>
      </div>

      <hr />
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary">Apply</button>
        </div>
      </div>
      <hr />

    </form>
    </div>



    <div class="box">
    <form class="form-horizontal">
      <div class="box-header with-border">
        <h4 class="box-title">Send Newsletter</h4>
      </div>

      <div class="box-body form-group">
        <label for="newsletterSendTime" class="col-sm-2 control-label">Delayed sending time</label>
        <div class="col-sm-4">
          <div class="checkbox">
            <label>
              <input id="newsletterSendTimeCheckbox" type="checkbox" name="" value="<?php echo date('Y-m-d H:i:s', time()); ?>" />
              Delayed sending enabled
            </label>
          </div>
        </div>
        <div class="col-sm-6">
          <input id="newsletterSendTime" class="form-control datetime-picker" placeholder="Delayed sending time" name="" value="<?php echo date('Y-m-d H:i:s', time()); ?>" />
        </div>
      </div>
      <div class="form-group">
        <label for="newsletterTitle" class="col-sm-2 control-label">Newsletter subject</label>
        <div class="col-sm-10">
          <input id="newsletterTitle" class="form-control" placeholder="Newsletter subject" name="" value="" />
        </div>
      </div>
      <div class="form-group">
        <label for="newsletter" class="col-sm-2 control-label">Newsletter</label>
        <div class="col-sm-10">
          <textarea id="newsletter" class="form-control summernote" placeholder="Newsletter" rows="15" name=""></textarea>
        </div>
      </div>

      <hr />
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-success">Send</button>
        </div>
      </div>

      <hr />
    </form>
    </div>

  </div>
