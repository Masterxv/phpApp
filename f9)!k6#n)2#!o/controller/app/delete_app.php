<?php
include($app_key.'/model/App.php');
include($app_key.'/model/User.php');
App::validate(['id'=>'required|numeric']);
$first_app = App::where(0,1,null,'first',['user_id' => $_SESSION[$app_key]['id'] ]);
if(empty($first_app)){
    header('content-type:application/json');
    echo json_encode(['status'=>'warning', 'message'=>'atleast one app is required.']);
}
User::update($_SESSION[$app_key]['id'],null,['active_app_id'=>$first_app['id']]);
$_SESSION[$app_key]['active_app_id']=$first_app['id'];
App::destroy($_POST['id']);
// $this->deleteTables($_POST['id']);
// $this->deleteQueries($_POST['id']);
header('content-type:application/json');
echo json_encode(['status' => 'success','message'=>'app deleted successfully.']);
?>