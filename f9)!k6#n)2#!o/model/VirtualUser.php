<?php 
include_once($app_key.'/model/Model.php');
/**
 * 
 */
class VirtualUser extends Model
{
	public static $table = 'virtual_users';
	
	public static $fields = ['id','user_id','domain_id','email','password','mailbox','alias','created_at','updated_at',];

	public static $visibles = ['id','name','email','phone','role','created_at','updated_at'];

	public static function roleArray($role = null){
		if($role == 'visibles'){
			return self::$visibles;
		}else{
			return self::$fields;
		}
	}
}
