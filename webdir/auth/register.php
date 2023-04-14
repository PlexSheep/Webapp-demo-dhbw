<?php
require "../common.php";

$conn = new DatabaseConnection($ini_array);

if ($_POST['email'] == null || $_POST['username'] == null || $_POST['password']) {
    print_r("param empty");
    return -1;
}

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

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