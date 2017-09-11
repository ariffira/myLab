<div class="col-md-12">

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li class="active"><a href="#invoiceTab" role="tab" data-toggle="tab">Invoice's</a></li>
  <li class="      "><a href="#emailTab" role="tab" data-toggle="tab">Email's</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content box">
  <div class="tab-pane fade in active" id="invoiceTab">
    <div class="row">
      <div class="col-md-12">
        
        <form class="form box-body" role="form" action="<?php echo site_url('admin/template/update_invoice') ?>" method="post">
          <div class="box-header with-border">
            <h4 class="box-title">Invoice template</h4>
          </div>

          <div class="form-group">
            <label for="invoiceTemplate"></label>
            <textarea id="invoiceTemplate" class="form-control summernote" placeholder="Patient confirmation Email template" rows="15" name="invoice_template"><?php echo $this->mod->dy_config->invoice_template; ?></textarea>
          </div>
          <div class="form-group box-body">
            <button type="submit" class="btn btn-primary">Apply</button>
          </div>

          <hr />
        </form>

      </div>
    </div>
  </div>
  <div class="tab-pane fade" id="emailTab">
    <div class="row">
      <div class="col-md-12">
        
        <form class="form box-body" role="form" action="<?php echo site_url('admin/template/update_confirm_patient') ?>" method="post">
          <div class="box-header with-border">
            <h4 class="box-title">Patient E-mail template</h4>
          </div>

          <div class="form-group">
            <label for="patientTitle">Patient confirmation Email subject</label>
            <input id="patientTitle" class="form-control" placeholder="Patient confirmation Email subject" name="patient_confirm_subject" value="<?php echo form_prep($this->mod->dy_config->patient_confirm_subject); ?>" />
          </div>
          <div class="form-group">
            <label for="patientTemplate">Patient confirmation Email template</label>
            <textarea id="patientTemplate" class="form-control summernote" placeholder="Patient confirmation Email template" rows="15" name="patient_confirm_content"><?php echo $this->mod->dy_config->patient_confirm_content; ?></textarea>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Apply</button>
          </div>

          <hr />
        </form>

        <form class="form box-body" role="form" action="<?php echo site_url('admin/template/update_confirm_doctor') ?>" method="post">
          <div class="box-header with-border">
            <h4 class="box-title">Doctor E-mail template</h4>
          </div>

          <div class="form-group">
            <label for="doctorTitle">Doctor confirmation Email subject</label>
            <input id="doctorTitle" class="form-control" placeholder="Doctor confirmation Email subject" name="doctor_confirm_subject" value="<?php echo form_prep($this->mod->dy_config->doctor_confirm_subject); ?>" />
          </div>
          <div class="form-group">
            <label for="doctorTemplate">Doctor confirmation Email template</label>
            <textarea id="doctorTemplate" class="form-control summernote" placeholder="Doctor confirmation Email template" rows="15" name="doctor_confirm_content"><?php echo $this->mod->dy_config->doctor_confirm_content; ?></textarea>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Apply</button>
          </div>

          <hr />
        </form>

      </div>
    </div>
  </div>
</div>
</div>