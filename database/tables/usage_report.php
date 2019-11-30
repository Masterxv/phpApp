<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from usage_report LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE usage_report (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	date date,
	user_id INT(6) UNSIGNED,
	app_id INT(6) UNSIGNED,
	api_calls INT(6) UNSIGNED DEFAULT 0,
	emails_sent INT(6) UNSIGNED DEFAULT 0,
	push_sent INT(6) UNSIGNED DEFAULT 0,
	chat_messages INT(6) UNSIGNED DEFAULT 0,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table usage_report created successfully<br>";
	} else {
	    echo "Error creating table: usage_report " . $conn->error."<br>";
	}

}else{
    // sql to update table
	$sql = "ALTER TABLE usage_report 
	-- ADD COLUMN phone VARCHAR(32) AFTER email
	";
    

	if ($conn->query($sql) === TRUE) {
	    echo "Table usage_report updated successfully<br>";
	} else {
	    echo "Error updating table usage_report: " . $conn->error."<br>";
	}
}

$conn->close();
?>