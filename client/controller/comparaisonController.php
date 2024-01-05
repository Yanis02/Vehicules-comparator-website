<?php
require_once("./view/comparateur.php");
require_once("./model/vehicule.php");


class ComparaisonController{
    private $compView;
public function __construct() {
        $this->compView = new Comparateur();
    }
    public function popCompDetails(){
        if (isset($_GET["idVehicule_1"]) && isset($_GET["idVehicule_2"]) ) {
            $idVehicule1=$_GET["idVehicule_1"];
           $idVehicule2=$_GET["idVehicule_2"];
           $VehiculeModel=new VehiculeModel();
           $temp=array();
           $vehicule_1=$VehiculeModel->getVehiculeById($idVehicule1);
          $vehicule_2=$VehiculeModel->getVehiculeById($idVehicule2);
          array_push($temp,$vehicule_1);
          array_push($temp,$vehicule_2);
          $this->compView->displayComp($temp);
    
        }
     }
}
?>