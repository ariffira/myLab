<?php (!isset($p) || !$p) && (!isset($d) || !$d) ? ($p = TRUE) : NULL; ?>
<?php isset($r) && isset($c) && $r && $c ? ($pass_data = array('r' => $r, 'c' => $c, )) : ($pass_data = array()); ?>

<div class="row">
  <div class="col-md-offset-4 col-md-4">
    
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li class="<?php echo isset($p) && $p ? 'active' : ''; ?>"><a href="#patientLogin" role="tab" data-toggle="tab">Als <strong>Patient</strong> einloggen</a></li>
      <li class="<?php echo isset($d) && $d ? 'active' : ''; ?>"><a href="#doctorLogin" role="tab" data-toggle="tab">Als <strong>Arzt</strong> einloggen</a></li>
    </ul>

  </div>
</div>

<?php if ( ! empty($alert) ) : ?>
  <div class="row m-5">
    <div class="col-md-offset-4 col-md-4">
      
      <div class="tile p-10 text-danger">
        <?php echo $alert; ?>
      </div>

    </div>
  </div>
<?php endif; ?>

<div class="tab-content text-left">

  <div class="tab-pane fade <?php echo isset($p) && $p ? 'in active' : ''; ?>" id="patientLogin">
    <?php $this->load->view('patient/login_view', $pass_data); ?>
  </div>

  <div class="tab-pane fade <?php echo isset($d) && $d ? 'in active' : ''; ?>" id="doctorLogin">
    <?php $this->load->view('doctor/login_view', $pass_data); ?>
  </div>

</div>