<?php
define("rep", 1);

require "../common.php";

?>

<head>
    <?php require '../templates/head.php' ?>
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

<div id="dialog-confirm-pass" title="Empty the recycle bin?" style="display: None">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Really change password?</p>
</div>

<div class="contailer-fluid d-flex p-2 flex-column justify-content-center align-items-center">

    <div>
        <input type="test" id="search-box" class="form-control align-items-center" placeholder="User email: " />
        <div id="user-search"></div>
    </div>

    <script>


    $(document).ready(function() {
        $("#search-box").keyup(function() {
            console.log("Here");
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
                        data: 'ID=' + $("#ID_del").val(),
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
        $( "#update_pass" ).on( "submit", function( event ) {
            event.preventDefault()
            $( "#dialog-confirm-pass" ).dialog({
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Change": function() {
                    $.ajax({
                        type: "POST",
                        url: "/admin/changePassword.php",
                        data: {ID: $("#ID").val(), PASS: + $("#PASS").val()},
                        success: function(data) {
                            alert( "Password changed" );
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
            <form id="delForm" class="form-control">
                <label for="ID_del">User to delete:</label>
                <input type="number" class="form-control" id="ID_del" name="ID" required>
                <input type="submit" class="form-control align-items-center" value="Löschen">
            </form>
        </div>
    </div>
    <div class="form-container">
        <div style="display: block;" class="form-content active-choice">
            <form class="form-control" id="update_pass" method="post">
                <label for="ID">User ID to update password:</label>
                <input type="number" id="ID" class="form-control" name="ID" required>
                
                <label for="ID">New Password:</label>
                <input type="PASS" class="form-control" id="PASS" name="PASS" required>
                
                <input type="submit" class="form-control" value="Update Password">
            </form>
        </div>
    </div>
    <div class="form-container">
        <div style="display: block;" id="loginForm" class="form-content active-choice">
            <form action="/admin/get_json.php" class="form-control" method="post">
                <label class="form-control" for="ID">Export user data of ID:</label>
                <input type="ID" id="ID" class="form-control" name="ID" required>
            </form>
        </div>
    </div>
    <div class="form-container">
        <div style="display: block;" class="form-control" class="form-content active-choice">
            <form id="cat">
                <label for="ID">Enter name of new category: </label>
                <input type="text" class="form-control" d="NAME" name="Name of category" required>
                <input type="submit" class="form-control align-items-center" value="add category">
            </form>
        </div>
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
