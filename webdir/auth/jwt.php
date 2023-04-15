<?php
require '/composer/vendor/autoload.php';

use Firebase\JWT\JWT;

$payload = array(
    "iss" => "example.com",
    "aud" => "example.com",
    "iat" => 1356999524,
    "nbf" => 1357000000
);

$jwt = JWT::encode($payload, "secret", 'HS256');

print_r($jwt)
?>