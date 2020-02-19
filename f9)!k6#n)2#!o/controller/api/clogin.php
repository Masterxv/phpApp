<?php
include($app_key.'/model/Session.php');
include($app_key.'/model/model/'.$model.'.php');
header('content-type:application/json');
// $this->validateGenericInputs($request, $author, true);
$app = App::find($query['app_id']);
$record = $model::where(0,1,null,'first',['email' => $_POST['email']]);
if(!empty($record)){
    if($record['email_verification'] == 'done'){
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
            echo json_encode(['status' => "success", '_token' => $new_token, 'user' => $record]);
        }else{
        	echo json_encode(['message' => "incorrect password"]);
        }
    }
    echo json_encode(['message' => "email address not verified"]);
}
echo json_encode(['message' => "email address does not exists"]);
deleteModelClass($table);
?>