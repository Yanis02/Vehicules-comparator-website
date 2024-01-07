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
    public function getVehiculeById($vehiculeId)
    {
        
        $db = new Database();
        $conn = $db->connectDb();
    
        $query = "SELECT vehicule.id as vehicule_id, vehicule.type as vehicule_type, vehicule.annee as vehicule_annee, 
                         version.id as version_id, version.nom as version_nom, 
                         modele.id as model_id, modele.nom as modele_nom,
                         modele.idMarque as marque_id
                  FROM vehicule
                  LEFT JOIN version ON vehicule.idVersion = version.id
                  LEFT JOIN modele ON version.idModele = modele.id
                  WHERE vehicule.id = $vehiculeId
                  ";
    
        $vehiculeData = $db->request($conn, $query);
    
        $result = array();
        foreach ($vehiculeData as $item) {
            $idVehicule = $item['vehicule_id'];
            $idVersion = $item['version_id'];
            $idModele = $item['model_id'];
            $idMarque = $item['marque_id'];
            $type=$item["vehicule_type"];
            $annee=$item["vehicule_annee"];
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
    
                $queryCharacteristics = "
                    SELECT id, nom
                    FROM caracteristique;
                ";
                $characteristicsData = $db->request($conn, $queryCharacteristics);
    
                $queryCharacteristicValues = "
                    SELECT c.id AS caracteristique_id, vc.valeur AS caracteristique_valeur
                    FROM vehicule_caracteristique vc
                    JOIN caracteristique c ON vc.idCaracteristique = c.id
                    WHERE vc.idVehicule = $idVehicule;
                ";
                $characteristicValuesData = $db->request($conn, $queryCharacteristicValues);
    
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
    
                $data = [
                    'vehicule_id' => $idVehicule,
                    'vehicule_name' => $vehiculeName,
                    'characteristics' => $characteristicsData,
                    'characteristics_values' => $characteristicsValues,
                    'image_paths' => $imagePathsData,
                    'marque_id' => $idMarque,
                    'version_id' => $idVersion,
                    'modele_id' => $idModele,
                    "vehicule_type"=> $type,
                    "vehicule_annee"=>$annee
                ];
    
                $result[] = $data;
            }
        }
    
        $db->disconnectDb($conn);
         
        return array_values($result);
    }

}
$modeleModel = new VehiculeModel();

if (isset($_POST['versionId'])) {
    $versionId = $_POST['versionId'];
    $modeleModel->getAnneeByVersionId($versionId);
}
 ?>