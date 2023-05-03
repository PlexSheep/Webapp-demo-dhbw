<?php
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
        <section class="search-results">
            <h2>Ergebnisse:</h2>
            <div class="recipe-grid" id="recipe-grid0">
            </div>
            <br>
    <?php
        $conn = new DatabaseConnection($ini_array);
        // TODO FIXME PROBABLY VULNERABLE TO SQL INJECTION
        if ($_GET['search'] == "") {
            $query = "SELECT * FROM recipie";  
        }
        else {
            // TODO make a query array, iterate over queries
            // TODO add partial string matching
            $query = "SELECT * FROM recipie WHERE title ='". $_GET['search'] ."'";  
            // TODO add country lookup
            // TODO add cooking components
        }
        $result = $conn->query_database($query);
        // TODO query all queries, join the arrays into a big atomic one.
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
    <?php require 'templates/footer.php' ?>
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
