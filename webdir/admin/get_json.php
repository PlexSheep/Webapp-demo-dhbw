<?php

require "../common.php";

$conn = new DatabaseConnection($ini_array);

$data = $conn -> query_all_user_data($_POST['ID']);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data -> get_result() -> fetch_object());

?>
