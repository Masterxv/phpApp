<?php
include('env.php');

$table_name = strtolower(str_replace(' ','_',$_POST['table']));
$table = 'app'.$_SESSION[$app_key]['active_app_id'].'_'.$table_name;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname2", $username2, $password2);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->prepare("describe $table ".$_POST['old_field_name']);
    $stmt->execute();
    $dt = $stmt->fetch(PDO::FETCH_ASSOC);
    $data_type = $dt['Type'];

    $stmt = $conn->prepare("ALTER TABLE $table CHANGE COLUMN ".$_POST['old_field_name']." ".$_POST['new_field_name']." ".$data_type);
    $stmt->execute();

}catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}

header('content-type:application/json');
echo  json_encode(['status' => 'success']);
?>