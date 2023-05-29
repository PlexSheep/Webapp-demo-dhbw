<?php
require "../common.php";

if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] != 1) {
        http_response_code(403); 
        exit;
    }

    $conn = new DatabaseConnection($ini_array);
    if ($_POST['ID'] != 1) {
        $hash = password_hash($_POST['PASS'], PASSWORD_ARGON2ID);
        $stmt = $conn -> connection -> prepare("UPDATE `user_pass` SET `password` = ? WHERE ID = ?");
        $stmt -> bind_param("si", $hash, $_POST['ID']);
        $stmt->execute(); 
        header('Location: /admin/admin.php');
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
