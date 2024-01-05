<?php
require_once("./view/gestionVehicules.php");
require_once("./model/vehicule.php");

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
}
?>