<?php
require_once('functions.php');

function sanitizeInput($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
    $username = sanitizeInput($_POST['username']);
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);

    $result = saveUser($username, $email, $password);
    if($result === true) {
        header('Location: index.php');
    } else {
        echo "Une erreur est survenue " . $result;
    }
}
?>


<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ma super app sécurisée - Inscription</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Inscription</h1>
    <form action="/register.php" method="post" class="needs-validation" novalidate onsubmit="return validatePassword()">
        <div class="form-group">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" class="form-control" id="username" name="username" required>
        <div class="invalid-feedback">
            S'il vous plaît entrez un nom d'utilisateur.
        </div>
    </div>
    <div class="form-group">
        <label for="email">Adresse email :</label>
        <input type="email" class="form-control" id="email" name="email" required>
        <div class="invalid-feedback">
            S'il vous plaît entrez une adresse email valide.
        </div>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe :</label>
        <input type="password" class="form-control" id="password" name="password" required>
        <div class="invalid-feedback">
            S'il vous plaît entrez un mot de passe.
        </div>
        <small id="passwordError" class="form-text text-danger"></small>
    </div>
    <div class="form-group">
        <label for="password-confirm">Confirmez le mot de passe :</label>
        <input type="password" class="form-control" id="password-confirm" name="password-confirm" required>
        <div class="invalid-feedback">
            S'il vous plaît confirmez votre mot de passe.
        </div>
    </div>
    <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
    <script>
        var password = document.getElementById("password");
        var confirm_password = document.getElementById("password-confirm");

        function validatePassword() {
            const passwordValue = password.value;
            const errorMessage = document.getElementById('passwordError');
            const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            if (!regex.test(passwordValue)) {
                errorMessage.textContent = 'Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.';
                return false;
            }
            errorMessage.textContent = '';

            if (passwordValue != confirm_password.value) {
                confirm_password.setCustomValidity("Les mots de passe ne correspondent pas");
                return false;
            } else {
                confirm_password.setCustomValidity('');
                return true;
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    </script>
</div>
</body>
</html>