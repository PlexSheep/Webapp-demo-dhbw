<?php
require "../common.php";
require "jwt.php";

$email = $_POST['email'];
$password = hash('sha512',$_POST['username']);

$conn = new DatabaseConnection($ini_array);
$result = $conn->query_database("SELECT `username` FROM `user_pass` WHERE `email` = '$email' AND `password` = '$password'");

if($result -> num_rows >= 1){
    
}

?>
