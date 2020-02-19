<?php
function createModelClass($table, $app_id = null, $fields = null)
{
    include('env.php');
    include_once($app_key.'/include/SqlQueries.php');
    $app_id = $app_id??$_SESSION[$app_key]['active_app_id'];
    $model_class = ucwords(rtrim('app'.$app_id.'_'.$table,'s'));
    $myFilePath = $_SERVER['DOCUMENT_ROOT'].'/'.$app_key."/model/model/".$model_class.".php";
    $myfile = fopen($myFilePath, "w");

    if(empty($fields)){
        $fields = getFields($table, [], $app_id);
    }
    $cont = "<?php\n";
    $cont = $cont . "include_once($"."app_key.'/model/Model.php');\n";
    $cont = $cont . "class ".$model_class." extends Model\n";
    $cont = $cont . "{\n";
    $cont = $cont . "public static $" ."servername = '" .$servername2."';\n";
    $cont = $cont . "public static $" ."dbname = '" .$dbname2."';\n";
    $cont = $cont . "public static $" ."username = '" .$username2."';\n";
    $cont = $cont . "public static $" ."password = '" .$password2."';\n";
    $cont = $cont . "public static $" ."table = '" .'app'.$app_id.'_'. $table."';\n";
    $cont = $cont . "public static $" ."fields = ['". implode("', '", $fields) ."'];\n";
    $cont = $cont . "}\n";

    fwrite($myfile, $cont);
    fclose($myfile);
}


function deleteModelClass($table, $app_id = null)
{
    include('env.php');
    $app_id = $app_id??$_SESSION[$app_key]['active_app_id'];
    $model_class = ucwords(rtrim('app'.$app_id.'_'.$table,'s'));
    $myFilePath = $_SERVER['DOCUMENT_ROOT'].'/'.$app_key."/model/model/".$model_class.".php";

    if(is_writable($myFilePath)){
        unlink($myFilePath);
    }
}
?>