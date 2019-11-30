<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from logs LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE logs (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	aid INT(6) UNSIGNED,
	fid INT(6) UNSIGNED,
	fap VARCHAR(255),
	qid INT(6) UNSIGNED,
	query_nick_name VARCHAR(255),
	auth_provider VARCHAR(255),
	table_name VARCHAR(255),
	command VARCHAR(32),
	ip VARCHAR(45),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table logs created successfully<br>";
	} else {
	    echo "Error creating table: logs " . $conn->error."<br>";
	}

}else{
    // sql to update table
	$sql = "ALTER TABLE logs 
	-- ADD COLUMN phone VARCHAR(32) AFTER email
	";
    

	if ($conn->query($sql) === TRUE) {
	    echo "Table logs updated successfully<br>";
	} else {
	    echo "Error updating table logs: " . $conn->error."<br>";
	}
}

$conn->close();
?>