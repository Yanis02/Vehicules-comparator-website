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
   
    
    
   
    
}

?>