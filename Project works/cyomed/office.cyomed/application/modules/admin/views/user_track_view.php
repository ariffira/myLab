<?php // print_r($usertrack);die; ?>
<div class="col-md-12">
    <div class="box box-warning box-solid">
    <div class="box-body">
      <form class="form-horizontal" method="get" enctype="application/x-www-form-urlencoded">
        <div class="form-group">
          <label for="searchField" class="control-label col-sm-3">Select field</label>
          <div class="col-sm-9">
            <select id="searchField" name="search_field" class="form-control">
                <option value="fullname" <?php echo $this->input->get('search_field') == "fullname" ? 'selected="selected"' : ''; ?>>Name</option>
                <option value="user_role" <?php echo $this->input->get('search_field') == "user_role" ? 'selected="selected"' : ''; ?>>User Role</option>
                <option value="request_uri"  <?php echo $this->input->get('search_field') == "request_uri" ? 'selected="selected"' : ''; ?>>Visited Link</option>
              <?php/* if (count($usertrack) > 0) : foreach ($usertrack[0] as $field => $value) : ?>
                <?php if (!is_array($value)) : ?>
                  <option value="<?php echo $field; ?>" <?php echo $this->input->get('search_field') == $field ? 'selected="selected"' : ''; ?> ><?php echo $field; ?></option>
                <?php endif; ?>
              <?php endforeach; endif; */?>
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
            <button type="submit" class="btn btn-danger btn-block">Search</button>
          </div>
        </div>
      </form>
      </div>
    </div>
 <div class="box">
    <div class="row box-body">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <?php echo isset($pagination) ? $pagination : ''; ?>
          </div>
        </div>
      </div>
    </div>
    </div>
    <div class="box">
    <div class="table-responsive box-body" style="overflow:auto;">
      <table class="table table-condensed table-hover table-striped">
       <thead>
        <th>S. No.</th>
        <th>Name</th>
        <th>Visited Link</th>
        <th>Counter</th>
        <th>User Role</th>
        <th>Date/Time</th>
       </thead>
        <tbody>
          <?php 
          $i=1;
//          $user_patient=$this->usertracking->user_list('role_patient');
//          $user_doctor=$this->usertracking->user_list('role_doctor');
          if($usertrack>0 && !empty($usertrack)){
          foreach ($usertrack as $row) : 
              ?>
            <tr>
                <td>   <?php echo $i;?></td>
                <td> 
                    <?php 
//                    if($row->user_role=='role_patient' ){
//                        foreach($user_patient as $raw){
//                            if($raw->id==$row->user_identifier ){
                                echo $row->fullname;
//                            }
//                        }
//                    }
//                    if($row->user_role=='role_doctor' ){
//                        foreach($user_doctor as $raw){
//                            if($raw->id==$row->user_identifier ){
//                                echo $raw->fullname;
//                            }
//                        }
//                    }
                ?>
                </td>
                <td>
                    <?php echo $row->request_uri ?>
                </td>
                 <td>
                    <?php echo $row->counter ?>
                </td>
                 <td>
                    <?php echo ($row->user_role=='role_patient')?"Patient":"Doctor"; ?>
                </td>
                <td>
                    <?php 
                    echo date('Y-m-d H:i:s', $row->timestamp); 
                    ?>
                </td>
            </tr>
          <?php
          $i++;
          endforeach; }?>
        </tbody>
      </table>
    </div>
    </div>

<!--    <div style="margin:10px;">
      <?php // echo isset($pagination) ? $pagination : ''; ?>
    </div>

    <hr />-->

    <div class="box">
    <div class="row box-body">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <?php echo isset($pagination) ? $pagination : ''; ?>
          </div>
        </div>
      </div>
    </div>
    </div>

  </div>
