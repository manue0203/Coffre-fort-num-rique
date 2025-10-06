<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="connexion.php" method="POST">
        <input type="text" id="login" name="login" placeholder="Login" required><br>
        <input type="password" id="password" name="password" placeholder="Mot de passe" required><br>
        <button type="submit">Se connecter</button>
        <a href="inscription.php">Inscription</a>
    </form>
</body>
</html>

<?php

require_once("../Controllers/UserController.php");

if (isset($_POST['login'], $_POST['password'])) {
    $login=$_POST['login'];
    $password = $_POST['password']; 

    init();

    if (ctrllogin($login, $password)) {
        header("Location: tableau.php");
        exit();
    }
}

    
?>