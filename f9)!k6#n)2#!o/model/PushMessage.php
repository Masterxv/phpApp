<?php 
include_once($app_key.'/model/Model.php');
/**
 * 
 */
class PushMessage extends Model
{
	public static $table = 'push_messages';
	
	public static $fields = ['id','app_id','push_message','created_at','updated_at'];

	public static $visibles = ['id','name','email','phone','role','created_at','updated_at'];

	public static function roleArray($role = null){
		if($role == 'visibles'){
			return self::$visibles;
		}else{
			return self::$fields;
		}
	}
}
