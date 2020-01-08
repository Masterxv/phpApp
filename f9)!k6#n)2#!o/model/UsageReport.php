<?php 
include_once($app_key.'/model/Model.php');
/**
 * 
 */
class UsageReport extends Model
{
	public static $table = 'usage_report';
	
	public static $fields = ['id','date','user_id','app_id','api_calls','emails_sent','push_sent','chat_messages','created_at','updated_at',];

	public static $visibles = ['id','name','email','phone','role','created_at','updated_at'];

	public static function roleArray($role = null){
		if($role == 'visibles'){
			return self::$visibles;
		}else{
			return self::$fields;
		}
	}
}
