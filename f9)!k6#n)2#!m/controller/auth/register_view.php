<?php 
if ($_SERVER["REQUEST_METHOD"] == "GET"){
    session_start(); 
    $rand=rand();
    $_SESSION['rand']=$rand;
}
?>
<?php 
if(isset($_SESSION['old'])){
    $old = $_SESSION['old'];
    unset($_SESSION['old']);
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>
<?php 
include('env.php');
?>
<?php include($app_key.'/views/auth/signup.php'); ?>