<?php
include($app_key.'/model/App.php');
App::validate(['description'=>'required|max:65536', 'id'=>'numeric']);
App::update($_POST['id'],null,[
    'description' => $_POST['description'],
]);
header('Content-Type:application/json');
echo  json_encode(['status' => 'success','message'=>'description saved successfully.']);
?>