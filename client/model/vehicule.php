<?php
require_once("database.php");

class VehiculeModel
{
    public function getAnneeByVersionId($versionId)
    {
        $db = new Database();
        $conn = $db->connectDb();

        $query = "SELECT id, annee FROM vehicule WHERE idVersion = $versionId";

        $modelesData = $db->request($conn, $query);
        $db->disconnectDb($conn);

        header('Content-Type: application/json');

        echo json_encode($modelesData);
    }
}
$modeleModel = new VehiculeModel();

if (isset($_POST['versionId'])) {
    $versionId = $_POST['versionId'];
    $modeleModel->getAnneeByVersionId($versionId);
}
 ?>