<?php
define("rep", 1);

require "../common.php";

if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] != 1) {
        http_response_code(403);
        exit;
    }

    $conn = new DatabaseConnection($ini_array);
    if (isset($_POST['NAME'])) {
        $stmt = $conn -> connection -> prepare("INSERT INTO `category` (`name`) VALUES (?)");
        $stmt -> bind_param("s", $_POST['NAME']);
        $stmt->execute();
    }

}
else {
    // Access control
    http_response_code(403); exit;
}
?>
