<?php

require_once("database.php");

class VersionModel
{
    public function getVersionsByModeleId($modeleId)
    {
        $db = new Database();
        $conn = $db->connectDb();

        $query = "SELECT id, nom FROM version WHERE idModele = $modeleId";

        $versionsData = $db->request($conn, $query);
        $db->disconnectDb($conn);

        header('Content-Type: application/json');
        echo json_encode($versionsData);
    }
}
$modeleModel = new VersionModel();

if (isset($_POST['modeleId'])) {
    $modeleId = $_POST['modeleId'];
    $modeleModel->getVersionsByModeleId($modeleId);
}
?>
