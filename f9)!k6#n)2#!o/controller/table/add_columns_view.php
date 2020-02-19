<?php include($app_key.'/include/csrf_token.php'); ?>

<?php
include($app_key.'/include/SqlQueries.php');
$fn = $_GET['fn']??0;
$table = $_GET['table'];
$fields = getAfterFields($_GET['table']);
include($app_key.'/view/db/add_columns.php');
?>