<?php
require "../common.php";

$conn = new DatabaseConnection($ini_array);

print_r($_POST['MAIL']);
print_r($_POST['USER']);
print_r($_POST['PASS']);


if (strlen($_POST['MAIL']) == 0 || strlen($_POST['USER']) == 0 || strlen($_POST['PASS']) == 0 ) {
    print_r("param empty");
    return -1;
}

$email = $_POST['MAIL'];
$username = $_POST['USER'];
$password = $_POST['PASS'];

if($conn->query_database("SELECT `username` FROM `user_pass` WHERE `email` = '$email'") -> num_rows >= 1){
    print_r("User already exists");
    return -1;
}

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
    $hash = hash('sha512', $_POST['password']);
    $conn->query_database("INSERT INTO `user_pass` (`username`, `password`, `email`) VALUES ('$username', '$hash', '$email')");
} else {
    print_r("Param missing");
}

?>