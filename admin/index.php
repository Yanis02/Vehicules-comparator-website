<?php
require_once("./controller/vehiculesController.php");
require_once("./controller/marquesController.php");
require_once("./controller/layoutController.php");
require_once("./controller/avisController.php");
require_once("./controller/userController.php");
require_once("./controller/newsController.php");




$layoutController=new layoutController();
$vehiculeController=new vehiculesController();
$marqueController=new MarquesController();
$avisController=new AvisController();
$userController=new UserController();
$newsController=new NewsController();


$layoutController->showHead();
$layoutController->showNavBar();


$action = isset($_GET['action']) ? $_GET['action'] : 'home';
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
                        
                 
                 
    
    }
    

   
?>