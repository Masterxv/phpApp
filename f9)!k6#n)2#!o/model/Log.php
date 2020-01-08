<?php 
include_once($app_key.'/model/Model.php');
/**
 * 
 */
class Log extends Model
{
	public static $table = 'logs';
	
	public static $fields = ['id','aid','fid','fap','qid','query_nick_name','auth_provider','table_name','command','ip','created_at','updated_at'];

	public static $visibles = ['id','name','email','phone','role','created_at','updated_at'];

	public static function roleArray($role = null){
		if($role == 'visibles'){
			return self::$visibles;
		}else{
			return self::$fields;
		}
	}
}
