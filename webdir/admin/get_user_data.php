<?php

require "../common.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST['ID'])){
        $conn = new DatabaseConnection($ini_array);
        $res = $conn -> query_all_user_data_email($_POST['ID']) -> get_result();
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
?>
