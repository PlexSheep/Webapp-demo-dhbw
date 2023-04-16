<?php
session_start();

//print_r(hash('sha256', "admin"));
//print_r($_SESSION['USER']);

if (isset($_SESSION['USER'])) {
    if ($_SESSION['USER'] == "test") {
        print_r("Athenticated");
    }
}

?>