<?php 
if($_SERVER["REQUEST_METHOD"] == "POST"){
session_start(); 
}
?>
<?php
    // define variables and set to empty values
    $report_message = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        include('env.php');

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            include($app_key.'/controller/v/v_create_user.php');

            $name = $old['name'];
            $email = $old['email'];
            $phone = $old['phone'];
            $passwd = password_hash($old['password'], PASSWORD_DEFAULT);
            $email_verification = hash('ripemd128', $old['email']);

            if(!$_POST['user_type']){
                $sql = "INSERT INTO students (name, email, phone, password, email_verification)
                VALUES ('$name', '$email', '$phone', '$passwd', '$email_verification')";
            }else{
                $sql = "INSERT INTO instructors (name, email, phone, password, email_verification)
                VALUES ('$name', '$email', '$phone', '$passwd', '$email_verification')";
            }

            $conn->exec($sql);
            
            $last_id = $conn->lastInsertId();

            include($app_key.'/controller/e/send_email_verification_link.php');

            $report_message = "Email verification link has been sent your email. Please click the same.";
          }
        catch(PDOException $e)
            {
            $report_message = $sql . "<br>" . $e->getMessage();
            echo $report_message;die();
            }

        $conn = null;

        echo "success";
        die();
    }
?>