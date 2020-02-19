<?php
include($app_key.'/model/App.php');
include($app_key.'/include/SqlQueries.php');
$app = App::find($_SESSION[$app_key]['active_app_id']);
$commands = ['ReadAll'=>'all', 'Create'=>'new', 'Read'=>'get', 'Update'=>'mod', 'Delete'=>'del', 
'SignUp' => 'signup', 'SendEmailVerificationCode' => 'sevc', 'VerifyEmail' => 've', 'Login' => 'login', 
'ConditionalLogin' => 'clogin', 'RefreshToken' => 'refresh', 'FilesUpload' => 'files_upload', 'SendMail' => 'mail'
, 'PushSubscribe' => 'ps', 'GetAppSecret' => 'secret'];
$specials = ['pluck', 'count', 'max', 'min', 'avg', 'sum'];
$auth_providers = json_decode($app['auth_providers'],true)??[];
$tables = getTables();
include($app_key.'/view/q/create_query.php');
?>