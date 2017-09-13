    <div class="container">
      <div class="row">
        <div class="col-xs-6">
          <h1>
            <a href="#">
              <img src="//placehold.it/150x150" />
              Logo here
            </a>
          </h1>
        </div>
        <div class="col-xs-6 text-right">
          <h1>INVOICE</h1>
          <h1><small>Invoice #{invoice_num}</small></h1>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-5">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>From: <a href="#">Cyomed / IhrArzt24 GmbH</a></h4>
            </div>
            <div class="panel-body">
              <p>
                Address <br>
                details <br>
                more <br>
              </p>
            </div>
          </div>
        </div>
        <div class="col-xs-5 col-xs-offset-2 text-right">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>To : <a href="#">{academic_grade} {name} {surname}</a></h4>
            </div>
            <div class="panel-body">
              <p>
                {payment_street} <br>
                {payment_street_additional} <br>
                {payment_postal_code} {payment_locality} <br>
              </p>
            </div>
          </div>
        </div>
      </div>
      <!-- / end client details section -->
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              <h4>Service</h4>
            </th>
            <th>
              <h4>Description</h4>
            </th>
            <th>
              <h4>Hrs/Qty</h4>
            </th>
            <th>
              <h4>Rate/Price</h4>
            </th>
            <th>
              <h4>Sub Total</h4>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{package}</td>
            <td><a href="#">{package_intro}</a></td>
            <td class="text-right">{duration}</td>
            <td class="text-right">{package_unit_price}</td>
            <td class="text-right">{package_total_price}</td>
          </tr>
        </tbody>
      </table>
      <div class="row text-right">
        <div class="col-xs-2 col-xs-offset-8">
          <p>
            <strong>
            Sub Total : <br>
            TAX : <br>
            Total : <br>
            </strong>
          </p>
        </div>
        <div class="col-xs-2">
          <strong>
          {invoice_sub_total} <br>
          {invoice_tax} <br>
          {invoice_total} <br>
          </strong>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-5">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h4>Bank details</h4>
            </div>
            <div class="panel-body">
              <p>Cyomed / IhrArzt24.de</p>
              <p>Bank Name</p>
              <p>Account Number / IBAN : --------</p>
              <p>BLZ / BIC : --------</p>
            </div>
          </div>
        </div>
        <div class="col-xs-7">
          <div class="span7">
            <div class="panel panel-info">
              <div class="panel-heading">
                <h4>Contact Details</h4>
              </div>
              <div class="panel-body">
                <p>
                  Email : service@ihrarzt24.de <br><br>
                  Mobile : -------- <br> <br>
                </p>
                <h4>Payment should be made by Bank Transfer</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>