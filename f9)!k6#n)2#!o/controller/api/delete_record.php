<?php
include($app_key.'/model/model/'.$model.'.php');
$model::destroy();
deleteModelClass($table, $query['app_id']);
echo json_encode(["status","success"]);
?>