<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<body>
<?php

$hostname = "localhost";
$username = "test";
$password = "test";
$db = "test_db";

$dbconnect=mysqli_connect($hostname,$username,$password,$db);

if ($dbconnect->connect_error) {
  die("Database connection failed: " . $dbconnect->connect_error);
}

?>

<table border="1" align="center">
<tr>
  <td>Reviewer Name</td>
  <td>Stars</td>
  <td>Details</td>
</tr>

<?php

$query = mysqli_query($dbconnect, "SELECT * FROM user_review")
   or die (mysqli_error($dbconnect));

while ($row = mysqli_fetch_array($query)) {
  echo
   "<tr>
    <td>{$row['id']}</td>
    <td>{$row['bar']}</td>
    <td>{$row['qux']}</td>
   </tr>\n";

}

?>
</table>
</body>
</html>
