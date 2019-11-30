<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from licenses LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE licenses (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	license_key VARCHAR(64) UNIQUE KEY,
	total_licenses INT(6) UNSIGNED,
	activated_licenses INT(6) UNSIGNED,
	created_by INT(6) UNSIGNED,
	expiry_date date,
	price_id INT(6) UNSIGNED,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table licenses created successfully<br>";
	} else {
	    echo "Error creating table: licenses " . $conn->error."<br>";
	}

}else{
    // sql to update table
	$sql = "ALTER TABLE licenses 
	-- ADD COLUMN phone VARCHAR(32) AFTER email
	";
    

	if ($conn->query($sql) === TRUE) {
	    echo "Table licenses updated successfully<br>";
	} else {
	    echo "Error updating table licenses: " . $conn->error."<br>";
	}
}

$conn->close();
?>