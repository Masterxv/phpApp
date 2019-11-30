<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from push_subscriptions LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE push_subscriptions (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	app_id INT(6) UNSIGNED,
	auth_provider VARCHAR(255),
	user_id INT(6) UNSIGNED,
	subscription VARCHAR(255),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table push_subscriptions created successfully<br>";
	} else {
	    echo "Error creating table: push_subscriptions " . $conn->error."<br>";
	}

}else{
    // sql to update table
	$sql = "ALTER TABLE push_subscriptions 
	-- ADD COLUMN phone VARCHAR(32) AFTER email
	";
    

	if ($conn->query($sql) === TRUE) {
	    echo "Table push_subscriptions updated successfully<br>";
	} else {
	    echo "Error updating table push_subscriptions: " . $conn->error."<br>";
	}
}

$conn->close();
?>