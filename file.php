<?php
class File {
    private $pdo;

    // Connexion à la base de données
    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=coffre;charset=utf8","root","", array(PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION));
        } 
        catch (PDOException $ex) {
            die("Erreur de connexion : " . $ex->getMessage());
        }
    }

    public function addFile($nameDoc, $nameUser){ // si on est déjà sur le tableau d'un utilisateur qu'on connait pourquoi avoir recourt à son nom
        $sql="INSERT INTO file(nameDoc, nameUser) VALUES (:nameDoc, :nameUser) ";
        $result= $this->pdo->prepare($sql);
        $result->bindParam(':nameDoc', $nameDoc);
        $result->bindParam(':nameUser',$nameUser);
        return $result->execute(); // retrourne quelque chose qu'on doit à tout pris récupérer dans l'un de mes fichiers 

    }

    public function deleteFile($nameDoc){ //fonction pour pouvoir supprimer le fichier se trouvant déjà dans la base de données 
        $sql="DELETE FROM file WHERE nameDoc= :nameDoc";
        $result=$this->pdo->prepare($sql);
        $result->bindParam(':nameDoc', $nameDoc);
        return $result->execute();
    }

   

}

?>