<?php
require_once("database.php");

class UserModel
{
    public function addUser($nom, $prenom, $sexe, $dateNaissance, $address, $motDePasse)
    {
        $db = new Database();
        $conn = $db->connectDb();

       

        $query = "INSERT INTO utilisateur (nom, prenom, sexe, dateNaissance, address, motDePasse) 
                  VALUES ('$nom', '$prenom', '$sexe', '$dateNaissance', '$address', '$motDePasse')";

         $db->request($conn, $query);
         $userId=$conn->lastInsertId();
        $db->disconnectDb($conn);
        return $userId;
    }
    public function auth($username, $password)
    {
        $db = new Database();
        $conn = $db->connectDb();

       

        $query = "SELECT * FROM utilisateur WHERE address = '$username'";
        $result = $db->request($conn, $query);

        if ($result && count($result) > 0) {
            $user = $result[0];
            
            if ($password==$user['motDePasse']) {
                
                $db->disconnectDb($conn);
                return $user;
            }
        }

        $db->disconnectDb($conn);
        return false;
    }
}



?>
