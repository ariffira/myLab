
<div class="row">
  <div class="col-md-12">

    <div class="alert alert-warning">
      <form class="form-horizontal" method="get" enctype="application/x-www-form-urlencoded">
        <div class="form-group">
          <label for="searchField" class="control-label col-sm-3">Select field</label>
          <div class="col-sm-9">
            <select id="searchField" name="search_field" class="form-control">
              <?php if (count($entries) > 0) : foreach ($entries[0] as $field => $value) : ?>
                <?php if (!is_array($value)) : ?>
                  <option value="<?php echo $field; ?>"><?php echo $field; ?></option>
                <?php endif; ?>
              <?php endforeach; endif; ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="searchValue" class="control-label col-sm-3">Search for value</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="searchValue" name="search_value" value="" placeholder="Search for value" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" class="btn btn-danger btn-block">Search</button>
          </div>
        </div>
      </form>
    </div>

    <div class="table-responsive" style="overflow:auto;">
      <table class="table table-condensed table-hover table-striped">
        <thead>
          <?php if (count($entries) > 0) : foreach ($entries[0] as $field => $value) : ?>
            <th>
              <?php echo $field; ?>
            </th>
          <?php endforeach; endif; ?>
        </thead>
        <tbody>
          <?php foreach ($entries as $row) : ?>
            <tr <?php if (isset($entry_click) && $entry_click) : ?> onclick="javascript:window.location='<?php echo site_url(trim($entry_click, '/').'/'.$row->id); ?>';" <?php endif; ?> >
              <?php foreach ($row as $field => $value) : ?>
                <td>
                  <?php if (is_array($value)) : ?>
                    <?php echo 'Array'; ?>
                  <?php else: ?>
                    <?php if ($field == 'id') : ?>
                      <?php echo $value; ?>
                    <?php elseif ($field == 'txtime') : ?>
                      <?php echo isset($entry_decode) && $entry_decode ? date('Y-m-d H:i:s', $this->encrypt->decode($value)) : $value; ?>
                    <?php else : ?>
                      <?php echo isset($entry_decode) && $entry_decode ? $this->encrypt->decode($value) : $value; ?>
                    <?php endif; ?>
                  <?php endif; ?>
                </td>
              <?php endforeach; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div style="margin:10px;">
      <?php echo isset($pagination) ? $pagination : ''; ?>
    </div>

    <hr />

    <div class="row">
      <div class="col-md-12">
        
        <?php foreach ($entries as $row) : ?>

          <div class="well well-sm">

            <h4>Plain Info for <small><?php echo isset($row->name) ? $row->name : ''; ?> <?php echo isset($row->surname) ? $row->surname : ''; ?></small></h4>
            <div class="row">
              <?php foreach ($row as $field => $value) : ?>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-sm-4" style="word-wrap: break-word;">
                      <p class="bg-primary"><?php echo $field; ?></p>
                    </div>
                    <div class="col-sm-8" style="word-wrap: break-word;">
                      <?php // echo !is_array($value) && isset($entry_update) && $entry_update ? text_field(isset($entry_decode) && $entry_decode ? $this->encrypt->decode($value) : $value, $field, trim($entry_update, '/').'/'.$row->id) : 'Array'; ?>
                      <?php if (is_array($value)) : ?>
                        <?php echo 'Array'; ?>
                      <?php else: ?>
                        <?php if ($field == 'id') : ?>
                          <?php echo $value; ?>
                        <?php elseif ($field == 'txtime') : ?>
                          <?php echo isset($entry_decode) && $entry_decode ? date('Y-m-d H:i:s', $this->encrypt->decode($value)) : $value; ?>
                        <?php else : ?>
                          <?php echo isset($entry_decode) && $entry_decode ? $this->encrypt->decode($value) : $value; ?>
                        <?php endif; ?>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>

            <h4>Macros for <small><?php echo isset($row->name) ? $row->name : ''; ?> <?php echo isset($row->surname) ? $row->surname : ''; ?></small></h4>
            <div class="row">
              <div class="col-md-12">
                <p>
                  <button type="button" class="btn btn-primary">Dummy Btn</button>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <p>
                  Dummy Dt <input type="date" name="from" class="form-control" value="<?php echo date('Y-m-d', time() - 86400 * 30); ?>" />
                </p>
              </div>
              <div class="col-md-3">
                <p>
                  Dummy Dt <input type="date" name="to" class="form-control" value="<?php echo date('Y-m-d', time()); ?>" />
                </p>
              </div>
              <div class="col-md-6">
                <p>
                  <br/>
                  <button type="button" class="btn btn-danger">Generate invoice</button>
                </p>
              </div>
            </div>

          </div>

          <hr />
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