<?php
define("rep", 1);
// require the common.php stuff
require 'common.php';
// include the upload function
require 'upload.php';
// process the form if it was sent
if($_POST) {
    if (
        $_POST['name'] == NULL || 
        $_POST['desc'] == NULL || 
        $_POST['category'] == NULL || 
        $_POST['ingredient'] == NULL || 
        $_POST['tags'] == NULL || 
        $_POST['country'] == NULL
    ) {
        exit_with_bad_request();
    }
    // decode tagify json strings
    $categories = (array_column(json_decode($_POST['category']), 'value'));
    $ingredients = (array_column(json_decode($_POST['ingredient']), 'value'));
    $tags = (array_column(json_decode($_POST['tags']), 'value'));
    $country = (array_column(json_decode($_POST['country']), 'value'));
    if (
        $tags == NULL ||
        $ingredients == NULL ||
        $categories == NULL ||
        count($categories) > 20 ||
        $country == NULL ||
        count($country) != 1 ||
        filter_var_array($categories, FILTER_SANITIZE_SPECIAL_CHARS) ||
        filter_var_array($ingredients, FILTER_SANITIZE_SPECIAL_CHARS) ||
        filter_var_array($tags, FILTER_SANITIZE_SPECIAL_CHARS) ||
        filter_var_array($country, FILTER_SANITIZE_SPECIAL_CHARS) ||
        filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS) ||
        filter_var($_POST['desc'], FILTER_SANITIZE_SPECIAL_CHARS)
    ) {
        exit_with_bad_request();
    }

    if ((isset($_FILES['fileToUpload']['name'])) && (!$_FILES['fileToUpload']['tmp_name'] == NULL)) {
        $filename = upload_img($_FILES);
        if ($filename == "ERROR" || $filename == NULL) {
            exit_with_bad_request();
        }
    }
    else {
        $filename = NULL;
    }
    $conn = new DatabaseConnection($ini_array);
    // get the uuid as a var, so we can use it after the initial thing is created to create its
    // relationships.
    $uuid = $conn ->query_database("SELECT UUID();")->fetch_row()[0];


    $tmp = 3;
    // create main entry
    $stmt = $conn-> connection -> prepare("
        INSERT INTO `recipie` (`title`, `country`, `image_path`, `description`, `id`, `score`, `slug`) 
        VALUES 
        (
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            '0', 
            ?
        );
    ");
    $stmt -> bind_param("ssssss", 
        $_POST['name'],
        $tmp,
        $filename,
        $_POST['desc'],
        $uuid,
        $uuid,
    );

    $result = $stmt -> execute();

    // map the category
    foreach ($categories as $cat) {
        $cat = $conn->get_category_by_name($cat);
        if ($cat == NULL) {
            exit_with_bad_request();
        }
        // cat[0] is the ID.
        if (!isset($cat[0]) || $cat[0] == NULL) {
            exit_with_bad_request();
        }
        $stmt = $conn-> connection -> prepare("
            INSERT INTO `recipie_category` (`ID`, `recipie`, `category`)
            VALUES 
            (
                NULL, 
                ?, 
                ?
            );
        ");
        $stmt -> bind_param("ss", 
            $uuid,
            $cat[0]
        );
        $result = $stmt -> execute();
        $stmt->close();
    }


    // map the ingredients
    foreach ($ingredients as $ing) {
        $ing = $conn->get_or_create_ingredient_by_name($ing);
        if ($ing == NULL) {
            exit_with_bad_request();
        }
        // tag[0] is the ID.
        if (!isset($ing[0]) || $ing[0] == NULL) {
            exit_with_bad_request();
        }
        $stmt = $conn-> connection -> prepare("
            INSERT INTO `recipie_ingredient` (`ID`, `recipie`, `ingredient`)
            VALUES 
            (
                NULL, 
                ?, 
                ?
            );
        ");
        $stmt -> bind_param("ss", 
            $uuid,
            $ing[0]
        );
        $result = $stmt -> execute();
        $stmt->close();
    }

    // map the tags
    foreach ($tags as $tag) {
        $tag = $conn->get_or_create_tag_by_name($tag);
        if ($tag == NULL) {
            exit_with_bad_request();
        }
        // tag[0] is the ID.
        if (!isset($tag[0]) || $tag[0] == NULL) {
            exit_with_bad_request();
        }
        $stmt = $conn-> connection -> prepare("
            INSERT INTO `recipie_tag` (`ID`, `recipie`, `tag`)
            VALUES 
            (
                NULL, 
                ?, 
                ?
            );
        ");
        $stmt -> bind_param("ss", 
            $uuid,
            $tag[0]
        );
        $result = $stmt -> execute();
        $stmt->close();
    }

    // map the country
    $country = $conn->get_country_by_name($country[0]);
    if ($country == NULL) {
        exit_with_bad_request();
    }
    // country[0] is the ID.
    if (!isset($country[0]) || $country[0] == NULL) {
        exit_with_bad_request();
    }
    $stmt = $conn-> connection -> prepare("
        INSERT INTO `recipie_country` (`ID`, `recipie`, `country`)
        VALUES 
        (
            NULL, 
            ?, 
            ?
        );
    ");
    $stmt -> bind_param("ss", 
        $uuid,
        $country[0]
    );
    $result = $stmt -> execute();
    $stmt->close();

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
            <form method="post" action="create.php" enctype="multipart/form-data">
                <div id="img-part">
                    <label for="img-upload">Bild</label>
                    <br>
                    <img src="img/icons/empty_plate.jpg" alt="image broken"></img>
                    <br>
                    <input type="file" name="fileToUpload" id="fileToUpload">
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
                        maxTags: 20,
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
                        maxTags: 1,
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
