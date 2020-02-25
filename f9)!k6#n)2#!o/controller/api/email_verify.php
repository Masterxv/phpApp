<?php
include($app_key.'/model/model/'.$model.'.php');
$record = $model::find();

if(empty($record)){
	echo json_encode(["message" => "record does not exists"]);
}
if($record->email_verification == $request->code){
    $model::update(null,null,['email_verification' => 'done']);
    echo json_encode(["message" => "email verification successfull"]);
}else{
	echo json_encode(["message" => "email verification failed"]);
}
deleteModelClass($table, $query['app_id']);
?>