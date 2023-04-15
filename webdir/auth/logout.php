<?php

if (isset($_SESSION['USER'])) {
    session_destroy();
}
else {
    print_r("Not logged in");
}

?>