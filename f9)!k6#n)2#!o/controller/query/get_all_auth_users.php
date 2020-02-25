
<?php
include($app_key.'/include/SqlQueries.php');
$res = [];
foreach ($_POST['tables']??[] as $table) {
    $arr = getIds($table);
    $a = array_intersect($res, $arr);
    $b = array_diff($res, $arr);
    $c = array_diff($arr, $res);
    $res = array_merge($a, $b, $c);
}
header('content-type:application/json');
echo json_encode($res);
?>