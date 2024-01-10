<?php
require_once("./view/gestionAvis.php");
require_once("./model/avis.php");
class AvisController{
    private $gestionAvisView;

    public function __construct() {
        $this->gestionAvisView = new GestionAvis();
    }
    public function showAvisTable(){
      $avisModel=new Avis();
      $avis=$avisModel->getAllAvisVehicules();
      $this->gestionAvisView->generateDataTable($avis);
    }
    public function showAvisTableMarques(){
        $avisModel=new Avis();
        $avis=$avisModel->getAllAvisMarques();
        $this->gestionAvisView->generateDataTableMarques($avis);
      }
    public function approuveAvis(){
        if (isset($_GET["id"])) {
            $id=$_GET["id"];
            $avisModel=new Avis();
            $avisModel->approuver($id);  
            header("Location: ./index.php?action=avis");
        }}
        public function approuveAvisMarque(){
            if (isset($_GET["id"])) {
                $id=$_GET["id"];
                $avisModel=new Avis();
                $avisModel->approuverMarque($id);  
                header("Location: ./index.php?action=avisMarques");
            }}
    public function refuserAvis(){
    if (isset($_GET["id"])) {
    $id=$_GET["id"];
    $avisModel=new Avis();
    $avisModel->refuser($id);  
    header("Location: ./index.php?action=avis");
            }    
    
}

public function refuserAvisMarque(){
    if (isset($_GET["id"])) {
    $id=$_GET["id"];
    $avisModel=new Avis();
    $avisModel->refuserMarque($id);  
    header("Location: ./index.php?action=avisMarques");
            }    
    
}
}
?>