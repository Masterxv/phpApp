<?php
include($app_key.'/model/User.php');
$_SESSION[$app_key]['active_app_id'] = $_POST['active_app_id'];
User::update($_SESSION[$app_key]['id'],null,['active_app_id' => $_POST['active_app_id']]);
echo 'success';
?>