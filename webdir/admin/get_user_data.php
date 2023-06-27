<?php
define("rep", 1);

require "../common.php";

if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] != 1) {
        http_response_code(403); 
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(!empty($_POST['MAIL'])){
            $conn = new DatabaseConnection($ini_array);
            $res = $conn -> query_all_user_data_email($_POST['MAIL']) -> get_result();
            $result = $res -> fetch_all(MYSQLI_ASSOC);
            //echo '<pre>'; print_r($result); echo '</pre>';
            if (! empty($result)) {
                    ?>
            <ul id="country-list">
            <?php
                    foreach ($result as $user) {
                        ?>
            <li
                    onClick="selectCountry('<?php echo $user["username"].$user["ID"]?>');">
                <?php echo $user["username"]." ID: ".$user["ID"]?>
                </li>
            <?php
                    } // end for
            ?>
            </ul>
        <?php
        } // end if not empty
    }

    }
    
}
else {
    // Access control
    http_response_code(403); exit;
}
?>
