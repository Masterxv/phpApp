<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from push_messages LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE push_messages (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	app_id INT(6) UNSIGNED,
	push_message TEXT,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table push_messages created successfully<br>";
	} else {
	    echo "Error creating table: push_messages " . $conn->error."<br>";
	}

}else{
    // sql to update table
	$sql = "ALTER TABLE push_messages 
	-- ADD COLUMN phone VARCHAR(32) AFTER email
	";
    

	if ($conn->query($sql) === TRUE) {
	    echo "Table push_messages updated successfully<br>";
	} else {
	    echo "Error updating table push_messages: " . $conn->error."<br>";
	}
}

$conn->close();
?>