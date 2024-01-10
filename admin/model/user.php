<?php
require_once("database.php");
class UserModel{
    public function bloquer($id){
        $db = new Database();
       $conn = $db->connectDb();
       $req = "UPDATE utilisateur SET bloque =1 WHERE id = $id";
   
           $db->request($conn,$req);
   
           $db->disconnectDb($conn);
   }
   public function debloquer($id){
    $db = new Database();
   $conn = $db->connectDb();
   $req = "UPDATE utilisateur SET bloque =0 WHERE id = $id";

       $db->request($conn,$req);

       $db->disconnectDb($conn);
}
public function valider($id){
    $db = new Database();
   $conn = $db->connectDb();
   $req = "UPDATE utilisateur SET valide =1 WHERE id = $id";

       $db->request($conn,$req);

       $db->disconnectDb($conn);
}
public function getAllUsers(){
    $db = new Database();
    $conn = $db->connectDb();
    $req = "SELECT * FROM utilisateur;";
 
        $users=$db->request($conn,$req);
 
        $db->disconnectDb($conn);
        return $users;
}
public function getUserById($id){
    $db = new Database();
    $conn = $db->connectDb();
    $req = "SELECT * FROM utilisateur WHERE id=$id;";
 
        $users=$db->request($conn,$req);
 
        $db->disconnectDb($conn);
        return $users;
}
public function getAllFavoris($idUser){
    $db = new Database();
    $conn = $db->connectDb();

    $query = "SELECT * FROM favoris WHERE idUser = '$idUser' ";

    $result=$db->request($conn, $query);
    $db->disconnectDb($conn);
    return $result;
}
}

?>