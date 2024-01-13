<?php
require_once("./model/publicite.php");
require_once("./model/image.php");
require_once("./view/gestionPubs.php");



class PubController{
    private $gestionPubView;

    public function __construct() {
        $this->gestionPubView = new GestionPubs();
    }
    public function showPubTable(){
        $newsModel=new Publicite();
        $pubs=$newsModel->getAllPubs();
        $this->gestionPubView->generateDataTable($pubs);
    }
    
    public function showPubDetails(){
        if (isset($_GET['idPub'])) {
                $id = $_GET['idPub'];
                $newsModel=new Publicite();
                $news=$newsModel->getPubbyId($id);
                $this->gestionPubView->pubDetails($news);
               
            

            }}

            public function updatePubImage(){
                $imageModel=new ImageModel();
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                               
                                $chemin=$_POST["idVimg"];
                                $id=$_POST["idMimg"];
                                if (isset($_FILES['photo'])) {
                                    $uploadDir = '../client/img/pubs/';
                                    $uploadFile = $uploadDir . basename($_FILES['photo']['name']);
                                    if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
                                        $imageModel->updateImagePub($id,basename($_FILES['photo']['name']));
                                        #echo 'File has been uploaded successfully.';

                                        header("Location: ./index.php?action=detailPub&idPub=".$id);
                                    } else {
                                        echo 'Error uploading the file.';
                                    }
                                } else {
                                    echo 'Invalid file upload.';
                                }
                               }
                               
                            } 
                            public function afficherPub(){
                                if (isset($_GET['id'])) {
                                    $id=$_GET['id'];
                                    $newsModel=new Publicite();
                                    $newsModel->afficher($id);
                                    header("Location: ./index.php?action=diaporama");
                        
                                }

                            }
                            public function cacherPub(){
                                if (isset($_GET['id'])) {
                                    $id=$_GET['id'];
                                    $newsModel=new Publicite();
                                    $newsModel->cacher($id);
                                    header("Location: ./index.php?action=diaporama");
                        
                                }

                            }
                            public function deletePub(){
                                if (isset($_GET['id'])) {
                                    $id=$_GET['id'];
                                    $newsModel=new Publicite();
                                    $newsModel->deletePub($id);
                                    header("Location: ./index.php?action=diaporama");
                        
                                }
                            }   
                            public function showAddPubForm(){
                                $this->gestionPubView->addPub();
                            }
                            public function addPub(){
                                $newsModel=new Publicite();
                                $imageModel=new ImageModel();
                        
                                if($_SERVER["REQUEST_METHOD"]=="POST"){
                                   
                                    $titre=$_POST["titre"];
                                    $lien=$_POST["lien"];
                                   $lastId=$newsModel->addPub($titre,$lien);
                                   if($lastId!=false){
                                    
                                    
                                    if (isset($_FILES['photo'])) {
                                        echo "hii";
                                        $uploadDir = '../client/img/pubs/';
                                        $uploadFile = $uploadDir . basename($_FILES['photo']['name']);
                                        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
                                            echo 'File has been uploaded successfully.';
                                            $imageModel->addImagePub($lastId,basename($_FILES['photo']['name']));
                                        } else {
                                            echo 'Error uploading the file.';
                                        }
                                    } else {
                                        echo 'Invalid file upload.';
                                    }
                                   }
                                   
                                } 
                                header("Location: ./index.php?action=diaporama");
                        
                            }                         
}
?>