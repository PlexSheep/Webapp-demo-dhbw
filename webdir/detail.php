<?php
// require the common.php stuff
require 'common.php';
if (!isset($_GET['recipie'])) {
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
    <main >
        <?php require 'templates/hero.php' // load the search bar and so on ?>
        <section class="recipie-detail-container container-fluid w-100">
            <center>
                <div class="w-100" class="recipie-detail-card container-fluid w-100">
                <?php 
                    $conn = new DatabaseConnection($ini_array);
                    $result = $conn->get_recipie_by_id($_GET['recipie']);
                    $ingridients = $conn -> query_ingridients($_GET['recipie']) -> get_result() -> fetch_all();
                    $categories = $conn -> query_categories($_GET['recipie']) -> get_result() -> fetch_all();
                    $tags = $conn -> query_tags($_GET['recipie']) -> get_result() -> fetch_all();
                    $user = $conn -> get_user_for_recipie($result['id']) -> get_result() -> fetch_all(MYSQLI_ASSOC);
                    if (!isset($user) || $user === NULL || count($user) !== 1) {
                        $user_exists = false;
                    }
                    else {
                        $user_exists = true;
                        $user = $user[0];
                    }
                    if ($result) {
                        echo "<h1 class='display-4 text-wrap'>" . htmlspecialchars($result['title'] , ENT_QUOTES, 'UTF-8') . "</h1>";
                        echo "<h4 class='h4 text-wrap'>" . htmlspecialchars($conn->get_country_by_id($result['country'])["name"] , ENT_QUOTES, 'UTF-8') . "</h4>";
                        if ($result['image_path']) {
                            echo "<img class='img-thumbnail w-25' src='img/useruploads/" . $result['image_path'] . "' alt=\"Bild des Rezepts\"></img>";
                        }                                   
                        else {                              
                            echo "<img class='img-thumbnail w-25' src='img/icons/empty_plate.jpg' alt='Bild des Rezepts'></img>";
                        }

                        echo "<article>" . 
                            (
                                $result = escape_newlines( 
                                    htmlspecialchars($result['description'] , ENT_QUOTES, 'UTF-8')
                                )
                            ) . "</article>";
                        
                        echo "<div class='container row'>";
                        echo "<div class='col'>";
                        echo "<label>Zutaten</label>";
                        echo "<ul class=\"list-group w-100\">";
                        if (count($ingridients) === 0) {
                            echo "<li style=\"min-width: 100px;\" class=\"list-group-item\">Keine</li>";
                        }
                        foreach ($ingridients as $key => $value) {
                            echo "<li style=\"min-width: 100px;\" class=\"list-group-item\">" . htmlspecialchars($value[0] , ENT_QUOTES, 'UTF-8') . "</li>";
                        }
                        echo "</ul>";
                        echo "</div>";

                        echo "<div class='col'>";
                        echo "<label>Tags</label>";
                        echo "<ul class=\"list-group w-100\">";
                        if (count($tags) === 0) {
                            echo "<li style=\"min-width: 100px;\" class=\"list-group-item\">Keine</li>";
                        }
                        foreach ($tags as $key => $value) {
                            echo "<li style=\"min-width: 100px;\" class=\"list-group-item\">" . htmlspecialchars($value[0] , ENT_QUOTES, 'UTF-8') . "</li>";
                        }
                        echo "</ul>";
                        echo "</div>";

                        echo "<div class='col'>";
                        echo "<label>Kategorien</label>";
                        echo "<ul class=\"list-group w-100\">";
                        if (count($categories) === 0) {
                            echo "<li style=\"min-width: 100px;\" class=\"list-group-item\">Keine</li>";
                        }
                        foreach ($categories as $key => $value) {
                            echo "<li style=\"min-width: 100px;\" class=\"list-group-item\">" . htmlspecialchars($value[0] , ENT_QUOTES, 'UTF-8') . "</li>";
                        }
                        echo "</ul>";
                        echo "</div>";

                        echo "<div class='col'>";
                        echo "<label>Nutzer</label>";
                        echo "<ul class=\"list-group w-100\">";
                        if ($user_exists) {
                            echo "<a href=\"/profile.php?user=" . $user['ID'] . "\"><li style=\"min-width: 100px;\" class=\"list-group-item\">" . $user['username'] . "</li></a>";
                        }
                        else {
                            echo "<li style=\"min-width: 100px;\" class=\"list-group-item\">Anonymous</li>";
                        }
                        echo "</ul>";
                        echo "</div>";
                        echo "</div>";

                        //// prepare the score images
                        //$score_meter = " ";
                        //for ($i = 0; $i < (int)$result['score']; $i++) {
                        //    $score_meter = $score_meter . "<img  src=\"img/icons/score.jpg\"></img> ";
                        //}
                        //for ($i = 5; $i > (int)$result['score']; $i--) {
                        //    $score_meter = $score_meter . "<img src=\"img/icons/noscore.png\"></img> ";
                        //}
                        //echo "<div class=\"score\"><h4>Score</h4><br><div class=\"score-inner\">" . 
                        //   $result['score'].
                        //   "<br>" . 
                        //   $score_meter . 
                        //    "</div></div>"; 
                        ////echo '<pre>'; print_r($ingridients -> get_result() -> fetch_all()); echo '</pre>';
                    }
                    else {
                        echo "<h3>Dieses Rezept konnte nicht gefunden werden.<br>:(</h3>";
                        echo "<img src=\"img/icons/empty_plate.jpg\" alt=\"empty plate\"></img>";
                    }
                ?>
                </div>
            </center>
        </section>
        <?php require 'templates/featured-recipies.php' // show popular ?>
    </main>
    <footer>
    <?php require 'templates/footer.php' ?>
    </footer>
</body>
</html>
