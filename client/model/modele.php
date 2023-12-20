<?php
require_once("database.php");

class ModeleModel
{
    public function getModelesByMarqueId($marqueId)
    {
        $db = new Database();
        $conn = $db->connectDb();

        $query = "SELECT id, nom FROM modele WHERE idMarque = $marqueId";

        $modelesData = $db->request($conn, $query);
        $db->disconnectDb($conn);

        header('Content-Type: application/json');

        echo json_encode($modelesData);
    }
}

$modeleModel = new ModeleModel();

if (isset($_POST['marqueId'])) {
    $marqueId = $_POST['marqueId'];
    $modeleModel->getModelesByMarqueId($marqueId);
}
?>
