<?php include($app_key.'/include/csrf_token.php'); ?>
<?php
include($app_key.'/model/App.php');
$app = App::find($id);
$origins = json_decode($app['origins'], true)??[];
include($app_key.'/view/app/app_origins.php');
?>