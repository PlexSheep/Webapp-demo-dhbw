<?php
require "../common.php";
//require "jwt.php";
//print_r($_POST['MAIL']);
//print_r($_POST['PASS']);

if (isset($_POST['MAIL']) && isset($_POST['PASS'])) {
    $email = $_POST['MAIL'];
    $password = $_POST['PASS'];
}
else {
    print_r("Missing parameter");
    return -1;
}

$conn = new DatabaseConnection($ini_array);
$result = $conn->query_login($email);

//echo '<pre>'; print_r($result -> fetch_object()); echo '</pre>';

if ($result -> num_rows > 0) {
    $data = $result -> fetch_object();
    $username = $data -> username;
    $dbPassword = $data -> password;
    //print_r($username);
    //print_r($dbPassword);

    if(password_verify($password, $dbPassword)){
        $_SESSION['MAIL'] = $email;
        $_SESSION['USER'] = $username;
        //print_r($_SESSION['USER']);
        header('Location: /index.php');
        //die();
    }
    else {
        header('Location: /auth/login.html');
    }
}
else {
    header('Location: /konto.php');
}
?>
