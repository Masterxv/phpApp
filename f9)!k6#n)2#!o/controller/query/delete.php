<?php
include($app_key.'/model/Query.php');
Query::destroy();
header('content-type:application/json');
echo json_encode(['status' => 'success']);
?>