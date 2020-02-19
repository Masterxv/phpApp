<?php
include($app_key.'/include/SqlQueries.php');
echo getFieldsSelectOptions($_GET['table']);
?>