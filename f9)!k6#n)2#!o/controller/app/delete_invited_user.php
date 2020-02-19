<?php
include($app_key.'/model/App.php');
include($app_key.'/model/User.php');
User::validate(['app_id'=>'numeric','user_id'=>'numeric']);
$invited_user = User::find($_POST['user_id']);
$app = App::find($_POST['app_id']);

$invited_apps = json_decode($invited_user['invited_apps']??'[]', true);
array_splice($invited_apps, array_search($app['id'], $invited_apps),1);
User::update($invited_user['id'],null,['invited_apps'=>$invited_apps?json_encode($invited_apps):null]);

$invited_users = json_decode($app['invited_users']??'[]', true);
array_splice($invited_users, array_search($invited_user['id'], $invited_users),1);
App::update($app['id'],null,['invited_users'=>$invited_users?json_encode($invited_users):null]);

header('content-type:application/json');
echo json_encode(['message' => 'success']);
?>