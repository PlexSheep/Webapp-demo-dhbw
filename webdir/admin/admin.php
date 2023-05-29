<?php
require "../common.php";

?>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>

<?php
if (isset($_SESSION['ID'])) {
    if ($_SESSION['ID'] != 1) {
        http_response_code(403); exit;
    }

?>

<body>

<div id="dialog-confirm" title="Empty the recycle bin?" style="display: None">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>This user will be deleted. Are you sure?</p>
</div>

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
            data: 'ID=' + $(this).val(),
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

    $(document).ready(function(){
        $( "#delForm" ).on( "submit", function( event ) {
            event.preventDefault()
            $( "#dialog-confirm" ).dialog({
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Delete": function() {
                    $.ajax({
                        type: "POST",
                        url: "/admin/userDelete.php",
                        data: 'ID=' + $("#ID").val(),
                        success: function(data) {
                            alert( "User deleted" );
                        }
                    });
                    $( this ).dialog( "close" );
                },
                Cancel: function() {
                $( this ).dialog( "close" );
                }
            }
            });

        });
        });

     $(document).ready(function(){
        $( "#cat" ).on( "submit", function( event ) {
            event.preventDefault()
            $.ajax({
                type: "POST",
                url: "/admin/add_category.php",
                data: 'NAME=' + $("#NAME").val(),
                success: function(data) {
                    alert( "Category added" );
                }
                });
            });
        });
</script>

<!--<body> -->
    <div class="form-container">
        <div style="display: block;" class="form-content active-choice"  >
            <form id="delForm">
                <label for="ID">User to delete:</label>
                <input type="number" id="ID" name="ID" required>
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
    <div class="form-container">
        <div style="display: block;" class="form-content active-choice">
            <form id="cat">
                <label for="ID">Enter name of new category: </label>
                <input type="text" id="NAME" name="Name of category" required>
                <input type="submit" value="add category">
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

</body>
</html>
