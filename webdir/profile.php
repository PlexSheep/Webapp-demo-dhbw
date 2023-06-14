<?php
// require the common.php stuff
require_once 'common.php';
if (!isset($_GET['user'])) {
    exit_with_bad_request();
}
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
                    <?php
                        $conn = new DatabaseConnection($ini_array);
                        
                        $user = $conn->query_all_user_data($_GET['user'])->get_result()->fetch_assoc();
                        if (!isset($user) || $user === NULL) {
                            exit_with_not_found();
                        }

                        echo '<h4 class="display-4 mt-5 mx-5">Rezepte von ' . $user['username'] . '</h4><br>';

                        $rows = $conn->query_recipies_user($_GET['user'])->get_result()->fetch_all(MYSQLI_ASSOC);
                        if (!isset($rows) || $rows === NULL) {
                            exit_with_not_found();
                        }
                        if (count($rows) < 1) {
                            echo '<p class="fs-3 mx-5">Dieser Nutzer hat keine Rezepte erstellt.</p>';
                        }
                        else {
                            echo '<div class="recipe-grid container-fluid px-5 mt-5" id="featured-recipies-grid">';
                            foreach ($rows as $row) {
                                if ($row['image_path'] === null) {
                                    echo '
                                    <a href=/detail.php?recipie=' . $row['slug'] . '>
                                    <div class="card" style="max-width: 18rem;">
                                      <div>
                                          <img src="img/icons/empty_plate.jpg" class="card-img-top card-img" alt="thumbnail">
                                      </div>
                                      <div class="card-body">
                                        <h5 class="card-title">' . htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8') . '</h5>
                                        <p class="card-text">' . htmlspecialchars(escape_newlines(substr($row['description'], 0, 100), ENT_QUOTES, 'UTF-8')) . '</p>
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
                                    <div class="card" style="max-width: 18rem;">
                                      <div>
                                          <img src="img/useruploads/' . $row['image_path'] . '" class="card-img-top card-img" alt="thumbnail">
                                      </div>
                                      <div class="card-body">
                                        <h5 class="card-title">' . htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8') . '</h5>
                                        <p class="card-text">' . htmlspecialchars(escape_newlines(substr($row['description'], 0, 100), ENT_QUOTES, 'UTF-8')) . '</p>
                                      </div>
                                      <ul class="list-group list-group-flush">
                                          <li class="list-group-item">' . $conn->get_country_by_id($row['country'])['name'] . '</li>
                                      </ul>
                                    </div>
                                    </a>';
                                }
                            }
                        }

                    ?>
                </div>
            </div>
        <div class="container-fluid">
            <?php require 'templates/featured-recipies.php' // show popular ?>
        </div>
    </main>
    <footer>
    <?php require 'templates/footer.php' ?>
    </footer>
</body>
</html>
