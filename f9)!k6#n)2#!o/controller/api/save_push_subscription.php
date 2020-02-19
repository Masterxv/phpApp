<?php
include($app_key.'/model/PushSubscription.php');
$exists = PushSubscription::where(0,1,null,'first',['subscription' => json_encode($_POST['subscription'])]);
if(!$exists){
    PushSubscription::create(null,['app_id' => $query['app_id'], 'auth_provider'=>$this->fap, 'user_id'=>$this->fid,  
        'subscription' => json_encode($_POST['subscription'])]);
    echo json_encode(['message' => "successfully saved"]);
}else{
	echo json_encode(['message' => "already saved"]);
}
?>