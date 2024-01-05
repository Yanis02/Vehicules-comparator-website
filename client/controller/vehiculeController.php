<?php
require_once("./model/marque.php");
require_once("./view/vehicule.php");
require_once("./view/commun.php");
require_once("./view/comparateur.php");
require_once("./view/avis.php");
require_once("./model/vehicule.php");
require_once("./model/avisVehicule.php");
require_once("./model/noteVehicule.php");
require_once("./model/favoris.php");
require_once("./model/comparaison.php");
class VehiculeController{
    private $vehiculeView;
    public function __construct() {
        $this->vehiculeView = new Vehicule();
    }
    
    public function showVehiculeDetails()
    {
        $commun=new Commun();
        $avisView=new Avis();
        $comparateurView=new Comparateur();
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if(isset($_GET['idVehicule'])){
            $id = $_GET['idVehicule'];
        $vehiculeModel=new VehiculeModel();
        $vehicule=$vehiculeModel->getVehiculeById($id); 
        $this->vehiculeView->vehiculeDetails($vehicule);
        $noteModel=new NoteVehiculeModel();
        $avg=$noteModel->getAverageNoteForVehicule($id);
        $commun->avgNote($avg);
        $commun->separator();
        $marquesModel=new marqueModel();
        $marques=$marquesModel->getAllMarques();
        $comparateurView->comparaisonV($marques,$vehicule[0]["vehicule_id"],$vehicule[0]["marque_id"],$vehicule[0]["modele_id"],$vehicule[0]["version_id"]);
        $commun->separator();
        $avisModele=new AvisVehiculeModel();
        $topAvis=$avisModele->getTopAvisVehicules($id);
        if ($topAvis) {
            $commun->AvisText();
            foreach ($topAvis as $avis) {
                if(isset($_SESSION['user'])){
                    $idUser=$_SESSION['user']["id"];
                $isAppreciated=$avisModele->checkAppreciation($idUser,$avis["avis_id"]);
               
                $avisView->avisVehicule($avis,$isAppreciated);

            }else {
                $avisView->avisVehicule($avis,false);

            }}
            $avisView->allAvisBtn($id);
        } 
        if(isset($_SESSION['user'])){
            $idUser=$_SESSION['user']["id"];
            $favorisModel=new FavorisModel();
         $result=$favorisModel->checkFavoris($idUser,$id);
         $commun->personalSection($id,$result,"vehicule"); 

        }
        $compModel=new ComparaisonModel();
        $popularComps=$compModel->getPopCompsVehicle($id);
        $comps=array();
     foreach ($popularComps as $pop) {
        $idVehicule_1=$pop["idVehicule_1"];
        $idVehicule_2=$pop["idVehicule_2"];
      $vehicule_1=$vehiculeModel->getVehiculeById($idVehicule_1);
      $vehicule_2=$vehiculeModel->getVehiculeById($idVehicule_2);
      $temp=array();
      array_push($temp,$vehicule_1);
      array_push($temp,$vehicule_2);
      ##print_r($temp);
      ##echo "------------";
      array_push($comps,$temp);
      unset($temp);
     }
      $commun->separator();
      $comparateurView->popularComps($comps);
         }
       
    }  
    public function showVehiculeAvis()
    {
        $commun=new Commun();
        $avisView=new Avis();
        if (isset($_GET['idVehicule'])) {
            $id = $_GET['idVehicule'];
            $vehiculeModel = new VehiculeModel();
            $vehicule = $vehiculeModel->getVehiculeById($id);
            $avisView->vehiculeAvis($vehicule);
            $noteModel = new NoteVehiculeModel();
            $avg = $noteModel->getAverageNoteForVehicule($id);
            $commun->avgNote($avg);
            $commun->separator();
            $avisModele = new AvisVehiculeModel();
    
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
            $avisPerPage = 5;
    
            $topAvis = $avisModele->getAllAvisVehicules($id, $currentPage, $avisPerPage);
    
            if ($topAvis) {
                $commun->AvisText();
                foreach ($topAvis as $avis) {
                    if (isset($_SESSION['user'])) {
                        $idUser = $_SESSION['user']["id"];
                        $isAppreciated = $avisModele->checkAppreciation($idUser, $avis["avis_id"]);
    
                        $avisView->avisVehicule($avis, $isAppreciated);
                    } else {
                        $avisView->avisVehicule($avis, false);
                    }
                }
            } else {
                $avisView->AvisNotFound();
            }
    
            $totalAvis = $avisModele->getTotalAvisCount($id);
            $totalPages = ceil($totalAvis / $avisPerPage);
    
            $commun->pagination($currentPage, $totalPages);
            $commun->vehiculeDetailsBtn($id);
        }
    }
    
  
}
?>