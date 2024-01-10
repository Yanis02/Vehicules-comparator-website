<?php
require_once("./view/gestionVehicules.php");
require_once("./model/vehicule.php");
require_once("./model/marque.php");
require_once("./model/caracteristique.php");
require_once("./model/image.php");


class vehiculesController{
    private $gestionVehiculeView;

    public function __construct() {
        $this->gestionVehiculeView = new GestionVehicules();
    }
    public function showVehiculesTable($vehicules,$id){
        
        $gestionVehicules=new GestionVehicules();
        $gestionVehicules->generateDataTable($vehicules,$id);
        #print_r($vehicules);
    }
    public function showVehiculeDetails(){
        if (isset($_GET['idVehicule'])) {
                $id = $_GET['idVehicule'];
                $vehiculeModel=new VehiculeModel();
                $vehicule=$vehiculeModel->getVehiculeById($id); 
                $this->gestionVehiculeView->vehiculeDetails($vehicule);
            }}
    public function showVehiculeForm(){
         $caracModel=new CaracModel();
         $caracs=$caracModel->getCarac();
         if(isset($_GET["idMarque"])){
          $id=$_GET["idMarque"];
        
        $this->gestionVehiculeView->addVehicule($id,$caracs);
    }
    }
    public function showAddCarForm(){
        $this->gestionVehiculeView->addCarac();
    }
    public function addVehicule(){
        $caracModel=new CaracModel();
        $vehiculeModel=new VehiculeModel();
        $imageModel=new ImageModel();

        if($_SERVER["REQUEST_METHOD"]=="POST"){
           
            $vehiculeFeatures =[];
            $type=$_POST["type"];
            $annee=$_POST["annee"];
            $modele=$_POST["modele"];
            $version=$_POST["version"];
            $marque=$_POST["marque"];
            foreach ($_POST as $key => $value) {
                if (strpos($key, 'car_') === 0) {
                    $featureId = substr($key, 4); 
                    $vehiculeFeatures[$featureId] = $value;
                }
            }
           $lastId=$vehiculeModel->addVehicule($marque,$modele,$version,$annee,$type);
           if($lastId!=false){
            
            foreach ($vehiculeFeatures as $featureId => $value) {
                $caracModel->insertVehiculeCaracteristique($lastId,$featureId,$value);
            }
            if (isset($_FILES['photo'])) {
                echo "hii";
                $uploadDir = '../client/img/vehicules/';
                $uploadFile = $uploadDir . basename($_FILES['photo']['name']);
                if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
                    echo 'File has been uploaded successfully.';
                    $imageModel->addImage($lastId,basename($_FILES['photo']['name']));
                } else {
                    echo 'Error uploading the file.';
                }
            } else {
                echo 'Invalid file upload.';
            }
           }
           
        } 
        header("Location: ./index.php?action=marques");

    }  
    public function deleteVehicule(){
        if (isset($_GET['id'])) {
            $id=$_GET['id'];
            $vehiculeModel=new VehiculeModel();
            $vehiculeModel->deleteVehicule($id);
            header("Location: ./index.php?action=marques");

        }
    } 
    public function updateVehiculeImage(){
        $imageModel=new ImageModel();
        if($_SERVER["REQUEST_METHOD"]=="POST"){
           
            $id=$_POST["idVimg"];
            if (isset($_FILES['photo'])) {
                $uploadDir = '../client/img/vehicules/';
                $uploadFile = $uploadDir . basename($_FILES['photo']['name']);
                if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
                    echo 'File has been uploaded successfully.';
                    $imageModel->updateImage($id,basename($_FILES['photo']['name']));
                    header("Location: ./index.php?action=detailVehicule&idVehicule=".$id);
                } else {
                    echo 'Error uploading the file.';
                }
            } else {
                echo 'Invalid file upload.';
            }
           }
           
        } 
    
         
}
?>