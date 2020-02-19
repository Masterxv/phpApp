<?php include($app_key.'/include/csrf_token.php'); ?>

<?php
include($app_key.'/model/App.php');
$desc = App::find($id,null,'description');
$name = App::find($id,null,'name');
include($app_key.'/view/app/app_description.php');
?>