<?php

require_once("database.php");

class AvisVehiculeModel
{
    public function addAvis($userId, $vehiculeId, $valeur)
    {
        $db = new Database();
        $conn = $db->connectDb();

        $approuve = 0;

        $query = "INSERT INTO avisvehicule (idUser, idVehicule, valeur, approuve) 
                  VALUES ('$userId', '$vehiculeId', '$valeur', '$approuve')";

        $db->request($conn, $query);
        $avisId = $conn->lastInsertId();
        $db->disconnectDb($conn);

        return $avisId;
    }
    public function getTopAvisVehicules($idVehicule)
{
    $db = new Database();
    $conn = $db->connectDb();

    $query = "
        SELECT avisvehicule.idVehicule as vehicule_id, avisvehicule.id as avis_id, avisvehicule.valeur, COUNT(appreciation.id) as appreciation_count,
               utilisateur.id as utilisateur_id, utilisateur.nom as utilisateur_nom, utilisateur.prenom as utilisateur_prenom
        FROM avisvehicule
        LEFT JOIN utilisateur ON avisvehicule.idUser = utilisateur.id
        LEFT JOIN appreciation ON avisvehicule.id = appreciation.IdAvis
        WHERE avisvehicule.idVehicule = $idVehicule AND avisvehicule.approuve = 1
        GROUP BY avisvehicule.id
        ORDER BY appreciation_count DESC
        LIMIT 3;
    ";

    $avisData = $db->request($conn, $query);

    $result = array();
    foreach ($avisData as $item) {
        $data = [
            "vehicule_id" => $item['vehicule_id'],
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
public function getAllAvisVehicules($idVehicule, $currentPage = 1, $avisPerPage = 5)
{
    $db = new Database();
    $conn = $db->connectDb();

    $startIndex = ($currentPage - 1) * $avisPerPage;

    $query = "
        SELECT avisvehicule.idVehicule as vehicule_id, avisvehicule.id as avis_id, avisvehicule.valeur, COUNT(appreciation.id) as appreciation_count,
               utilisateur.id as utilisateur_id, utilisateur.nom as utilisateur_nom, utilisateur.prenom as utilisateur_prenom
        FROM avisvehicule
        LEFT JOIN utilisateur ON avisvehicule.idUser = utilisateur.id
        LEFT JOIN appreciation ON avisvehicule.id = appreciation.IdAvis
        WHERE avisvehicule.idVehicule = $idVehicule AND avisvehicule.approuve = 1
        GROUP BY avisvehicule.id
        ORDER BY appreciation_count DESC
        LIMIT $startIndex, $avisPerPage;
    ";

    $avisData = $db->request($conn, $query);

    $result = array();
    foreach ($avisData as $item) {
        $data = [
            "vehicule_id" => $item['vehicule_id'],
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
public function getTotalAvisCount($idVehicule)
    {
        $db = new Database();
        $conn = $db->connectDb();

        $query = "SELECT COUNT(*) AS totalAvis FROM avisvehicule WHERE idVehicule = '$idVehicule' AND approuve = 1";
        $result = $db->request($conn, $query);

        $totalAvis = ($result && !empty($result[0]['totalAvis'])) ? $result[0]['totalAvis'] : 0;

        $db->disconnectDb($conn);

        return $totalAvis;
    }
public function addAppreciation($idUser, $avisId)
{
    $db = new Database();
    $conn = $db->connectDb();

    $queryCheck = "SELECT id FROM appreciation WHERE idUser = $idUser AND idAvis = $avisId";
    $resultCheck = $db->request($conn, $queryCheck);

    if (!$resultCheck) {
        $query = "INSERT INTO appreciation (idUser, idAvis) VALUES ($idUser, $avisId)";
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

        $queryCheck = "SELECT id FROM appreciation WHERE idUser = $idUser AND idAvis = $avisId";
        $resultCheck = $db->request($conn, $queryCheck);

        $db->disconnectDb($conn);
        
        return !empty($resultCheck); 
    }
public function deleteAppreciation($idUser, $avisId)
    {
        $db = new Database();
        $conn = $db->connectDb();
            $queryDelete = "DELETE FROM appreciation WHERE idUser = $idUser AND idAvis = $avisId";
            $db->request($conn, $queryDelete);

            $db->disconnectDb($conn);

    }
}

?>
