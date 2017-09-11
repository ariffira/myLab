<script>
 $(document).ready(function(){
	$("#syc_run").click(function(){
		$(this).find('.fa-angle-right').toggleClass('fa-angle-down');
		$( "#run_login_div" ).toggle( "", function() {
			$("#msg").html('');
		});	
	});
    
//	  $("body").append('<div id="loadingDiv"></div>');
   $("#run_sync_button").click(function(){
       var image_path = $.baseUrl+'assets/img/loading.png';
       $("#loading").html('<img class="star" height="20px" weight="20px" src="'+image_path+'" />');
       $("#runtastic").ajaxSubmit({
                success: function(html) { 
//                    alert(html);
                 $("#loading").html('');    

                    if(html!=''){
                    $("#gaph_view").html(html); 
                    $("#msg").html('');
                   }else{
                    $("#msg").html('Ihr Benutzername oder Passwort falsch, sind wir nicht in der Lage, aktuelle Daten zu synchronisieren, jetzt alten Daten nur Listen');
//                       $.loadUrl($('#feedList .dropdown .active').attr('href'), $('#feedContent'));
//                     $('#runtastic_link').click();  
                   } 
                }

              });
       //$('.ajax-feed-link.active').click();
   });  
 });   
</script>

<?php
  $this->load->language('pwidgets/runtastic',$this->m->user_value('language'));
?>
<div class='blog-list'>
<div class="block block-c1 block-c1-1">
  <div class="head" id="syc_run">
    <div class="pull-right"><span class="fa fa-angle-right"></span></div>
    <h2 class="font-bold">
      <?php echo strtoupper($this->lang->line('runtastic_sync_data')); ?>
    </h2>
  </div>
   
  <div id="run_login_div" class="tab-pane blog-text" style="display:none;">   
      <div id="msg" style="color: red;"></div>
    <div class="panel">
      <div class="panel-body">
        <div><strong>
         <?php echo strtoupper($this->lang->line('runtastic_client_auth')); ?>
        </strong>
        </div>
        <div>&nbsp;</div>
        <form enctype="multipart/form-data" action="<?php echo base_url('index.php/akte/updateruntastic'); ?>" method="post" role="form" id="runtastic" class="form form-horizontal">
          <div class="form form-group">
            <div class="control-label col-md-4">
              <?php echo strtoupper($this->lang->line('runtastic_user_name')); ?>
            </div>
            <div class="col-md-6">
              <input type="text" name="run_username" id="run_username" class="form-control" value="" />
            </div>
          </div>
          <div class="form form-group">
            <div class="control-label col-md-4">
              <?php echo strtoupper($this->lang->line('runtastic_password')); ?>
            </div>
            <div class="col-md-6">
              <input type="password" name="run_password" id="run_password" class="form-control" value="" />
            </div>
          </div>
        </form>
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <input type="button" value="<?php echo strtoupper($this->lang->line('runtastic_sync_data_submit')); ?>" id="run_sync_button" name="run_sync_button" class="btn btn-sync" />
            <span id="loading"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

    
   
    
<!--</div>-->
<!--<div id="loading_div"></div>-->
<div id="gaph_view" >
<?php
if(count($entries)>0 && !empty($entries)) {
       echo $this->load->view('overview/runtastic_graph',
                     array(
                         'entries'=>$entries
                     ),TRUE
                     );
}else {?>
<div style="color:red;">
  <?php echo strtoupper($this->lang->line('runtastic_not_sync_info')); ?>
</div>
<?php } ?>
</div>
</div>
