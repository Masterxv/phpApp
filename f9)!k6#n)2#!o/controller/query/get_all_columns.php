
<?php
include($app_key.'/include/SqlQueries.php');
$res = [];
foreach ($_GET['tables']??[] as $table) {
    $arr = getFields($table, ['password', 'remember_token']);
    $a = array_intersect($res, $arr);
    $b = array_diff($res, $arr);
    $c = array_diff($arr, $res);
    $res = array_merge($a, $b, $c);
}
header('content-type:application/json');
echo json_encode($res);
?>