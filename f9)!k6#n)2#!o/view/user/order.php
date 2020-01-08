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
<p>Redirecting to payment gateway .....</p>
@yield('payment_redirect')
<?php require($app_key.'/views/layouts/scripts.html'); ?>
</body>
</html>