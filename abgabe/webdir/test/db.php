<?php
/*
 * Working php script, reads all entries of a test table
 *
 * this file runs in a docker container, 127.0.0.1 is the dockercontainer itself.
 */
if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] != 1) {
        http_response_code(403);
        exit;
    }
require "../common.php";
$conn = new DatabaseConnection($ini_array);
$result = $conn->query_database("SELECT * FROM recipie");
print_r($result->fetch_all(MYSQLI_ASSOC));

else {
    // Access control
    http_response_code(403); exit;
}

?>
