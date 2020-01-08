<?php 
include_once($app_key.'/model/Model.php');
/**
 * 
 */
class Chat extends Model
{
	public static $table = 'chat';
	
	public static $fields = ['id','app_id','cid','message','fid','fap','fname','tid','tap','tname','style','status','created_at','updated_at'];

	public static $visibles = ['id','name','email','phone','role','created_at','updated_at'];

	public static function roleArray($role = null){
		if($role == 'visibles'){
			return self::$visibles;
		}else{
			return self::$fields;
		}
	}
}
