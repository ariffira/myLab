
<h3>Neu Termin</h3>

<?php $this->lang->load('reserve_success'); ?>
<table>
  <?php if (isset($success_info) && is_array($success_info) && count($success_info) > 0) : foreach ($success_info as $key => $value) : ?>

    <tr>
      <td><?php echo $this->lang->line($key) ? $this->lang->line($key) : $key; ?></td>
      <td>
        <?php if($key == 'gender') : ?>
          <?php echo $value == 1 ? 'Frau' : ($value == 2 ? 'Herr' : ''); ?>
        <?php elseif($key == 'insurance') : ?>
          <?php echo $value == 1 ? 'privat' : ($value == 2 ? 'gesetzlich' : ''); ?>
        <?php elseif($key == 'insurance_provider') : ?>
          <?php echo isset($insurance_provider) && isset($insurance_provider[$value]) && isset($insurance_provider[$value]->name) ? $insurance_provider[$value]->name : $value; ?>
        <?php else: ?>
          <?php echo $value; ?>
        <?php endif; ?>
      </td>
    </tr>

  <?php endforeach; endif; ?>
</table>