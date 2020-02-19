<?php include($app_key.'/include/csrf_token.php'); ?>

<?php
include($app_key.'/model/App.php');
include($app_key.'/model/User.php');
$app = App::find($id);

$filter = [['id','in',json_decode($app['invited_users']??'[]', true)]];

$pageno = $_GET['pageno']??1;
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;
$total_pages = ceil(App::where(null,null,'visibles','count',$filter) / $no_of_records_per_page);

$apps = App::where($offset, $no_of_records_per_page,'visibles',null,$filter);
$active_app = App::find($_SESSION[$app_key]["active_app_id"]);

include($app_key.'/view/app/invited_users.php');
?>