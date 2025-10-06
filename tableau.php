<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Formulaire de fichiers</title>
</head>
<body>
    <h1>Tableau</h1>
    <h3>Bienvenue sur votre tableau de fichiers</h3>
   
    <form method="POST" action="tableau.php" enctype="multipart/form-data" >
        <table border="1">
        <tr>
            <td>Fichier</td>
            <td>Date</td>
        </tr>
        <!-- <tr>
            <td>nom à mettre</td> et chercher à savoir pourquoi dans la partie du formulaire la partie fichier n'est pas comme les autres 
        </tr> -->
        </table>
        <input type="file" name="nameDoc"><br> 
        <input type="text" id="nameUser" name="nameUser" placeholder="nameUser" required><br>
        <input type="date" id="date" name="date" placeholder="date" required><br>
        <button type="submit" name="upload" >Ajouter</p></button>
    </form>
    <br>
    <form method="POST" action="tableau.php">
        <input type="text" name="nameDoc" placeholder="Nom du fichier à supprimer" required><br>
        <button type="submit" name="delete">Supprimer</button>
    </form>
        
        
 <a href="deconnexion.php">Déconnexion</a>
</body>
</html>
<?php

require_once("../Controllers/FileController.php");
$ctrl = new FileController();


if (isset($_POST['upload'])) {
    $file = $_FILES['nameDoc'];
    $nameUser = $_POST['nameUser'];
    $date = $_POST['date'];
    if (isset($_FILES['nameDoc']) && $_FILES['nameDoc']['error'] === 0) {
        if ($ctrl->add($file, $nameUser)) {
            echo "L'enregistrement a réussi !";
        } 
        else {
            echo " Fichier non ajouté.";
        }
    } 
    else {
        echo "Aucun fichier n'a été reçu.";
    }
    
    
    
}
    if (isset($_POST['delete'])) {
        $nameDoc = $_POST['nameDoc'];

        if ($ctrl->delete($nameDoc)) {
            echo "Fichier supprimé avec succès !";
        } 
        else {
            echo "Échec de la suppression.";
        }
    }

    
