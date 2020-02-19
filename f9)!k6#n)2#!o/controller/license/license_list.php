<?php include($app_key.'/include/csrf_token.php'); ?>

<?php
include($app_key.'/model/License.php');

$filter = ['created_by' => $_SESSION[$app_key]["active_app_id"]];

$pageno = $_GET['pageno']??1;
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;
$total_pages = ceil(License::where(null,null,'visibles','count',$filter) / $no_of_records_per_page);

$licenses = License::where($offset, $no_of_records_per_page,'visibles','sort:ORDER BY created_at',$filter);
?>

<?php 
include($app_key.'/view/license/license_list.php');
?>