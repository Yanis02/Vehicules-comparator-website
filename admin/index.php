<?php
require_once("./controller/vehiculesController.php");
require_once("./controller/layoutController.php");

$layoutController=new layoutController();
$vehiculeController=new vehiculesController();
$layoutController->showHead();

$action = isset($_GET['action']) ? $_GET['action'] : 'home';
switch ($action) {
    case "home":
        $vehiculeController->showVehiculesTable();
              break;
    case "detailVehicule": 
        $vehiculeController->showVehiculeDetails();
        break;
    case "ajouterVehicule": 
        $vehiculeController->showVehiculeForm();
         break;    
         case "addVehicule": 
            $vehiculeController->addVehicule();
             break; 
             case "deleteVehicule": 
                $vehiculeController->deleteVehicule();
                 break; 

                 case "editVehiculeImage": 
                    $vehiculeController->updateVehiculeImage();
                     break; 
                     case  "ajouterCarac":
                        $vehiculeController->showAddCarForm();
                     break; 
                        
                 
                 
    
    }

?>