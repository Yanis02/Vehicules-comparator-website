<?php
require_once("database.php");

class Publicite{
    public function getAllPubs(){
        $db = new database();
        $conn = $db->connectDb();

        $query = "SELECT n.id, n.titre, n.lien,n.affiche, i.chemin as image_path
                  FROM publicite n
                  LEFT JOIN imagespublicite i ON n.id = i.idPub";

        $news = $db->request($conn, $query);
        $db->disconnectDb($conn);

        $result = array();
        foreach ($news as $item) {
            $newsId = $item['id'];
            if (!isset($result[$newsId])) {
                $result[$newsId] = array(
                    'id' => $item['id'],
                    'titre' => $item['titre'],
                    'lien' => $item['lien'],
                    'affiche' => $item['affiche'],
                    'images' => array()
                );
            }

            if (!empty($item['image_path'])) {
                $result[$newsId]['images'][] = $item['image_path'];
            }
        }

        return array_values($result); 
    }
    public function getPubbyId($id){
        $db = new database();
        $conn = $db->connectDb();

        $query = "SELECT n.id, n.titre, n.lien,n.affiche, i.chemin as image_path
                  FROM publicite n
                  LEFT JOIN imagespublicite i ON n.id = i.idPub
                  WHERE n.id=$id";

        $news = $db->request($conn, $query);
        $db->disconnectDb($conn);

        $result = array();
        foreach ($news as $item) {
            $newsId = $item['id'];
            if (!isset($result[$newsId])) {
                $result[$newsId] = array(
                    'id' => $item['id'],
                    'titre' => $item['titre'],
                    'lien' => $item['lien'],
                    'affiche' => $item['affiche'],
                    'images' => array()
                );
            }

            if (!empty($item['image_path'])) {
                $result[$newsId]['images'][] = $item['image_path'];
            }
        }

        return array_values($result); 
    }
    public function addPub($titre,$lien) {
        $db = new Database();
        $conn = $db->connectDb();
    
    $req="SELECT id FROM publicite WHERE titre='$titre';";
     $result=$db->request($conn, $req);
     if (empty($result)) {
        $query = "INSERT INTO publicite (titre,lien) VALUES ('$titre','$lien')";
            $db->request($conn, $query);
            $lastId=$conn->lastInsertId();
            $db->disconnectDb($conn);
             return $lastId;
            
     }else {
        $db->disconnectDb($conn);
        return false;
     } 
    
        
    }  
    public function afficher($id){
        $db = new Database();
        $conn = $db->connectDb();
        $query = "UPDATE publicite SET affiche=1 WHERE id=$id";
        $db->request($conn, $query);
        $db->disconnectDb($conn);


    }
    public function cacher($id){
        $db = new Database();
        $conn = $db->connectDb();
        $query = "UPDATE publicite SET affiche=0 WHERE id=$id";
        $db->request($conn, $query);
        $db->disconnectDb($conn);


    }
    public function updatePub($id,$titre,$lien) {
        $db = new Database();
        $conn = $db->connectDb();
    
        $query = "UPDATE publicite SET titre=?, lien=? WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $titre);
        $stmt->bindParam(2, $lien);
        $stmt->bindParam(3, $id);
    
        try {
            $stmt->execute();
            $result = array('success' => true);
        } catch (PDOException $e) {
            $result = array('success' => false, 'error' => $e->getMessage());
        }
    
        $db->disconnectDb($conn);
    
        header('Content-Type: application/json');
        echo json_encode($result);
    }
    
    
    public function deletePub($id){
        $db = new Database();
            $conn = $db->connectDb();
            $query = "DELETE FROM publicite WHERE id = '$id'";
            $db->request($conn, $query);
            $db->disconnectDb($conn);
    }
    
   
    
}
if (isset($_POST['idPub']) && isset($_POST['titre']) && isset($_POST['lien'])) {
    $idPub=$_POST['idPub'];
    $titre=$_POST['titre'];
    $lien=$_POST['lien'];
    
    $newsModel=new Publicite();
    $newsModel->updatePub($idPub, $titre, $lien);
   }
?>