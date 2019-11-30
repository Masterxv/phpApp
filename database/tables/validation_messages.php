<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from validation_messages LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE validation_messages (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	app_id INT(6) UNSIGNED,
	rule VARCHAR(255),
	error_message VARCHAR(255),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table validation_messages created successfully<br>";
	} else {
	    echo "Error creating table: validation_messages " . $conn->error."<br>";
	}

}else{
    // sql to update table
	$sql = "ALTER TABLE validation_messages 
	-- ADD COLUMN phone VARCHAR(32) AFTER email
	";
    

	if ($conn->query($sql) === TRUE) {
	    echo "Table validation_messages updated successfully<br>";
	} else {
	    echo "Error updating table validation_messages: " . $conn->error."<br>";
	}
}

$conn->close();
?>