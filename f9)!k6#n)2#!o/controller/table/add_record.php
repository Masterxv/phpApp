<?php
$_SESSION[$_SERVER['HTTP_REFERER'].'_rand']="";

include($app_key.'/include/CreateModelClass.php');
$model = ucwords(rtrim('app'.$_SESSION[$app_key]['active_app_id'].'_'.$_POST['table'],'s'));
createModelClass($_POST['table']);
include($app_key.'/model/model/'.$model.'.php');

if(!empty($_POST['password'])){
	$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
}
$model::create();

deleteModelClass($table);
header("Location: ".$app_url.'/table/crud_view?table='.$_POST['table']);
?>