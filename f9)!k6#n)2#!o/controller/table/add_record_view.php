<?php include($app_key.'/include/csrf_token.php'); ?>

<?php
include($app_key.'/include/SqlQueries.php');
include($app_key.'/include/CreateModelClass.php');
include($app_key.'/include/InputTypesArray.php');

$td = getDescriptions($_GET['table'], ['id', 'created_at', 'updated_at', 'remember_token']);
$inpTyp = getInputTypeArray($td);
$isTA = getTextAreaTypes();
$step = getDecimalTypes();
$table = $_GET['table'];

include($app_key.'/view/db/add_record.php');
?>