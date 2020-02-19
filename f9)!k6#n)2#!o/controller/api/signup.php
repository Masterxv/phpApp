<?php
include($app_key.'/model/model/'.$model.'.php');
// $this->validateGenericInputs($request, $author);
$id = $model::create();
$model::update($id,null,['password' => password_hash($_POST['password'], PASSWORD_DEFAULT)]);
deleteModelClass($table);
header('content-type:application/json');
echo json_encode(['status' => 'success', 'user' => $model::find($id)]);
?>