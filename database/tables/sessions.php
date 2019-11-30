<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from sessions LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE sessions (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	_token VARCHAR(64),
	expiry INT(6) UNSIGNED,
	app_id INT(6) UNSIGNED,
	user_id INT(6) UNSIGNED,
	auth_provider VARCHAR(255),
	user_name VARCHAR(255),
	chat_resource_id INT(6) UNSIGNED DEFAULT 0,
	user_agent TEXT,
	ip_address VARCHAR(45),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table sessions created successfully<br>";
	} else {
	    echo "Error creating table: sessions " . $conn->error."<br>";
	}

}else{
    // sql to update table
	$sql = "ALTER TABLE sessions 
	-- ADD COLUMN phone VARCHAR(32) AFTER email
	";
    

	if ($conn->query($sql) === TRUE) {
	    echo "Table sessions updated successfully<br>";
	} else {
	    echo "Error updating table sessions: " . $conn->error."<br>";
	}
}

$conn->close();
?>