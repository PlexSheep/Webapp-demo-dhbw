<?php
session_start();

if (isset($_SESSION['USER'])) {
    if ($_SESSION['USER'] != "admin") {
        http_response_code(403); exit;
    }
}
else {
    // Access control
    http_response_code(403); exit;
}

foreach ($_SESSION as $sess => $value) {
    print_r($value);
}

?>