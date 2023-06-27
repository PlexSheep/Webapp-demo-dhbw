<?php 
require "common.php"; 
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <?php require 'templates/head.php' ?>
</head>
<body>
    <?php require 'templates/header.php' ?>
    <main>
        <section class="account">
            <h1>Mein Konto</h1>
            <div class="account-choice">
                <button onclick="toggleLogin()" class="choice-btn active-choice" id="loginChoice">Anmelden/Registrieren</button>
                <!--<button onclick="toggleReg()" class="choice-btn" id="registerChoice">Registrieren</button> -->
            </div>
            <div class="form-container">
                <div style="display: block;" id="loginForm" class="form-content active-choice">
                    <form action="/auth/login.php" method="post">
                        <label for="email">E-Mail-Adresse:</label>
                        <input type="email" class="form-control" id="email" name="MAIL" required>
                        <br>
                        <label for="password">Passwort:</label>
                        <input type="password" class="form-control" id="password" name="PASS" required>
                        <br>
                        <input type="submit" value="Anmelden">
                    </form>
            </div>                        
            <div style="display: none;" id="registerForm" class="form-content">
                    <form action="/auth/register.php" method="post">
                        <label for="reg-user">Nutzername:</label>
                        <input type="username" class="form-control" id="reg-email" name="USER" required>
                        <br>
                        <label for="reg-email">E-Mail-Adresse:</label>
                        <input type="email" class="form-control" id="reg-email" name="MAIL" required>
                        <br>
                        <label for="reg-password">Passwort:</label>
                        <input type="password" class="form-control" id="reg-password" name="PASS" required>
                        <br>
                        <label for="reg-password-confirm">Passwort bestätigen:</label>
                        <input type="password" class="form-control" id="reg-password-confirm" name="reg-password-confirm" required>
                        <br>
                        <input type="submit" value="Registrieren">
                    </form>
            </div>
            <div>
                <?php 
                if (isset($_SESSION['ERROR'])) {
                    echo($_SESSION['ERROR']);
                    unset($_SESSION['ERROR']);
                }  
                ?>
            </div>
            <script>
                var login = document.getElementById('loginForm');
                var register = document.getElementById('registerForm');
                function toggleLogin() {
                    console.log("Toggle: ");
                    if (login.style.display === 'none') {
                        console.log("visible");
                        login.style.display = 'block';
                        register.style.display = 'none'
                    } else {
                        console.log("invisible");
                        login.style.display = 'none';
                        register.style.display = 'block'
                    }
                }
                function toggleReg() {
                    console.log("Toggle: ");
                    if (register.style.display === 'none') {
                        console.log("visible");
                        register.style.display = 'block';
                        login.style.display = 'none';
                    } else {
                        console.log("invisible");
                        register.style.display = 'none';
                        login.style.display = 'block';
                    }
                }
            </script>
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
    <?php require 'templates/footer.php' ?>
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
</body>
</html>
