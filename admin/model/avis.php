<?php
require_once("database.php");

class Avis{
    public function getAllAvisVehicules()
{
    $db = new Database();
    $conn = $db->connectDb();


    $query = "
        SELECT avisvehicule.idVehicule as vehicule_id, avisvehicule.id as avis_id, avisvehicule.valeur, COUNT(appreciation.id) as appreciation_count,avisvehicule.approuve as status,
               utilisateur.id as utilisateur_id, utilisateur.nom as utilisateur_nom, utilisateur.prenom as utilisateur_prenom,utilisateur.bloque as user_status
        FROM avisvehicule
        LEFT JOIN utilisateur ON avisvehicule.idUser = utilisateur.id
        LEFT JOIN appreciation ON avisvehicule.id = appreciation.IdAvis
        GROUP BY avisvehicule.id
        ORDER BY appreciation_count DESC
    ";
    $avisData = $db->request($conn, $query);
   

    $result = array();
    foreach ($avisData as $item) {
        $idVehicule=$item['vehicule_id'];
        $queryNames = "
                SELECT CONCAT(m.nom, ' ', mo.nom, ' ', v.nom, ' ', a.annee) AS vehicule_name
                FROM marques m
                JOIN modele mo ON m.id = mo.idMarque
                JOIN version v ON mo.id = v.idModele
                JOIN vehicule a ON v.id = a.idVersion
               WHERE a.id = $idVehicule;";
            $vehiculeNameData = $db->request($conn, $queryNames);
      
            $vehiculeName = $vehiculeNameData[0]['vehicule_name'];
        $data = [
            "vehicule_id" => $item['vehicule_id'],
            "vehicule_nom"=> $vehiculeName,
            'avis_id' => $item['avis_id'],
            'valeur' => $item['valeur'],
            'nbAppreciations' => $item['appreciation_count'],
            'utilisateur' => [
                'id' => $item['utilisateur_id'],
                'nom' => $item['utilisateur_nom'],
                'prenom' => $item['utilisateur_prenom'],
                "user_status"=>$item['user_status']
            ],
            "status"=>$item["status"]
        ];

        $result[] = $data;
    }

    $db->disconnectDb($conn);

    return $result;
}
 public function getAllAvisMarques()
{
    $db = new Database();
    $conn = $db->connectDb();

    $query = "
        SELECT avismarque.idMarque as marque_id, avismarque.id as avis_id, avismarque.valeur, COUNT(appreciationmarque.id) as appreciation_count,avismarque.approuve as status,
               utilisateur.id as utilisateur_id, utilisateur.nom as utilisateur_nom, utilisateur.prenom as utilisateur_prenom,utilisateur.bloque as user_status
        FROM avismarque
        LEFT JOIN utilisateur ON avismarque.idUser = utilisateur.id
        LEFT JOIN appreciationmarque ON avismarque.id = appreciationmarque.IdAvis
        GROUP BY avismarque.id
        ORDER BY appreciation_count DESC;
    ";

    $avisData = $db->request($conn, $query);

    $result = array();
    foreach ($avisData as $item) {
        $idMarque=$item['marque_id'];
        $queryMarque="SELECT nom FROM marques where id=$idMarque;";
        $marqueNameData=$db->request($conn,$queryMarque);
         $marqueName=$marqueNameData[0]["nom"];
        $data = [
            "marque_id" => $item['marque_id'],
            "marque_nom"=>$marqueName,
            'avis_id' => $item['avis_id'],
            'valeur' => $item['valeur'],
            'nbAppreciations' => $item['appreciation_count'],
            'utilisateur' => [
                'id' => $item['utilisateur_id'],
                'nom' => $item['utilisateur_nom'],
                'prenom' => $item['utilisateur_prenom'],
                "user_status"=>$item['user_status']

            ],
            "status"=>$item["status"]

        ];

        $result[] = $data;
    }

    $db->disconnectDb($conn);

    return $result;
}
public function approuver($id){
     $db = new Database();
    $conn = $db->connectDb();
    $req = "UPDATE avisVehicule SET approuve =1 WHERE id = $id";

        $db->request($conn,$req);

        $db->disconnectDb($conn);
}
public function approuverMarque($id){
    $db = new Database();
   $conn = $db->connectDb();
   $req = "UPDATE avismarque SET approuve =1 WHERE id = $id";

       $db->request($conn,$req);

       $db->disconnectDb($conn);
}
public function refuser($id){
    $db = new Database();
   $conn = $db->connectDb();
   $req = "DELETE FROM avisVehicule WHERE id = $id";

       $db->request($conn,$req);

       $db->disconnectDb($conn);
}
public function refuserMarque($id){
    $db = new Database();
   $conn = $db->connectDb();
   $req = "DELETE FROM avismarque WHERE id = $id";

       $db->request($conn,$req);

       $db->disconnectDb($conn);
}
}

?>