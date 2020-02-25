<?php 
include_once($app_key.'/model/Model.php');
/**
 * 
 */
class App extends Model
{
	public static $table = 'apps';

	public static $fields = ['id','user_id','name','secret','token_lifetime','db_connection','auth_providers','token_auths','user_name_fields','invited_users','origins','can_chat_with','description','availability','blocked','created_at','updated_at'];

	public static $visibles = ['id','user_id','name','secret','token_lifetime','db_connection','auth_providers','token_auths','origins','can_chat_with','blocked','created_at','updated_at'];

	public static function roleArray($role = null){
		if($role == 'visibles'){
			return self::$visibles;
		}else{
			return self::$fields;
		}
	}
}