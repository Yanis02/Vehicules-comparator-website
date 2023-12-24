<?php
require_once("./controller/accueilController.php");

// Set default action to "home" if no action is provided
$action = isset($_GET['action']) ? $_GET['action'] : 'home';

$controllerModel = new accueilController();
$controllerModel->showHead();
$controllerModel->showHeader();


switch ($action) {
    case "comparateur": 
        $controllerModel->showNavbar();
        $controllerModel->showComp();
        break;
    case "detailVehicule" :
        $controllerModel->showNavbar();
        $controllerModel->showVehiculeDetails();
         break;
   case  "marques" :
    $controllerModel->showNavbar();
    $controllerModel->showMarquesSectionPage();
    $controllerModel->showMarque();
    break; 
    case "auth" :
        $controllerModel->showLoginPage();
        break;
    case "register" :
        $controllerModel->showRegisterPage();
        break;
    case "handleRegister" :
        $controllerModel->handleRegister();
        break;
    case "loginHandler" :
        $controllerModel->handleLogin();
        break;
        case "logoutHandler" :
            $controllerModel->handleLogout();
            break;           
     
    default:
        $controllerModel->displayNewsSection();
        $controllerModel->showNavbar();
        $controllerModel->showMarquesSection();
        $controllerModel->showSeparator();
        $controllerModel->showCompPage(); 
}
?>
