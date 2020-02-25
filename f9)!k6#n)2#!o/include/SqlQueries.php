<?php

// public function getNonHiddenFields($table, $app_id = null)
// {
//     return getFields($table, ['password', 'remember_token'], $app_id);
// }

function getRemovableFields($table, $app_id = null)
{
    return getFields($table, ['id','password', 'remember_token','created_at', 'updated_at'], $app_id);
}

function getAfterFields($table, $app_id = null)
{
    return getFields($table, ['remember_token', 'created_at', 'updated_at'], $app_id);
}

function getFieldsSelectOptions($table, $app_id = null)
{
    $array = getRemovableFields($table, $app_id);
    $fields="";
    foreach ($array as $field) {
        $fields=$fields.'<option>'.$field.'</option>';
    }
    return $fields??'';
}

function getRawTables($app_id = null)
{
    include('env.php');
    $app_id = $app_id??$_SESSION[$app_key]['active_app_id'];
    $tables = [];
    try {
        $conn = new PDO("mysql:host=".$servername2.";dbname=".$dbname2, $username2, $password2);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare("SHOW TABLES LIKE 'app".$app_id."\_%'");
        $stmt->execute();
        $raw = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($raw as $key => $value){
            foreach($value as $key1 => $table){
                $tables[]=$table;
            }
        }
        return $tables;

    }catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
}

function getTables($app_id = null)
{
    include('env.php');
    $app_id = $app_id??$_SESSION[$app_key]['active_app_id'];
    $tables = [];
    try {
        $conn = new PDO("mysql:host=".$servername2.";dbname=".$dbname2, $username2, $password2);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare("SHOW TABLES LIKE 'app".$app_id."\_%'");
        $stmt->execute();
        $raw = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($raw as $key => $value){
            foreach($value as $key1 => $table){
                $tables[]=str_replace('app'.$app_id.'_','', $table);
            }
        }
        return $tables;

    }catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
}

function getTablesWithSizes($app_id = null)
{
    include('env.php');
    $app_id = $app_id??$_SESSION[$app_key]['active_app_id'];
    $tables = [];
    try {
        $conn = new PDO("mysql:host=".$servername2.";dbname=".$dbname2, $username2, $password2);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare('SELECT table_name AS `Table`, round(((data_length + index_length) / 1024 / 1024), 2) `Size` FROM information_schema.TABLES WHERE table_schema = "'.$dbname2.'" AND table_name LIKE "app'.$app_id.'\_%"');
        $stmt->execute();
        $raw = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($raw as $key => $value){
            $tables[]=['name'=>str_replace('app'.$app_id.'_','', $value['Table']), 'size'=>$value['Size']];
        }
        return $tables;

    }catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
}

function getFields($table, $skips, $app_id = null)
{
    include('env.php');
    $app_id = $app_id??$_SESSION[$app_key]['active_app_id'];
    $fields=[];
    try {
        $conn = new PDO("mysql:host=".$servername2.";dbname=".$dbname2, $username2, $password2);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = '".$dbname2."' AND TABLE_NAME = '".'app'.$app_id.'_'.$table."'");
        $stmt->execute();
        $raw = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($raw as $key => $value) {
            foreach ($value as $key2 => $field) {
                if(in_array($field, $skips))
                    continue;
                $fields[]=$field;
            }
        }

        return $fields??[];

    }catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
}

function getIds($table, $app_id = null)
{
    include('env.php');
    $app_id = $app_id??$_SESSION[$app_key]['active_app_id'];
    $fields=[];
    try {
        $conn = new PDO("mysql:host=".$servername2.";dbname=".$dbname2, $username2, $password2);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare("SELECT id FROM ".'app'.$app_id.'_'.$table);
        $stmt->execute();
        $raw = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($raw as $value) {
            $fields[]=$value['id'];
        }

        return $fields??[];

    }catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
}

// public function getFieldsLike($table, $likes, $app_id = null)
// {
//     include('env.php')
//     $app_id = $app_id??$_SESSION[$app_key]['active_app_id'];
//     $fields=[];
//     try {
//         $conn = new PDO("mysql:host=".$servername2.";dbname=".$dbname2, $username2, $password2);
//         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
//         foreach ($likes as $like) {
//             $stmt = $conn->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".'app'.$app_id.'_'.$table."' AND COLUMN_NAME LIKE '%".$like."%'");
//             $stmt->execute();
//             $raw = $stmt->fetchAll(PDO::FETCH_ASSOC);

//             foreach ($raw as $key => $value) {
//                 foreach ($value as $key2 => $field) {
//                     $fields[]=$field;
//                 }
//             }
//         }
//         return $fields??[];

//     }catch(PDOException $e){
//         echo $sql . "<br>" . $e->getMessage();
//     }
//     $conn = null;
// }

// public function getAppFields($skips)
// {
//     include('env.php')
//     $app_id = $app_id??$_SESSION[$app_key]['active_app_id'];
//     $fields=[];
//     try {
//         $conn = new PDO("mysql:host=".$servername2.";dbname=".$dbname2, $username2, $password2);
//         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
//         $stmt = $conn->prepare("SELECT DISTINCT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME LIKE 'app".$app_id."\_%'");
//         $stmt->execute();
//         $raw = $stmt->fetchAll(PDO::FETCH_ASSOC);

//         foreach ($raw as $key => $value) {
//             foreach ($value as $key2 => $field) {
//                 if(in_array($field, $skips))
//                     continue;
//                 $fields[]=$field;
//             }
//         }
//         return $fields??[];

//     }catch(PDOException $e){
//         echo $sql . "<br>" . $e->getMessage();
//     }
//     $conn = null;
// }

// public function getAppFieldsOfDataTypes($data_types)
// {
//     include('env.php')
//     $app_id = $app_id??$_SESSION[$app_key]['active_app_id'];
//     $fields=[];
//     try {
//         $conn = new PDO("mysql:host=".$servername2.";dbname=".$dbname2, $username2, $password2);
//         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
//         $stmt = $conn->prepare("SELECT DISTINCT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME LIKE 'app".$app_id."\_%' AND DATA_TYPE IN ('".implode(', ', $data_types)."')");
//         $stmt->execute();
//         $raw = $stmt->fetchAll(PDO::FETCH_ASSOC);

//         foreach ($raw as $key => $value) {
//             foreach ($value as $key2 => $field) {
//                 $fields[]=$field;
//             }
//         }
//         return $fields??[];

//     }catch(PDOException $e){
//         echo $sql . "<br>" . $e->getMessage();
//     }
//     $conn = null;
// }

function getDescriptions($table, $skips, $app_id = null)
{
    include('env.php');
    $app_id = $app_id??$_SESSION[$app_key]['active_app_id'];
    try {
        $conn = new PDO("mysql:host=".$servername2.";dbname=".$dbname2, $username2, $password2);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare('DESCRIBE app'.$app_id.'_'.$table);
        $stmt->execute();
        $td = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($td as $k => $v) {
            if(in_array($v['Field'], $skips))
                unset($td[$k]);
        }
        return $td??[];

    }catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
}

// public function copyTables($new_app_id, $app_id = null)
// {
//     include('env.php')
//     $app_id = $app_id??$_SESSION[$app_key]['active_app_id'];
//     try {
//         $conn = new PDO("mysql:host=".$servername2.";dbname=".$dbname2, $username2, $password2);
//         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
//         $stmt = $conn->prepare("SHOW TABLES LIKE 'app".$app_id."\_%'");
//         $stmt->execute();
//         $raw = $stmt->fetchAll(PDO::FETCH_ASSOC);

//         foreach($raw as $key => $value){
//             foreach($value as $key1 => $table){
//                 $stmt = $conn->prepare('CREATE TABLE '.str_replace('app'.$app_id.'_','app'.$new_app_id.'_',$table).' LIKE '.$table);
//                 $stmt->execute();
//                 $raw = $stmt->fetchAll(PDO::FETCH_ASSOC);
//             }
//         }
//         return true;

//     }catch(PDOException $e){
//         echo $sql . "<br>" . $e->getMessage();
//     }
//     $conn = null;
// }

// public function deleteTables($app_id = null)
// {
//     include('env.php')
//     $app_id = $app_id??$_SESSION[$app_key]['active_app_id'];
//     try {
//         $conn = new PDO("mysql:host=".$servername2.";dbname=".$dbname2, $username2, $password2);
//         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
//         $stmt = $conn->prepare("SHOW TABLES LIKE 'app".$app_id."\_%'");
//         $stmt->execute();
//         $raw = $stmt->fetchAll(PDO::FETCH_ASSOC);

//         foreach($raw as $key => $value){
//             foreach($value as $key1 => $table){
//                 $stmt = $conn->prepare('DROP TABLE '.$table);
//                 $stmt->execute();
//                 $raw = $stmt->fetchAll(PDO::FETCH_ASSOC);
//             }
//         }
//         return true;

//     }catch(PDOException $e){
//         echo $sql . "<br>" . $e->getMessage();
//     }
//     $conn = null;
// }

// public function getUserStorageFootPrint($app_id = null)
// {
//     include('env.php')
//     include_once($app_key.'/model/App.php');
//     $app_id = $app_id??$_SESSION[$app_key]['active_app_id'];
//     $user_id = $_SESSION[$app_key]['id'];
//     $app_ids = App::where(null,null,null,'pluck:id',['user_id' => $user_id]);
//     $size = 0;
//     try {
//         $conn = new PDO("mysql:host=".$servername2.";dbname=".$dbname2, $username2, $password2);
//         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//         foreach ($app_ids as $id) {
//             $stmt = $conn->prepare('SELECT SUM(round(((data_length + index_length) / 1024 / 1024), 2)) `Size` FROM information_schema.TABLES WHERE table_schema = "'.$dbname2.'" AND table_name LIKE "app'.$id.'\_%"');
//             $stmt->execute();
//             $raw = $stmt->fetchAll(PDO::FETCH_ASSOC);
//             $size = $size + $raw[0]->Size;
//         }

//     }catch(PDOException $e){
//         echo $sql . "<br>" . $e->getMessage();
//     }
//     $conn = null;
//     $size = $size + round(App::where(null,null,null,'sum:size',[['app_id','in',$app_ids]])/1024/1024,2);
//     return $size;
// }

// private function type($dt)
// {
//     $arr = [
//         'tinyint(4)' => 'tinyint',
//         'tinyint(3) unsigned' => 'tinyint',
//         'smallint(6)' => 'smallint',
//         'smallint(5) unsigned' => 'smallint',
//         'mediumint(9)' => 'mediumint',
//         'mediumint(8) unsigned' => 'mediumint',
//         'int(11)' => 'int',
//         'int(10) unsigned' => 'int',
//         'bigint(20)' => 'bigint',
//         'bigint(20) unsigned' => 'bigint',
//         'decimal(8,2)' => 'decimal(8,2)',
//         'decimal(8,2) unsigned' => 'decimal(8,2)',
//         'double(8,2)' => 'double(8,2)',
//         'double' => 'double',
//         'tinyint(1)' => 'tinyint',
//         'date' => 'date',
//         'time' => 'time',
//         'char(255)' => 'char',
//         'varchar(255)' => 'varchar',
//         'text' => 'text',
//         'mediumtext' => 'mediumtext',
//         'longtext' => 'longtext',
//         'blob' => 'blob',
//         'geometry' => 'geometry',
//         'point' => 'point',
//         'linestring' => 'linestring',
//         'polygon' => 'polygon',
//         'multipoint' => 'multipoint',
//         'multilinestring' => 'multilinestring',
//         'multipolygon' => 'multipolygon',
//         'geometrycollection' => 'geometrycollection',
//         'varchar(45)' => 'varchar',
//         'varchar(17)' => 'varchar',
//         'char(36)' => 'char',
//         'year(4)' => 'year',
//     ];
//     if(strpos($dt,"num(\'")){
//         return 'enum';
//     }else{
//         return $arr[$dt]??'string';
//     }
// }

// private function len($dt)
// {
//     $arr = [
//         'tinyint(4)' => '4',
//         'tinyint(3) unsigned' => '3',
//         'smallint(6)' => '6',
//         'smallint(5) unsigned' => '5',
//         'mediumint(9)' => '9',
//         'mediumint(8) unsigned' => '8',
//         'int(11)' => '11',
//         'int(10) unsigned' => '10',
//         'bigint(20)' => '20',
//         'bigint(20) unsigned' => '20',
//         // 'decimal(8,2)' => 'decimal(8,2)',
//         // 'decimal(8,2) unsigned' => 'decimal(8,2) unsigned',
//         // 'double(8,2)' => 'double(8,2)',
//         'tinyint(1)' => '1',
//         'char(255)' => '255',
//         'varchar(255)' => '255',
//         'varchar(45)' => '45',
//         'varchar(17)' => '17',
//         'char(36)' => '36',
//         'year(4)' => '4',
//     ];
//     if(strpos($dt,"num(\'")){
//         return 'in:'.str_replace(['enum(',')',"\'",' '],['','','',''],$dt);
//     }else{
//         return $arr[$dt]??'';
//     }
// }

// private function uns($dt)
// {
//     $arr = [
//         'tinyint(3) unsigned' => 'unsigned',
//         'smallint(5) unsigned' => 'unsigned',
//         'mediumint(8) unsigned' => 'unsigned',
//         'int(10) unsigned' => 'unsigned',
//         'bigint(20) unsigned' => 'unsigned',
//         'decimal(8,2) unsigned' => 'unsigned',
//     ];
//     return $arr[$dt]??'';
// }

// private function ret($dt)
// {
//     $enum = "enum(\'apple\',\' banana\',\' mango\',\' grapes\',\' jack\')";
//     $arr = [
//         'tinyint(4)' => 'tinyint(4)',
//         'tinyint(3) unsigned' => 'tinyint(3) unsigned',
//         'smallint(6)' => 'smallint(6)',
//         'smallint(5) unsigned' => 'smallint(5) unsigned',
//         'mediumint(9)' => 'mediumint(9)',
//         'mediumint(8) unsigned' => 'mediumint(8) unsigned',
//         'int(11)' => 'int(11)',
//         'int(10) unsigned' => 'int(10) unsigned',
//         'bigint(20)' => 'bigint(20)',
//         'bigint(20) unsigned' => 'bigint(20) unsigned',
//         'decimal(8,2)' => 'decimal(8,2)',
//         'decimal(8,2) unsigned' => 'decimal(8,2) unsigned',
//         'double(8,2)' => 'double(8,2)',
//         'double' => 'double',
//         'tinyint(1)' => 'tinyint(1)',
//         'date' => 'date',
//         'time' => 'time',
//         'char(255)' => 'char(255)',
//         'varchar(255)' => 'varchar(255)',
//         'text' => 'text',
//         'mediumtext' => 'mediumtext',
//         'longtext' => 'longtext',
//         'blob' => 'blob',
//         'geometry' => 'geometry',
//         'point' => 'point',
//         'linestring' => 'linestring',
//         'polygon' => 'polygon',
//         'multipoint' => 'multipoint',
//         'multilinestring' => 'multilinestring',
//         'multipolygon' => 'multipolygon',
//         'geometrycollection' => 'geometrycollection',
//         'varchar(45)' => 'varchar(45)',
//         'varchar(17)' => 'varchar(17)',
//         'char(36)' => 'char(36)',
//         'year(4)' => 'year(4)',
//     ];
//     return $arr[$dt]??'';
// }

?>