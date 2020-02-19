<?php
include('env.php');
include($app_key.'/include/DataTypesArray.php');
// $this->validateAddColumnsRequest($request);
// $this->addColumnsSchema($request, $request->name);

$table_name = strtolower(str_replace(' ','_',$_POST['name']));
$table = 'app'.$_SESSION[$app_key]['active_app_id'].'_'.$table_name;

$sql = "ALTER TABLE $table ";
foreach ($_POST['field_type'] as $key => $value) {
	$sql = $sql.'ADD COLUMN '.$_POST['field_name'][$key];
	$sql = $sql.' '.dataTypes($value, $_POST['field_param'][$key]);
	if(!empty($_POST['field_default'][$key])){
		$sql = $sql.' '.'default "'.$_POST['field_default'][$key].'"';
	}
	if(!empty($_POST['field_key'][$key])){
		$sql = $sql.' '.$_POST['field_key'][$key].' key';
	}
	if(!empty($_POST['field_pos'][$key])){
		$sql = $sql.' AFTER '.$_POST['field_pos'][$key];
	}
	$sql = $sql.', ';
}
$sql = rtrim($sql,', ');

// echo $sql;exit;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname2", $username2, $password2);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();

}catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}

header("Location:".$app_url."/table/table_list");
?>