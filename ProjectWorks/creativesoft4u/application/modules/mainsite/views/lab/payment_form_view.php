<button type="button" class="btn btn-default btn-lg  btn-block">Pay as: <i class="fa fa-credit-card"></i></button>
<button type="button" class="btn btn-default btn-lg  btn-block">Pay as: <i class="fa fa-cc-mastercard"></i></button>
<button type="button" class="btn btn-default btn-lg  btn-block">Pay as: <i class="fa fa-cc-amex"></i></button>



<!-- Button trigger modal -->
<button type="button" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#myModal">
Pay as: <i class="fa fa-paypal"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Paypal Integration Test</h4>
      </div>
      <div class="modal-body">
      <form class="paypal" action="payments.php" method="post" id="paypal_form" target="_blank">
		<input type="text" name="cmd" value="_xclick" />
		<input type="hidden" name="no_note" value="1" />
		<input type="hidden" name="lc" value="UK" />
		<input type="hidden" name="currency_code" value="GBP" />
		<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
		<input type="hidden" name="first_name" value="Customer's First Name" />
		<input type="hidden" name="last_name" value="Customer's Last Name" />
		<input type="hidden" name="payer_email" value="customer@example.com" />
		<input type="hidden" name="item_number" value="123456" / >
		<input type="submit" name="submit" value="Submit Payment"/>
	  </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send</button>
      </div>
    </div>
  </div>
</div>
