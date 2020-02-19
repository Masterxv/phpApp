<?php
$_SESSION[$_SERVER['HTTP_REFERER'].'_rand']="";

include($app_key.'/include/CreateModelClass.php');
$model = ucwords(rtrim('app'.$_SESSION[$app_key]['active_app_id'].'_'.$_POST['table'],'s'));
createModelClass($_POST['table']);
include($app_key.'/model/model/'.$model.'.php');

$model::update();
deleteModelClass($table);
header("Location: ".$_SERVER['HTTP_REFERER']);
?>