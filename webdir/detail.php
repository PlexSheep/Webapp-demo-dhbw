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
    <main>
        <?php require 'templates/hero.php' // load the search bar and so on ?>
        <section class="recipe-detail-container">
            <center>
                <div class="recipe-detail-card">
                <?php 
                    // TODO FIXME THIS IS LIKELY VULNERABLE TO HTML INJECTION AND PROBABLY XSS ASWELL!!!
                    $conn = new DatabaseConnection($ini_array);
                    $result = $conn->get_recepe_by_id($_GET['recipe']);
                    $ingridients = $conn -> query_ingridients($_GET['recipe']) -> get_result() -> fetch_all();
                    //echo '<pre>'; print_r($ingridients); echo '</pre>';
                    if ($result) {
                        echo "<h1>" . htmlspecialchars($result['title'] , ENT_QUOTES, 'UTF-8') . "</h1>";
                        echo "<h4>" . htmlspecialchars($conn->get_country_by_id($result['country'])["name"] , ENT_QUOTES, 'UTF-8') . "</h4>";
                        if ($result['image_path']) {
                            echo "<img src='img/useruploads/" . $result['image_path'] . "' alt=\"Bild des Rezepts\"></img>";
                        }
                        else {
                            echo "( kein Bild vorhanden. )<br>";
                        }

                        echo "<article>" . htmlspecialchars($result['description'] , ENT_QUOTES, 'UTF-8') . "</article>";
                        // prepare the score images
                        $score_meter = " ";
                        for ($i = 0; $i < (int)$result['score']; $i++) {
                            $score_meter = $score_meter . "<img  src=\"img/icons/score.jpg\"></img> ";
                        }
                        for ($i = 5; $i > (int)$result['score']; $i--) {
                            $score_meter = $score_meter . "<img src=\"img/icons/noscore.png\"></img> ";
                        }
                        echo "<div class=\"score\"><h4>Score</h4><br><div class=\"score-inner\">" . 
                           $result['score'].
                           "<br>" . 
                           $score_meter . 
                            "</div></div>"; 
                        //echo '<pre>'; print_r($ingridients -> get_result() -> fetch_all()); echo '</pre>';
                        
        echo "<table>";
        echo "<tr>";
        foreach ($ingridients as $key => $value) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($value[0] , ENT_QUOTES, 'UTF-8') . "</td>";
            echo "</tr>";
        }
        echo "</tr>";
        echo "</table>";


                        echo "<form action=\"upload.php\" method=\"post\" enctype=\"multipart/form-data\">
                              Select image to upload:
                              <input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\">
                              <input type=\"hidden\" name=\"recipe\" id=\"recipe\" value=\"" . $result['slug'] ."\">
                              <input type=\"submit\"></form>";
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
