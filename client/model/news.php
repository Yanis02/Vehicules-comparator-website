<?php
require_once("database.php");

class newsModel {

    public function getAllNews(){
        $db = new database();
        $conn = $db->connectDb();

        $query = "SELECT n.id, n.title, n.description, n.details, i.chemin as image_path
                  FROM news n
                  LEFT JOIN imagesnews i ON n.id = i.idNews";

        $news = $db->request($conn, $query);
        $db->disconnectDb($conn);

        $result = array();
        foreach ($news as $item) {
            $newsId = $item['id'];
            if (!isset($result[$newsId])) {
                $result[$newsId] = array(
                    'id' => $item['id'],
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'details' => $item['details'],
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
