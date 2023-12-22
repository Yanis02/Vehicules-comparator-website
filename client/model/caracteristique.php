<?php
require_once("database.php");

class CaracModel
{
    public function getCarac()
    {
        $db = new Database();
        $conn = $db->connectDb();

        $query = "SELECT id, nom FROM caracteristique";

        $modelesData = $db->request($conn, $query);
        $db->disconnectDb($conn);

        return array_values($modelesData);
    }
}


?>