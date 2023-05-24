<?php
define("rep", 1);
// require the common.php stuff
require 'common.php';
// process the form if it was sent
if($_POST) {
    // parse
    $tags = $_POST['tags'];
    $ingredient = $_POST['ingredient'];
    $category = $_POST['category'];
    
    $conn = new DatabaseConnection($ini_array);
    $stmt = $conn-> connection -> prepare("
INSERT INTO `recipie` (`title`, `country`, `image_path`, `description`, `id`, `score`, `slug`) 
VALUES 
(
    'title', 
    '3', 
    'path', 
    'desc', 
    uuid(), 
    '0', 
    uuid()
)

");
$stmt -> bind_param("ssss", 
    $_POST['title'],
    $country,
    $img_path,
    $_POST['description']

    
    $tmp = 3;

    $conn = new DatabaseConnection($ini_array);
    $stmt = $conn-> connection -> prepare("
    INSERT INTO `recipie` (`title`, `country`, `image_path`, `description`, `id`, `score`, `slug`) 
    VALUES 
    (
        ?, 
        ?, 
        null, 
        ?,
        uuid(), 
        '0', 
        uuid()
    )

    ");
    $stmt -> bind_param("sss", 
    $_POST['name'],
    $tmp,
    $_POST['desc']
);

    $result = $stmt -> execute();
    $result = $stmt -> get_result();

    header("Location:".$_SERVER['HTTP_REFERER']);
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
                <input type="text" id="ingredient" placeholder="Zutaten" name="ingredient">
                <label for="category">Kategorie:</label> 
                <input id="category" placeholder="Kategorie" name="category">
                <div id="opetions-for-category" class="tagify-option-chooser"></div>
                <label for="country">Land:</label> 
                <input id="country" placeholder="Land" name="country">
                <div id="opetions-for-country" class="tagify-option-chooser"></div>
                <input type="submit" value="Erstellen">
                <script>
                    // The DOM element you wish to replace with Tagify
                    var tags = document.querySelector('input[name=tags]');
                    var ingredient = document.querySelector('input[name=ingredient]');

                    // initialize Tagify on the above input node reference
                    new Tagify(tags)
                    new Tagify(ingredient)

                    var category = document.querySelector('input[name=category'),
                    // init Tagify script on the above inputs
                    tagify = new Tagify(category, {
                    whitelist : [<?php 

                        $conn = new DatabaseConnection($ini_array);

                        $stmt = $conn-> connection -> prepare("SELECT * FROM category");
                        $result = $stmt -> execute();
                        $result = $stmt -> get_result();

                        $rows = $result->fetch_all(MYSQLI_ASSOC);
                        foreach ($rows as $row) {
                            echo "\"" . $row['name'] . "\",";
                        }
                        ?>],
                        dropdown: {
                            position: "manual",
                            maxItems: Infinity,
                            enabled: 0,
                            classname: "customSuggestionsList"
                        },
                        templates: {
                            dropdownItemNoMatch() {
                                return `<div class='empty'>Nothing Found</div>`;
                            }
                        },
                        enforceWhitelist: true
                    })

                    tagify.dropdown.show() // load the list
                    document.getElementById("opetions-for-category").appendChild(tagify.DOM.dropdown)

                    var country = document.querySelector('input[name=country'),
                    // init Tagify script on the above inputs
                    tagify = new Tagify(country, {
                    whitelist : [<?php 

                        $conn = new DatabaseConnection($ini_array);

                        $stmt = $conn-> connection -> prepare("SELECT * FROM country");
                        $result = $stmt -> execute();
                        $result = $stmt -> get_result();

                        $rows = $result->fetch_all(MYSQLI_ASSOC);
                        foreach ($rows as $row) {
                            echo "\"" . $row['name'] . "\",";
                        }
                        ?>],
                        dropdown: {
                            position: "manual",
                            maxItems: Infinity,
                            enabled: 0,
                            classname: "customSuggestionsList"
                        },
                        templates: {
                            dropdownItemNoMatch() {
                                return `<div class='empty'>Nothing Found</div>`;
                            }
                        },
                        enforceWhitelist: true
                    })

                    tagify.on("dropdown:show", onSuggestionsListUpdate)
                          .on("dropdown:hide", onSuggestionsListHide)
                          .on('dropdown:scroll', onDropdownScroll)

                    tagify.dropdown.show() // load the list
                    document.getElementById("opetions-for-country").appendChild(tagify.DOM.dropdown)

                    // ES2015 argument destructuring
                    function onSuggestionsListUpdate({ detail:suggestionsElm }){
                        console.log(  suggestionsElm  )
                    }

                    function onSuggestionsListHide(){
                        console.log("hide dropdown")
                    }

                    function onDropdownScroll(e){
                        console.log(e.detail)
                      }

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
