<?php
include($app_key.'/model/App.php');
$app = App::find($id);
$arr = json_decode($app['origins'], true)??[];
array_splice($arr, array_search($_POST['name'], $arr), 1);
App::update($app['id'],null,['origins' => json_encode($arr)]);
echo 'success'
?>