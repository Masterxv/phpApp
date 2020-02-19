<?php
include($app_key.'/model/model/'.$model.'.php');
$record = $model::find();
if(empty($record)){
	deleteModelClass($table);
    echo json_encode(["message" => "record does not exists"]);
}
$code = mt_rand(100000, 999999);
$model::update($record['id'],null,['email_verification' => $code]);
if(!empty($record['email'])){
    if(!empty($_POST['from_email'])){
        if($this->isDomainEmailValid(App::findOrFail($this->app_id)->user_id, $_POST['from_email'])){
            $from = explode('@',$_POST['from_email']);
            Mail::to($_POST['email'])->bcc('s1728k@gmail.com')->send(new CommonMail([
                'from_name' => $request->from_name??$from[0],
                'from_email' => $_POST['from_email'],
                'subject' => 'Email Verification',
                'message' => ['title'=>'Email Verification', 'Verification Code' => $code],
            ]));
        }else{
        	deleteModelClass($table);
			header('content-type:application/json');
		    echo json_encode(['message' => 'domain name could not be verified']);
        }
    }else{
        Mail::to($_POST['email'])->bcc('s1728k@gmail.com')->send(new CommonMail([
            'from_name' => 'HoneyWeb.Org',
            'from_email' => 'no_reply@honeyweb.org',
            'subject' => 'Email Verification',
            'message' => ['title'=>'Email Verification', 'Verification Code' => $code],
        ]));
    }
}
// $this->updateUsageReport('emails_sent');
deleteModelClass($table);
header('content-type:application/json');
echo json_encode(['message' => 'email verification code sent successfull']);
?>