<?php
require "../common.php";

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>

<?php
if (isset($_SESSION['USER'])) {
    if ($_SESSION['USER'] != "admin") {
        http_response_code(403); exit;
    }

?>

<body>
<div>
    <input type="test" id="search-box" placeholder="User email: " />
    <div id="user-search"></div>
</div>

<script>
    $(document).ready(function() {
    $("#search-box").keyup(function() {
        $.ajax({
            type: "POST",
            url: "/admin/get_user_data.php",
            data: 'MAIL=' + $(this).val(),
            beforeSend: function() {
                $("#search-box").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
            },
            success: function(data) {
                $("#user-search").show();
                $("#user-search").html(data);
                $("#search-box").css("background", "#FFF");
            }
        });
    });
    });

    function selectCountry(val) {
        $("#search-box").val(val);
        $("#user-search").hide();
    }
</script>

<?php
    $conn = new DatabaseConnection($ini_array);
    $result = $conn->query_database("SELECT * FROM `user_pass`");

    /*
    echo "<table class=\"table-bordered\">";
    echo "<tr>";
    foreach ($result as $key => $value) {
        echo "<tr>";
        echo "<td>$value[username]</td>";
        echo "<td>$value[ID]</td>";
        echo "</tr>";
    }
    echo "</tr>";
    echo "</table>";
    */
?>

<!--<body> -->
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
