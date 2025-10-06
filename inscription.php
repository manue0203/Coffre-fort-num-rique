<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de compte</title>
</head>
<body>
    <form action="inscription.php" method="POST">
        <input type="password" id="password" name="password" placeholder="Mot de passe" required><br>
        <input type="text" id="login" name="login" placeholder="Login" required><br>
        <input type="mail" id="mail" name="mail" placeholder="Mail" required><br>
        <button type="submit">OK</p></button>
    </form>
</body>

<?php
require_once("../Controllers/UserController.php");

if (isset( $_POST['password'],$_POST['login'], $_POST['mail'])) {
    $password = $_POST['password'];
    $login = $_POST['login'];
    $mail = $_POST['mail'];
  

    if (ctrlinscription($password, $login, $mail)) {
        echo "l'inscription a réussie !";
        header("Location: connexion.php");
        exit();
    } else {
        echo " L'une des informations est déjà utilisé.";
    }
}

?>

