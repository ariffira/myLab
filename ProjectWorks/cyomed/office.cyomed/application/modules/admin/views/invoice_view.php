
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li class=""><a href="#patientTab" role="tab" data-toggle="tab">Patient</a></li>
  <li class="active"><a href="#doctorTab" role="tab" data-toggle="tab">Doctor</a></li>
</ul>

<hr/>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane fade" id="patientTab">
    <?php $this->load->view('admin/invoice_patient_view', array('patients' => $patients, 'pagination' => $pat_pagination, )); ?>
  </div>
  <div class="tab-pane fade in active" id="doctorTab">
    <?php $this->load->view('admin/invoice_doctor_view', array('doctors' => $doctors, 'pagination' => $doc_pagination, )); ?>
  </div>
</div>