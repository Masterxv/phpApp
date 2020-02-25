<?php
require ('../env.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn->query('select 1 from queries LIMIT 1') === FALSE)
{
	// sql to create table
	$sql = "CREATE TABLE queries (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	app_id INT(6) UNSIGNED,
	name VARCHAR(255),
	auth_providers VARCHAR(255),
	tables VARCHAR(255),
	commands VARCHAR(255),
	fillables TEXT,
	auth_users TEXT,
	filter TEXT,
	specials VARCHAR(255),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table queries created successfully<br>";
	} else {
	    echo "Error creating table: queries " . $conn->error."<br>";
	}

}else{
    // sql to update table
	$sql = "ALTER TABLE queries 
	-- ADD COLUMN auth_users TEXT AFTER fillables,
	-- ADD COLUMN filter TEXT AFTER auth_users,
	-- DROP COLUMN hiddens,
	-- DROP COLUMN mandatory,
	-- DROP COLUMN joins,
	-- DROP COLUMN filters
	";
    

	if ($conn->query($sql) === TRUE) {
	    echo "Table queries updated successfully<br>";
	} else {
	    echo "Error updating table queries: " . $conn->error."<br>";
	}
}

$conn->close();
?>