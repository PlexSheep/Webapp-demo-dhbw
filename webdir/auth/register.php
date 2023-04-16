<?php
require "../common.php";

$conn = new DatabaseConnection($ini_array);

print_r($_POST['MAIL']);
print_r($_POST['USER']);
print_r($_POST['PASS']);


if (isset($_POST['USER']) && isset($_POST['PASS']) && isset($_POST['MAIL'])) {
    if (strlen($_POST['MAIL']) == 0 || strlen($_POST['USER']) == 0 || strlen($_POST['PASS']) == 0 ) {
        print_r("param empty");
        return -1;
    }
}

$email = $_POST['MAIL'];
$username = $_POST['USER'];
$password = $_POST['PASS'];

if(($conn->query_database("SELECT `username` FROM `user_pass` WHERE `email` = '$email'") -> num_rows) >= 1){
    print_r("User already exists");
    return -1;
}

$hash = password_hash($password, PASSWORD_DEFAULT);
$conn->query_database("INSERT INTO `user_pass` (`username`, `password`, `email`) VALUES ('$username', '$hash', '$email')"); 

?>