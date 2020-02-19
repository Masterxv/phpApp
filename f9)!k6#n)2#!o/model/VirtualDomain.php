
<?php 
include_once($app_key.'/model/Model.php');
/**
 * 
 */
class VirtualDomain extends Model
{
	public static $table = 'virtual_domains';
	
	public static $fields = ['id','user_id','name','verified','expiry_date','created_at','updated_at',];

	public static $visibles = ['id','name','email','phone','role','created_at','updated_at'];

	public static function roleArray($role = null){
		if($role == 'visibles'){
			return self::$visibles;
		}else{
			return self::$fields;
		}
	}
}
