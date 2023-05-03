<?php
// require the common.php stuff
require 'common.php';
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php require 'templates/head.php' ?>
</head>
<body>
    <header>
    <?php require 'templates/header.php' ?>
    </header>
    <main>
        <?php require 'templates/hero.php' // load the search bar and so on ?>
        <section class="recipie-creator-container">
            <form method="post" action="create.php">
                <div id="img-part">
                    <label for="img-upload">Bild</label>
                    <br>
                    <img src="img/icons/empty_plate.jpg" alt="image broken"></img>
                    <br>
                    <input type="file" name="img-upload" id="img-upload">
                </div>
                <h2>Rezept erstellen</h2>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Name">
                <label for="desc-box">Beschreibung</label>
                <textarea name="desc" id="desc-box" placeholder="Beschreibung des Rezepts" rows="20" cols="120"></textarea>

                <input type="submit" value="Erstellen">
            </form>
        </section>
        <?php require 'templates/featured-recipies.php' // show popular ?>
    </main>
    <footer>
    <?php require 'templates/footer.php' ?>
    </footer>
</body>
</html>
