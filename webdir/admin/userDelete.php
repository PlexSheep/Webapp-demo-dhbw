<?php
define("rep", 1);
require "../common.php";

if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] != 1) {
        http_response_code(403); 
        exit;
    }

    $conn = new DatabaseConnection($ini_array);
    if ($_POST['ID'] != 1) {
        $result = $conn->query_database("DELETE FROM `user_pass` WHERE `user_pass`.`ID` =" . $_POST['ID']);  
        echo "Deleted";  
    }
    else {
        echo "No";
    }

}
else {
    // Access control
    http_response_code(403); exit;
}
?>
