<?php
require_once('functions.php');
session_start();
$csrfToken = generateCsrfToken();


$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
    if (!isset($_POST['csrf_token']) || !validateCsrfToken($_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }

    $users = logUser($_POST['email'], $_POST['password']);
    if(!empty($users)) {
        $user = $users[0];
        $_SESSION['user'] = $user;
    }
}
?>

<html>
<head>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Oué</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css"
              integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu"
              crossorigin="anonymous">
    </head>
</head>
<body>
<div class="container">
    <?php if(!$user): ?>
    <h1>Connexion</h1>
        <form action="/" method="POST">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group">
                <label for="stayConnected">Rester connecté</label>
                <input name="stayConnected" type="checkbox" id="stayConnected">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    <a href="register.php">Je m'inscrit</a>
    <?php else: ?>
        <h1>Bienvenue <?= $user->email ?></h1>
    <a href="informations.php?id=<?= $user->id ?>">Mes informations</a><br/>
    <a href="logout.php">Logout</a>
    <?php endif ?>
</div>
</body>
</html>