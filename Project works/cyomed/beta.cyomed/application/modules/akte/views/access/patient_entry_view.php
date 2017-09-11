<?php $this->load->language('patients/my_doctors', $this->m->user_value('language')); ?>
<?php $this->load->language('global/general_text', $this->m->user_value('language')); ?>
<?php $this->load->language('pwidgets/my_account', $this->m->user_value('language')); ?>

<div id="videochat" class="modal fade videochat-modal-sm">
   <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                       <h4 class="modal-title">
                         <?php echo $this->lang->line('my_pat_details');?>
                      </h4>
            </div>
<div class="modal-body p-l-20 p-r-20 ">
<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('akte/access/insertpatient'); ?>" id="frminsertpatient">
   <div class="form-group">
    <label for="firstname" class="col-sm-3 control-label text-white">
      <span class="icomoon  i-vcard"></span> 
          <?php echo $this->lang->line('pwidgets_my_account_first_name');?>
    </label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="first_name" id="first_name" value="" placeholder="Enter firstname" required/>
    </div>
  </div>
    <div class="form-group">
    <label for="lastname" class="col-sm-3 control-label text-white">
      <span class="icomoon  i-vcard"></span> 
          <?php echo $this->lang->line('pwidgets_my_account_last_name');?>
    </label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="last_name" id="last_name" value="" placeholder="Enter lastname" required/>
    </div>
  </div>
  <div class="form-group">
    <label for="emailaddress" class="col-sm-3 control-label text-white">
      <span class="icomoon  i-vcard"></span> 
          <?php echo $this->lang->line('pwidgets_my_account_email');?>
    </label>
    <div class="col-sm-9">
      <input type="email" class="form-control" name="email" id="email" value="" placeholder="Email Address" required/>
    </div>
  </div>
    <div class="form-group">
    <label for="mobilenumber" class="col-sm-3 control-label text-white">
      <span class="icomoon  i-vcard"></span> 
          <?php echo $this->lang->line('pwidgets_my_account_mobile_number');?>
    </label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="mobile" id="mobile" value="" placeholder="Mobile Number" />
    </div>
  </div>
    <div class="form-group">
    <label for="telephone" class="col-sm-3 control-label text-white">
      <span class="icomoon  i-vcard"></span> 
          <?php echo $this->lang->line('pwidgets_my_account_telephone_number');?>
    </label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="telephone" id="telephone" value="" placeholder="Telephone No." />
    </div>
  </div>
  <div class="form-group">
    <label for="gender" class="col-sm-3 control-label text-white">
      <span class="icomoon  i-vcard"></span> 
                <?php echo $this->lang->line('pwidgets_my_account_sex');?>
    </label>
    <div class="col-sm-9"> 
        <select class="form-control" name="gender" id="gender" >
            <option value="2">
          <?php echo $this->lang->line('pwidgets_my_account_sex_male');?>
            </option>
            <option value="1">
          <?php echo $this->lang->line('pwidgets_my_account_sex_female');?>
            </option>
        </select>
      
    </div>
  </div>
  <div class="form-group">
    <label for="firstname" class="col-sm-3 control-label text-white">
      <span class="icomoon  i-vcard"></span> 
          <?php echo $this->lang->line('pwidgets_my_account_city');?>
    </label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="city" id="city" value="" placeholder="Enter City" required/>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12 text-right">
      <button class="btn btn-alt btn-lg" type="submit">
        <span class="icomoon i-enter"></span> 
        <?php echo $this->lang->line('general_text_button_add_patient');?>
      </button>
    </div>
  </div>
</form>
   </div>
  </div> 
 </div>
</div>
<script type="text/javascript">
	$("#frminsertpatient").submit(function(e){
		e.preventDefault();

		var emailRegex = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
		
		if($("#first_name").val()=="")
		{
			alert("Please enter first name.")
			return false;
		}
		else if($("#last_name").val()=="")
		{
			alert("Please enter first name.")
			return false;
		}
		else if($("#email").val()=="")
		{
			alert("Please enter email address.");
			return false;
		}
		else if(!emailRegex.test($("#email").val()))
		{
			alert("Please enter valid email address.");
			return false;
		}
		else if($("#city").val()=="")
		{
			alert("Please enter city name.")
			return false;
		}
		else 
		{
			var ajaxurl = "<?php echo site_url('akte/access/insertpatient'); ?>";
			jQuery.ajax({
				type:'POST',
				data:{first_name:jQuery("#first_name").val(),
					  last_name:jQuery("#last_name").val(),
					  email:jQuery("#email").val(),
					  mobile:jQuery("#mobile").val(),
					  telephone:jQuery("#telephone").val(),
					  gender:jQuery("#gender").val(),
					  city:jQuery("#city").val()},
				url: ajaxurl,
				cache:false,
				contentType: "application/x-www-form-urlencoded",
				beforeSend: function(){
					var image_path ="<?php echo base_url('assets/img/ajax-loader.gif'); ?>";
					$("<img class='loader' src='"+image_path+"' />").insertBefore("#frminsertpatient button[type='submit']");
               
					$("input").prop("disabled",true);
					$("select").prop("disabled",true);
					$("button").prop("disabled",true);
				},
				success:function(responseText)
				{
					responseText = responseText.split("||");
					alert(responseText[1]);

					$("input").prop("disabled",false);
					$("select").prop("disabled",false);
					$("button").prop("disabled",false);

					$(".loader").remove();
					
					if(responseText[0]==1)
					{
						window.location = "<?php echo site_url('akte/access/'); ?>";
					}
				},
				failure: function(errMsg) {
					alert(errMsg);
				}
			});
		}
	});
</script>