<?php include($app_key.'/include/csrf_token.php'); ?>

<?php
include($app_key.'/model/App.php');

$filter = ['user_id' => $_SESSION[$app_key]["id"]];

$pageno = $_GET['pageno']??1;
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;
$total_pages = ceil(App::where(null,null,'visibles','count',$filter) / $no_of_records_per_page);

$apps = App::where($offset, $no_of_records_per_page,'visibles',null,$filter);
$active_app = App::find($_SESSION[$app_key]["active_app_id"]);
?>

<?php 
include($app_key.'/view/app/myapp_list.php'); 
?>