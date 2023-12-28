<?php
require_once("database.php");

class AvisMarqueModel
{
    public function addAvis($idUtilisateur, $idMarque, $valeur)
    {
        $db = new Database();
        $conn = $db->connectDb();

        $query = "INSERT INTO avismarque (idUser, idMarque, valeur) 
                  VALUES ('$idUtilisateur', '$idMarque', '$valeur')";

        $db->request($conn, $query);
        $avisMarqueId = $conn->lastInsertId();
        $db->disconnectDb($conn);

        return $avisMarqueId;
    }
    public function getTopAvisMarques($idMarque)
{
    $db = new Database();
    $conn = $db->connectDb();

    $query = "
        SELECT avismarque.idMarque as marque_id, avismarque.id as avis_id, avismarque.valeur, COUNT(appreciationmarque.id) as appreciation_count,
               utilisateur.id as utilisateur_id, utilisateur.nom as utilisateur_nom, utilisateur.prenom as utilisateur_prenom
        FROM avismarque
        LEFT JOIN utilisateur ON avismarque.idUser = utilisateur.id
        LEFT JOIN appreciationmarque ON avismarque.id = appreciationmarque.IdAvis
        WHERE avismarque.idMarque = $idMarque AND avismarque.approuve = 1
        GROUP BY avismarque.id
        ORDER BY appreciation_count DESC;
    ";

    $avisData = $db->request($conn, $query);

    $result = array();
    foreach ($avisData as $item) {
        $data = [
            "marque_id" => $item['marque_id'],
            'avis_id' => $item['avis_id'],
            'valeur' => $item['valeur'],
            'nbAppreciations' => $item['appreciation_count'],
            'utilisateur' => [
                'id' => $item['utilisateur_id'],
                'nom' => $item['utilisateur_nom'],
                'prenom' => $item['utilisateur_prenom'],
            ],
        ];

        $result[] = $data;
    }

    $db->disconnectDb($conn);

    return $result;
}
public function addAppreciation($idUser, $avisId)
{
    $db = new Database();
    $conn = $db->connectDb();

    $queryCheck = "SELECT id FROM appreciationmarque WHERE idUser = $idUser AND idAvis = $avisId";
    $resultCheck = $db->request($conn, $queryCheck);

    if (!$resultCheck) {
        $query = "INSERT INTO appreciationmarque (idUser, idAvis) VALUES ($idUser, $avisId)";
        $db->request($conn, $query);

        $db->disconnectDb($conn);
        return true; 
    }

    $db->disconnectDb($conn);
    return false; 
}
public function checkAppreciation($idUser, $avisId)
    {
        $db = new Database();
        $conn = $db->connectDb();

        $queryCheck = "SELECT id FROM appreciationmarque WHERE idUser = $idUser AND idAvis = $avisId";
        $resultCheck = $db->request($conn, $queryCheck);

        $db->disconnectDb($conn);
        
        return !empty($resultCheck); 
    }
public function deleteAppreciation($idUser, $avisId)
    {
        $db = new Database();
        $conn = $db->connectDb();
            $queryDelete = "DELETE FROM appreciationmarque WHERE idUser = $idUser AND idAvis = $avisId";
            $db->request($conn, $queryDelete);

            $db->disconnectDb($conn);

    }
}
?>
