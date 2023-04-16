<?php

session_start();

if (isset($_SESSION['MAIL'])) {
    session_destroy();
}
else {
    print_r("Not logged in");
}

?>