<?php
require_once("database.php");

class NoteMarqueModel
{
    public function addNote($idUtilisateur, $idMarque, $valeur)
    {
        $db = new Database();
        $conn = $db->connectDb();

        $existingNoteQuery = "SELECT id FROM notemarque WHERE idUser = '$idUtilisateur' AND idMarque = '$idMarque'";
        $existingNoteResult = $db->request($conn, $existingNoteQuery);

        if ($existingNoteResult) {
            $noteId = $existingNoteResult[0]['id'];
            $updateQuery = "UPDATE notemarque SET valeur = '$valeur' WHERE id = '$noteId'";
            $db->request($conn, $updateQuery);
            $db->disconnectDb($conn);
            return false;
        } else {
            $insertQuery = "INSERT INTO notemarque (idUser, idMarque, valeur) VALUES ('$idUtilisateur', '$idMarque', '$valeur')";
            $db->request($conn, $insertQuery);
            $db->disconnectDb($conn);
            return true;
        }

        
    }

    public function getAverageNoteForMarque($idMarque)
    {
        $db = new Database();
        $conn = $db->connectDb();

        $query = "SELECT AVG(valeur) AS averageNote FROM notemarque WHERE idMarque = '$idMarque'";
        $result = $db->request($conn, $query);

        $averageNote = ($result && !empty($result[0]['averageNote'])) ? $result[0]['averageNote'] : 0;

        $db->disconnectDb($conn);

        return $averageNote;
    }
}
?>
