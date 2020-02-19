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
<p>Redirecting to payment gateway .....</p>
@yield('payment_redirect')
<?php require($app_key.'/view/layouts/scripts.php'); ?>
</body>
</html>