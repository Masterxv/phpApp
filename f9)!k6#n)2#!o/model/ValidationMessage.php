<?php 
include_once($app_key.'/model/Model.php');
/**
 * 
 */
class ValidationMessage extends Model
{
	public static $table = 'validation_messages';
	
	public static $fields = ['id','app_id','rule','error_message','created_at','updated_at',];

	public static $visibles = ['id','name','email','phone','role','created_at','updated_at'];

	public static function roleArray($role = null){
		if($role == 'visibles'){
			return self::$visibles;
		}else{
			return self::$fields;
		}
	}
}
