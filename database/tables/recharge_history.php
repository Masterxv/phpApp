<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from recharge_history LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE recharge_history (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	user_id INT(6) UNSIGNED,
	plan VARCHAR(255),
	status VARCHAR(255),
	expiry_date date,
	recharge_date date,
	recharge_amount date,
	tax DECIMAL(8,2),
	top_up DECIMAL(8,2),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table recharge_history created successfully<br>";
	} else {
	    echo "Error creating table: recharge_history " . $conn->error."<br>";
	}

}else{
    // sql to update table
	$sql = "ALTER TABLE recharge_history 
	-- ADD COLUMN phone VARCHAR(32) AFTER email
	";
    

	if ($conn->query($sql) === TRUE) {
	    echo "Table recharge_history updated successfully<br>";
	} else {
	    echo "Error updating table recharge_history: " . $conn->error."<br>";
	}
}

$conn->close();
?>