<?php $hidden_fields = array('pathname', 'basename', 'filename', ); ?>
<?php $lang_driver = isset($lang_driver) ? $lang_driver : 'db'; ?>

<div class="col-md-12" id="language-pack-1">  
  <div class="box">
    <div class="box-body">

      <h4>
        In total <?php echo isset($lines) && is_array($lines) ? count($lines) : '0'; ?> entries.
      </h4>
      
      <?php if (! empty($lang_driver) && $lang_driver === 'fs') : ?>
        <p>
          <a href="#translate/language_fs/to_db" class="btn btn-danger btn-lg">
            Replace Language Database With All Entries In File System
          </a>

          <small class="help-block">
            <span class="fa fa-arrow-up"></span> Warning, this is irreversable! Be really careful pressing this button. 
          </small>
        </p>
      <?php endif; ?>

      <hr />

      <div class="row">
        <div class="col-md-6">

          <div class="form-group">
            <label>Export Excel</label>
            <!-- <a href="#translate/language_<?php echo $lang_driver; ?>/excel" class="btn btn-default"> -->
            <div>
              <a href="<?php echo site_url('translate/language_'.$lang_driver.'/excel'); ?>" class="btn btn-default">
                Export Excel
              </a>
            </div>
            <small class="help-block">
              Just for viewing everything in one Excel file.
            </small>
          </div>

        </div>
        <div class="col-md-6">

          <?php echo form_open_multipart('translate/language_'.$lang_driver.'/excel_update'); ?>
            <div class="form-group">
              <label>Import Excel</label>
              <input type="file" name="lang" />
            </div>
            <div class="form-group">
              <input type="submit" value="Import" class="btn btn-primary" />
              <small class="help-block">
                After some changes made to the Excel file, you could import your changes to the system (File System / Database based).
              </small>
            </div>
          <?php echo form_close(); ?>
          
        </div>
      </div>

      <hr />

      <p>
        <a href="#translate/language_<?php echo $lang_driver; ?>/add" class="btn btn-success">
          Add new term
        </a>

        <small class="help-block">
          When programmers need a new term, whereas it's not in the dictionary yet.
        </small>
      </p>

    </div>
  </div>
</div>

<div class="col-md-12" id="language-pack-2">
  
  <div class="box">

    <div class="table-responsive box-body" style="overflow:auto;">

      <table class="table table-condensed table-hover table-striped">
        <thead>
          <?php
            if (isset($langs) && is_array($langs) && count($langs) > 0)
            {

            }
            else
            {
              $langs = array();

              if (isset($lines) && is_array($lines) && count($lines) > 0)
              {
                foreach ($lines as $row)
                {
                  foreach ($row as $field => $value)
                  {
                    if ( ! in_array($field, $langs))
                    {
                      array_push($langs, $field);
                    }
                  }
                }
              }
            }
          ?>

          <th>Actions</th>

          <?php foreach ($langs as $lang) : ?>
            <?php if ( ! in_array($lang, ! empty($hidden_fields) ? $hidden_fields : array() )) : ?>
              <th>
                <?php echo $lang; ?>
              </th>
            <?php endif; ?>
          <?php endforeach; ?> 
        </thead>
        <tbody>

          <?php if (isset($lines) && is_array($lines) && count($lines) > 0) : foreach ($lines as $key => $row) : ?>
            <tr>

              <td>
                <a href="#translate/language_<?php echo $lang_driver; ?>/line/<?php echo rawurlencode($key); ?>" class="btn btn-success btn-xs">Edit</a>
              </td>

              <?php foreach ($langs as $field) : ?>

                <?php
                  if (isset($row[$field]))
                  {
                    $value = $row[$field];
                  }
                  else
                  {
                    $value = '';
                  }
                ?>

                <?php if ( ! in_array($field, ! empty($hidden_fields) ? $hidden_fields : array() )) : ?>
                  <td>                  

                    <?php if (in_array($field, array('key', 'relpath', 'filename', 'basename', 'module', ) ) ) : ?>

                      <?php if (is_array($value)) : ?>
                        <?php if (count($value) > 1) : ?>
                          <p><strong>Multiple</strong> (<?php echo count($value); ?>)</p>
                          <ol style="word-break:break-all;">
                            <?php foreach ($value as $value_key => $value_value) : ?>
                              <li><?php echo $value_value; ?></li>
                            <?php endforeach; ?>
                          </ol>
                        <?php else: ?>
                          <?php echo $value[0]; ?>
                        <?php endif; ?>
                      <?php else : ?>
                        <?php echo $value; ?>
                      <?php endif; ?>

                    <?php else : ?>

                      <div>
                        <a href="javascript:void(0);" onclick="$(this).html($(this).closest('div').next().hasClass('hidden') ? 'Hide' : 'Show').closest('div').next().toggleClass('hidden');">
                          Show
                        </a>
                      </div>

                      <div class="hidden">

                        <?php if (is_array($value)) : ?>
                          <?php if (count($value) > 1) : ?>
                            <p><strong>Multiple</strong> (<?php echo count($value); ?>)</p>
                            <ol style="word-break:break-all;">
                              <?php foreach ($value as $value_key => $value_value) : ?>
                                <li><?php echo $value_value; ?></li>
                              <?php endforeach; ?>
                            </ol>
                          <?php else: ?>
                            <?php echo $value[0]; ?>
                          <?php endif; ?>
                        <?php else : ?>
                          <?php echo $value; ?>
                        <?php endif; ?>

                      </div>

                    <?php endif; ?>

                  </td>
                <?php endif; ?>
              <?php endforeach; ?>

            </tr>
          <?php endforeach; endif ;?>

        </tbody>
      </table>

    </div>

  </div>

</div>


<script type="text/javascript">
  App && App.pageSetup && jQuery && jQuery.isFunction && jQuery.isFunction(App.pageSetup) ? + function () {
    App.pageSetup('#language-pack-1, #language-pack-2');
  } () : 1;
</script>