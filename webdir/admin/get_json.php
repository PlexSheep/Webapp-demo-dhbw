<?php
define("rep", 1);

require "../common.php";

if(isset($_SESSION['ID'])){
	if($_SESSION['ID'] == 1) {
		$conn = new DatabaseConnection($ini_array);

		$data = $conn -> query_all_user_data($_POST['ID']);
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($data -> get_result() -> fetch_all());

	}
}


?>
