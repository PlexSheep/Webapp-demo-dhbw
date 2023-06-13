<?php
define("rep", 1);
// require the common.php stuff
require 'common.php';
// include the upload function
require 'upload.php';
// process the form if it was sent

if (!isset($_SESSION['ID'])){
    header("Location: /konto.php");
}
if($_POST) {
    if (
        $_POST['name'] == NULL || 
        $_POST['desc'] == NULL || 
        $_POST['category'] == NULL || 
        $_POST['ingredient'] == NULL || 
        $_POST['tags'] == NULL || 
        $_POST['country'] == NULL
    ) {
        echo "bad HTTP POST";
        exit_with_bad_request();
    }
    // POST to normal stuff
    $name = $_POST['name'];
    $name = ($name);
    $desc = $_POST['desc'];
    $desc = ($desc);
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
        test_for_bad_chars_array($categories) ||
        test_for_bad_chars_array($ingredients) ||
        test_for_bad_chars_array($tags) ||
        test_for_bad_chars_array($country) ||
        test_for_bad_chars($name) ||
        test_for_bad_chars($desc)
    ) {
        echo "bad parameters given";
        exit_with_bad_request();
    }

    if ((isset($_FILES['fileToUpload']['name'])) && (!$_FILES['fileToUpload']['tmp_name'] == NULL)) {
        $filename = upload_img($_FILES);
        if ($filename == "ERROR" || $filename == NULL) {
            echo "file error";
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


    // get the country ID
    $country = $conn->get_country_by_name($country[0]);
    if ($country == NULL) {
        echo "country not found";
        exit_with_bad_request();
    }
    // country[0] is the ID.
    if (!isset($country[0]) || $country[0] == NULL) {
        echo "country value not found";
        exit_with_bad_request();
    }

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
        $name,
        // TODO add country lookup and writing to db
        $country[0],
        $filename,
        $desc,
        $uuid,
        $uuid,
    );

    $result = $stmt -> execute();

    // map the category
    foreach ($categories as $cat) {
        $cat = $conn->get_category_by_name($cat);
        if ($cat == NULL) {
            echo "category not found";
            exit_with_bad_request();
        }
        // cat[0] is the ID.
        if (!isset($cat[0]) || $cat[0] == NULL) {
            echo "category value not found";
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
        $escaped = $cat[0];
        $escaped = escape_newlines($escaped);
        $stmt -> bind_param("ss", 
            $uuid,
            $escaped
        );
        $result = $stmt -> execute();
        $stmt->close();
    }


    // map the ingredients
    foreach ($ingredients as $ing) {
        $ing = $conn->get_or_create_ingredient_by_name($ing);
        if ($ing == NULL) {
            echo "ingredient not found";
            exit_with_bad_request();
        }
        // ing[0] is the ID.
        if (!isset($ing[0]) || $ing[0] == NULL) {
            echo "category value not found";
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
        $escaped = $ing[0];
        $escaped = escape_newlines($escaped);
        $stmt -> bind_param("ss", 
            $uuid,
            $escaped
        );
        $result = $stmt -> execute();
        $stmt->close();
    }

    // map the tags
    foreach ($tags as $tag) {
        $tag = $conn->get_or_create_tag_by_name($tag);
        if ($tag == NULL) {
            echo "tag not found";
            exit_with_bad_request();
        }
        // tag[0] is the ID.
        if (!isset($tag[0]) || $tag[0] == NULL) {
            echo "tag value not found";
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
        $escaped = $tag[0];
        $escaped = escape_newlines($escaped);
        $stmt -> bind_param("ss", 
            $uuid,
            $escaped
        );
        $result = $stmt -> execute();
        $stmt->close();
    }

    // map the country
    $stmt = $conn-> connection -> prepare("
        INSERT INTO `recipie_country` (`ID`, `recipie`, `country`)
        VALUES 
        (
            NULL, 
            ?, 
            ?
        );
    ");
    $escaped = $country[0];
    $escaped = escape_newlines($escaped);
    $stmt -> bind_param("ss", 
        $uuid,
        $escaped
    );
    $result = $stmt -> execute();
    $stmt->close();

    $url = '/detail.php?recipie=' . $uuid;
    header("Location:". $url);
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
        <section class="recipie-creator-container row container-fluid">
            <form class="form-group" method="post" action="create.php" enctype="multipart/form-data">
                <div class="container-xxl">
                    <h2 class="h-5">Rezept erstellen</h2>
                    <div class="row">
                        <div class="col-3">
                            <label class="form-label" for="img-upload">Bild</label>
                            <br>
                            <img id="upload-display" src="img/icons/empty_plate.jpg" alt="thumbnail" style="min-width: 200px;" class="m-3 pb-3 img-fluid"></img>
                            <br>
                            <input class="form-control"type="file" name="fileToUpload" style="min-width: 200px;" id="fileToUpload" onchange="loadFile(event)">
                            <script>
                                function loadFile(event) {
                                    console.log("DO SOMETHING")
                                  var image = document.getElementById('upload-display');
                                  image.src=URL.createObjectURL(event.target.files[0]);
                                }
                            </script>
                        </div>
                        <div class="g-1"></div>
                        <div class="container col">
                            <label class="form-label"for="name">Name</label>
                            <input class="form-control" type="text" id="name" name="name" placeholder="Name">
                            <label class="form-label"for="desc-box">Beschreibung</label>
                            <textarea name="desc" id="desc-box" placeholder="Beschreibung des Rezepts" class="form-control"></textarea>
                            <div class="container row">
                                <div class="col mx-auto">
                                    <label class="form-label"for="tags">Tags:</label><br>
                                    <input type="text" id="tags" placeholder="Tags" name="tags">
                                </div>
                                <div class="col mx-auto">
                                    <label class="form-label"for="ingredient">Zutaten:</label><br>
                                    <input type="text" id="ingredient" placeholder="Zutaten" name="ingredient">
                                </div>
                                <div class="col mx-auto">
                                    <label class="form-label"for="category">Kategorie:</label><br>
                                    <input id="category" placeholder="Kategorie" name="category">
                                    <div id="opetions-for-category" class="tagify-option-chooser"></div>
                                </div>
                                <div class="col mx-auto">
                                    <label class="form-label"for="country">Land:</label><br>
                                    <input id="country" placeholder="Land" name="country">
                                    <div id="opetions-for-country" class="tagify-option-chooser"></div>
                                </div>
                            </div>
                            <input class="form-control"type="submit" value="Erstellen">
                        </div>
                        </div>
                    </div>
                </div>
                <script>
                    var tags = document.querySelector('input[name=tags]');
                    var ingredient = document.querySelector('input[name=ingredient]');

                    // initialize Tagify on the above input class="form-control"node reference
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
                      
                    const warning = (e) => {
                        // For most browsers, just the following line is sufficient:
                        return `Are you sure?`;
                    };

                    window.addEventListener(`beforeunload`, warning);

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
