<?php
require_once("database.php");

class Contact{
    public function getContact() {
        $db = new Database();
        $conn = $db->connectDb();
    
    
    
        $query = "SELECT * FROM contact;";
            $result=$db->request($conn, $query);
            $db->disconnectDb($conn);
             return $result;
            
     
    
        
    }  
   
    public function addContact($nomDev,$mail,$facebook,$numero) {
        $db = new Database();
        $conn = $db->connectDb();
    
    
    
        $query = "INSERT INTO contact (nomDev,mail,facebook,numero) VALUES ('$nomDev','$mail','$facebook','$numero')";
            $db->request($conn, $query);
            $lastId=$conn->lastInsertId();
            $db->disconnectDb($conn);
             return $lastId;
            
     
    
        
    }  
    public function updateContact($nomDev,$mail,$facebook,$numero) {
        $db = new Database();
        $conn = $db->connectDb();
    
        $query = "UPDATE contact SET nomDev=?, mail=?, facebook=?,numero=? WHERE id=0";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $nomDev);
        $stmt->bindParam(2, $mail);
        $stmt->bindParam(3, $facebook);
        $stmt->bindParam(4, $numero);

    
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
    
    
    
    
   
    
}
if (isset($_POST['nomDev']) && isset($_POST['mail']) && isset($_POST['facebook']) && isset($_POST["numero"])) {
    $nomDev=$_POST['nomDev'];
    $mail=$_POST['mail'];
    $facebook=$_POST['facebook'];
    $numero=$_POST['numero'];
    $newsModel=new Contact();
    $newsModel->updateContact($nomDev, $mail, $facebook,$numero);
   }
?>