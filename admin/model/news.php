<?php
require_once("database.php");

class News{
    public function getAllNews(){
        $db = new database();
        $conn = $db->connectDb();

        $query = "SELECT n.id, n.title, n.description, n.details,n.affiche, i.chemin as image_path
                  FROM news n
                  LEFT JOIN imagesnews i ON n.id = i.idNews";

        $news = $db->request($conn, $query);
        $db->disconnectDb($conn);

        $result = array();
        foreach ($news as $item) {
            $newsId = $item['id'];
            if (!isset($result[$newsId])) {
                $result[$newsId] = array(
                    'id' => $item['id'],
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'details' => $item['details'],
                    "affiche"=>$item["affiche"],
                    'images' => array()
                );
            }

            if (!empty($item['image_path'])) {
                $result[$newsId]['images'][] = $item['image_path'];
            }
        }

        return array_values($result); 
    }
    public function afficher($id){
        $db = new Database();
        $conn = $db->connectDb();
        $query = "UPDATE news SET affiche=1 WHERE id=$id";
        $db->request($conn, $query);
        $db->disconnectDb($conn);


    }
    public function cacher($id){
        $db = new Database();
        $conn = $db->connectDb();
        $query = "UPDATE news SET affiche=0 WHERE id=$id";
        $db->request($conn, $query);
        $db->disconnectDb($conn);


    }
    public function getNewsbyId($id){
        $db = new database();
        $conn = $db->connectDb();

        $query = "SELECT n.id, n.title, n.description, n.details, i.chemin as image_path
                  FROM news n
                  LEFT JOIN imagesnews i ON n.id = i.idNews
                  WHERE n.id=$id";

        $news = $db->request($conn, $query);
        $db->disconnectDb($conn);

        $result = array();
        foreach ($news as $item) {
            $newsId = $item['id'];
            if (!isset($result[$newsId])) {
                $result[$newsId] = array(
                    'id' => $item['id'],
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'details' => $item['details'],
                    'images' => array()
                );
            }

            if (!empty($item['image_path'])) {
                $result[$newsId]['images'][] = $item['image_path'];
            }
        }

        return array_values($result); 
    }
    public function addNews($title,$description,$details) {
        $db = new Database();
        $conn = $db->connectDb();
    
    $req="SELECT id FROM news WHERE title='$title';";
     $result=$db->request($conn, $req);
     if (empty($result)) {
        $query = "INSERT INTO news (title,description,details) VALUES ('$title','$description','$details')";
            $db->request($conn, $query);
            $lastId=$conn->lastInsertId();
            $db->disconnectDb($conn);
             return $lastId;
            
     }else {
        $db->disconnectDb($conn);
        return false;
     } 
    
        
    }  
    public function updateNews($id, $title, $description, $details) {
        $db = new Database();
        $conn = $db->connectDb();
    
        $query = "UPDATE news SET title=?, description=?, details=? WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $description);
        $stmt->bindParam(3, $details);
        $stmt->bindParam(4, $id);
    
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
    
    
    public function deleteNews($id){
        $db = new Database();
            $conn = $db->connectDb();
            $query = "DELETE FROM news WHERE id = '$id'";
            $db->request($conn, $query);
            $db->disconnectDb($conn);
    }
    
    public function addImageNews($newsId, $chemin) {
        $conn = $this->db->connectDb();
    
    
            $query = "INSERT INTO imagesnews (idNews, chemin) VALUES ($newsId,'$chemin')";
            $this->db->request($conn, $query);
            
            $this->db->disconnectDb($conn);
    
        
    }  
    
}
if (isset($_POST['idNews']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['details'])) {
    $idNews=$_POST['idNews'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $details=$_POST['details'];
    
    $newsModel=new News();
    $newsModel->updateNews($idNews, $title, $description,$details);
   }
?>