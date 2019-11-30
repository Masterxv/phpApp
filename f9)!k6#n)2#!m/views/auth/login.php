<!DOCTYPE html>
<html>
<head>
  <?php require($app_key.'/views/layouts/styles.html'); ?>
  <style>
  .error {color: #FF0000;}
  </style>
</head>
<body>
  <?php require($app_key.'/views/layouts/nav.php'); ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 text-center">
          <h3>Login</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <form method="POST" action="/login" aria-label="__Login">
            <input type="hidden" name="_token" value="<?php echo $rand; ?>">
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="email">E-Mail Address</label>
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
                    <label for="password">Password</label>
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

            <div class="form-group row mb-0">
                <div class="col-md-4"></div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Login</button>

                    <a class="btn btn-link" href="/password_reset_request_view">Forgot Your Password</a>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-4"></div>
                <div class="col-md-6">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" <?php $old['remember'] ? 'checked' : '' ?>>Remember Me</label>
                    </div>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
<?php require($app_key.'/views/layouts/scripts.html'); ?>
</body>
</html>