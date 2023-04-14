<?php
/*
 * Working php script, reads all entries of a test table
 *
 *
 * this file runs in a docker container, 127.0.0.1 is the dockercontainer itself.
 */
$servername = "db:3306";
$username = "test";
$password = "test";
$dbname = "test_db";


try {
    $conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
  
?>