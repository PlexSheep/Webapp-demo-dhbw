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
    <header>
    <?php require 'templates/header.php' ?>
    </header>
    <main >
        <?php require 'templates/hero.php' // load the search bar and so on ?>
        <section class="recipe-detail-container container-fluid w-100">
            <center>
                <div class="w-100" class="recipe-detail-card container-fluid w-100">
                <?php 
                    $conn = new DatabaseConnection($ini_array);
                    $result = $conn->get_recepe_by_id($_GET['recipe']);
                    $ingridients = $conn -> query_ingridients($_GET['recipe']) -> get_result() -> fetch_all();
                    $categories = $conn -> query_categories($_GET['recipe']) -> get_result() -> fetch_all();
                    $tags = $conn -> query_tags($_GET['recipe']) -> get_result() -> fetch_all();
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
                        echo "<ul class=\"list-group w-50\">";
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
                        echo "<ul class=\"list-group w-50\">";
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
                        echo "<ul class=\"list-group w-50\">";
                        if (count($categories) === 0) {
                            echo "<li style=\"min-width: 100px;\" class=\"list-group-item\">Keine</li>";
                        }
                        foreach ($categories as $key => $value) {
                            echo "<li style=\"min-width: 100px;\" class=\"list-group-item\">" . htmlspecialchars($value[0] , ENT_QUOTES, 'UTF-8') . "</li>";
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
