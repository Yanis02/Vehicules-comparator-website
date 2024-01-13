<?php
require_once("database.php");

class Publicite{
    public function getAllDisplayedPubs(){
        $db = new database();
        $conn = $db->connectDb();

        $query = "SELECT n.id, n.titre, n.lien,n.affiche, i.chemin as image_path
                  FROM publicite n
                  LEFT JOIN imagespublicite i ON n.id = i.idPub
                  WHERE n.affiche=1";

        $news = $db->request($conn, $query);
        $db->disconnectDb($conn);

        $result = array();
        foreach ($news as $item) {
            $newsId = $item['id'];
            if (!isset($result[$newsId])) {
                $result[$newsId] = array(
                    'id' => $item['id'],
                    'titre' => $item['titre'],
                    'lien' => $item['lien'],
                    'affiche' => $item['affiche'],
                    'images' => array()
                );
            }

            if (!empty($item['image_path'])) {
                $result[$newsId]['images'][] = $item['image_path'];
            }
        }

        return array_values($result); 
    }
   
    
}

?>