<?php include($app_key.'/include/csrf_token.php'); ?>

<?php
include($app_key.'/model/App.php');
include($app_key.'/include/SqlQueries.php');
$app = App::find($id);
$ap = json_decode($app['auth_providers'],true)??[];
$ap = array_slice($ap,1);
$aunf = json_decode($app['user_name_fields']??'',true)??[];
$fields = [];
foreach ($ap as $a) {
    if(empty($aunf[$a])){
        $aunf[$a] = ['email'];
    }
    $fields[$a] = getFields($a, ['id', 'created_at', 'updated_at'], $id);
}
include($app_key.'/view/app/app_user_name_fields.php');
?>