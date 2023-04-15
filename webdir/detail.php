<?php
// require the common.php stuff
require 'common.php';
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Globale Küchenreise</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo"><a href = "http://localhost:8080">Rezepti</a></div>
        <nav>
            <ul>
                <li><a href="recipes.html">Rezepte</a></li>
                <li><a href="region.html">Regionen</a></li>
                <li><a href="#">Zutaten</a></li>
                <li><a href="#">Konto</a></li>
                <!-- TODO remove these links for the test environment for the final version! -->
                <li><a href="test/index.php">Testpages</a></li>
                <li><a href="http://localhost:8082">phpmyadmin</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="hero">
            <h1>Entdecke Rezepte aus der ganzen Welt und erlebe eine globale Küchenreise</h1>
            <input type="search" placeholder="Suche nach Rezepten, Zutaten oder Ländern">
        </section>
        <section class="recipe-detail-container">
            <center>
                <div class="recipe-detail-card">
                <?php 
                    // TODO FIXME THIS IS LIKELY VULNERABLE TO SQL INJECTION!!!
                    // TODO FIXME THIS IS LIKELY VULNERABLE TO HTML INJECTION AND PROBABLY XSS ASWELL!!!
                    $conn = new DatabaseConnection($ini_array);
                    $result = $conn->get_recepe_by_id($_GET['recipe']);
                    if ($result) {
                        echo "<h1>" . $result['title'] . "</h1>";
                        echo "<h4>" . $conn->get_country_by_id($result['country'])["name"] . "</h4>";
                        if ($result['image_path']) {
                            echo "<img src='img/useruploads/" . $result['image_path'] . "' alt=\"Bild des Rezepts\"></img>";
                        }
                        else {
                            echo "( kein Bild vorhanden. )<br>";
                        }

                        echo "<article>" . $result['description'] . "</article>";
                        // prepare the score images
                        $score_meter = " ";
                        for ($i = 0; $i < (int)$result['score']; $i++) {
                            $score_meter = $score_meter . "<img src=\"img/icons/score.jpg\"></img> ";
                        }
                        for ($i = 5; $i > (int)$result['score']; $i--) {
                            $score_meter = $score_meter . "<img src=\"img/icons/noscore.png\"></img> ";
                        }
                        echo "<div class=\"score\"><h4>Score</h4><br><div class=\"score-inner\">" . 
                            $result['score'] .
                           "<br>" . 
                            $score_meter . 
                            "</div></div>"; 
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
    </main>
    <footer>
        <div class="footer-content">
            <p>Impressum | Datenschutz | Nutzungsbedingungen</p>
            <p>&copy; 2023 Globale Küchenreise. Alle Rechte vorbehalten.</p>
        </div>
    </footer>
</body>
</html>
