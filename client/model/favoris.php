<?php
require_once("database.php");

class FavorisModel
{
    public function addFavoris($idUtilisateur, $idVehicule)
    {
        $db = new Database();
        $conn = $db->connectDb();

        $queryCheck = "SELECT * FROM favoris WHERE idUser = '$idUtilisateur' AND idVehicule = '$idVehicule'";
        $resultCheck = $db->request($conn, $queryCheck);

        if ($resultCheck && count($resultCheck) > 0) {
            // Favoris entry already exists, return false
            $db->disconnectDb($conn);
            return false;
        }

        // Add new favoris entry
        $query = "INSERT INTO favoris (idUser, idVehicule) 
                  VALUES ('$idUtilisateur', '$idVehicule')";

        $db->request($conn, $query);
        $favorisId = $conn->lastInsertId();
        $db->disconnectDb($conn);

        return $favorisId;
    }
    public function checkFavoris($idUtilisateur, $idVehicule)
    {
        $db = new Database();
        $conn = $db->connectDb();

        $queryCheck = "SELECT * FROM favoris WHERE idUser = '$idUtilisateur' AND idVehicule = '$idVehicule'";
        $resultCheck = $db->request($conn, $queryCheck);

        if ($resultCheck && count($resultCheck) > 0) {
            // Favoris entry already exists, return false
            $db->disconnectDb($conn);
            return false;
        }else return true;

        
    }
    public function deleteFavoris($idUser, $idVehicule)
    {
        $db = new Database();
        $conn = $db->connectDb();

        $query = "DELETE FROM favoris WHERE idUser = '$idUser' AND idVehicule = '$idVehicule'";

        $db->request($conn, $query);
        $db->disconnectDb($conn);
    }
}
?>
