<!DOCTYPE html>
<html>
<head>
  <?php require($app_key.'/view/layouts/styles.html'); ?>
  <style>
  .error {color: #FF0000;}
  </style>
</head>
<body>
  <?php require($app_key.'/view/layouts/nav.php'); ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 text-center">
				<h3>Sign Up</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<form method="POST" action="/register" aria-label="__Register">
					<input type="hidden" name="_token" value="<?php echo $rand; ?>">
		            <div class="form-group row">
		                <div class="col-md-4">
		                    <label for="name">Profile Name</label>
		                </div>
		                <div class="col-md-6">
		                    <input id="name" type="text" class="form-control<?php $error['name']?'is-invalid':'' ?>" name="name" value="<?php echo $old['name']; ?>" required autofocus/>
		                    <?php if($error['name']): ?>
		                        <span class="invalid-feedback" role="alert">
		                            <strong><?php echo $error['name']; ?></strong>
		                        </span>
		                    <?php endif; ?>
		                </div>
		            </div>
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
		                    <button type="submit" class="btn btn-primary">Register</button>
		                </div>
		            </div>
		        </form>
			</div>
		</div>
	</div>
<?php require($app_key.'/view/layouts/scripts.html'); ?>
</body>
</html>