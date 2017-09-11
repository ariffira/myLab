<div class="row">
  <div class="col-md-12">
    
    <h4>Terms &amp; Services</h4>

    <!-- Nav tabs -->
    <ul class="nav nav-pills" role="tablist">
      <?php if (isset($terms) && is_array($terms) && count($terms) > 0) : $t_index = 0; foreach ($terms as $row) : ?>
        <li class="<?php echo $t_index ? '' : 'active'; ?>">
          <a href="#termsTab<?php echo $row->id; ?>" role="tab" data-toggle="tab">
            <?php echo $row->name.'<br/>'.nbs(1); ?>
          </a>
        </li>
      <?php $t_index++; endforeach; endif; ?>

      <li class="<?php echo isset($terms) && is_array($terms) && count($terms) > 0 ? '' : 'active'; ?>">
        <a href="#termsTab0" role="tab" data-toggle="tab">
          <span class="icomoon i-folder-plus" style="font-size:37px;"></span>
        </a>
      </li>

      <?php isset($terms) && is_array($terms) ? ($terms[] = new stdClass()) : ($terms = array(new stdClass(), )) ; ?>
    </ul>

    <hr/>

    <!-- Tab panes -->
    <div class="tab-content">
      <?php if (isset($terms) && is_array($terms) && count($terms) > 0) : $t_index = 0; foreach ($terms as $row) : ?>
        <?php
          if (!isset($row->id) || !$row->id)
          {
            $row->id                  = 0;
            $row->name                = 'term_'.count($terms);
            $row->title               = 'term_'.count($terms);
            $row->intro               = 'term_'.count($terms);
          }
        ?>

        <div class="tab-pane fade <?php echo $t_index ? '' : 'in active'; ?>" id="termsTab<?php echo $row->id; ?>">
          <form class="form-horizontal" method="post">

            <input type="hidden" name="term_id" value="<?php echo $row->id; ?>" />

            <div class="form-group">
              <label for="termID" class="col-sm-3 control-label">Term ID</label>
              <div class="col-sm-9">
                <p class="form-control-static"><?php echo $row->id; ?></p>
              </div>
            </div>

            <div class="form-group">
              <label for="termName" class="col-sm-3 control-label">Name</label>
              <div class="col-sm-9">
                <input id="termName" type="text" class="form-control" name="term_name" value="<?php echo form_prep($row->name); ?>" />
              </div>
              <small class="help-block col-sm-9 col-sm-offset-3">
                This is for internal use. Would be used also for program. Be careful to choose this name, avoiding conflicts.
              </small>
            </div>

            <div class="form-group">
              <label for="termTitle" class="col-sm-3 control-label">Title</label>
              <div class="col-sm-9">
                <input id="termTitle" type="text" class="form-control" name="term_title" value="<?php echo form_prep($row->title); ?>" />
              </div>
              <small class="help-block col-sm-9 col-sm-offset-3">
                Will be used when popup is opened on the TITLE of the <strong>POPED-UP WINDOW</strong>
              </small>
            </div>

            <div class="form-group">
              <label for="termIntro" class="col-sm-3 control-label">Term Content</label>
              <div class="col-sm-9">
                <textarea id="termIntro" class="form-control summernote" name="term_intro" rows="5" ><?php echo $row->intro; ?></textarea>
              </div>
            </div>

            <hr />

            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-3">
                <?php if (isset($row->id) && $row->id) : ?>
                  <button type="submit" role="submit" name="update" value="update" class="btn btn-success">Update</button>
                  <button type="submit" role="submit" name="delete" value="delete" class="btn btn-danger">Delete</button>
                <?php else : ?>
                  <button type="submit" role="submit" name="insert" value="insert" class="btn btn-success">Insert</button>
                <?php endif; ?>
              </div>
            </div>

          </form>
        </div>
      <?php $t_index++; endforeach; endif; ?>
    </div>


  </div>
</div>