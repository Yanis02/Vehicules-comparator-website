<?php
require_once("./controller/vehiculesController.php");
require_once("./controller/marquesController.php");
require_once("./controller/layoutController.php");
require_once("./controller/avisController.php");
require_once("./controller/userController.php");




$layoutController=new layoutController();
$vehiculeController=new vehiculesController();
$marqueController=new MarquesController();
$avisController=new AvisController();
$userController=new UserController();

$layoutController->showHead();

$action = isset($_GET['action']) ? $_GET['action'] : 'home';
switch ($action) {
    
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
         case "addVehicule": 
            $vehiculeController->addVehicule();
             break;
             case "addMarque": 
                $marqueController->addMarque();
                 break; 
             case "deleteVehicule": 
                $vehiculeController->deleteVehicule();
                 break; 
                 case "deleteMarque": 
                    $marqueController->deleteMarque();
                     break; 

                 case "editVehiculeImage": 
                    $vehiculeController->updateVehiculeImage();
                     break; 
                     case "editMarqueImage": 
                        $marqueController->updateMarqueImage();
                         break; 
                     case  "ajouterCarac":
                        $vehiculeController->showAddCarForm();
                     break; 
                        
                 
                 
    
    }
    
?>