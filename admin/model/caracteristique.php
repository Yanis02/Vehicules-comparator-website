<?php
require_once("database.php");

class CaracModel
{

    private $db;

    public function __construct() {
        $this->db = new Database();
    }


    public function insertVehiculeCaracteristique($idVehicule, $idCaracteristique, $valeur) {
        $conn = $this->db->connectDb();

        $query = "INSERT INTO vehicule_caracteristique (idVehicule, idCaracteristique, valeur) VALUES ($idVehicule, $idCaracteristique, '$valeur')";
        $this->db->request($conn, $query);

        $newRowId = $conn->lastInsertId();

        $this->db->disconnectDb($conn);

        return $newRowId;
    }

    public function getCarac()
    {
        $conn = $this->db->connectDb();

        $query = "SELECT id, nom FROM caracteristique";

        $modelesData = $this->db->request($conn, $query);
        $this->db->disconnectDb($conn);

        return array_values($modelesData);
    }
}


?>