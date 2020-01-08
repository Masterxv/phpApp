<?php 
include_once($app_key.'/model/Model.php');
/**
 * 
 */
class License extends Model
{
	public static $table = 'licenses';
	
	public static $fields = ['id','license_key','total_licenses','activated_licenses','created_by','expiry_date','price_id','created_at','updated_at'];

	public static $visibles = ['id','license_key','total_licenses','activated_licenses','expiry_date'];

	public static function roleArray($role = null){
		if($role == 'visibles'){
			return self::$visibles;
		}else{
			return self::$fields;
		}
	}
}
