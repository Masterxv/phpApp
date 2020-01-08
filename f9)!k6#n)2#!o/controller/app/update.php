<?php 
include($app_key.'/model/App.php');
if(isset($_POST['request_new_secret'])){
    App::update(null,null,[
        'name' => $_POST['new_app_name']??'My App',
        'token_lifetime' => $_POST['token_lifetime']??43200,
        'availability' => $_POST['availability']??'Private',
        'secret' => hash('ripemd128', uniqid(rand(), true)),
    ]);
}else{
    App::update(null,null,[
        'name' => $_POST['new_app_name']??'My App',
        'token_lifetime' => $_POST['token_lifetime']??43200,
        'availability' => $_POST['availability']??'Private',
    ]);
}
header("Location: $app_url/app/app_list");
?>