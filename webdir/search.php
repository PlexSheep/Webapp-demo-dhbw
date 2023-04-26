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
            <form action="search.php" method="get">
                <input type="search" name="search" id="search" placeholder="Suche nach Rezepten, Zutaten oder Ländern">
                <input type="submit" value="Los">
            </form>
        </section>
        <section class="search-results">
            <h2>Ergebnisse:</h2>
            <div class="recipe-grid" id="recipe-grid0">
            </div>
            <br>
    <?php
        $conn = new DatabaseConnection($ini_array);
        // TODO: FIXME PROBABLY VULNERABLE TO SQL INJECTION
        //TODO: yes
        if ($_GET['search'] == "") {
            $stmt = $conn-> connection -> prepare("SELECT * FROM recipies");
            $result = $stmt -> execute() -> get_result();  
        }
        else {
            // TODO make a query array, iterate over queries
            // TODO add partial string matching
            $stmt = $conn-> connection -> prepare("SELECT * FROM recipies WHERE title = ?");
            $stmt -> bind_param("s", $_GET['search']);
            $stmt->execute();
            $result = $stmt -> get_result();
            //$query = "SELECT * FROM recipies WHERE title ='". $_GET['search'] ."'";  
            // TODO add country lookup
            // TODO add cooking components
        }
        //$result = $conn->query_database($query);
        // TODO query all queries, join the arrays into a big atomic one.
        //echo '<pre>'; print_r($result -> fetch_object()); echo '</pre>';
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        if ($rows) {
            echo "<script>recipes = [";
            foreach ($rows as $row) {
                echo "\t\t{
                  title: '" . $row['title'] ."',
                  country: '" . $conn->get_country_by_id($row['country'])['name'] . "',
                  imgUrl: 'img/useruploads/" . $row['image_path'] ."',
                  description: '" . $row['description'] . "',
                  id: '" . $row['id'] . "',
                  slug: '" . $row['slug'] . "',
                  score: '" . $row['score'] . "',
            },\n";
            }
            // TODO load the script from a js file
            echo "
      ];

      function displayRecipes() {
        const recipeGrid = document.getElementById(\"recipe-grid0\");
        
        recipes.forEach(recipe => {
          const recipeLink = document.createElement('a');
          recipeLink.href = \"detail.php?recipe=\" + recipe.slug;
          const recipeCard = document.createElement('div');
          recipeCard.classList.add('recipe-card');
          
          const recipeImg = document.createElement('img');
          recipeImg.src = recipe.imgUrl;
          recipeImg.alt = recipe.title;
          recipeCard.appendChild(recipeImg);
          
          const recipeTitle = document.createElement('h3');
          recipeTitle.innerText = recipe.title;
          recipeCard.appendChild(recipeTitle);
          
          const recipeCountry = document.createElement('p');
          recipeCountry.innerText = `Land: \${recipe.country}`;
          recipeCard.appendChild(recipeCountry);
          
          const recipeDescription = document.createElement('p');
          recipeDescription.innerText = recipe.description;
          recipeCard.appendChild(recipeDescription);
          
          recipeLink.appendChild(recipeCard);
          recipeGrid.appendChild(recipeLink);
        });
      }

      displayRecipes();
    </script>
";
        }
        else {
            echo "<h1>Keine Rezepte für '" . $_GET['search'] . "' gefunden.</h1>";
        }

    ?>
        </section>
        <section class="featured-recipes">
            <h2>Beliebte Rezepte</h2>
            <div class="recipe-grid" id="recipe-grid1">
            </div>
        </section>
    </main>
    <footer>
        <div class="footer-content">
            <p>Impressum | Datenschutz | Nutzungsbedingungen</p>
            <p>&copy; 2023 Globale Küchenreise. Alle Rechte vorbehalten.</p>
        </div>
    </footer>
    <script>
      recipes = [
    <?php
        $conn = new DatabaseConnection($ini_array);
        $result = $conn->query_database("SELECT * FROM recipies");
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($rows as $row) {
            echo "\t\t{
              title: '" . $row['title'] ."',
              country: '" . $conn->get_country_by_id($row['country'])['name'] . "',
              imgUrl: 'img/useruploads/" . $row['image_path'] ."',
              description: '" . $row['description'] . "',
              id: '" . $row['id'] . "',
              slug: '" . $row['slug'] . "',
              score: '" . $row['score'] . "',
        },\n";
        }

    ?>
      ];

      function displayRecipes() {
        const recipeGrid = document.getElementById("recipe-grid1");
        
        recipes.forEach(recipe => {
          const recipeLink = document.createElement('a');
          recipeLink.href = "detail.php?recipe=" + recipe.slug;
          const recipeCard = document.createElement('div');
          recipeCard.classList.add('recipe-card');
          
          const recipeImg = document.createElement('img');
          recipeImg.src = recipe.imgUrl;
          recipeImg.alt = recipe.title;
          recipeCard.appendChild(recipeImg);
          
          const recipeTitle = document.createElement('h3');
          recipeTitle.innerText = recipe.title;
          recipeCard.appendChild(recipeTitle);
          
          const recipeCountry = document.createElement('p');
          recipeCountry.innerText = `Land: ${recipe.country}`;
          recipeCard.appendChild(recipeCountry);
          
          const recipeDescription = document.createElement('p');
          recipeDescription.innerText = recipe.description;
          recipeCard.appendChild(recipeDescription);
          
          recipeLink.appendChild(recipeCard);
          recipeGrid.appendChild(recipeLink);
        });
      }

      displayRecipes();
    </script>
</body>
</html>
