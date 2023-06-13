<nav class="navbar navbar-expand-lg main-nav fs-5" style="background-color: #fc6508;">
  <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="img/icons/rezepti.png" width="30" height="30" class="me-3 ms-2"></img>
            <span class="fs-4 text-nowrap text-dark">Rezepti</span>
        </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-0 ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="create.php">Erstellen</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="konto.php">Konto</a>
        </li>
        <?php
        if(isset($_SESSION['ID'])){
            echo "<li><a class=\"nav-link\" href=\"../auth/logout.php\">Logout</a></li>";

            if ($_SESSION['ID'] == 1){
                echo "<li><a class=\"nav-link\" href=\"../admin/admin.php\">Admin</a></li>";
                echo "<li><a class=\"nav-link\" href=\"test/index.php\">Testpages</a></li>";
                echo "<li><a class=\"nav-link\" href=\"http://localhost:8082\">phpmyadmin</a></li>";
            }
        }
        ?>
      </ul>
    </div>
  </div>
</nav>
