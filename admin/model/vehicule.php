<?php
require_once("database.php");

class VehiculeModel{
    private $db;

    public function __construct() {
        $this->db = new Database();
    }
    public function getAllVehicules()
{
    
    $conn =$this->db->connectDb();

    $query = "SELECT vehicule.id as vehicule_id, vehicule.type, vehicule.annee as vehicule_annee, 
                     version.id as version_id, version.nom as version_nom, 
                     modele.id as model_id, modele.nom as modele_nom,
                     modele.idMarque as marque_id
              FROM vehicule
              LEFT JOIN version ON vehicule.idVersion = version.id
              LEFT JOIN modele ON version.idModele = modele.id
              
              ";

    $vehiculeData = $this->db->request($conn, $query);

    $result = array();
    foreach ($vehiculeData as $item) {
        $idVehicule = $item['vehicule_id'];
        $idVersion = $item['version_id'];
        $idModele = $item['model_id'];
        $idMarque = $item['marque_id'];
        $nomModele=$item['modele_nom'];
        $nomVersion=$item['version_nom'];
        $anneeVehicule=$item['vehicule_annee'];
        $req="SELECT marques.nom as marque_nom from marques WHERE marques.id = $idMarque ";
        $nomMarque=$this->db->request($conn,$req);
        $queryNames = "
            SELECT CONCAT(m.nom, ' ', mo.nom, ' ', v.nom, ' ', a.annee) AS vehicule_name
            FROM marques m
            JOIN modele mo ON m.id = mo.idMarque
            JOIN version v ON mo.id = v.idModele
            JOIN vehicule a ON v.id = a.idVersion
            WHERE m.id = $idMarque AND mo.id = $idModele AND v.id = $idVersion AND a.id= $idVehicule;
        ";

        $vehiculeNameData = $this->db->request($conn, $queryNames);

        if ($vehiculeNameData) {
            $vehiculeName = $vehiculeNameData[0]['vehicule_name'];
            $data = [
                'vehicule_id' => $idVehicule,
                'vehicule_name' => $vehiculeName,
                "marque_nom"=>$nomMarque[0]["marque_nom"],
                "modele_nom"=>$nomModele,
                "version_nom"=>$nomVersion,
                "annee"=>$anneeVehicule,
                'marque_id' => $idMarque,
                'version_id' => $idVersion,
                'modele_id' => $idModele
            ];

            $result[] = $data;
        }
    }

    $this->db->disconnectDb($conn);
     
    return array_values($result);
}
public function getVehiculeById($vehiculeId)
{
    $conn = $this->db->connectDb();

    $query = "SELECT vehicule.id as vehicule_id, vehicule.type as vehicule_type, vehicule.annee as vehicule_annee, 
                     version.id as version_id, version.nom as version_nom, 
                     modele.id as model_id, modele.nom as modele_nom,
                     modele.idMarque as marque_id
              FROM vehicule
              LEFT JOIN version ON vehicule.idVersion = version.id
              LEFT JOIN modele ON version.idModele = modele.id
              WHERE vehicule.id = $vehiculeId
              ";

    $vehiculeData = $this->db->request($conn, $query);

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

        $vehiculeNameData = $this->db->request($conn, $queryNames);

        if ($vehiculeNameData) {
            $vehiculeName = $vehiculeNameData[0]['vehicule_name'];

            $queryCharacteristics = "
                SELECT id, nom
                FROM caracteristique;
            ";
            $characteristicsData = $this->db->request($conn, $queryCharacteristics);

            $queryCharacteristicValues = "
                SELECT c.id AS caracteristique_id, vc.valeur AS caracteristique_valeur
                FROM vehicule_caracteristique vc
                JOIN caracteristique c ON vc.idCaracteristique = c.id
                WHERE vc.idVehicule = $idVehicule;
            ";
            $characteristicValuesData = $this->db->request($conn, $queryCharacteristicValues);

            $characteristicsValues = [];
            foreach ($characteristicValuesData as $row) {
                $characteristicsValues[$row['caracteristique_id']] = $row['caracteristique_valeur'];
            }

            $queryImagePaths = "
                SELECT chemin
                FROM imagesvehicules
                WHERE idVehicule = $idVehicule;
            ";
            $imagePathsData = $this->db->request($conn, $queryImagePaths);

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

    $this->db->disconnectDb($conn);
     
    return array_values($result);
}
public function updateValue($idVehicule, $idCharacteristic, $newValue){
    $conn = $this->db->connectDb();

    $query = "
    UPDATE vehicule_caracteristique
    SET valeur = '$newValue'
    WHERE idVehicule = $idVehicule AND idCaracteristique = $idCharacteristic;
 ";
   $result= $this->db->request($conn, $query);
   $this->db->disconnectDb($conn);
    header('Content-Type: application/json');
    echo json_encode($result);  
}
public function updateVehicule($id,$type,$annee){
    $conn = $this->db->connectDb();
    $query = "
    UPDATE vehicule
    SET type = '$type' , annee='$annee'
    WHERE id = $id;";
    $result=$this->db->request($conn, $query);
    $this->db->disconnectDb($conn);
    header('Content-Type: application/json');
    echo json_encode($result); 

}
public function addVehicule($versionId, $annee, $type) {
    $conn = $this->db->connectDb();

    $existingVehicleId = $this->getExistingVehicleId($versionId, $annee, $type);

    if ($existingVehicleId) {
        return false;
    } else {
        $query = "INSERT INTO vehicule (idVersion, annee, type) VALUES ($versionId, $annee, '$type')";

        $this->db->request($conn, $query);

        $newVehicleId = $conn->lastInsertId();

        $this->db->disconnectDb($conn);

        return $newVehicleId;
    }
}


private function getExistingVehicleId($versionId, $annee, $type) {
    $conn = $this->db->connectDb();

    $query = "SELECT id FROM vehicule WHERE idVersion = $versionId AND annee = $annee AND type = '$type'";
    $existingVehicleId = $this->db->request($conn,$query);
    $this->db->disconnectDb($conn);
    return !empty($existingVehicleId);
}
public function deleteVehicule($id){
    $db = new Database();
        $conn = $db->connectDb();
        $query = "DELETE FROM vehicule WHERE id = '$id'";
        $db->request($conn, $query);
        $db->disconnectDb($conn);
}

   
}
if (isset($_POST['idVehicule']) && isset($_POST['idCharacteristic']) && isset($_POST['newValue']) ) {
    $idVehicule=$_POST['idVehicule'];
    $idCharacteristic=$_POST['idCharacteristic'];
    $newValue=$_POST['newValue'];
    $VehiculeModel=new VehiculeModel();
    $VehiculeModel->updateValue($idVehicule, $idCharacteristic, $newValue);
   }
   if (isset($_POST['idVehicule']) && isset($_POST['type']) && isset($_POST['annee']) ) {
    $idVehicule=$_POST['idVehicule'];
    $typeV=$_POST['type'];
    $AnneeV=$_POST['annee'];
    $VehiculeModel=new VehiculeModel();
    $VehiculeModel->updateVehicule($idVehicule, $typeV, $AnneeV);
   }


?>