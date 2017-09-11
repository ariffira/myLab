<?php (!isset($p) || !$p) && (!isset($d) || !$d) ? ($p = TRUE) : NULL; ?>
<?php isset($r) && isset($c) && $r && $c ? ($pass_data = array('r' => $r, 'c' => $c, )) : ($pass_data = array()); ?>
<?php $this->moterm->reset_modals(); $this->moterm->get_list(); ?>

<div class="row">
  <div class="col-md-offset-4 col-md-4">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li class="<?php echo isset($p) && $p ? 'active' : ''; ?>"><a href="#patientRegister" role="tab" data-toggle="tab">Als <strong>Patient</strong> registrieren <span class="icomoon i-inject"></span></a></li>
      <li class="<?php echo isset($d) && $d ? 'active' : ''; ?>"><a href="#doctorRegister" role="tab" data-toggle="tab">Als <strong>Arzt</strong> registrieren <span class="icomoon i-profile"></span></a></li>
    </ul>

  </div>
</div>

<div class="tab-content text-left">

  <div class="tab-pane fade <?php echo isset($p) && $p ? 'in active' : ''; ?>" id="patientRegister">
    <?php $this->load->view('patient/register_view', $pass_data); ?>
  </div>

  <div class="tab-pane fade <?php echo isset($d) && $d ? 'in active' : ''; ?>" id="doctorRegister">
    <?php $this->load->view('doctor/register_view', $pass_data); ?>
  </div>

</div>

<!-- generate modals -->
<?php echo $this->moterm->modal_output(); ?>
<!-- end generate modals -->