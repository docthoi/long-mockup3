<?php
// Sets verable for database name
$database_name = "ixd830_ocr";

// Database Connection
$db = new mysqli('ixd830.firebird.sheridanc.on.ca', 'ixd830', 'Xab1yomo3', $database_name);

// Create Table "images" into Database if not exists
$query = "CREATE TABLE IF NOT EXISTS photos (firstName STRING, lastName STRING, picture STRING)";
$db->query($query);
?>
