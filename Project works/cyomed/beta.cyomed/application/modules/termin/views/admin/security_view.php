
    <div class="row">
      <div class="col-12 col-md-12">
        <?php $alert = isset($alert) && $alert ? $alert : $this->session->flashdata('page_alert'); ?>

        <?php if (is_string($alert) && $alert) : $alert = array('text' => $alert, ); endif; ?>

        <?php if (is_array($alert)) : ?>
          <?php foreach ($alert as $key => $value) : ?>
            <?php if (!is_numeric($key)) : $value = $alert; endif; ?>
            <div class="<?php echo isset($value['class']) && $value['class'] ? $value['class'] : 'alert alert-danger'; ?>">
              <?php echo isset($value['text']) && $value['text'] ? $value['text'] : 'Fehler aufgetreten.'; ?>
            </div>
            <?php if (!is_numeric($key)) : break; endif; ?>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Passwort ändern</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-12 col-md-7">
                <form class="form-horizontal" role="form" method="post" id="formChangePassword">
                  <fieldset>
                    <div class="form-group">
                      <label for="inputPasswordOld" class="col-sm-4 control-label">Aktuelles Passwort</label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control" name="password_old" id="inputPasswordOld" placeholder="Aktuelles Passwort">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPasswordNew" class="col-sm-4 control-label">Neues Passwort</label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control" name="password_new" id="inputPasswordNew" placeholder="Neues Passwort">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPasswordRepeat" class="col-sm-4 control-label">Neues Passwort erneut</label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control" name="password_repeat" id="inputPasswordRepeat" placeholder="Neues Passwort erneut">
                      </div>
                    </div>
                    </fieldset>
                  </form>
                </div>
                <div class="col-12 col-md-5">
                  <form class="form-horizontal" role="form">
                    <fieldset>
                      <div class="form-group">
                        <label for="labelAccountHolder" class="col-sm-4 control-label">Kontoinhaber</label>
                        <div class="col-sm-8">
                          <p id="labelAccountHolder" class="form-control-static"><?php echo $this->mod->user_value('title'); ?> <?php echo $this->mod->user_value('first_name'); ?> <?php echo $this->mod->user_value('last_name'); ?></p>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="labelEmail" class="col-sm-4 control-label">Email</label>
                        <div class="col-sm-8">
                          <p id="labelEmail" class="form-control-static"><?php echo $this->mod->user_value('email'); ?></p>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label">&nbsp;</label>
                        <div class="col-sm-8">
                          <a type="button" class="btn btn-default" href="<?php echo site_url('profile/doctor/member/'.$this->mod->user_id()); ?>">Öffentliches Profil</a>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
            </div>
            
            <hr/>

            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <button type="button" class="btn btn-primary btn-block" id="submitChangePassword">Speichern</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>