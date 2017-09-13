<div class="col-xs-12">

  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Allgemeine Informationen</h3>

      <div class="pull-right">

          <a href="#auth/change_password" class="btn btn-danger btn-flat">Change password</a>
      </div>
      
    </div><!-- /.box-header -->

    <div class="box-body">

      <?php if (isset($error)) : ?>
        <div  id="infoMessage"><?php echo $error; ?></div>
      <?php endif; ?>

      <form class="form-horizontal" role="form" method="post" action="<?php echo site_url('auth/profile/update_profile'); ?>" id="formAdminProfile" enctype="multipart/form-data" >


        <fieldset>
          <div class="row">
            <div class="col-md-8">

              <div class="form-group">
                <label for="inputFirstName" class="col-sm-2 control-label">Vorname</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="first_name" value="<?php echo $this->mod->user_value('name'); ?>" id="inputFirstName" placeholder="Vorname">
                </div>
              </div>

              <div class="form-group">
                <label for="inputLastName" class="col-sm-2 control-label">Nachname</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="last_name" value="<?php echo $this->mod->user_value('surname'); ?>" id="inputLastName" placeholder="Nachname">
                </div>
              </div>

              <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" disabled class="form-control" name="email" value="<?php echo $this->mod->user_value('email'); ?>" id="inputEmail" placeholder="Email">
                </div>
              </div>



            </div>
            <div class="col-md-4">
              <h3>Profilbild</h3>
              <?php if ($this->mod->user_value('avatar') && @getimagesize($this->mod->user_value('avatar'))) : ?>
                <div class="row">
                  <div class="col-xs-8">
                    <a href="<?php echo $this->mod->user_value('avatar'); ?>" class="thumbnail">
                      <img data-src="<?php echo $this->mod->user_value('avatar'); ?>" src="<?php echo $this->mod->user_value('avatar'); ?>" alt="Profilbild" />
                    </a>
                  </div>
                  <div class="col-xs-4">
                    <a href="<?php echo $this->mod->user_value('avatar'); ?>" class="thumbnail">
                      <img data-src="<?php echo $this->mod->user_value('avatar'); ?>" src="<?php echo $this->mod->user_value('avatar'); ?>" alt="Profilbild" />
                    </a>
                  </div>
                </div>
              <?php endif; ?>
              <div class="row">
                <div class="col-md-12">
                  <label for="avatar">Aktualisieren</label>
                  <input type="file" name="avatar" id="avatar">
                  <button type="submit" class="btn btn-success">Aktualisieren</button>
                </div>
              </div>
            </div>
          </div>
          <hr />
        </fieldset>

        <div class="row">
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Speichern</button>
          </div>
        </div>

      </form>

    </div>
  </div>
</div>