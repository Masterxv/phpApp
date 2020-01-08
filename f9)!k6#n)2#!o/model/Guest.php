<?php 
include_once($app_key.'/model/Model.php');
/**
 * 
 */
class Guest extends Model
{
	public static $table = 'guests';
	
	public static $fields = ['id','ip_address','uuid','name','chat_resource_id','created_at','updated_at',];

	public static $visibles = ['id','name','email','phone','role','created_at','updated_at'];

	public static function roleArray($role = null){
		if($role == 'visibles'){
			return self::$visibles;
		}else{
			return self::$fields;
		}
	}
}
