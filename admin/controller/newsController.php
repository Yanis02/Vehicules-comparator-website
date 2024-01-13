<?php
require_once("./model/news.php");
require_once("./model/image.php");
require_once("./view/news.php");
require_once("./controller/vehiculesController.php");



class NewsController{
    private $gestionNewsView;

    public function __construct() {
        $this->gestionNewsView = new GestionNews();
    }
    public function showNewsTable(){
        $newsModel=new News();
        $news=$newsModel->getAllNews();
        $this->gestionNewsView->generateDataTable($news);
    }
    public function showPubTableD(){
        $newsModel=new News();
        $pubs=$newsModel->getAllNews();
        $this->gestionNewsView->generateDataTableDiaporama($pubs);
    }
    public function showNewsDetails(){
        if (isset($_GET['idNews'])) {
                $id = $_GET['idNews'];
                $newsModel=new News();
                $news=$newsModel->getNewsbyId($id);
                $this->gestionNewsView->newsDetails($news);
               
            

            }}

            public function updateNewsImage(){
                $imageModel=new ImageModel();
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                               
                                $chemin=$_POST["idVimg"];
                                $id=$_POST["idMimg"];
                                if (isset($_FILES['photo'])) {
                                    $uploadDir = '../client/img/news/';
                                    $uploadFile = $uploadDir . basename($_FILES['photo']['name']);
                                    if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
                                        $imageModel->updateImageNews($id,basename($_FILES['photo']['name']));
                                        #echo 'File has been uploaded successfully.';

                                        header("Location: ./index.php?action=detailNews&idNews=".$id);
                                    } else {
                                        echo 'Error uploading the file.';
                                    }
                                } else {
                                    echo 'Invalid file upload.';
                                }
                               }
                               
                            } 
                            public function deleteNews(){
                                if (isset($_GET['id'])) {
                                    $id=$_GET['id'];
                                    $newsModel=new News();
                                    $newsModel->deleteNews($id);
                                    header("Location: ./index.php?action=news");
                        
                                }
                            }   
                            public function showAddNewsForm(){
                                $this->gestionNewsView->addNews();
                            }
                            public function addNews(){
                                $newsModel=new News();
                                $imageModel=new ImageModel();
                        
                                if($_SERVER["REQUEST_METHOD"]=="POST"){
                                   
                                    $title=$_POST["title"];
                                    $description=$_POST["description"];
                                    $details=$_POST["details"];
                                   $lastId=$newsModel->addNews($title,$description,$details);
                                   if($lastId!=false){
                                    
                                    
                                    if (isset($_FILES['photo'])) {
                                        echo "hii";
                                        $uploadDir = '../client/img/news/';
                                        $uploadFile = $uploadDir . basename($_FILES['photo']['name']);
                                        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
                                            echo 'File has been uploaded successfully.';
                                            $imageModel->addImageNews($lastId,basename($_FILES['photo']['name']));
                                        } else {
                                            echo 'Error uploading the file.';
                                        }
                                    } else {
                                        echo 'Invalid file upload.';
                                    }
                                   }
                                   
                                } 
                                header("Location: ./index.php?action=news");
                        
                            }     
                            
                            public function afficherNews(){
                                if (isset($_GET['id'])) {
                                    $id=$_GET['id'];
                                    $newsModel=new News();
                                    $newsModel->afficher($id);
                                    header("Location: ./index.php?action=diaporama");
                        
                                }

                            }
                            public function cacherNews(){
                                if (isset($_GET['id'])) {
                                    $id=$_GET['id'];
                                    $newsModel=new News();
                                    $newsModel->cacher($id);
                                    header("Location: ./index.php?action=diaporama");
                        
                                }

                            }
}
?>