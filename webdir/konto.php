<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezepti</title>
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
                <li><a href="konto.html" class="active">Konto</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="account">
            <h1>Mein Konto</h1>
            <div class="account-choice">
                <button class="choice-btn active-choice" id="loginChoice">Anmelden</button>
                <button class="choice-btn" id="registerChoice">Registrieren</button>
            </div>
            <div class="form-container">
                <div id="loginForm" class="form-content active-choice">
                    <form>
                        <label for="email">E-Mail-Adresse:</label>
                        <input type="email" id="email" name="email" required>
                        <br>
                        <label for="password">Passwort:</label>
                        <input type="password" id="password" name="password" required>
                        <br>
                        <input type="submit" value="Anmelden">
                    </form>
                </div>
                <div id="registerForm" class="form-content">
                    <form>
                        <label for="reg-email">E-Mail-Adresse:</label>
                        <input type="email" id="reg-email" name="reg-email" required>
                        <br>
                        <label for="reg-password">Passwort:</label>
                        <input type="password" id="reg-password" name="reg-password" required>
                        <br>
                        <label for="reg-password-confirm">Passwort bestätigen:</label>
                        <input type="password" id="reg-password-confirm" name="reg-password-confirm" required>
                        <br>
                        <input type="submit" value="Registrieren">
                    </form>
                </div>
            </div>
            <div id="profile" class="profile-content" style="display: none;">
                <h2>Willkommen, [Benutzername]!</h2>
                <div id="newRecipeForm" class="form-content" style="display: none;">
    <form id="recipeForm">
        <label for="recipeTitle">Rezepttitel:</label>
        <input type="text" id="recipeTitle" name="recipeTitle" required>
        <br>
        <label for="recipeCountry">Land:</label>
        <input type="text" id="recipeCountry" name="recipeCountry" required>
        <br>
        <label for="recipeIngredients">Zutaten:</label>
        <textarea id="recipeIngredients" name="recipeIngredients" required></textarea>
        <br>
        <label for="recipeInstructions">Zubereitung:</label>
        <textarea id="recipeInstructions" name="recipeInstructions" required></textarea>
        <br>
        <input type="submit" value="Rezept erstellen">
    </form>
</div>

         <button id="createRecipeBtn">Neues Rezept erstellen</button>

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
    document.getElementById('createRecipeBtn').addEventListener('click', createRecipe);

    function createRecipe() {
        // Verstecken Sie den Erstellen-Button und zeigen Sie das Formular zum Erstellen eines Rezepts an
        const createRecipeBtn = document.getElementById('createRecipeBtn');
        const newRecipeForm = document.getElementById('newRecipeForm');
        createRecipeBtn.style.display = 'none';
        newRecipeForm.style.display = 'block';

        // Fügen Sie einen Eventlistener zum Formular hinzu, um die Daten zu erfassen, wenn das Formular abgeschickt wird
        const recipeForm = document.getElementById('recipeForm');
        recipeForm.addEventListener('submit', (event) => {
            event.preventDefault();

            const recipeTitle = document.getElementById('recipeTitle').value;
            const recipeCountry = document.getElementById('recipeCountry').value;
            const recipeIngredients = document.getElementById('recipeIngredients').value;
            const recipeInstructions = document.getElementById('recipeInstructions').value;

            const recipeData = {
                title: recipeTitle,
                country: recipeCountry,
                ingredients: recipeIngredients,
                instructions: recipeInstructions
            };

            // Senden Sie die Rezeptdaten an Ihren Server, um sie dort zu speichern und zu verarbeiten
            console.log(recipeData);

            // Navigieren Sie zurück zum Erstellen-Button, nachdem das Rezept erstellt wurde (optional)
            newRecipeForm.style.display = 'none';
            createRecipeBtn.style.display = 'block';
        });
    }

    const loginChoice = document.getElementById('loginChoice');
    const registerChoice = document.getElementById('registerChoice');
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const choiceBtns = document.getElementsByClassName('choice-btn');
    const formContents = document.getElementsByClassName('form-content');

    loginChoice.addEventListener('click', () => {
        changeActiveChoice(loginChoice, loginForm);
    });

    registerChoice.addEventListener('click', () => {
        changeActiveChoice(registerChoice, registerForm);
    });

    function changeActiveChoice(choiceBtn, formContent) {
        for (let i = 0; i < choiceBtns.length; i++) {
            choiceBtns[i].classList.remove('active-choice');
        }
        for (let i = 0; i < formContents.length; i++) {
            formContents[i].classList.remove('active-choice');
        }
        choiceBtn.classList.add('active-choice');
        formContent.classList.add('active-choice');
    }
</script>


