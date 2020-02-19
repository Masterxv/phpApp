<?php
include($app_key.'/model/User.php');
$result = User::find($_SESSION[$app_key]["id"]);
unset($_SESSION[$app_key]);
header("Location: $app_url/login_view");
?>