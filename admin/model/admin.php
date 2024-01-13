<?php
require_once("database.php");

class Admin{
    public function auth($username, $password)
    {
        $db = new Database();
        $conn = $db->connectDb();

       

        $query = "SELECT * FROM admin WHERE username = '$username'";
        $result = $db->request($conn, $query);

        if ($result && count($result) > 0) {
            $user = $result[0];
            
            if ($password==$user['password']) {
                
                $db->disconnectDb($conn);
                return $user;
            }
        }

        $db->disconnectDb($conn);
        return false;
    }
   
      
}

?>