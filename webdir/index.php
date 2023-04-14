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
            </ul>
        </nav>
    </header>
    <main>
        <section class="hero">
            <h1>Entdecke Rezepte aus der ganzen Welt und erlebe eine globale Küchenreise</h1>
            <input type="search" placeholder="Suche nach Rezepten, Zutaten oder Ländern">
        </section>
        <section class="featured-recipes">
            <h2>Beliebte Rezepte</h2>
            <div class="recipe-grid">
                <!-- Hier können Sie Beispielrezepte einfügen -->
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
      const recipes = [
        {
          title: 'Spaghetti Carbonara',
          country: 'Italien',
          imgUrl: 'img/carbonara.png',
          description: 'Ein klassisches italienisches Pasta-Gericht mit Speck, Eiern und Parmesan.',
        },
        {
          title: 'Sushi',
          country: 'Japan',
          imgUrl: 'img/sushi.png',
          description: 'Eine japanische Spezialität, bei der Reis mit rohem Fisch, Meeresfrüchten und Gemüse kombiniert wird.',
        },
          {
        title: 'Chili con Carne',
        country: 'Mexiko',
        imgUrl: 'img/chilli.png',
        description: 'Ein herzhaftes Gericht aus Hackfleisch, Bohnen, Tomaten und Gewürzen, das perfekt zu Reis oder Tortilla-Chips passt.',
        },
        {
        title: 'Paella',
        country: 'Spanien',
        imgUrl: 'img/paella.png',
        description: 'Ein klassisches spanisches Reisgericht mit Meeresfrüchten, Hühnerfleisch, Chorizo und Gemüse, gekocht in einer großen flachen Pfanne.',
        },
        {
        title: 'Ratatouille',
        country: 'Frankreich',
        imgUrl: 'img/ratatouille-rezept-b3.png',
        description: 'Ein herzhaftes Gemüsegericht aus der französischen Provence, das aus Zucchini, Auberginen, Paprika, Tomaten und Zwiebeln besteht.',
        },
        {
        title: 'Pad Thai',
        country: 'Thailand',
        imgUrl: 'img/padthai.png',
        description: 'Ein beliebtes thailändisches Nudelgericht mit Reisnudeln, Eiern, Tofu, Garnelen oder Hühnchen, Bohnensprossen und einer süß-sauren Tamarindensauce.',
        },
        {
        title: 'Tacos',
        country: 'Mexiko',
        imgUrl: 'img/tacos.png',
        description: 'Kleine gefüllte Tortillas, gefüllt mit einer Vielzahl von Zutaten wie gegrilltem Fleisch, Bohnen, Käse, Gemüse und scharfen Saucen.',
        },
        {
        title: 'Currywurst',
        country: 'Deutschland',
        imgUrl: 'img/currywurst.png',
        description: 'Eine deutsche Fast-Food-Spezialität, die aus gebratenen oder gegrillten Würstchen besteht, die in Scheiben geschnitten und mit einer würzigen Ketchup-Curry-Sauce serviert werden.',
        },


        // Fügen Sie hier weitere Rezepte hinzu
      ];

      function displayRecipes() {
        const recipeGrid = document.querySelector('.recipe-grid');
        
        recipes.forEach(recipe => {
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
          
          recipeGrid.appendChild(recipeCard);
        });
      }

      displayRecipes();
    </script>
    
    
</body>
</html>
