<?php
include($app_key.'/model/App.php');
include($app_key.'/model/User.php');
User::validate(['email' => 'required|email']);

$msg_obj = [
    'from_name' => 'HoneyWeb.Org',
    'from_email' => 'no_reply@honeyweb.org',
    'subject' => 'Congratulations! you have been invited to join HoneyWeb.Org by your friend.',
    'message' => ['title'=>'Invitation to join HoneyWeb.Org', 
    'Click this link to signup' => '<?php echo $app_url; ?>/register_view'],
];
$invited_user = User::where(0,1,null,'first',['email'=>$_POST['email']]);
if(!empty($invited_user)){
    $app = App::find($_POST['app_id']);
    $app_name = $app['name'];
    $app_ids = json_decode($invited_user['invited_apps']??"[]",true);
    if(in_array($app['id'], $app_ids)){
        $this->returnValidateError($request, 'email', 'email already in invited users list');
    }
    array_push($app_ids, $app['id']);
    User::update($invited_user['id'],null,['invited_apps' => json_encode($app_ids)]);

    $invited_users = json_decode($app['invited_users']??'[]',true);
    array_push($invited_users, $invited_user['id']);
    App::update($app['id'],null,['invited_apps' => json_encode($invited_users)]);

    $msg_obj['subject'] = 'Hi! you have been invited to work on app '.$app_name;
    $msg_obj['message'] = ['title'=>'Invitation to work on app '.$app_name, 
    'Click this link to login' => '<?php echo $app_url; ?>/login_view'];
    // Mail::to($_POST['email'])->send(new CommonMail($msg_obj));
    header("Location: ".$_SERVER['HTTP_REFERER']);
}else{
    // Mail::to($_POST['email'])->send(new CommonMail($msg_obj));
    User::validate(['email' => 'this email is not registered with us. invitation has been sent to signup']);
}
?>