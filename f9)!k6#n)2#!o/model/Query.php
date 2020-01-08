<?php 
include_once($app_key.'/model/Model.php');
/**
 * 
 */
class Query extends Model
{
	public static $table = 'queries';
	
	public static $fields = ['id','app_id','name','auth_providers','tables','commands','fillables','hiddens','mandatory','joins','filters','specials','created_at','updated_at',];

	public static $visibles = ['id','name','email','phone','role','created_at','updated_at'];

	public static function roleArray($role = null){
		if($role == 'visibles'){
			return self::$visibles;
		}else{
			return self::$fields;
		}
	}
}
