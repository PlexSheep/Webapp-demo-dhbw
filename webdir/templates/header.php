<nav class="navbar navbar-expand-lg text-nowrap fs-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="img/icons/rezepti.png" width="30" height="30" class="me-3 ms-2"></img>
            <span class="fs-4 text-nowrap text-dark">Rezepti</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex" id="navbarNavAltMarkup">
            <div class="navbar-nav text-end">
                <a class="nav-link mx-1" href="create.php">Erstellen</a>
                <a class="nav-link mx-1" href="konto.php">Konto</a>
                <?php
                    if(isset($_SESSION['ID'])){
                    echo "<a class=\"nav-link mx-1\" href=\"../auth/logout.php\">Logout</a>";

                    if ($_SESSION['ID'] == 1){
                    echo "<a class=\"nav-link mx-1\" href=\"../admin/admin.php\">Admin</a>";
                    echo "<a class=\"nav-link mx-1\" href=\"test/index.php\">Testpages</a>";
                    echo "<a class=\"nav-link mx-1\" href=\"http://localhost:8082\">phpmyadmin</a>";
                    }
                    }
                ?>
            </div>
        </div>
</nav>
