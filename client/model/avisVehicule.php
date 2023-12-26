<?php

require_once("database.php");

class AvisVehiculeModel
{
    public function addAvis($userId, $vehiculeId, $valeur)
    {
        $db = new Database();
        $conn = $db->connectDb();

        // Default values
        $nbAppreciation = 0;
        $approuve = 0;

        $query = "INSERT INTO avisvehicule (idUser, idVehicule, valeur, nbAppreciations, approuve) 
                  VALUES ('$userId', '$vehiculeId', '$valeur', '$nbAppreciation', '$approuve')";

        $db->request($conn, $query);
        $avisId = $conn->lastInsertId();
        $db->disconnectDb($conn);

        return $avisId;
    }
}

?>
