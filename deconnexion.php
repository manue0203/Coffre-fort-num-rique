<?php
session_start();
$login=$_SESSION['login'];
$date = date('Y-m-d H:i:s');
error_log("Déconnexion de l'utilisateur : $login à $date\n", 3, "./errors.log");
// error_log("Deconnexion de l'utilisateur :". $login." à". $date."\n, 3", "./errors.log");
session_destroy();
header('Location:connexion.php');
exit;
?>