<?php
require_once("../Models/file.php");

class FileController {
    private $fichier;

    function __construct() {
        $this->fichier = new File();
    }

    function add($file, $nameUser) { // méthode pour ajouter les fichiers selon le nom de l'utilisateur 
        $date = date('Y-m-d H:i:s');

        if (!isset($file) || $file['error'] !== 0) { // regarde si il y a aune erreur et retourne le problème qui se pose tout en retournant un message par rapport à ça 
            error_log("Aucun fichier valide reçu à $date\n", 3, "./errors.log");
            return false;
        }

        $destination="uploads";
        $nameDoc = basename($file['name']);
        $tmpPath = $file['tmp_name'];

        if (move_uploaded_file($tmpPath, $destination)) { // télécharge un fichier quelconque dans la base de données 
            $model = new File();
            error_log("Le fichier a bien été ajouté à la base de donné à: $date\n", 3, "./errors.log");
            return $model->addFile($nameDoc, $nameUser, $date);
        }   
        else {
            error_log("Échec du déplacement du fichier à $date\n", 3, "./errors.log");
            return false;
        }

    
    }
    function delete($nameDoc) { // fonction pour supprimer un fichier 
        $chemin = "uploads/" . $nameDoc;

        if (file_exists($chemin)) {
            unlink($chemin);
            $model = new File();
            error_log("Le fichier à bien été supprimer : $nameDoc\n", 3, "./errors.log");
            return $model->deleteFile($nameDoc);

        } 
        else {
            error_log("Fichier introuvable : $nameDoc\n", 3, "./errors.log");
            return false;
        }
    }




    
// }
}