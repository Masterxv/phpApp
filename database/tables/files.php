<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from files LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE files (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255),
	mime VARCHAR(255),
	size INT(6) UNSIGNED,
	path VARCHAR(255),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table files created successfully<br>";
	} else {
	    echo "Error creating table: files " . $conn->error."<br>";
	}

}else{
    // sql to update table
	$sql = "ALTER TABLE files 
	-- ADD COLUMN phone VARCHAR(32) AFTER email
	";
    

	if ($conn->query($sql) === TRUE) {
	    echo "Table files updated successfully<br>";
	} else {
	    echo "Error updating table files: " . $conn->error."<br>";
	}
}

$conn->close();
?>