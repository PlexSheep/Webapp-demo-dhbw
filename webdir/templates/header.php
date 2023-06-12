<div class="logo">
    <img src="img/icons/rezepti.png"></img>
    <a href = "http://localhost:8080">Rezepti</a>
</div>

    <nav class="navbar navbar-expand-sm  ">
        <div class="container-fluid" >
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item" ><a class="nav-link" href="create.php">Erstellen</a></li>
                    <li class="nav-item "><a class="nav-link" href="konto.php">Konto</a></li
                    <?php
                    if(isset($_SESSION['ID'])){
                        echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"../auth/logout.php\">Logout</a></li>";

                        if ($_SESSION['ID'] == 1){
                            echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"../admin/admin.php\">Admin</a></li>";
                            echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"test/index.php\">Testpages</a></li>";
                            echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"http://localhost:8082\">phpmyadmin</a></li>";
                        }
                    }
                    ?>
            </ul>
            </div>
        </div>
</nav>
</body>
