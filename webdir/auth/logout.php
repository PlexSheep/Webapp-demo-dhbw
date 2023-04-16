<?php

session_start();

if (isset($_SESSION['MAIL'])) {
    session_destroy();
    header('Location: /index.php');
}
else {
    print_r("Not logged in");
}

?>