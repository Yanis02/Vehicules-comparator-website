<?php
require_once("./model/marques.php");
require_once("./view/gestionMarques.php");
require_once("./controller/vehiculesController.php");



class MarquesController{
    private $gestionMarquesView;

    public function __construct() {
        $this->gestionMarquesView = new GestionMarques();
    }
    public function showMarquesTable(){
        $marquesModel=new MarquesModel();
        $marques=$marquesModel->getAllMarques();
        $this->gestionMarquesView->generateDataTable($marques);
    }
    public function showMarqueDetails(){
        if (isset($_GET['idMarque'])) {
                $id = $_GET['idMarque'];
                $marquesModel=new MarquesModel();
                $marque=$marquesModel->getMarquebyId($id);
                $vehicules=$marquesModel->getAllVehicules($id);
                $this->gestionMarquesView->marqueDetails($marque);
                $vehiculeController=new vehiculesController();
                $vehiculeController->showVehiculesTable($vehicules,$id);


            }}
    public function updateMarqueImage(){
    $imageModel=new ImageModel();
    if($_SERVER["REQUEST_METHOD"]=="POST"){
                   
                    $chemin=$_POST["idVimg"];
                    $id=$_POST["idMimg"];
                    if (isset($_FILES['photo'])) {
                        $uploadDir = '../client/img/marques/';
                        $uploadFile = $uploadDir . basename($_FILES['photo']['name']);
                        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
                            echo 'File has been uploaded successfully.';
                            $imageModel->updateImageMarque($chemin,basename($_FILES['photo']['name']));
                            header("Location: ./index.php?action=detailMarque&idMarque=".$id);
                        } else {
                            echo 'Error uploading the file.';
                        }
                    } else {
                        echo 'Invalid file upload.';
                    }
                   }
                   
                } 
                public function showMarquesForm(){
                    
                   $this->gestionMarquesView->addMarque();
               }         
            public function addMarque(){
                $marquesModel=new MarquesModel();
                $imageModel=new ImageModel();
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                   
                    $nom=$_POST['nom'];
                    $pays=$_POST['pays'];
                    $siege=$_POST['siege'];
                    $annee=$_POST['annee'];
                   
                   
                   if (isset($_FILES['photo'])) {
                    $uploadDir = '../client/img/marques/';
                    $uploadFile = $uploadDir . basename($_FILES['photo']['name']);
                    if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
                        #echo 'File has been uploaded successfully.';
                        $lastId=$imageModel->addImageMarque(basename($_FILES['photo']['name']));
                        if ($lastId) {
                            $marquesModel->addMarque($nom,$pays,$siege,$annee,$lastId);
                        }
                    } else {
                        echo 'Error uploading the file.';
                    }
                } else {
                    echo 'Invalid file upload.';
                }
                   
                   
                } 
                header("Location: ./index.php?action=marques");
        
            }
            public function deleteMarque(){
                if (isset($_GET['id'])) {
                    $id=$_GET['id'];
                    $marquesModel=new MarquesModel();
                    $marquesModel->deleteMarque($id);
                    header("Location: ./index.php?action=marques");
        
                }
            }   
}
?>