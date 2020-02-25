<?php
include($app_key.'/model/model/'.$model.'.php');
$filter = [
	'id'=>$id
];
$row = $model::where(0, 1,null,'first',$filter);

if($author == 'guest'){
	$token_auths = json_decode($app['token_auths'],true)??[];
	if(in_array($table,$token_auths)){
		// echo $row['_token'];
		// echo $_GET['_token'];exit;
		if($row['api_token']!=$_GET['api_token']){
			echo json_encode(['status'=>'un-authorized']);exit;
		}
	}
}

deleteModelClass($table, $query['app_id']);
echo json_encode($row);
?>