<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from emails LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE emails (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	app_id INT(6) UNSIGNED,
	email TEXT,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table emails created successfully<br>";
	} else {
	    echo "Error creating table: emails " . $conn->error."<br>";
	}

}else{
    // sql to update table
	$sql = "ALTER TABLE emails 
	-- ADD COLUMN phone VARCHAR(32) AFTER email
	";
    

	if ($conn->query($sql) === TRUE) {
	    echo "Table emails updated successfully<br>";
	} else {
	    echo "Error updating table emails: " . $conn->error."<br>";
	}
}

$conn->close();
?>