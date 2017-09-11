	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	</head>


	<body>
		<!--mpdf
		<htmlpageheader name="myHTMLHeader">
		<div class="header">
			<div class="left">
				<img src="assets/img/logo/cyomedlogo3.png"  width="50%"  />
			</div>
		</div>
		</htmlpageheader>

		<htmlpagefooter name="myHTMLFooter">
			<div class="footer">
				<div class="left" >{DATE d.m.y}  | <?php echo 'Copyright Cyomed'; ?></div>
				<div class="right">Page {PAGENO} - {nb}</div>
			</div>
		</htmlpagefooter>
		mpdf-->
	<?php
		$this->load->language('pwidgets/rezept',$this->m->user_value('language'));
		$this->load->language('pwidgets/my_account', $this->m->user_value('language'));
	?>
	<div class="postContainer">
		<div class="postTitle">
			Patient Infomation
		</div>
	    <div class="page">
	        <table class="list_table">
	            <tbody>
	                <?php foreach ($patient as $key=>$value):?> 
	                    <tr>
	                        <td><h6><?php echo $this->lang->line('pwidgets_my_account_'.$key);?></h6></td>
	                        <td><?php echo $value;?></td>
	                    </tr>
	                <?php endforeach;?>
	            </tbody>
	        </table>
	    </div>
	</div>

	<div class="page"></div>
	<div class="page"></div>

	<div class="postContainer">
	    <div class="postTitle">
			Rezept Infomation
		</div>
	    <div class="page">
	        <table class="list_table">
	            <tbody>
	                <?php foreach ($eprescription as $key=>$value):?> 
	                    <tr>
	                        <td><h6><?php echo $this->lang->line('pwidgets_'.$key);?></h6></td>
	                        <td><?php echo $value;?></td>
	                    </tr>
	                <?php endforeach;?>
	            </tbody>
	        </table>
	    </div>
	</div>

	<div class="page"></div>
	<div class="page"></div>

	<div class="postContainer">
	    <div class="postTitle">
			Fragebogen
		</div>
	    <div class="page">
	        <table class="list_table">
	            <tbody>
	                <?php foreach ($answers as $key=>$value):?> 
	                    <tr>
	                        <td><?php echo $value['question']; ?></td>
	                        <td><?php echo $value['answer']; ?></td>
	                    </tr>
	                <?php endforeach;?>
	            </tbody>
	        </table>
	    </div>
	</div>

	<div class="page"></div>


		<!-- <div class = "container">
			<div class = "col-md-1">
				
			</div>
			<div class = "col-md-7">
				<div class="row">
					<div class="col-sm-12">
						<h5>Krankenkasse bzw. Kostenträger</h5>
						<p></p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<h5>Name, Vorname des Versicherten</h5>
						<p></p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<h5>Kassen-nr.</h5>
						<p></p>
					</div>
					<div class="col-sm-4">
						<h5>Versicherten-nr.</h5>
						<p></p>
					</div>
					<div class="col-sm-4">
						<h5>Kassen-nr.</h5>
						<p></p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<h5>Kassen-nr.</h5>
						<p></p>
					</div>
					<div class="col-sm-4">
						<h5>Arzt-Nr.</h5>
						<p></p>
					</div>
					<div class="col-sm-4">
						<h5>Datum</h5>
						<p></p>
					</div>
				</div>

				
			</div>
			<div class = "col-sm-md">
				
			</div>
			
		</div> -->
	</body>
	</html>
