<?php
include($app_key.'/model/model/'.$model.'.php');
$model::destroy();
deleteModelClass($table);
echo json_encode(["status","success"]);
?>