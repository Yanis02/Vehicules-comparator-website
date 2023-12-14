<?php

require_once("database.php");

class MarqueModel
{
    public function getAllMarques()
    {
        $db = new Database();
        $conn = $db->connectDb();

        // Select data from both tables using a SQL JOIN
        $query = "SELECT marques.id, marques.nom, marques.pays, marques.siege, marques.anne_creation, images.chemin 
                  FROM marques 
                  LEFT JOIN images ON marques.idImage = images.id";

        $marquesData = $db->request($conn, $query);
        $db->disconnectDb($conn);

        $result = array();
        foreach ($marquesData as $item) {
            $marqueId = $item['id'];
            if (!isset($result[$marqueId])) {
                $result[$marqueId] = array(
                    'id' => $item['id'],
                    'nom' => $item['nom'],
                    'pays' => $item['pays'],
                    'siege' => $item['siege'],
                    'anne_creation' => $item['anne_creation'],
                    'images' => array()
                );
            }

            if (!empty($item['chemin'])) {
                $result[$marqueId]['images'][] = $item['chemin'];
            }
        }

        return array_values($result); 
    }
}
?>


 