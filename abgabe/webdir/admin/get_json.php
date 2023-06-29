<?php
define("rep", 1);

require "../common.php";
/**
 * This script gets the 
 */
if(isset($_SESSION['ID'])){
	if($_SESSION['ID'] == 1) {
		$conn = new DatabaseConnection($ini_array);

		$data = $conn -> query_all_user_data($_POST['ID']);
		$user = $data -> get_result() -> fetch_object();
		
		$data_reci = $conn -> query_recipies_user($_POST['ID']);
		$reci = $data_reci -> get_result() -> fetch_all(MYSQLI_ASSOC);
		
		$arr = array();
		$arr[0] = $user;
		$arr[1] = $reci;
		
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($arr);

	}
}


?>
