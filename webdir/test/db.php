<?php
/*
 * Working php script, reads all entries of a test table
 *
 * this file runs in a docker container, 127.0.0.1 is the dockercontainer itself.
 */
require "../common.php";
$conn = new DatabaseConnection($ini_array);
$result = $conn->query_database("SELECT * FROM recipies");
print_r($result);
?>
