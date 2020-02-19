<?php include($app_key.'/include/csrf_token.php'); ?>
<?php
include($app_key.'/model/Query.php');

$filter = ['app_id' => $_SESSION[$app_key]["active_app_id"]];

$pageno = $_GET['pageno']??1;
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;
$total_pages = ceil(Query::where(null,null,'visibles','count',$filter) / $no_of_records_per_page);

$queries = Query::where($offset, $no_of_records_per_page,'visibles',null,$filter);
?>

<?php 
include($app_key.'/view/q/query_list.php'); 
?>