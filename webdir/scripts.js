const recipes = [
  {
    title: 'Spaghetti Carbonara',
    country: 'Italien',
    imgUrl: 'https://www.springlane.de/magazin/wp-content/uploads/2021/04/Spaghetti_Carbonara_mit_Sahne_107637_Titelbild.jpg',
    description: 'Ein klassisches italienisches Pasta-Gericht mit Speck, Eiern und Parmesan.',
  },
  {
    title: 'Sushi',
    country: 'Japan',
    imgUrl: 'https://d12xickik43a9a.cloudfront.net/images/magazine/de/M73180-Sushi-Uramaki_71226-Q75-375.jpg',
    description: 'Eine japanische Spezialität, bei der Reis mit rohem Fisch, Meeresfrüchten und Gemüse kombiniert wird.',
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
