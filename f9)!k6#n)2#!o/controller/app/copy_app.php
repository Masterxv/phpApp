<?php
include($app_key.'/model/App.php');
include($app_key.'/model/User.php');
App::validate(['id'=>'required|numeric']);
$app = App::find($_POST['id']);
$id = App::create(null,[
    'user_id'=>$_SESSION[$app_key]['id'],
    'name'=>$app['name'],
    'secret'=>hash('ripemd128', uniqid(rand(), true)),
    'token_lifetime'=>$app['token_lifetime'],
    'db_connection'=>$app['db_connection'],
    'auth_providers'=>$app['auth_providers'],
    'user_name_fields'=>$app['user_name_fields'],
    'invited_users'=>$app['invited_users'],
    'origins'=>$app['origins'],
    'can_chat_with'=>$app['can_chat_with'],
    'description'=>$app['description'],
    'availability' => 'Private',
    'blocked' => $app['blocked'],
]);
User::update($_SESSION[$app_key]['id'],null,['active_app_id'=>$id]);
$_SESSION[$app_key]['active_app_id']=$id;

// $this->copyTables($app->id, $_POST['id']);
// $this->copyQueries($app->id, $_POST['id']);

header('content-type:application/json');
echo json_encode(['status' => 'success','message'=>'app copied successfully.']);
?>