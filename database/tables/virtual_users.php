<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from virtual_users LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE virtual_users (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	user_id INT(6) UNSIGNED,
	domain_id INT(6) UNSIGNED,
	email VARCHAR(255) UNIQUE KEY,
	password VARCHAR(255),
	mailbox VARCHAR(255),
	alias VARCHAR(255),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table virtual_users created successfully<br>";
	} else {
	    echo "Error creating table: virtual_users " . $conn->error."<br>";
	}

}else{
    // sql to update table
	$sql = "ALTER TABLE virtual_users 
	-- ADD COLUMN phone VARCHAR(32) AFTER email
	";
    

	if ($conn->query($sql) === TRUE) {
	    echo "Table virtual_users updated successfully<br>";
	} else {
	    echo "Error updating table virtual_users: " . $conn->error."<br>";
	}
}

$conn->close();
?>