<?php 
include_once($app_key.'/model/Model.php');
/**
 * 
 */
class RechargeHistory extends Model
{
	public static $table = 'recharge_history';
	
	public static $fields = ['id','user_id','plan','status','expiry_date','recharge_date','recharge_amount','tax','top_up','created_at','updated_at'];

	public static $visibles = ['id','name','email','phone','role','created_at','updated_at'];

	public static function roleArray($role = null){
		if($role == 'visibles'){
			return self::$visibles;
		}else{
			return self::$fields;
		}
	}
}
