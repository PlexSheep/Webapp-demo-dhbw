<?php
define("rep", 1);
// require the common.php stuff
require 'common.php';
// process the form if it was sent
if($_POST) {
    print_r($_POST);
    // parse
    $tags = $_POST['tags'];
    $ingredient = $_POST['ingredient'];
    $category = $_POST['category'];
    
    //$conn = new DatabaseConnection($ini_array);

    exit;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php require 'templates/head.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
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
                <label for="tags">Tags:</label>
                <input type="text" id="tags" placeholder="Tags" name="tags">
                <label for="ingredient">Zutaten:</label>
                <input type="text" id="ingredient" placeholder="Zutaten">
                <label for="category">Kategorie:</label> 
                <select>
                    <option>test</option>
                </select>
                <input type="submit" value="Erstellen">
                <script>
                    // The DOM element you wish to replace with Tagify
                    var input = document.querySelector('input[name=tags]');

                    // initialize Tagify on the above input node reference
                    new Tagify(input)
                </script>
            </form>
        </section>
        <?php require 'templates/featured-recipies.php' // show popular ?>
    </main>
    <footer>
    <?php require 'templates/footer.php' ?>
    </footer>
</body>
</html>
