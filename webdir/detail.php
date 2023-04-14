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
        <div class="logo">Globale Küchenreise</div>
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
            <center><h1>Der Frontend Dev hat hier noch keine Arbeit geleistet :(</h1></center>
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
