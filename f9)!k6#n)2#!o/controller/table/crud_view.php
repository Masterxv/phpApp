<?php
include($app_key.'/include/SqlQueries.php');
include($app_key.'/include/CreateModelClass.php');
include($app_key.'/include/InputTypesArray.php');

$td = getDescriptions($_GET['table'], []);
$inpTyp = getInputTypeArray($td);
$isTA = getTextAreaTypes();
$table = $_GET['table'];

$model = ucwords(rtrim('app'.$_SESSION[$app_key]['active_app_id'].'_'.$_GET['table'],'s'));
createModelClass($_GET['table']);
include($app_key.'/model/model/'.$model.'.php');

$filter = [];
foreach ($td as $key => $value) { 
    if(!empty($_GET[$value['Field']])){
        $filter[] = [$value['Field'],'LIKE','%'.$_GET[$value['Field']].'%'];
    }
}
// print_r($filter);exit;
// $records = $this->dateFilter($request, $records);
// $records = $this->whereFilters($records, $_POST['_f']?explode('|', $_POST['_f']):[]);
// $records = $records->paginate(10);

$pageno = $_GET['pageno']??1;
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;
$total_pages = ceil($model::where(null,null,null,'count',$filter) / $no_of_records_per_page);
$records = $model::where($offset,$no_of_records_per_page,null,null,$filter);
// print_r($records);exit;
deleteModelClass($table);
?>

<?php 
include($app_key.'/view/db/crud.php'); 
?>