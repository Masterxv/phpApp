<?php
$model = ucwords(rtrim('app'.$query['app_id'].'_'.$table,'s'));
createModelClass($table,$query['app_id'],$fillables);

include($app_key.'/model/model/'.$model.'.php');
// $this->validateGenericInputs($request, $table, true);
$app = App::find($query['app_id']);
$user_name_fields = json_decode($app['user_name_fields'], true)??[];
if(!empty($user_name_fields[$table])){
    foreach ($user_name_fields[$table] as $user) {
        $record = $model::where(0,1,null,'first',[$user => $_POST[$user]]);
        if(!empty($record)){
            if (password_verify($_POST['password'], $record['password'])){
            	$new_token = hash('ripemd128', rand());
			    $expiry = $app['token_lifetime'] + time();
			    Session::create(null,[
			        '_token' => $new_token, 
			        'expiry' => $expiry,
			        'app_id' => $app['id'],
			        'user_id' => $record['id'],
			        'auth_provider' => $table,
			        'user_name' => $record['name'],
			        'user_agent' => $_SERVER['HTTP_USER_AGENT'],
			        'ip_address' => $_SERVER['REMOTE_ADDR'],
			    ]);
                deleteModelClass($table);
                echo json_encode(['status' => "success", '_token' => $new_token, 'user' => $record]);
                exit;
            }else{
                deleteModelClass($table);
                echo json_encode(['message' => "incorrect password"]);
                exit;
            }
        }
    }
}
deleteModelClass($table, $query['app_id']);
echo json_encode(['message' => "wrong credentials"]);
exit;
?>