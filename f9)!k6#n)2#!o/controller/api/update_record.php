<?php
include($app_key.'/model/model/'.$model.'.php');
// $this->validateGenericInputs($request, $table);
$model::update();
deleteModelClass($table, $query['app_id']);
echo json_encode(['message' => "record updated!"]);
?>