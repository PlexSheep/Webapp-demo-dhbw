<?php
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
/*
 * Working php script, reads all entries of a test table
 *
 *
 * this file runs in a docker container, 127.0.0.1 is the dockercontainer itself.
 */
$servername = $_ENV['DB_CONN'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];
$dbname = "Recepie_Service";


// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

?>