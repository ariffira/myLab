
  <div class="col-md-12">
	<?php if(isset($hide_search) && !$hide_search):?>
	    <div class="box box-warning box-solid">
	    <div class="box-body">
	      <form class="form-horizontal" method="get" enctype="application/x-www-form-urlencoded">
	        <div class="form-group">
	          <label for="searchField" class="control-label col-sm-3">Select field</label>
	          <div class="col-sm-9">
	            <select id="searchField" name="search_field" class="form-control">
	              <?php if (count($fields) > 0) : foreach ($fields as $field => $value) : ?>
	                <?php if (!is_array($value)) : ?>
	                  <option value="<?php echo $value->name; ?>" <?php echo $this->input->get('search_field') == $value->name ? 'selected="selected"' : ''; ?> ><?php echo $value->name; ?></option>
	                <?php endif; ?>
	              <?php endforeach; endif; ?>
	            </select>
	          </div>
	        </div>
	        <div class="form-group">
	          <label for="searchValue" class="control-label col-sm-3">Search for value</label>
	          <div class="col-sm-9">
	            <input type="text" class="form-control" id="searchValue" name="search_value" value="<?php echo $this->input->get('search_value') ? form_prep($this->input->get('search_value')) : ''; ?>" placeholder="Search for value" />
	          </div>
	        </div>
	        <div class="form-group">
	          <div class="col-sm-offset-3 col-sm-9">
	            <button type="submit" class="btn btn-danger col-sm-5">Search</button>
	            <a href="<?php echo site_url('admin/medicine/'); ?>" class="btn btn-success col-sm-offset-2 col-sm-5">Show All Medicines</a>
	          </div>
	        </div>
	      </form>
	      </div>
	    </div>
    <?php endif;?>
	<div class="pull-right" style="margin-bottom:20px;">
      <a href="<?php echo site_url('admin/medicine/addmedicine'); ?>" class="btn btn-success">Add New Medicine</a>
    </div>
    <div class="box" style="clear:both">
    <div class="table-responsive box-body" style="overflow:auto;">
      <table class="table table-condensed table-hover table-striped">
        <thead>
          <?php if (count($medicines) > 0) : foreach ($medicines[0] as $field => $value) : ?>
            <th>
              <?php echo $field; ?>
            </th>
          <?php endforeach; endif; ?>
        </thead>
        <tbody>
          <?php foreach ($medicines as $row) : ?>
            <tr onclick="javascript:window.location='<?php echo site_url('admin/medicine/entry/'.$row->id); ?>';">
              <?php foreach ($row as $field => $value) : ?>
                <td>
                  <?php echo !is_array($value) ? $value : 'Array'; ?>
                </td>
              <?php endforeach; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    </div>

    <div style="margin:10px;">
      <?php echo isset($pagination) ? $pagination : ''; ?>
    </div>

    <hr />

    <div class="box">
    <div class="row box-body">
      <div class="col-md-12">
        
        <?php foreach ($medicines as $row) : ?>

          <h4>Plain Info for <small><?php echo isset($row->medicine) ? $row->medicine : ''; ?> </small></h4>
          <div class="row">
            <?php foreach ($row as $field => $value) : ?>
              <div class="col-md-3">
                <div class="row">
                  <div class="col-sm-4" style="word-wrap: break-word;">
                    <p class="bg-info"><?php echo $field; ?></p>
                  </div>
                  <div class="col-sm-8" style="word-wrap: break-word;">
                  	<?php 
                  		if($field=='id')
                  			echo !is_array($value) ? $value : 'Array';
                  		else
                  			echo !is_array($value) ? text_field($value, $field, 'medicine/update_field/'.$row->id) : 'Array'; 
                  	?>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <hr />
          

          <div class="box box-priramy"></div>
        <?php endforeach; ?>
        
        <div class="row">
          <div class="col-md-12">
            <?php echo isset($pagination) ? $pagination : ''; ?>
          </div>
        </div>

      </div>
    </div>
    </div>

  </div>
