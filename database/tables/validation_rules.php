<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from validation_rules LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE validation_rules (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	app_id INT(6) UNSIGNED,
	field VARCHAR(255),
	rule VARCHAR(255),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table validation_rules created successfully<br>";
	} else {
	    echo "Error creating table: validation_rules " . $conn->error."<br>";
	}

}else{
    // sql to update table
	$sql = "ALTER TABLE validation_rules 
	-- ADD COLUMN phone VARCHAR(32) AFTER email
	";
    

	if ($conn->query($sql) === TRUE) {
	    echo "Table validation_rules updated successfully<br>";
	} else {
	    echo "Error updating table validation_rules: " . $conn->error."<br>";
	}
}

$conn->close();
?>