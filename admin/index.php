<?php
require_once("./controller/vehiculesController.php");
require_once("./controller/layoutController.php");

$layoutController=new layoutController();
$vehiculeController=new vehiculesController();
$layoutController->showHead();
$vehiculeController->showVehiculesTable();

$action = isset($_GET['action']) ? $_GET['action'] : 'home';
switch ($action) {
    case "detailVehicule": 
        $vehiculeController->showVehiculeDetails();
        break;
    case "ajouterVehicule": 
        $vehiculeController->showVehiculeForm();
         break;    
         case "addVehicule": 
            $vehiculeController->addVehicule();
             break;    
    
    }

?>