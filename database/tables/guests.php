<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from guests LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE guests (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	ip_address VARCHAR(45),
	uuid VARCHAR(45),
	name VARCHAR(45),
	chat_resource_id INT(6) UNSIGNED DEFAULT 0,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table guests created successfully<br>";
	} else {
	    echo "Error creating table: guests " . $conn->error."<br>";
	}

}else{
    // sql to update table
	$sql = "ALTER TABLE guests 
	-- ADD COLUMN phone VARCHAR(32) AFTER email
	";
    

	if ($conn->query($sql) === TRUE) {
	    echo "Table guests updated successfully<br>";
	} else {
	    echo "Error updating table guests: " . $conn->error."<br>";
	}
}

$conn->close();
?>