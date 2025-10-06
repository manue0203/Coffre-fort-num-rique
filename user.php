<?php
class User {
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

    public function verif($login) {
    $sql = "SELECT login, password FROM user WHERE login = :login";
    $result = $this->pdo->prepare($sql);
    $result->bindParam(':login', $login);
    $result->execute();
    return $result->fetch(PDO::FETCH_ASSOC);
}
    // Inscrit un nouvel utilisateur avec des requêtes préparées
    public function inscription($login, $mail, $hashedPassword) {
        $sql = "INSERT INTO user (login, mail, password) VALUES (:login, :mail, :password)";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':login', $login);
        $result->bindParam(':mail', $mail);
        $result->bindParam(':password', $hashedPassword);
        return $result->execute();
    }


    
}

    

    


?>