<?php
include($app_key.'/model/User.php');
User::validate([
  'name' => 'required',
  'email' => 'required|email|unique:users',
  'password' => 'required|password_confirmation'
]);
$email_verification = hash('ripemd128', $_POST['email']);
$id = User::create(null,[
  'name' => $_POST['name'],
  'email' => $_POST['email'],
  'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
  'email_verification' => $email_verification,
]);

$subject = "Email Verification";

$message = $app_url."/email_verification?user_id=".$id."&hash=".$email_verification;
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <webmaster@honeyweb.org>' . "\r\n";
// $headers .= 'Cc: myboss@example.com' . "\r\n";

mail($_POST['email'],$subject,$message,$headers);

$msg = "signup";
include($app_key.'/view/user_interaction.php');
?>