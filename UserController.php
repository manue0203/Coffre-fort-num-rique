<?php
require_once("../Models/user.php");
session_start();

    function init(){
        $date = date('Y-m-d H:i:s');
        if (!file_exists("./errors.log")) {
        file_put_contents("./errors.log", "=== Fichier de log créé le " . date("Y-m-d H:i:s") . " ===\n",FILE_APPEND);
        }
    }




function ctrllogin($user, $password) { // fonction servant à vérifier les informatioons de l'utilisateur lors de la connexion au compte
    $date = date('Y-m-d H:i:s');
    $us = new User();
    $resultat = $us->verif($user);

    if ($resultat && password_verify($password, $resultat['password'])) { // test pour vérifier la correspondance du mot de passe saisie à ce qui est dans la bdd
            $success = true;
    }
    else{
        echo"Erreur de connection";
        $success = false;
    }
    
    if ($success) {
        error_log("Connexion réussie pour : $user à $date\n", 0, "./errors.log");
        $_SESSION['login']=$user;
        return true;
    } else {
        error_log("Échec de connexion pour : $user à $date\n", 0, "./errors.log");
        return false;
    }
}

function strongPassword($password):bool{ // fonction servant à déterminer la force d'un mot de passe
    $compteur=0;
    $long=strlen($password);
    if ($long>=12){
        $compteur+=1;
    }
    if (preg_match("/[A-Z]/",$password)){
        $compteur+=1;
    }
    if (preg_match("/[a-z]/",$password)){
        $compteur+=1;
    }
    if (preg_match("/[0-9]/",$password)){
        $compteur+=1;
    }
    if (preg_match("/[\W]/", $password)){
        $compteur+=1;
    }
    if ($compteur==5){
        error_log("Force du mot de passe OK\n", 3, "./errors.log");
        //  error_log("force de mot de passe ok",$compteur);
        return True;
    }
        
    else{
        error_log("Le mot de passe est faible\n", 3, "./errors.log");
        // error_log("mot de passe faible");
        return False;

    }
         
} 

// test unitaire
function runTest($input, $expected){
    $result=strongPassword($input);
    if($result == $expected){
        // error_log("Le test fonctionne bel et bien\n", 3, "./errors.log");
        echo"Le test fonctionne bel et bien"; //cela peut être utiliser par un message log (à tester)
    }
    else{
        // error_log("Le test ne fonctionne pas\n", 3, "./errors.log");
        echo"Le test ne fonctionne pas";
    }
}
runTest("Ergonominne@20", true); // test OK
runTest("D@rm1r",false); //pas la bonne taille
runTest("solution!8ùh",false); // pas de Majuscule
runTest("mIrabellaD0rt",false); // pas de symbole
runTest("@UBERG1NE!256",false); // pas de minuscule
runTest("Mavieesttropbelle!",false);// pas de chiffres




function ctrlinscription($password, $login, $mail) {
    $date = date('Y-m-d H:i:s');
    $result=strongPassword($password);
    if ($result==false) {
        echo "Mot de passe trop faible. Il doit contenir au moins 12 caractères, une majuscule, une minuscule, un chiffre et un symbole.";
        $success = false;
    }

    
    else{
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $us = new User();
        $us->inscription($login, $mail, $hashedPassword);
       
        $success = true;
    
        if ($success) {
            error_log("Inscription effectuée de l'utilisateur : $login à $date\n", 3, "./errors.log");
            // error_log("Inscription éffectué de l'utilisateur :". $login." à". $date."\n, 3", "./errors.log");
            return true;
        } 
        else {
            error_log("Inscription échoué de l'utilisateur :". $login." à". $date."\n, 3", "./errors.log");
            return false;
        }
    }
    
}
?>