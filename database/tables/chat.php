<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from chat LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE chat (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	app_id INT(6) UNSIGNED,
	cid INT(6) UNSIGNED,
	message VARCHAR(255),
	fid INT(6) UNSIGNED,
	fap VARCHAR(32),
	fname VARCHAR(32),
	tid INT(6) UNSIGNED,
	tap VARCHAR(32),
	tname VARCHAR(32),
	style VARCHAR(32),
	status VARCHAR(32),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table chat created successfully<br>";
	} else {
	    echo "Error creating table: chat " . $conn->error."<br>";
	}

}else{
    // sql to update table
	$sql = "ALTER TABLE chat 
	-- ADD COLUMN phone VARCHAR(32) AFTER email
	";
    

	if ($conn->query($sql) === TRUE) {
	    echo "Table chat updated successfully<br>";
	} else {
	    echo "Error updating table chat: " . $conn->error."<br>";
	}
}

$conn->close();
?>