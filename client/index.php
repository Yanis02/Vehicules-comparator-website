<?php
require_once("./controller/accueilController.php");

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
         case "avisVehicule" :
            $controllerModel->showNavbar();
            $controllerModel->showVehiculeAvis();
             break;
   case  "marques" :
    $controllerModel->showNavbar();
    $controllerModel->showMarquesSectionPage();
    $controllerModel->showMarque();
    break; 
    case  "avis" :
        $controllerModel->showNavbar();
        $controllerModel->showMarquesSectionPageForAvis();
        $controllerModel->showAvisPage();
        break; 

    case "news" :
        $controllerModel->showNavbar();
        $controllerModel->showNewsPage();
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
        case "handleAvis" :
            $controllerModel->handleAvis();           
            break;
            case "handleNote" :
                $controllerModel->handleNote();           
                break;
                case "addFavoris" :
                    $controllerModel->handleFavoris();           
                    break;
            case "deleteFavoris" :
                $controllerModel->deleteFavoris();
                break;
            case "appreciateAvis":
                $controllerModel->handleAppreciation();
                break; 
                case "deleteAppreciation" :
                    $controllerModel->deleteAppreciation();
                    break; 
                    case "handleAvisMarque" :
                        $controllerModel->handleAvisMarque();           
                        break;
                        case "handleNoteMarque" :
                            $controllerModel->handleNoteMarque();           
                            break;
                            case "appreciateAvisMarque" :
                                $controllerModel->handleAppreciationMarque();           
                                break; 
                                case "deleteAppreciationMarque" :
                                    $controllerModel->deleteAppreciationMarque();           
                                    break;
                                    case "popularComp" :
                                        $controllerModel->showNavbar();
                                        $controllerModel->popCompDetails();
                                        break; 
                                    case "profile" :
                                        $controllerModel->showNavbar();
                                        $controllerModel->showProfile();
                                        break;                       

    default:
        $controllerModel->displayNewsSection();
        $controllerModel->showNavbar();
        $controllerModel->showMarquesSection();
        $controllerModel->showSeparator();
        $controllerModel->showCompPage(); 
        $controllerModel->showPopularComps();
}
?>
