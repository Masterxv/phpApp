<?php
include($app_key.'/model/App.php');
$err = ['active_url' => 'The name must be an active url or a valid IP address.', 
                'ip' => 'The name must be an active url or a valid IP address.'];
if(str_replace('localhost','',$_POST['name']) != $_POST['name'] || $_POST['name'] == '*'){

}elseif(str_replace('http','',$_POST['name']) != $_POST['name']){
    App::validate(['name' => 'required|max:255' ], $err);
}else{
    App::validate(['name' => 'required|max:255' ], $err);
}
$app = App::find($id);
$or = json_decode(htmlspecialchars_decode($app['origins']), true)??[];
array_push($or, $_POST['name']);
App::update($app['id'],null,['origins' => json_encode($or)]);
header("Location: $app_url/app/app_origins/".$id);
?>