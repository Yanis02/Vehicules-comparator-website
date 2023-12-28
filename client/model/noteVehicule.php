<?php
require_once("database.php");

class NoteVehiculeModel
{
    public function addNote($idUtilisateur, $idVehicule, $valeur)
{
    $db = new Database();
    $conn = $db->connectDb();

    $existingNoteQuery = "SELECT id FROM notevehicule WHERE idUser = '$idUtilisateur' AND idVehicule = '$idVehicule'";
    $existingNoteResult = $db->request($conn, $existingNoteQuery);

    if ($existingNoteResult) {
        $noteId = $existingNoteResult[0]['id'];
        $updateQuery = "UPDATE notevehicule SET valeur = '$valeur' WHERE id = '$noteId'";
        $db->request($conn, $updateQuery);
        $db->disconnectDb($conn);
        return false;
    } else {
        $insertQuery = "INSERT INTO notevehicule (idUser, idVehicule, valeur) 
                        VALUES ('$idUtilisateur', '$idVehicule', '$valeur')";
        $db->request($conn, $insertQuery);
        $noteVehiculeId = $conn->lastInsertId();
        $db->disconnectDb($conn);
        return true;
    }
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
