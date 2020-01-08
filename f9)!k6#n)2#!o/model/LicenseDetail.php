<?php 
include_once($app_key.'/model/Model.php');
/**
 * 
 */
class LicenseDetail extends Model
{
	public static $table = 'license_details';
	
	public static $fields = ['id','license_id','hardware_code','computer_name','computer_user','created_at','updated_at',];

	public static $visibles = ['id','license_id','hardware_code','computer_name','computer_user'];

	public static function roleArray($role = null){
		if($role == 'visibles'){
			return self::$visibles;
		}else{
			return self::$fields;
		}
	}
}
