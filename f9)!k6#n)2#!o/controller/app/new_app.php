<?php
include($app_key.'/model/App.php');
include($app_key.'/model/User.php');
App::validate(['name' => 'required|max:255']);
$id = App::create(null,[
    'name' => $_POST['name']??'My App',
    'user_id' => $_SESSION[$app_key.'_user_id'],
    'secret' => hash('ripemd128', uniqid(rand(), true)),
    'auth_providers' => json_encode(array('guest', 'users')),
    'blocked' => false,
    'origins' => "",
]);
$_SESSION[$app_key.'_user_active_app_id'] = $id;
User::update($_SESSION[$app_key.'_user_id'],null,['active_app_id'=>$id]);
header("Location: $app_url/app/app_list");
?>