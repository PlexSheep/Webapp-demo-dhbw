<?php
//session_start();

require "../common.php";

if (isset($_SESSION['USER'])) {
    if ($_SESSION['USER'] != "admin") {
        http_response_code(403); exit;
    }

    $conn = new DatabaseConnection($ini_array);
    $result = $conn->query_database("SELECT * FROM `user_pass`");

    echo "<table>";
    echo "<tr>";
    foreach ($result as $key => $value) {
        echo "<tr>";
        echo "<td>$value[username]</td>";
        echo "<td>$value[ID]</td>";
        echo "</tr>";
    }
    echo "</tr>";
    echo "</table>";

?>

<body>
    <div class="form-container">
        <div style="display: block;" id="loginForm" class="form-content active-choice">
            <form action="/admin/userDelete.php" method="post">
                <label for="ID">User to delete:</label>
                <input type="ID" id="ID" name="ID" required>
                <input type="submit" value="Löschen">
            </form>
        </div>
    </div>
    <div class="form-container">
        <div style="display: block;" id="loginForm" class="form-content active-choice">
            <form action="/admin/changePassword.php" method="post">
                <label for="ID">User to update password:</label>
                <input type="ID" id="ID" name="ID" required>
                
                <label for="ID">New Password:</label>
                <input type="PASS" id="PASS" name="PASS" required>
                
                <input type="submit" value="Update Password">
            </form>
        </div>
    </div>
    <div class="form-container">
        <div style="display: block;" id="loginForm" class="form-content active-choice">
            <form action="/admin/get_json.php" method="post">
                <label for="ID">Export user data of ID:</label>
                <input type="ID" id="ID" name="ID" required>
            </form>
        </div>
    </div>
</body>

<?php
}
else {
    // Access control
    http_response_code(403); exit;
}

/*
foreach ($_SESSION as $sess => $value) {
    print_r($value);
}
*/

?>
