<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from users LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE users (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	avatar VARCHAR(1000),
	name VARCHAR(60) NOT NULL,
	email VARCHAR(70),
	password VARCHAR(64),
	active_app_id INT(6) UNSIGNED DEFAULT 0,
	hidden_modules VARCHAR(255) DEFAULT '[\"Licenses\"]',
	online_status VARCHAR(255) DEFAULT 'offline',
	chat_resource_id INT(6) UNSIGNED DEFAULT 0,
	chat_friends TEXT,
	email_varification VARCHAR(64),
	password_reset_code VARCHAR(64),
	blocked boolean DEFAULT 0,
	recharge_balance DECIMAL(8,2),
	recharge_expiry_date date,
	remember_token VARCHAR(64),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table users created successfully<br>";
	} else {
	    echo "Error creating table: users " . $conn->error."<br>";
	}

}else{
    // sql to update table
	$sql = "ALTER TABLE users 
	-- ADD COLUMN phone VARCHAR(32) AFTER email
	";
    

	if ($conn->query($sql) === TRUE) {
	    echo "Table users updated successfully<br>";
	} else {
	    echo "Error updating table users: " . $conn->error."<br>";
	}
}

$conn->close();
?>