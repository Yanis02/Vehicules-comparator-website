<?php
require_once("./model/marque.php");
require_once("./model/avisVehicule.php");
require_once("./model/avisMarque.php");
require_once("./view/avis.php");
require_once("./view/commun.php");
class AvisController{
    private $avisView;
    public function __construct() {
        $this->avisView = new Avis();
    }
    public function showAvisPage()
    {
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        $marquesModel=new marqueModel();
        $marque=$marquesModel->getMarqueById($id);
        
        $this->avisView->avisPage($marque);}
        
    }
    public function handleAvis(){
        $commun=new Commun();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_SESSION['user'])){
                $id=$_SESSION['user']["id"];
                    $valeur=filter_input(INPUT_POST, 'avis', FILTER_SANITIZE_STRING);;
                    $idVehicule=filter_input(INPUT_POST, 'idVehicule', FILTER_SANITIZE_STRING);
                 $avisModel=new AvisVehiculeModel();
                 $result=$avisModel->addAvis($id,$idVehicule,$valeur);
                 if ($result) {
                    
                    $text="Avis is waiting to be approuved!";
                    $commun->waitingApprouval($text,"vehicule");
                } else {
                    echo "Add Avis failed failed. Please try again.";
                    
                }
            } else echo "user not found";
        }
        
     }
     public function handleAvisMarque(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_SESSION['user'])){
                $id=$_SESSION['user']["id"];
                    $valeur=filter_input(INPUT_POST, 'avis', FILTER_SANITIZE_STRING);;
                    $idMarque=filter_input(INPUT_POST, 'idMarqueAvis', FILTER_SANITIZE_STRING);
                 $avisModel=new AvisMarqueModel();
                 $result=$avisModel->addAvis($id,$idMarque,$valeur);
                 if ($result) {
                    
                    $text="Avis is waiting to be approuved!";
                    $this->accuilModel->waitingApprouval($text,"marque");
                } else {
                    echo "Add Avis failed failed. Please try again.";
                    
                }
            } else echo "user not found";
        }
        
     }
}
?>