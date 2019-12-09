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

//==================================================================================================================
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$error = $old = [];
$validation_pass = true;


if (empty($_POST["name"])) {
  $error['name'] = "Name is required";
  $validation_pass = false;
} else {
  $old['name'] = test_input($_POST["name"]);
}

if (empty($_POST["email"])) {
  $error['email'] = "Email is required";
} else {
  $old['email'] = test_input($_POST["email"]);
  if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
    $error['email'] = "Invalid email format";
    $validation_pass = false;
  }else{
    $stmt = $conn->prepare('SELECT COUNT(email) AS EmailCount FROM users WHERE email = :email');
    $stmt->execute(array('email' => $old['email']));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['EmailCount'] !== '0') {
      $error['email'] = "User with this email already exists!";
      $validation_pass = false;
    }
  }
}

if (empty($_POST["password"])) {
  $error['password'] = "password is required";
  $validation_pass = false;
} else {
  $old['password'] = test_input($_POST["password"]);
  if (strlen($old['password']) <= '6') {
      $error['password'] = "Your Password Must Contain At Least 6 Characters!";$validation_pass = false;
  }
  elseif(!preg_match("#[0-9]+#",$old['password'])) {
      $error['password'] = "Your Password Must Contain At Least 1 Number!";$validation_pass = false;
  }
  // elseif(!preg_match("#[A-Z]+#",$old['password'])) {
  //     $error['password'] = "Your Password Must Contain At Least 1 Capital Letter!";$validation_pass = false;
  // }
  elseif(!preg_match("#[a-z]+#",$old['password'])) {
      $error['password'] = "Your Password Must Contain At Least 1 Lowercase Letter!";$validation_pass = false;
  }
}

if ($_POST["password_confirmation"] !== $_POST["password"]) {
  $error['password_confirmation'] = "password_confirmation did not match";
  $validation_pass = false;
}

if(!$validation_pass){
  $error['message'] = "Validation Error";
  $_SESSION['error'] = $error;
  $_SESSION['old'] = $old;
  header("Location: $app_url/register_view");
  die();
}


//======================================================================================================================

            $name = $old['name'];
            $email = $old['email'];
            $passwd = password_hash($old['password'], PASSWORD_DEFAULT);
            $email_verification = hash('ripemd128', $old['email']);

            $sql = "INSERT INTO users (name, email, password, email_verification)
            VALUES ('$name', '$email', '$passwd', '$email_verification')";

            $conn->exec($sql);
            
            $last_id = $conn->lastInsertId();

//======================================================================================================================

$subject = "Email Verification";

$message = $app_url."/email_verification?user_id=".$last_id."&hash=".$email_verification;

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <webmaster@ailearn.in>' . "\r\n";
// $headers .= 'Cc: myboss@example.com' . "\r\n";

mail($old['email'],$subject,$message,$headers);

//=======================================================================================================================

            echo "Email verification link has been sent your email. Please click the same.";
          }
        catch(PDOException $e)
            {
            $report_message = $sql . "<br>" . $e->getMessage();
            echo $report_message;die();
            }

        $conn = null;
        header("Location: $app_url/register_view");
        die();
    }
?>