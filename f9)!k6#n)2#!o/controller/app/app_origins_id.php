<?php 
if ($_SERVER["REQUEST_METHOD"] == "GET"){
    session_start(); 
    $rand=rand();
    $_SESSION['rand']=$rand;
}
?>
<?php
include($app_key.'/model/App.php');
$app = App::find($id);
$origins = json_decode(htmlspecialchars_decode($app['origins']), true)??[];
include($app_key.'/view/app/app_origins.php');
?>