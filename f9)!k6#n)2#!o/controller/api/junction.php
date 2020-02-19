<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('content-type:application/json');
?>
<?php
include($app_key.'/include/CreateModelClass.php');
include($app_key.'/model/Session.php');
include($app_key.'/model/App.php');
include($app_key.'/model/Query.php');
include($app_key.'/middleware/api_auth.php');

// if(empty($request->route('query_id'))){
//     if($request->_token){
//         $this->getAuth($request->_token);
//     }else{
//         $this->aid = $request->app_id;
//         $this->fap = $request->fap;
//         $this->fname = $request->fname??'Guest';
//     }
// }else{
//     $this->getAuth($request->_token);
// }

        
// $query = Query::find($query_id);
// $this->con = App::find($query['app_id'])->db_connection;
// $this->updateUsageReport('api_calls');

if(!$_GET['author']){
    $authors = explode(', ', $query['auth_providers']);
    $author = $authors[0];
}else{
    $author = $_GET['author'];
}

if(!$_GET['table']){
    $tables = explode(', ', $query['tables']);
    $table = $tables[0];
}else{
    $table = $_GET['table'];
}

if(!$_GET['command']){
    $commands = explode(', ', $query['commands']);
    $command = $commands[0];
}else{
    $command = $_GET['command'];
}

if(!$_GET['fillable']){
    $fillables = $query['fillables'] ? explode(', ', $query['fillables']) : null;
}else{
    $fillables = $query['fillables'] ? explode(', ', $query['fillables']) : null;
}

if(!$_GET['hidden']){
    $hiddens = explode(', ', $query['hiddens']);
}else{
    $hiddens = array_merge(explode(', ', $query['hiddens']), explode(',', $_GET['hidden']));
}

if(!$_GET['join']){
    $joins = $query['joins']?explode('|', $query['joins']):[];
}else{
    $joins = explode('|', $_GET['join']);
}

if(!$_GET['filter']){
    $filters = $query['filters']?explode('|', $query['filters']):[];
}else{
    $filters = explode('|', $_GET['filter']);
}

if(!$_GET['special']){
    $specials = explode(', ', $query['specials']);
}

if($command == 'signup'){
    array_push($fillables, 'password');
    include($app_key.'/controller/api/signup.php');
    // return $this->signup($_GET, $table, $fillables, $hiddens);
}elseif($command == 'login'){
    array_push($fillables, 'password');
    include($app_key.'/controller/api/login.php');
    // return $this->login($_GET, $table, $fillables, $hiddens);
}elseif($command == 'clogin'){
    array_push($fillables, 'password');
    include($app_key.'/controller/api/clogin.php');
    // return $this->clogin($request, $table, $fillables, $hiddens);
}elseif($command == 'files_upload'){
	include($app_key.'/controller/api/upload_files.php');
    // return $this->uploadFiles($request);
}elseif($command == 'mail'){
	include($app_key.'/controller/api/send_mail.php');
    // return $this->sendMail($request);
}elseif($command == 'ps'){
	include($app_key.'/controller/api/save_push_subscription.php');
    // return $this->savePushSubscription($request);
}

$model = ucwords(rtrim('app'.$query['app_id'].'_'.$table,'s'));
createModelClass($table,$query['app_id'],$fillables);

if($command == 'all'){
    include($app_key.'/controller/api/index.php');
}elseif($command == 'new'){
	include($app_key.'/controller/api/store_record.php');
}elseif($command == 'get'){
	include($app_key.'/controller/api/get_record.php');
    // return $this->getRecord($table_class, $id, $filters);
}elseif($command == 'mod'){
	include($app_key.'/controller/api/update_record.php');
    // return $this->updateRecord($request, $table_class, $table, $id);
}elseif($command == 'del'){
	include($app_key.'/controller/api/delete_record.php');
    // return $this->deleteRecord($table_class, $id);
}elseif($command == 'sevc'){
	include($app_key.'/controller/api/send_email_verification_code.php');
    // return $this->sendEmailVerificationCode($request, $table_class);
}elseif($command == 've'){
	include($app_key.'/controller/api/email_verify.php');
    // return $this->emailVerify($request, $table_class);
}
?>