<?php
include($app_key.'/model/User.php');
$result = User::find($_SESSION[$app_key."_user_id"]);
foreach ($result as $key => $value) {
    unset($_SESSION[$app_key."_user_".$key]);
}
header("Location: $app_url/login_view");
?>