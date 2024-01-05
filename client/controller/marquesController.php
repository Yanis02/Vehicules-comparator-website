<?php
require_once("./model/marque.php");
require_once("./view/marques.php");
require_once("./view/comparateur.php");
require_once("./view/commun.php");
require_once("./view/avis.php");
require_once("./model/avisMarque.php");
require_once("./model/noteMarque.php");
class MarquesController{

    
    private $marquesView;
public function __construct() {
        $this->marquesView = new Marques();
    }
private function showMarquesSectionPage(){
    
        $marquesModel=new marqueModel();
        $marques=$marquesModel->getAllMarques();
        $this->marquesView->marquesSectionPage($marques,"marques");
       }

public function showMarquesSectionPageForAvis(){
    
        $marquesModel=new marqueModel();
        $marques=$marquesModel->getAllMarques();
        $this->marquesView->marquesSectionPage($marques,"avis");
       }
public function showMarque(){
        $commun=new Commun();
        $avisView=new Avis();
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        $marquesModel=new marqueModel();
        $marque=$marquesModel->getMarqueById($id);
        
        $this->marquesView->marqueDetails($marque);
        $noteModel=new NoteMarqueModel();
        $avg=$noteModel->getAverageNoteForMarque($id);
        $commun->avgNote($avg);
        $commun->separator();
        if(isset($_SESSION['user'])){
            $idUser=$_SESSION['user']["id"];
            $commun->personalSection($id,"","marque"); 
        
        }
        $avisModele=new AvisMarqueModel();
        $topAvis=$avisModele->getTopAvisMarques($id);
        if ($topAvis) {
            $commun->AvisText();
            foreach ($topAvis as $avis) {
                if(isset($_SESSION['user'])){
                    $idUser=$_SESSION['user']["id"];
                $isAppreciated=$avisModele->checkAppreciation($idUser,$avis["avis_id"]);
               
                $avisView->avisMarque($avis,$isAppreciated);

            }else {
                $avisView->avisMarque($avis,false);

            }}
        } 
        }
        
    }

public function showMarquesPage(){
        $this->showMarquesSectionPage();
        $this->showMarque();
       }
public function showComp()
{
        
        $marquesModel=new marqueModel();
        $marques=$marquesModel->getAllMarques();
        $comparateurView=new Comparateur();
         $comparateurView->comparaison($marques);
}       



}


?>