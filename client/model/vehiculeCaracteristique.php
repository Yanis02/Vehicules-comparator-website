<?php
require_once("database.php");

class VehiCarModel
{
    public function getValues($idMarque, $idModele, $idVersion, $idVehicule)
    {
        $db = new Database();
        $conn = $db->connectDb();

        // Query to retrieve the names of the vehicles
        $queryNames = "
    SELECT CONCAT(m.nom, ' ', mo.nom, ' ', v.nom, ' ', a.annee) AS vehicule_name
    FROM marques m
    JOIN modele mo ON m.id = mo.idMarque
    JOIN version v ON mo.id = v.idModele
    JOIN vehicule a ON v.id = a.idVersion
    WHERE m.id = $idMarque AND mo.id = $idModele AND v.id = $idVersion AND a.id= $idVehicule;
";

        $vehiculeNameData = $db->request($conn, $queryNames);

        if ($vehiculeNameData) {
            $vehiculeName = $vehiculeNameData[0]['vehicule_name'];

            // Query to retrieve characteristics from the caracteristique table
            $queryCharacteristics = "
                SELECT id, nom
                FROM caracteristique;
            ";
            $characteristicsData = $db->request($conn, $queryCharacteristics);

            // Query to retrieve characteristic values by caracteristiqueId
            $queryCharacteristicValues = "
                SELECT c.id AS caracteristique_id, vc.valeur AS caracteristique_valeur
                FROM vehicule_caracteristique vc
                JOIN caracteristique c ON vc.idCaracteristique = c.id
                WHERE vc.idVehicule = $idVehicule;
            ";
            $characteristicValuesData = $db->request($conn, $queryCharacteristicValues);

            // Organize the characteristic values by caracteristiqueId
            $characteristicsValues = [];
            foreach ($characteristicValuesData as $row) {
                $characteristicsValues[$row['caracteristique_id']] = $row['caracteristique_valeur'];
            }
            $queryImagePaths = "
                SELECT chemin
                FROM imagesvehicules
                WHERE idVehicule = $idVehicule;
            ";
            $imagePathsData = $db->request($conn, $queryImagePaths);
            // Return the data
            $data = [
                'vehicule_id' => $idVehicule,
                'vehicule_name' => $vehiculeName,
                'characteristics' => $characteristicsData,
                'characteristics_values' => $characteristicsValues,
                'image_paths' => $imagePathsData
            ];

            $db->disconnectDb($conn);

            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }
}

$modeleModel = new VehiCarModel();
if (isset($_POST['idVehicule']) && isset($_POST['idMarque']) && isset($_POST['idModele']) && isset($_POST['idVersion'])) {
    $idVehicule = $_POST['idVehicule'];
    $idMarque = $_POST['idMarque'];
    $idModele = $_POST['idModele'];
    $idVersion = $_POST['idVersion'];
    $modeleModel->getValues($idMarque, $idModele, $idVersion, $idVehicule);
}
?>
