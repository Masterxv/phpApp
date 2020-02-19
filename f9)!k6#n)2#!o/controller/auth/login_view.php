<?php include($app_key.'/include/csrf_token.php'); ?>
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
<?php include($app_key.'/view/auth/login.php'); ?>