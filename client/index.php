<?php
require_once("./controller/accueilController.php");

// Set default action to "home" if no action is provided
$action = isset($_GET['action']) ? $_GET['action'] : 'home';

$controllerModel = new accueilController();
$controllerModel->showHead();
$controllerModel->showHeader();
$controllerModel->displayNewsSection();
$controllerModel->showNavbar();

switch ($action) {
    case "comparateur": 
        $controllerModel->showComp();
        break;
    case "detailVehicule" :
        $controllerModel->showVehiculeDetails();
         break;
   case  "marques" :
    $controllerModel->showMarquesSectionPage();
    $controllerModel->showMarque();
    break; 
    default:
        $controllerModel->showMarquesSection();
        $controllerModel->showSeparator();
        $controllerModel->showCompPage(); 
}
?>
