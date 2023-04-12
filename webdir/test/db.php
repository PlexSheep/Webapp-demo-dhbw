<?php
$servername = "127.0.0.1";
$username = "test";
$password = "test";
$port = 3306;

// Create connection
$conn = new mysqli($servername, $username, $password, "test_db", $port);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
