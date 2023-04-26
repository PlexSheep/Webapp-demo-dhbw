<?php
// require the common.php stuff
require 'common.php';
session_start();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <a href="http://localhost:8080"><title>Rezepti</title></a>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
    <?php require 'templates/header.php' ?>
    </header>
    <main>
        <section class="hero">
            <form action="search.php" method="get">
                <input type="search" name="search" id="search" placeholder="Suche nach Rezepten, Zutaten oder Ländern">
                <input type="submit" value="Los">
            </form>
            <h1>Schmecke die Welt</h1>
        </section>
        <section class="featured-recipes">
            <h2>Beliebte Rezepte</h2>
            <div class="recipe-grid">
            </div>
        </section>
    </main>
    <footer>
    <?php require 'templates/footer.php' ?>
    </footer>
    <script>
      const recipes = [
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
        const recipeGrid = document.querySelector('.recipe-grid');
        
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
