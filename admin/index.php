<?php
require_once("./controller/vehiculesController.php");
require_once("./controller/marquesController.php");
require_once("./controller/layoutController.php");
require_once("./controller/avisController.php");
require_once("./controller/userController.php");
require_once("./controller/newsController.php");
require_once("./controller/contactController.php");
require_once("./controller/authController.php");
require_once("./controller/pubController.php");






$layoutController=new layoutController();
$vehiculeController=new vehiculesController();
$marqueController=new MarquesController();
$avisController=new AvisController();
$userController=new UserController();
$newsController=new NewsController();
$contactController=new ContactController();
$authController=new AuthController();
$pubController=new PubController();


$layoutController->showHead();


$action = isset($_GET['action']) ? $_GET['action'] : 'auth';

if ($action=="auth"){
   $layoutController->showAuthFrom();
   

}else if($action=="loginHandler"){
    $authController->auth();
} else {
   if (session_status() != PHP_SESSION_ACTIVE) {
      session_start();
  }
   if(isset($_SESSION['admin'])){
$layoutController->showNavBar();



switch ($action) {
              case "home":
                $layoutController->showDashboard();
                break;
              case "marques":
                $marqueController->showMarquesTable();
                      break;
                      case "users":
                        $userController->showUserTable();
                        break;
                        case "validerUser":
                           $userController->validerUser();
                           break;
                           case "profileUser":
                              $userController->profile();
                              break;
                      case "avis":
                        $avisController->showAvisTable();
                              break;
                              case "avisMarques":
                                 $avisController->showAvisTableMarques();
                                       break;
                              case "approuverAvisVehicule":
                                 $avisController->approuveAvis();
                                 break;
                                 case "approuverAvisMarque":
                                    $avisController->approuveAvisMarque();
                                    break;
                                 case "refuserAvisVehicule":
                                    $avisController->refuserAvis();
                                    break;
                                    case "refuserAvisMarque":
                                       $avisController->refuserAvisMarque();
                                       break;
                                    case "bloquerUtilisateur":
                                       $userController->bloquerUser();
                                       break;
                                       case "debloquerUtilisateur":
                                          $userController->debloquerUser();
                                          break;
                                          case "news":
                                             $newsController->showNewsTable();
                                             break;
                                             case "detailNews":
                                                $newsController->showNewsDetails();
                                                break;
                      case "detailMarque":
                        $marqueController->showMarqueDetails();
                              break;
    case "detailVehicule": 
        $vehiculeController->showVehiculeDetails();
        break;
    case "ajouterVehicule": 
        $vehiculeController->showVehiculeForm();
         break; 
         case "ajouterMarque": 
            $marqueController->showMarquesForm();
             break; 
             case "ajouterNews": 
               $newsController->showAddNewsForm();
                break;    
         case "addVehicule": 
            $vehiculeController->addVehicule();
             break;
             case "addMarque": 
                $marqueController->addMarque();
                 break; 
                 case "addNews": 
                  $newsController->addNews();
                   break; 
             case "deleteVehicule": 
                $vehiculeController->deleteVehicule();
                 break; 
                 case "deleteMarque": 
                    $marqueController->deleteMarque();
                     break; 
                     case "deleteNews": 
                        $newsController->deleteNews();
                         break; 

                 case "editVehiculeImage": 
                    $vehiculeController->updateVehiculeImage();
                     break; 
                     case "editMarqueImage": 
                        $marqueController->updateMarqueImage();
                         break; 
                         case "editNewsImage":
                           $newsController->updateNewsImage();
                           break;
                     case  "ajouterCarac":
                        $vehiculeController->showAddCarForm();
                     break; 
                     case "contact":
                        $contactController->showContactDetails();
                        break; 
                        case "parametres":
                           $layoutController->showParametres();
                           break;
                           case "logout":
                              $authController->handleLogout();
                              break;
                              case "diaporama":
                                 $pubController->showPubTable();
                                 $newsController->showPubTableD();
                                 break;
                                 case "ajouterPub":
                                    $pubController->showAddPubForm();
                                    break;
                                    case "addPub":
                                       $pubController->addPub();
                                       break;
                                       case "detailPub":
                                          $pubController->showPubDetails();
                                          break;
                                          case "editPubImage":
                                             $pubController->updatePubImage();
                                             break;
                                             case "deletePub":
                                                $pubController->deletePub();
                                                break;
                                                case "afficherPub":
                                                   $pubController->afficherPub();
                                                   break;
                                                   case "cacherPub":
                                                      $pubController->cacherPub();
                                                      break;
                                                      case "afficherNews":
                                                         $newsController->afficherNews();
                                                         break;
                                                         case "cacherNews":
                                                            $newsController->cacherNews();
                                                            break;
                 
                 
    
    }}else  echo "ADMIN NOT LOGGED IN";}
    

   
?>