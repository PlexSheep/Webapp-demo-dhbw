<?php
session_start();

//print_r(hash('sha256', "admin"));
//print_r($_SESSION['USER']);

if (isset($_SESSION['MAIL'])) {
        print_r($_SESSION['MAIL']);
}

?>