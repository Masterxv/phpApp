<?php include($app_key.'/include/csrf_token.php'); ?>

<?php
include('env.php');
include($app_key.'/model/File.php');

$filter = ['app_id' => $_SESSION[$app_key]["active_app_id"]];

$pageno = $_GET['pageno']??1;
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;
$total_pages = ceil(File::where(null,null,'visibles','count',$filter) / $no_of_records_per_page);

$files = File::where($offset, $no_of_records_per_page,'visibles',null,$filter);
$size = File::where(null,null,null,'sum:size',$filter);
$size = round($size/1024/1024,2);
?>

<?php 
include($app_key.'/view/file/files_store.php'); 
?>