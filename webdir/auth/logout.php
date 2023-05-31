<?php
define("rep", 1);

require "../common.php";

if (isset($_SESSION['MAIL'])) {
    session_destroy();
    header('Location: /index.php');
}
else {
    print_r("Not logged in");
}

?>
