<?php
require_once("database.php");
class MarquesModel{
    public function getAllMarques()
    {
        $db = new Database();
        $conn = $db->connectDb();

        $query = "SELECT marques.id, marques.nom, marques.pays, marques.siege, marques.anne_creation, images.chemin 
                  FROM marques 
                  LEFT JOIN images ON marques.idImage = images.id";

        $marquesData = $db->request($conn, $query);
        $db->disconnectDb($conn);

        $result = array();
        foreach ($marquesData as $item) {
            $marqueId = $item['id'];
            if (!isset($result[$marqueId])) {
                $result[$marqueId] = array(
                    'id' => $item['id'],
                    'nom' => $item['nom'],
                    'pays' => $item['pays'],
                    'siege' => $item['siege'],
                    'anne_creation' => $item['anne_creation'],
                    'images' => array()
                );
            }

            if (!empty($item['chemin'])) {
                $result[$marqueId]['images'][] = $item['chemin'];
            }
        }

        return array_values($result); 
    }

    public function getMarquebyId($idMarque)
    {$db = new Database();
        $conn = $db->connectDb();        


        $query = "SELECT marques.id, marques.nom, marques.pays, marques.siege, marques.anne_creation, images.chemin 
                  FROM marques 
                  LEFT JOIN images ON marques.idImage = images.id WHERE marques.id=$idMarque";

        $marquesData = $db->request($conn, $query);
        $db->disconnectDb($conn);

        $result = array();
        foreach ($marquesData as $item) {
            $marqueId = $item['id'];
            if (!isset($result[$marqueId])) {
                $result[$marqueId] = array(
                    'id' => $item['id'],
                    'nom' => $item['nom'],
                    'pays' => $item['pays'],
                    'siege' => $item['siege'],
                    'anne_creation' => $item['anne_creation'],
                    'images' => array()
                );
            }

            if (!empty($item['chemin'])) {
                $result[$marqueId]['images'][] = $item['chemin'];
            }
        }

        return array_values($result); 
    }
   
    public function updateMarque($id,$nom,$pays,$siege,$annee){
        $db = new Database();
        $conn = $db->connectDb();        
        $query = "
        UPDATE marques
        SET nom = '$nom' ,pays = '$pays',siege = '$siege', anne_creation='$annee'
        WHERE id = $id;";
        $result=$db->request($conn, $query);
        $db->disconnectDb($conn);
        header('Content-Type: application/json');
        echo json_encode($result); 
    
    }
    private function getExistingMarqueId($nom,$pays,$siege,$annee,$lastId) {
        $db = new Database();
        $conn = $db->connectDb();    
        $query = "SELECT id FROM marques WHERE nom ='$nom' AND pays = '$pays' AND siege = '$siege' AND anne_creation = $annee AND idImage = $lastId ";
        $existingMarqueId = $db->request($conn,$query);
        $db->disconnectDb($conn);
        return !empty($existingMarqueId);
    }
    public function addMarque($nom,$pays,$siege,$annee,$lastId){
        $db = new Database();
        $conn = $db->connectDb();
    

    $existingMarqueId = $this->getExistingMarqueId($nom,$pays,$siege,$annee,$lastId);

    if ($existingMarqueId) {
        return false;
    } else {
        $query = "INSERT INTO marques (nom,pays,siege,anne_creation,idImage) VALUES ('$nom', '$pays', '$siege',$annee,$lastId);";
        $db->request($conn, $query);



        $db->disconnectDb($conn);

    }
    }
   public function deleteMarque($id){
    $db = new Database();
        $conn = $db->connectDb();
        $queryy = "SELECT * FROM marques WHERE id = '$id'";
        $result= $db->request($conn, $queryy);
        $idImg=$result[0]["idImage"];
        $query = "DELETE FROM images WHERE id = '$idImg'";
        $db->request($conn, $query);
        $db->disconnectDb($conn);
   }
   public function getAllVehicules($idMarque)
    {
        $db = new Database();
        $conn = $db->connectDb();
    
        $query = "SELECT vehicule.id as vehicule_id, vehicule.type, vehicule.annee as vehicule_annee, 
        version.id as version_id, version.nom as version_nom, 
        modele.id as model_id, modele.nom as modele_nom,
        modele.idMarque as marque_id
 FROM vehicule
 LEFT JOIN version ON vehicule.idVersion = version.id
 LEFT JOIN modele ON version.idModele = modele.id
                  WHERE modele.idMarque = $idMarque
                  ";
    
        $vehiculesData = $db->request($conn, $query);
    
        $result = array();
        foreach ($vehiculesData as $item) {
            $idVehicule = $item['vehicule_id'];
        $idVersion = $item['version_id'];
        $idModele = $item['model_id'];
        $idMarque = $item['marque_id'];
        $nomModele=$item['modele_nom'];
        $nomVersion=$item['version_nom'];
        $anneeVehicule=$item['vehicule_annee'];
        $req="SELECT marques.nom as marque_nom from marques WHERE marques.id = $idMarque ";
        $nomMarque=$db->request($conn,$req);
    
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
    
        $db->disconnectDb($conn);
    
        return $result;    }
}
if (isset($_POST['idMarque']) && isset($_POST['nom']) && isset($_POST['pays']) && isset($_POST['siege']) && isset($_POST['annee']) ) {
    $idMarque=$_POST['idMarque'];
    $nom=$_POST['nom'];
    $pays=$_POST['pays'];
    $siege=$_POST['siege'];
    $annee=$_POST['annee'];
    
    $marqueModel=new MarquesModel();
    $marqueModel->updateMarque($idMarque, $nom, $pays,$siege,$annee);
   }
?>