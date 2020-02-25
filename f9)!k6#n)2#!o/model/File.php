
<?php 
include_once($app_key.'/model/Model.php');
/**
 * 
 */
class File extends Model
{
	public static $table = 'files';
	
	public static $fields = ['id','app_id','name','mime','size','path','created_at','updated_at'];

	public static $visibles = ['id','app_id','name','mime','size','path','created_at','updated_at'];

	public static function roleArray($role = null){
		if($role == 'visibles'){
			return self::$visibles;
		}else{
			return self::$fields;
		}
	}
}
