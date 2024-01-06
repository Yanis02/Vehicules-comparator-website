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
    public function showVehiculesTable(){
        $vehiculeModel=new VehiculeModel();
        $vehicules=$vehiculeModel->getAllVehicules();
        $gestionVehicules=new GestionVehicules();
        $gestionVehicules->displayTable($vehicules);
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
         $marqueModel=new MarqueModel();
         $marques=$marqueModel->getAllMarques();
         $caracModel=new CaracModel();
         $caracs=$caracModel->getCarac();
        $this->gestionVehiculeView->addVehicule($marques,$caracs);
    }
    public function addVehicule(){
        $caracModel=new CaracModel();
        $vehiculeModel=new VehiculeModel();
        $imageModel=new ImageModel();

        if($_SERVER["REQUEST_METHOD"]=="POST"){
           
            $vehiculeFeatures =[];
            $versionId=$_POST["version"];
            $type=$_POST["type"];
            $annee=$_POST["annee"];
            foreach ($_POST as $key => $value) {
                if (strpos($key, 'car_') === 0) {
                    $featureId = substr($key, 4); 
                    $vehiculeFeatures[$featureId] = $value;
                }
            }
           $lastId=$vehiculeModel->addVehicule($versionId,$annee,$type);
           
           if($lastId!=false){
            foreach ($vehiculeFeatures as $featureId => $value) {
                $caracModel->insertVehiculeCaracteristique($lastId,$featureId,$value);
            }
           }
           if (isset($_FILES['photo'])) {
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
}
?>