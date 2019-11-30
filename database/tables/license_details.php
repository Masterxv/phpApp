<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from license_details LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE license_details (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	license_id INT(6) UNSIGNED,
	hardware_code VARCHAR(255),
	computer_name VARCHAR(255),
	computer_user VARCHAR(255),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table license_details created successfully<br>";
	} else {
	    echo "Error creating table: license_details " . $conn->error."<br>";
	}

}else{
    // sql to update table
	$sql = "ALTER TABLE license_details 
	-- ADD COLUMN phone VARCHAR(32) AFTER email
	";
    

	if ($conn->query($sql) === TRUE) {
	    echo "Table license_details updated successfully<br>";
	} else {
	    echo "Error updating table license_details: " . $conn->error."<br>";
	}
}

$conn->close();
?>