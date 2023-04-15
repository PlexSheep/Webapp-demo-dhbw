<?php
require "../common.php";
//require "jwt.php";
session_start();

//print_r($_POST['MAIL']);
//print_r($_POST['PASS']);

if (isset($_POST['MAIL']) && isset($_POST['MAIL'])) {
    $email = $_POST['MAIL'];
    $password = hash('sha256', $_POST['PASS']);
}
else {
    print_r("Missing parameter");
    return -1;
}

$conn = new DatabaseConnection($ini_array);
$result = $conn->query_database("SELECT `username` FROM `user_pass` WHERE `email` = '$email' AND `password` = '$password'");

if($result -> num_rows >= 1){
    //print_r($result -> fetch_object() -> username);
    $_SESSION['USER'] = $result -> fetch_object() -> username;
    //print_r($_SESSION['USER']);
    header('Location: /index.php');
    //die();
}

?>
