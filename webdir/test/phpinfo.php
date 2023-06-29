<?php
if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] != 1) {
        http_response_code(403);
        exit;
    }

phpinfo();

else {
    // Access control
    http_response_code(403); exit;
}

?>
