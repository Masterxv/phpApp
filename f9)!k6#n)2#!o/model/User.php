<?php 
include_once($app_key.'/model/Model.php');
/**
 * 
 */
class User extends Model
{
	public static $table = 'users';
	
	public static $fields = ['id','avatar','name','email','password','active_app_id','hidden_modules','online_status','chat_resource_id','chat_friends','email_verification','password_reset_code','blocked','recharge_balance','recharge_expiry_date','remember_token','created_at','updated_at',];

	public static $visibles = ['id','name','email','phone','role','created_at','updated_at'];

	public static function roleArray($role = null){
		if($role == 'visibles'){
			return self::$visibles;
		}else{
			return self::$fields;
		}
	}
}