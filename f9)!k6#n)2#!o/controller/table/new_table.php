<?php
include('env.php');
include($app_key.'/model/Model.php');
include($app_key.'/model/App.php');
include($app_key.'/include/DataTypesArray.php');
// print_r($_POST);exit;
$_POST['name'] = strtolower(str_replace(' ','_',$_POST['name']));
// Model::validate([
// 	"name" => ['required','string','max:255', function($attribute, $value, $fail){
//                 if(Schema::connection($this->con)->hasTable($this->table($value))){
//                     $fail('A table with this name already exisits.');
//                 }
//             }],
// ]);
// $request->validate([
//     'name' => 'required|string|max:255',
//     "field_name.*" => "required|string|max:255",

//     "field_type.*" => "required|in:increments,tinyIncrements,smallIncrements,mediumIncrements,bigIncrements,tinyInteger,unsignedTinyInteger,smallInteger,unsignedSmallInteger,mediumInteger,unsignedMediumInteger,integer,unsignedInteger,bigInteger,unsignedBigInteger,decimal,unsignedDecimal,float,double,boolean,date,dateTime,dateTimeTz,time,timeTz,char,string,text,mediumText,longText,binary,enum,geometry,point,lineString,polygon,multiPoint,multiLineString,multiPolygon,geometryCollection,ipAddress,macAddress,uuid,year,timestamp,timestamps,timestampsTz",

//     "field_param.*" => [function($attribute, $value, $fail)use($request){
//         if(!empty($value)){ 
//             $key = str_replace('field_param.','',$attribute);
//             if(in_array($request->field_type[$key], ['char','string'])){
//                 if(is_numeric($value)){
//                     if($value>21844){
//                         $fail('String length must not be more than 21844.');
//                     }else if( strpos($value, ".") ){
//                         $fail('String length must be whole number.');
//                     }
//                 }else {
//                     $fail('String length must be numeric.');
//                 } 
//             }else if(in_array($request->field_type[$key], ['decimal','unsignedDecimal','float'])){
//                 if( strpos($value, ",") ){
//                     $t=explode(',',$value);
//                     if(is_numeric($t[0]) && is_numeric($t[1])){
//                         if($t[0]>65){
//                             $fail('Real type M(total digits) must not be more than 65.');
//                         }else if( $t[1]>30 ){
//                             $fail('Real type D(decimals) must not be more than 30.');
//                         }else if( $t[1]>$t[0] ){
//                             $fail('Real type  M(total digits) must be greater than or equal to D(decimals).');
//                         }else if( strpos($t[0], ".") || strpos($t[1], ".") ){
//                             $fail('Real type must have M & D values as whole number.');
//                         }
//                     }else{
//                         $fail('Real type must have numeric lengths.');
//                     }
//                 }else{
//                     $fail('Real type must have both M(total digits), D(decimals).');
//                 }
//             }else if($request->field_type[$key] == 'enum'){
//                 if($value==""){
//                     $fail('Enum type must have options separated by comma.');
//                 }
//             }
//         }
//     }],

//     "field_key.*" => "in:primary,unique,index,null",
// ]);

// $rules = [];
// if(count($request->field_default)!=0){
//     foreach ($request->field_default as $key => $value) {
//         if(!empty($value)){
//             $val=$this->getValidationString($this->getDataTypeString($request->field_type[$key], $request->field_param[$key]));
//             $rules["field_default.".$key] = $val;
//         }
//     }
// }

// $request->validate($rules);

// $fields = $this->getAfterFields($request->name);
// if($fields !== []){
//     $rules = ['field_pos.*' => 'in:'.implode(',', $fields)];
//     $request->validate($rules);
//     \Log::Info(request()->ip()." validation passed for add columns request for app id ".$this->app_id);
// }




// $this->validateCreateTableRequest($request);
$table_name = strtolower(str_replace(' ','_',$_POST['name']));
$table = 'app'.$_SESSION[$app_key]['active_app_id'].'_'.$table_name;
// $this->createTableSchema($request, $table);

// if($_POST['model'] == "authenticatable"){
//     $this->addUserTypeToApp($table);
// }
$sql = "CREATE TABLE $table (";
foreach ($_POST['field_type'] as $key => $value) {
	$sql = $sql.$_POST['field_name'][$key];
	$sql = $sql.' '.dataTypes($value, $_POST['field_param'][$key]);
	if(!empty($_POST['field_default'][$key])){
		$sql = $sql.' '.'default "'.$_POST['field_default'][$key].'"';
	}
	if(!empty($_POST['field_key'][$key])){
		$sql = $sql.' '.$_POST['field_key'][$key].' key';
	}
	$sql = $sql.', ';
}
$sql = rtrim($sql,', ') . ')';

try {
    $conn = new PDO("mysql:host=$servername2;dbname=$dbname2", $username2, $password2);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if($_POST['model'] == "authenticatable"){
	    $ap = App::find($_SESSION[$app_key]['active_app_id'],null,'auth_providers');
	    $ap = json_decode($ap,true)??[];
	    array_push($ap,$table_name);
	    App::update($_SESSION[$app_key]['active_app_id'],null,[
	    	'auth_providers' => json_encode($ap),
	    ]);
	}
	if($_POST['model'] == "token_auth"){
	    $ap = App::find($_SESSION[$app_key]['active_app_id'],null,'token_auths');
	    $ap = json_decode($ap,true)??[];
	    array_push($ap,$table_name);
	    App::update($_SESSION[$app_key]['active_app_id'],null,[
	    	'token_auths' => json_encode($ap),
	    ]);
	}

}catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}

header("Location:".$app_url."/table/table_list");
?>