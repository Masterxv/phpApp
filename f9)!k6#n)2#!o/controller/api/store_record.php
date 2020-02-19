<?php
include($app_key.'/model/model/'.$model.'.php');
// $this->validateGenericInputs($request, $table);
$id = $model::create();
deleteModelClass($table, $query['app_id']);
echo $id;
?>