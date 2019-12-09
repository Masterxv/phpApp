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
    	<div class="col-md-3"></div>
        <div class="col-md-6" style="text-align: center;">
        	<div class="panel panel-default">
              <div class="panel-body">
                <?php if($msg == "login_redirect"): ?>
                    <h1>Verification link has been sent to your email (Please check in spam folder also). Please click the verification link to confirm your email.</h1>
                <?php endif; ?>
                <?php if($msg == "signup"): ?>
	            	<h1>Verification link has been sent to your email (Please check in spam folder also). Please click the verification link to confirm your email.</h1>
                <?php endif; ?>
                <?php if($msg == "signup_complete"): ?>
                    <h1>Congratulations! your email address is verified.</h1>
                    <a class="btn btn-primary" href="/login_view">Login</a>
                <?php endif; ?>
                <?php if($msg == "reset"): ?>
                    <h1>Password reset link has been sent to your email (Please check in spam folder also). Please click the link to reset your password.</h1>
                <?php endif; ?>
                <?php if($msg == "invalid_link"): ?>
                    <h1>This link is not valid now.</h1>
                <?php endif; ?>
                <?php if($msg == "reset_complete"): ?>
                    <h1>Congratulations! you have reset your password.</h1>
                    <a class="btn btn-primary" href="/login_view">Login</a>
                <?php endif; ?>
                <?php if($msg == "user_blocked"): ?>
                    <h1>Hi {{$user->name}}. you have been blocked by the site admin.</h1>
                <?php endif; ?>
                <?php if($msg == "404"): ?>
                    <h1>404 Page Not Found.</h1>
                <?php endif; ?>
	          </div>
	        </div>
        </div>
    </div>
</div>
<?php require($app_key.'/views/layouts/scripts.html'); ?>
</body>
</html>
