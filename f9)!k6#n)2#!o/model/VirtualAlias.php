<?php 
include_once($app_key.'/model/Model.php');
/**
 * 
 */
class VirtualAlias extends Model
{
	public static $table = 'virtual_alias';
	
	public static $fields = ['id','user_id','email','domain','verified','expiry_date','created_at','updated_at',];

	public static $visibles = ['id','name','email','phone','role','created_at','updated_at'];

	public static function roleArray($role = null){
		if($role == 'visibles'){
			return self::$visibles;
		}else{
			return self::$fields;
		}
	}
}
