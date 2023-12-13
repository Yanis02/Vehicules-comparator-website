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

        $result = £db->request($conn,$query);

        if ($result->num_rows > 0) {
            // Fetch data from the result set
            $marques = [];
            while ($row = $result->fetch_assoc()) {
                $marques[] = [
                    'id' => $row['id'],
                    'nom' => $row['nom'],
                    'pays' => $row['pays'],
                    'siege' => $row['siege'],
                    'anne_creation' => $row['anne_creation'],
                    'image' => $row['chemin'],
                ];
            }

            $$db->disconnectDb();

            return $marques;
        } else {
            return [];
        }
    }
}



 ?>