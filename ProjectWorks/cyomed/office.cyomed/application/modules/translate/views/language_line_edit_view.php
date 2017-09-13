<?php // $hidden_fields = array('pathname', 'basename', 'filename', ); ?>
<?php $lang_driver = isset($lang_driver) ? $lang_driver : 'db'; ?>

<div class="col-md-12" id="language-line-edit">
  
  <div class="box">

    <div class="box-body">

      <?php if (empty($line)) : $line = array(); endif; ?>

      <form action="<?php echo site_url('translate/language_'.$lang_driver.'/line_update/'.( ! empty($line['key']) ? $line['key'] : 'add/post' )); ?>" method="post">

        <input type="hidden" name="orig_key" value="<?php echo ! empty($line['key']) ? $line['key'] : ''; ?>" />

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

            <th style="width:10%;">
              Key
            </th>

            <th style="width:40%;">
              Value
            </th>

            <th style="width:5%;">

            </th>

            <th style="width:45%;">
              Edit
            </th>

          </thead>
          <tbody>

              <?php foreach ($langs as $field) : ?>

                <tr>

                  <td style="vertical-align:middle;"><?php echo $field; ?></td>

                  <?php
                    if (isset($line[$field]))
                    {
                      $value = $line[$field];
                    }
                    else
                    {
                      $value = '';
                    }
                  ?>

                  <td style="vertical-align:middle;">
                  
                    <?php if ( ! in_array($field, ! empty($hidden_fields) ? $hidden_fields : array() )) : ?>

                      <?php if ($field === 'module') : ?>

                        <select class="chosen-select bs-form-control" multiple="multiple" name="module[]" >
                          <?php foreach (array(
                            '-' => '-',
                            'akte' => 'akte', 
                            'portal' => 'portal', 
                            'rezept' => 'rezept', 
                            'tarif' => 'tarif', 
                            'termin' => 'termin', 
                            'video' => 'video', ) as $sv => $st) : ?>
                            <option value="<?php echo $sv; ?>" <?php echo $value == $sv || is_array($value) && in_array($sv, $value) ? 'selected="selected"' : ''; ?> ><?php echo $st; ?></option>
                          <?php endforeach; ?>
                        </select>

                      <?php elseif (in_array($field, array('key', 'relpath', 'filename', 'basename', ) ) ) : ?>

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
                            Hide
                          </a>
                        </div>

                        <div class="">

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

                    <?php endif; ?>

                  </td>

                  <td style="vertical-align:middle;">

                    <?php if (in_array($field, array('module', ) ) ) : ?>

                    <?php elseif (in_array($field, array('pathname', ) ) ) : ?>

                    <?php elseif (in_array($field, array('key', 'relpath', 'filename', 'basename', ) ) ) : ?>

                      <label>
                        <input type="checkbox" name="<?php echo $field; ?>_enable" value="1" />
                      </label>

                    <?php else: ?>

                      <label>
                        <input type="checkbox" name="<?php echo $field; ?>_enable" value="1" />
                      </label>

                    <?php endif; ?>

                  </td>

                  <td>

                    <?php if (in_array($field, array('module', ) ) ) : ?>

                    <?php elseif (in_array($field, array('pathname', ) ) ) : ?>

                    <?php elseif (in_array($field, array('key', 'relpath', 'filename', 'basename', ) ) ) : ?>

                      <input class="form-control" name="<?php echo $field; ?>" <?php $value_str = !is_array($value) ? $value : (count($value) == 1 ? $value[0] : ''); $value_str = htmlentities($value_str); ?> value="<?php echo $value_str; ?>" data-original-value="<?php echo $value_str; ?>" onfocus="javascript:$(this).closest('td').prev().find('input[type=\'checkbox\']').iCheck('check');" onblur="javascript:$(this).val() == $(this).data('original-value') ? $(this).closest('td').prev().find('input[type=\'checkbox\']').iCheck('uncheck') : void(0);" />

                    <?php else: ?>

                      <!-- Language -->

                      <textarea class="form-control" name="<?php echo $field; ?>" <?php $value_str = !is_array($value) ? $value : (count($value) == 1 ? $value[0] : ''); $value_str = htmlentities($value_str); ?> value="<?php echo $value_str; ?>" data-original-value="<?php echo $value_str; ?>" onfocus="javascript:$(this).closest('td').prev().find('input[type=\'checkbox\']').iCheck('check');" onblur="javascript:$(this).val() == $(this).data('original-value') ? $(this).closest('td').prev().find('input[type=\'checkbox\']').iCheck('uncheck') : void(0);" ><?php echo $value_str; ?></textarea>

                    <?php endif; ?>

                    
                  </td>
              
                </tr>

              <?php endforeach; ?>

          </tbody>
        </table>

        <div class="form-group text-right">
          <button class="btn btn-lg btn-primary">Update</button>
        </div>

      </form>

    </div>

  </div>

</div>

<script type="text/javascript">
  App && App.pageSetup && jQuery && jQuery.isFunction && jQuery.isFunction(App.pageSetup) ? + function () {
    App.pageSetup('#language-line-edit');
  } () : 1;
</script>