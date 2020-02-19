<?php include($app_key.'/include/csrf_token.php'); ?>
<?php
include($app_key.'/include/SqlQueries.php');
include($app_key.'/include/CreateModelClass.php');
include($app_key.'/include/InputTypesArray.php');

$table = $_GET['table'];
$td = getDescriptions($_GET['table'], ['created_at', 'updated_at', 'remember_token']);
$inpTyp = getInputTypeArray($td);
$isTA = getTextAreaTypes();
$step = getDecimalTypes();

$model = ucwords(rtrim('app'.$_SESSION[$app_key]['active_app_id'].'_'.$_GET['table'],'s'));
createModelClass($_GET['table']);
include($app_key.'/model/model/'.$model.'.php');

$record = $model::find($_GET['id']);
deleteModelClass($table);
?>

<?php 
include($app_key.'/view/db/edit_record.php'); 
?>