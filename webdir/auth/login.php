<?php
require "../common.php";
//require "jwt.php";
session_start();

//print_r($_POST['MAIL']);
//print_r($_POST['PASS']);

if (isset($_POST['MAIL']) && isset($_POST['MAIL'])) {
    $email = $_POST['MAIL'];
    $password = $_POST['PASS'];
}
else {
    print_r("Missing parameter");
    return -1;
}

$conn = new DatabaseConnection($ini_array);
$result = $conn->query_database("SELECT `password` FROM `user_pass` WHERE `email` = '$email'");

if(password_verify($password, $result -> fetch_object() -> password)){
    //print_r($result -> fetch_object() -> username);
    $_SESSION['MAIL'] = $email;
    //print_r($_SESSION['USER']);
    header('Location: /index.php');
    //die();
}
else {
    header('Location: /auth/login.html');
}

?>
