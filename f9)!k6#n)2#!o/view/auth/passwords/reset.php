<!DOCTYPE html>
<html>
<head>
  <?php require($app_key.'/view/layouts/styles.php'); ?>
  <style>
  .error {color: #FF0000;}
  </style>
</head>
<body>
  <?php require($app_key.'/view/layouts/nav.php'); ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 text-center">
        <h3>Reset Password</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <form method="POST" action="password_reset" aria-label="__Reset Password">
          <input type="hidden" name="_token" value="<?php echo $rand; ?>">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          
          <div class="form-group row">
              <div class="col-md-4">
                  <label for="email">E-Mail</label>
              </div>
              <div class="col-md-6">
                  <input id="email" type="email" class="form-control<?php $error['email']?'is-invalid':'' ?>" name="email" value="<?php echo $old['email']; ?>" required autofocus/>
                  <?php if($error['email']): ?>
                      <span class="invalid-feedback" role="alert">
                          <strong><?php echo $error['email']; ?></strong>
                      </span>
                  <?php endif; ?>
              </div>
          </div>
          <div class="form-group row">
              <div class="col-md-4">
                  <label for="password">New Password</label>
              </div>
              <div class="col-md-6">
                  <input id="password" type="password" class="form-control<?php $error['password']?'is-invalid':'' ?>" name="password" value="<?php echo $old['password']; ?>" required />
                  <?php if($error['password']): ?>
                      <span class="invalid-feedback" role="alert">
                          <strong><?php echo $error['password']; ?></strong>
                      </span>
                  <?php endif; ?>
              </div>
          </div>

          <div class="form-group row">
              <div class="col-md-4">
                  <label for="password-confirm">Confirm Password</label>
              </div>
              <div class="col-md-6">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required/>
              </div>
          </div>

          <div class="form-group row">
              <div class="col-md-4"></div>
              <div class="col-md-6">
                  <button type="submit" class="btn btn-primary">
                      {{ __('Reset Password') }}
                  </button>
              </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php require($app_key.'/view/layouts/scripts.php'); ?>
</body>
</html>