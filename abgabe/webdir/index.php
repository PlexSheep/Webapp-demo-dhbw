<?php
// require the common.php stuff
require_once 'common.php';
?>
<!DOCTYPE html>
<html lang="de">
<head>
<?php require 'templates/head.php' ?>
</head>
<body>
    <?php require 'templates/header.php' ?>
    <main>
        <?php require 'templates/hero.php' // load the search bar and so on ?>
        <div class="container-fluid">
            <?php require 'templates/featured-recipies.php' // show popular ?>
        </div>
    </main>
    <footer>
    <?php require 'templates/footer.php' ?>
    </footer>
</body>
</html>
