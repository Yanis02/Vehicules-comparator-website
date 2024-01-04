<?php
require_once("database.php");

class ComparaisonModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function insertComparison($idVehicule1, $idVehicule2) {
        $existingComparison = $this->getExistingComparison($idVehicule1, $idVehicule2);

        if ($existingComparison) {

            $this->incrementPopularite($existingComparison[0]['id']);
        } else {
            $this->insertNewComparison($idVehicule1, $idVehicule2);
        }
    }

    private function getExistingComparison($idVehicule1, $idVehicule2) {
        $req = "SELECT * FROM comparaison 
                WHERE (idVehicule_1 = '$idVehicule1' AND idVehicule_2 = '$idVehicule2') 
                   OR (idVehicule_1 = '$idVehicule2' AND idVehicule_2 = '$idVehicule1') 
                LIMIT 1";

        $conn = $this->db->connectDb();
       
        $existingComparison =$this->db->request($conn,$req);

        $this->db->disconnectDb($conn);

        return $existingComparison;
    }

    private function incrementPopularite($comparisonId) {
        $req = "UPDATE comparaison SET popularite = popularite + 1 WHERE id = '$comparisonId'";

        $conn = $this->db->connectDb();
        $this->db->request($conn,$req);

        $this->db->disconnectDb($conn);
    }

    private function insertNewComparison($idVehicule1, $idVehicule2) {
        $req = "INSERT INTO comparaison (idVehicule_1, idVehicule_2, popularite) VALUES ('$idVehicule1', '$idVehicule2', 0)";

        $conn = $this->db->connectDb();
        $this->db->request($conn,$req);
        $this->db->disconnectDb($conn);
    }
    public function getTopPopularComparisons() {
        $req = "SELECT * FROM comparaison ORDER BY popularite DESC LIMIT 3";
    
        $conn = $this->db->connectDb();
        $result = $this->db->request($conn, $req);
        $this->db->disconnectDb($conn);
    
        return $result;
    }
      
}

$compModele=new ComparaisonModel();
if (isset($_POST["idVehicule1"]) && isset($_POST["idVehicule2"]) ) {
    $idVehicule1=$_POST["idVehicule1"];
    $idVehicule2=$_POST["idVehicule2"];
    $compModele->insertComparison($idVehicule1, $idVehicule2);
}
  
?>