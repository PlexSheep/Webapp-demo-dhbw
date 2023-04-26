<?php
//session_start();

require "../common.php";

if (isset($_SESSION['USER'])) {
    if ($_SESSION['USER'] != "admin") {
        http_response_code(403); exit;
    }

    $conn = new DatabaseConnection($ini_array);
    $result = $conn->query_database("SELECT * FROM `user_pass`");

    echo "<table>";
    echo "<tr>";
    foreach ($result as $key => $value) {
        echo "<tr>";
        echo "<td>$value[username]</td>";
        echo "<td>$value[ID]</td>";
        echo "</tr>";
    }
    echo "</tr>";
    echo "</table>";


}
else {
    // Access control
    http_response_code(403); exit;
}

/*
foreach ($_SESSION as $sess => $value) {
    print_r($value);
}
*/

?>