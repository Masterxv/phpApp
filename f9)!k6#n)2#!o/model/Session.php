<?php 
include_once($app_key.'/model/Model.php');
/**
 * 
 */
class Session extends Model
{
	public static $table = 'sessions';
	
	public static $fields = ['id','_token','expiry','app_id','user_id','auth_provider','user_name','chat_resource_id','user_agent','ip_address','created_at','updated_at',];

	public static $visibles = ['id','name','email','phone','role','created_at','updated_at'];

	public static function roleArray($role = null){
		if($role == 'visibles'){
			return self::$visibles;
		}else{
			return self::$fields;
		}
	}
}
