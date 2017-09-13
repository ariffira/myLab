<div class="container">           
  <table class="table" id="table-methods-table">
    <thead>
      <tr>
        <th>Patient name</th>
        <th>Patient Regid</th>
        <th>Sex</th>
        <th>Age</th>
        <th>Address</th>
        <th>phone</th>
        <th>request time</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
        <?php foreach ($patients as $Patient) :?>
          # code...
        <?php endforeach;?>
      <tr class="success">
      </tr>
      <tr class="danger">
        <td>Mary</td>
        <td>Moe</td>
        <td>mary@example.com</td>
      </tr>
      <tr class="info">
        <td>July</td>
        <td>Dooley</td>
        <td>july@example.com</td>
      </tr>
    </tbody>
  </table>
</div>

