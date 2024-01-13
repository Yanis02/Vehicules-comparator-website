<?php
require_once("./controller/accueilController.php");
require_once("./controller/marquesController.php");
require_once("./controller/vehiculeController.php");
require_once("./controller/avisController.php");
require_once("./controller/newsController.php");
require_once("./controller/authController.php");
require_once("./controller/noteController.php");
require_once("./controller/favorisController.php");
require_once("./controller/appreciationController.php");
require_once("./controller/comparaisonController.php");
require_once("./controller/profileController.php");
require_once("./controller/contactController.php");
require_once("./controller/communController.php");



$action = isset($_GET['action']) ? $_GET['action'] : 'home';

$controllerModel = new accueilController();
$marquesController=new MarquesController();
$vehiculeController=new VehiculeController();
$avisController=new AvisController();
$newsController=new NewsController();
$authController=new AuthController();
$noteController=new NoteController();
$favorisController=new FavorisController();
$appreciationController=new AppreciationController();
$comparaisonController=new ComparaisonController();
$profileController=new ProfileController();
$contactController=new ContactController();
$communController=new communController();


$controllerModel->showHead();
$controllerModel->showHeader();


switch ($action) {
    case "comparateur": 
        $controllerModel->showNavbar();
        $marquesController->showComp();
        break;
    case "detailVehicule" :
        $controllerModel->showNavbar();
        $vehiculeController->showVehiculeDetails();
         break;
         case "avisVehicule" :
            $controllerModel->showNavbar();
            $vehiculeController->showVehiculeAvis();
             break;
   case  "marques" :
    $controllerModel->showNavbar();
    $marquesController->showMarquesPage();
    break; 
    case  "avis" :
        $controllerModel->showNavbar();
        $marquesController->showMarquesSectionPageForAvis();
        $avisController->showAvisPage();
        break; 

    case "news" :
        $controllerModel->showNavbar();
        $newsController->showNewsPage();
        break;    
    case "auth" :
        $authController->showLoginPage();
        break;
    case "register" :
        $authController->showRegisterPage();
        break;
    case "handleRegister" :
        $authController->handleRegister();
        break;
    case "loginHandler" :
        $authController->handleLogin();
        break;
        case "logoutHandler" :
            $authController->handleLogout();
            break;
        case "handleAvis" :
            $avisController->handleAvis();           
            break;
            case "handleNote" :
                $noteController->handleNote();           
                break;
                case "addFavoris" :
                    $favorisController->handleFavoris();           
                    break;
            case "deleteFavoris" :
                $favorisController->deleteFavoris();
                break;
            case "appreciateAvis":
                $appreciationController->handleAppreciation();
                break; 
                case "deleteAppreciation" :
                    $appreciationController->deleteAppreciation();
                    break; 
                    case "handleAvisMarque" :
                        $avisController->handleAvisMarque();           
                        break;
                        case "handleNoteMarque" :
                            $noteController->handleNoteMarque();           
                            break;
                            case "appreciateAvisMarque" :
                                $appreciationController->handleAppreciationMarque();           
                                break; 
                                case "deleteAppreciationMarque" :
                                    $appreciationController->deleteAppreciationMarque();           
                                    break;
                                    case "popularComp" :
                                        $controllerModel->showNavbar();
                                        $comparaisonController->popCompDetails();
                                        break; 
                                    case "profile" :
                                        $controllerModel->showNavbar();
                                        $profileController->showProfile();
                                        break;    
                                        case "contact":
                                            $controllerModel->showNavbar();

                                            $contactController->showContactDetails();
                                            break;
                                            case "detailNews":
                                                $controllerModel->showNavbar();

                                                $newsController->showNewsDetails();
                                                break;
                                                               

    default:
        $controllerModel->displayNewsSection();
        $controllerModel->showNavbar();
        $controllerModel->showMarquesSection();
        $controllerModel->showCompPage(); 
        $controllerModel->showPopularComps();
}
   $communController->showFooter();
?>
