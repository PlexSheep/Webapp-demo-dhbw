<?php
define("rep", 1);
// require the common.php stuff
require 'common.php';
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
        <section class="recipes-cards-section ">
            <h2>Ergebnisse:</h2>
            <div class="recipe-grid" id="recipe-grid0">
            </div>
            <br>
<?php
$conn = new DatabaseConnection($ini_array);
// TODO: FIXME PROBABLY VULNERABLE TO SQL INJECTION
//TODO: yes
if ($_GET['search'] == "") {
    $stmt = $conn-> connection -> prepare("SELECT * FROM recipie");
    $stmt -> execute();
    $result = $stmt -> get_result();
}
else {
    $stmt = $conn-> connection -> prepare("
            SELECT * FROM `recipie` 
            WHERE title LIKE ? OR 
            ID in (
                SELECT recipie FROM recipie_ingredient WHERE 
                ingredient in (SELECT ID FROM ingredient WHERE name LIKE ?)
            ) OR
            ID in (
                SELECT recipie FROM recipie_country WHERE 
                country in (SELECT ID FROM country WHERE name LIKE ?)
            ) OR
            ID in (
                SELECT recipie FROM recipie_tag WHERE 
                tag in (SELECT ID FROM tag WHERE name LIKE ?)
            ) OR
            ID in (
                SELECT recipie FROM recipie_category WHERE 
                category in (SELECT ID FROM category WHERE name LIKE ?)
            );
            ");
    $search = "%{$_GET['search']}%";
    $stmt -> bind_param("sssss", 
        $search, 
        $search, 
        $search, 
        $search, 
        $search
    );
    $stmt->execute();
    $result = $stmt -> get_result();
}
$rows = $result->fetch_all(MYSQLI_ASSOC);
if ($rows) {
    echo '
            <div class="container-fluid">
                <div class="recipe-grid container-fluid px-5 mt-5" id="featured-recipies-grid">
';
    foreach ($rows as $row) {
        if ($row['image_path'] === null) {
            echo '
            <a href=' . $row['slug'] . '>
            <div class="card" style="width: 18rem;">
              <div>
                  <img src="img/icons/empty_plate.jpg" class="card-img-top card-img" alt="thumbnail">
              </div>
              <div class="card-body">
                <h5 class="card-title">' . htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8') . '</h5>
                <p class="card-text">' . htmlspecialchars(escape_newlines($row['description'], ENT_QUOTES, 'UTF-8')) . '</p>
              </div>
              <ul class="list-group list-group-flush">
                  <li class="list-group-item">' . $conn->get_country_by_id($row['country'])['name'] . '</li>
              </ul>
            </div>
            </a>';
        }
        else {
            echo '
            <a href=/detail.php?recipie=' . $row['slug'] . '>
            <div class="card" style="width: 18rem;">
              <div>
                  <img src="img/useruploads/' . $row['image_path'] . '" class="card-img-top card-img" alt="thumbnail">
              </div>
              <div class="card-body">
                <h5 class="card-title">' . htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8') . '</h5>
                <p class="card-text">' . htmlspecialchars(escape_newlines($row['description'], ENT_QUOTES, 'UTF-8')) . '</p>
              </div>
              <ul class="list-group list-group-flush">
                  <li class="list-group-item">' . $conn->get_country_by_id($row['country'])['name'] . '</li>
              </ul>
            </div>
            </a>';
        }
    }
    echo '</div></div>';
}
else {
    echo "<h1 class=\"h1\">Keine Rezepte für '" . htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8') . "' gefunden.</h1>";
}
?>
        </section>
        <?php require 'templates/featured-recipies.php' // show popular ?>
    </main>
    <footer>
    <?php require 'templates/footer.php' ?>
    </footer>
</body>
</html>
