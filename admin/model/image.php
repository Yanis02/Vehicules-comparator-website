<?php
require_once("database.php");

class ImageModel{
    private $db;

    public function __construct() {
        $this->db = new Database();
    }
 

public function addImage($vehiculeId, $chemin) {
    $conn = $this->db->connectDb();


        $query = "INSERT INTO imagesvehicules (idVehicule, chemin) VALUES ($vehiculeId,'$chemin')";

        $this->db->request($conn, $query);


        $this->db->disconnectDb($conn);

    
}


}
    
?>