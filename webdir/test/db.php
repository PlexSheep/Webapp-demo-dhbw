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

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br><br>";

$sql = "SELECT id, bar, qux FROM foo";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - bar: " . $row["bar"]. " - qux: " . $row["qux"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();

?>
