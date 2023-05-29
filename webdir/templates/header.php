<head>
    <?php require 'templates/head.php' ?>

</head>

<div class="logo container-fluid">
    <img src="img/icons/rezepti.png"></img>
    <a href = "http://localhost:8080">Rezepti</a>
</div>
<nav class="navbar navbar-expand-lg">
<div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item "><a class="nav-link" href="recipes.html">Rezepte</a></li>
            <li class="nav-item "><a class="nav-link" href="region.html">Regionen</a></li>
            <li class="nav-item "><a class="nav-link" href="#">Zutaten</a></li>
            <li class="nav-item ><a class="nav-link" href="create.php">Erstellen</a></li>
            <li class="nav-item active"><a class="nav-link" href="konto.php">Konto</a></li
            <!-- TODO remove these links for the test environment for the final version! -->
            <?php
            if(isset($_SESSION['ID'])){
                echo "<li><a href=\"../auth/logout.php\">Logout</a></li>";

                if ($_SESSION['ID'] == 1){
                    echo "<li><a href=\"../admin/admin.php\">Admin</a></li>";
                    echo "<li><a href=\"test/index.php\">Testpages</a></li>";
                    echo "<li><a href=\"http://localhost:8082\">phpmyadmin</a></li>";
                }
            }
            ?>
    </ul>
    </div>
</div>
</nav>
