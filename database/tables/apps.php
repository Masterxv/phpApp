<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from apps LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE apps (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	user_id INT(6) UNSIGNED DEFAULT 0,
	name VARCHAR(255),
	secret VARCHAR(64) UNIQUE KEY,
	token_lifetime INT(6) UNSIGNED DEFAULT 43200,
	db_connection VARCHAR(255),
	auth_providers TEXT,
	origins TEXT,
	can_chat_with TEXT,
	blocked boolean DEFAULT 0,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table apps created successfully<br>";
	} else {
	    echo "Error creating table: apps " . $conn->error."<br>";
	}

}else{
    // sql to update table
	$sql = "ALTER TABLE apps 
	-- ADD COLUMN phone VARCHAR(32) AFTER email
	";
    

	if ($conn->query($sql) === TRUE) {
	    echo "Table apps updated successfully<br>";
	} else {
	    echo "Error updating table apps: " . $conn->error."<br>";
	}
}

$conn->close();
?>