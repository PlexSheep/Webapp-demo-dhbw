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
            // TODO make a query array, iterate over queries
            // TODO add partial string matching
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
            $stmt -> bind_param("sssss", 
                $_GET['search'], 
                $_GET['search'], 
                $_GET['search'], 
                $_GET['search'], 
                $_GET['search']
            );
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
            echo "<h1>Keine Rezepte für '" . htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8') . "' gefunden.</h1>";
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
