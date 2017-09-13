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
		<img src="assets/img/logos/logo10.png"  width="50%"  />
	</div>

	<div class="right">
		<b><?php echo $profile->name; ?> <?php echo $profile->surname; ?> </b><br/>
		<font size="2" >Age:</font> <b><?php echo date_diff(date_create($profile->dob), date_create('today'))->y; ?></b> &nbsp;&nbsp;&nbsp; <font size="2" >Sex:</font><b><?php echo $profile->gender; ?></b> <br/>
		<font size="2" >e:</font> <?php echo $profile->email; ?><br/>
	</div>
</div>
</htmlpageheader>

<htmlpagefooter name="myHTMLFooter">
	<div class="footer">
		<div class="left" >{DATE d.m.y}  | <?php echo $title; ?></div>
		<div class="right">Page {PAGENO} - {nb}</div>
	</div>
</htmlpagefooter>
mpdf-->

<!--
<?php
$i = 1;
 
    $dataArray[]=array();

    foreach($points as $value ) {
         
         $field = $value -> HbA1C;
         $labels = $value -> bloodsugar;
          
         $dataArray [$i][$field] = $labels;  
         $i++; 
      }

    $data = array();
    foreach ($dataArray as $b) {
        foreach ($b as $c) {
            if (isset($c)) {
                $data[] = $c;
            }
        }
    }
?>
-->

<?php

  $data1 = array();

  foreach ($line1 as $field => $label){
    if (count($points) > 0 && isset($points[0]->$field)){
      $i = 0; 
      $total = count($points); 
      $total = $total > 30 ? 30 : $total;
      foreach ($points as $point){
        if ($i >= $total){
          break;
        }

        $data1 []['line1'] = $point -> $field; 
        $i++;
      }
    }
  }
  
  foreach ($line2 as $field => $label){
    if (count($points) > 0 && isset($points[0]->$field)){
      $i = 0; 
      $total = count($points); 
      $total = $total > 30 ? 30 : $total;
      foreach ($points as $point){
        if ($i >= $total){
          break;
        }

        $data1 []['line2'] = $point -> $field; 
        $i++;
      }
    }
  }

  $data2 = array();

  if ($g2line1) {
    foreach ($g2line1 as $field => $label){
    if (count($points) > 0 && isset($points[0]->$field)){
      $i = 0; 
      $total = count($points); 
      $total = $total > 30 ? 30 : $total;
      foreach ($points as $point){
        if ($i >= $total){
          break;
        }

        $data2 []['line1'] = $point -> $field; 
        $i++;
      }
    }
  }
  }

  if ($g2line2) {
    foreach ($g2line2 as $field => $label){
    if (count($points) > 0 && isset($points[0]->$field)){
      $i = 0; 
      $total = count($points); 
      $total = $total > 30 ? 30 : $total;
      foreach ($points as $point){
        if ($i >= $total){
          break;
        }

        $data2 []['line2'] = $point -> $field; 
        $i++;
      }
    }
  }
  }

  if ($g2line3) {
    foreach ($g2line3 as $field => $label){
    if (count($points) > 0 && isset($points[0]->$field)){
      $i = 0; 
      $total = count($points); 
      $total = $total > 30 ? 30 : $total;
      foreach ($points as $point){
        if ($i >= $total){
          break;
        }

        $data2 []['line3'] = $point -> $field; 
        $i++;
      }
    }
  }
  }


?>





<div class="postContainer">
    <div class="postTitle">
    	<!--
    	<div class="left"><?php echo $medication->name; ?></div>
		<div class="right"><?php echo $medication->document_date; ?></div>
		-->
		<?php echo $title ?>
	</div>


<div class="graph">
<div class="graphtitle">
      <table class="single_table"  >
        <tr>
          <td style="width:70%; text-align: left; "><?php echo $label1; ?></td>
          <td style="width:30%; text-align: right; "><?php echo $iconsult->document_date; ?></td>
        </tr>
      </table>
</div>
<!-- serializing data without base64 encoding
<img src="<?php echo site_url('/graph/graph/graph1')."?mydata1=".urlencode(serialize($data1)); ?>" />
-->
<img src="<?php echo site_url('/graph/graph/graph1')."?mydata1=".urlencode(base64_encode(serialize($data1))); ?>" />

</div>

<?php if ($controller == 'marcumar' ||  $controller == 'heart_frequency') : ?>
<div class="page"></div>
<div class="graph">
<div class="graphtitle">
      <table class="single_table"  >
        <tr>
          <td style="width:70%; text-align: left; "><?php echo $label2; ?></td>
          <td style="width:30%; text-align: right; "><?php echo $iconsult->document_date; ?></td>
        </tr>
      </table>
</div>
<!-- serializing data without base64 encoding
<img src="<?php echo site_url('/graph/graph/graph2')."?mydata2=".urlencode(serialize($data2)); ?>" />
-->
<img src="<?php echo site_url('/graph/graph/graph2')."?mydata2=".urlencode(base64_encode(serialize($data2))); ?>" />
</div>
<div class="page"></div>
<?php endif; ?>

<!--<img width="500" height="250" src="<?php echo site_url('export/export/graph');?>" />-->


<div class="page">	
<table class="graph_table"  >
	<?php
      $header_name = array(
        'rec_date'   => $this->lang->line('pwidget_plot_graph_insert_date'),
        'rec_time'   => $this->lang->line('pwidget_plot_graph_insert_time'),

        'rr_sys'     => 'RR sys.',
        'rr_dia'     => 'RR dia.',
        'puls'       => 'Puls',
        
        'bloodsugar' => $this->lang->line('pwidget_plot_graph_blood_sugar_Value'),
        'HbA1C'      => 'HbA1C %',
        
        'weight'     => $this->lang->line('pwidget_plot_graph_weight'),
        'bmi'        => 'BMI',
        
        'INR'        => 'INR',
        'lower_limit' => 'lower_limit',
        'upper_limit' => 'upper_limit',
        'quick'      => 'Quick %',
      );
    ?>

    <thead>
    	<tr>
    	<?php foreach ($header_name as $field => $label) : ?>
    		<?php if (count($points) > 0 && isset($points[0]->$field)) : ?>
    			<th>
    				<?php echo $label; ?>
    			</th>
    		<?php endif; ?>
    	<?php endforeach; ?>
		</tr>
	</thead>

	<tbody>
      <?php if (count($points) > 0) : $c = 1; foreach ($points as $point) : ?>
        <tr>
          <?php foreach ($header_name as $field => $label) : ?>
            <?php if (isset($point->$field)) : ?>
              <td style="vertical-align:middle;">
                <?php echo $point->$field; ?>
              </td>
            <?php endif; ?>
          <?php endforeach; ?>
        </tr>
      <?php if (++$c > 30) break; endforeach; endif; ?>
    </tbody>

</table>
</div>



</div>
    <script>
    $.baseUrl = "<?php echo base_url(); ?>";
    $.siteUrl = "<?php echo site_url(); ?>";
    </script>
</body>
</html>
