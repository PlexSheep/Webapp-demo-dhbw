<?php
// require the common.php stuff
/**
 * @ignore
 */
define("rep", 1);
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
            <div class="container-fluid text-center my-5">
                <h1 class="display-1">Diese Seite existiert nicht</h1>
            </div>
            <?php require 'templates/featured-recipies.php' // show popular ?>
        </div>
    </main>
    <footer>
    <?php require 'templates/footer.php' ?>
    </footer>
</body>
</html>
