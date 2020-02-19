<?php include($app_key.'/include/csrf_token.php'); ?>

<?php
include($app_key.'/include/SqlQueries.php');
$tables = getTablesWithSizes();
$size = 0;
foreach ($tables as $table) {
    $size = $size + $table['size'];
}

$pageno = $_GET['pageno']??1;
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;
$total_pages = ceil(count($tables) / $no_of_records_per_page);
?>

<?php 
include($app_key.'/view/db/mytable_list.php'); 
?>