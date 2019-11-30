<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from virtual_domains LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE virtual_domains (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	user_id INT(6) UNSIGNED,
	name VARCHAR(255),
	verified VARCHAR(255),
	expiry_date TIMESTAMP,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table virtual_domains created successfully<br>";
	} else {
	    echo "Error creating table: virtual_domains " . $conn->error."<br>";
	}

}else{
    // sql to update table
	$sql = "ALTER TABLE virtual_domains 
	-- ADD COLUMN phone VARCHAR(32) AFTER email
	";
    

	if ($conn->query($sql) === TRUE) {
	    echo "Table virtual_domains updated successfully<br>";
	} else {
	    echo "Error updating table virtual_domains: " . $conn->error."<br>";
	}
}

$conn->close();
?>