<?php
include($app_key.'/model/model/'.$model.'.php');
$filter = [
	'id'=>$id
];
$row = $model::where(0, 1,null,'first',$filter);
deleteModelClass($table);
echo json_encode($row);
?>