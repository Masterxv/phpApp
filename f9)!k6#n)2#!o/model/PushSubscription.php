<?php 
include_once($app_key.'/model/Model.php');
/**
 * 
 */
class PushSubscription extends Model
{
	public static $table = 'push_subscriptions';
	
	public static $fields = ['id','app_id','auth_provider','user_id','subscription','created_at','updated_at',];

	public static $visibles = ['id','name','email','phone','role','created_at','updated_at'];

	public static function roleArray($role = null){
		if($role == 'visibles'){
			return self::$visibles;
		}else{
			return self::$fields;
		}
	}
}
