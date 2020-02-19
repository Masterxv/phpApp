<?php
include($app_key.'/model/App.php');
App::validate(['user_name_fields'=>'json', 'id'=>'numeric']);
$app = App::update($_POST['id'],null,[
    'user_name_fields' => $_POST['user_name_fields'],
]);
header('Content-Type:application/json');
echo  json_encode(['status' => 'success','message'=>'User name fields saved successfully.']);
?>