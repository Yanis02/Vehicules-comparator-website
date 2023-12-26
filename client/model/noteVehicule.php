<?php
require_once("database.php");

class NoteVehiculeModel
{
    public function addNote($idUtilisateur, $idVehicule, $valeur)
    {
        $db = new Database();
        $conn = $db->connectDb();

        
        $query = "INSERT INTO notevehicule (idUser, idVehicule, valeur) 
                  VALUES ('$idUtilisateur', '$idVehicule', '$valeur')";

        $db->request($conn, $query);
        $noteVehiculeId = $conn->lastInsertId();
        $db->disconnectDb($conn);

        return $noteVehiculeId;
    }
    public function getAverageNoteForVehicule($idVehicule)
    {
        $db = new Database();
        $conn = $db->connectDb();

        $query = "SELECT AVG(valeur) AS averageNote FROM notevehicule WHERE idVehicule = '$idVehicule'";
        $result = $db->request($conn, $query);

        $averageNote = ($result && !empty($result[0]['averageNote'])) ? $result[0]['averageNote'] : 0;

        $db->disconnectDb($conn);

        return $averageNote;
    }
}
?>
