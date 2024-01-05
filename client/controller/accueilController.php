<?php
require_once("./model/news.php");
require_once("./model/marque.php");
require_once("./view/accueil.php");
require_once("./view/commun.php");
require_once("./view/comparateur.php");
require_once("./model/caracteristique.php");
require_once("./model/vehicule.php");
require_once("./model/comparaison.php");






class accueilController{
    private $accuilModel;

    public function __construct() {
        $this->accuilModel = new accueil();
    }
   public function showHead(){
    
    $this->accuilModel->head("AUTOCOMP","Comparateur de vehicules");
   }
   public function showHeader(){
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    
    $this->accuilModel->header();
   }
   public function showNavbar(){
    
    $this->accuilModel->navBar();
   }
   public function showMarquesSection(){
    
    $marquesModel=new marqueModel();
    $marques=$marquesModel->getAllMarques();
    $this->accuilModel->marquesSection($marques);
   }
   public function displayNewsSection()
{

        $newsModel=new newsModel();
        $news=$newsModel->getAllNews();
        
        $this->accuilModel->newsSection($news);
}

    public function showCompPage(){
        $comparateur=new Comparateur();
        $marquesModel=new marqueModel();
        $caracModel=new CaracModel();
        $marques=$marquesModel->getAllMarques();
        $carac=$caracModel->getCarac();
        $comparateur->comparaisonPage($marques,$carac);
    }
public function showPopularComps(){
    $compModel=new ComparaisonModel();
    $VehiculeModel=new VehiculeModel();
    $comparateur=new Comparateur();
    $popularComps=$compModel->getTopPopularComparisons();
    
    $comps=array();
    foreach ($popularComps as $pop) {
        $idVehicule_1=$pop["idVehicule_1"];
        $idVehicule_2=$pop["idVehicule_2"];
      $vehicule_1=$VehiculeModel->getVehiculeById($idVehicule_1);
      $vehicule_2=$VehiculeModel->getVehiculeById($idVehicule_2);
      $temp=array();
      array_push($temp,$vehicule_1);
      array_push($temp,$vehicule_2);
      ##print_r($temp);
      ##echo "------------";
      array_push($comps,$temp);
      unset($temp);
    }
      ##print_r($comps[0][0][0]["vehicule_name"]);
     $comparateur->popularComps($comps);
 }
 
 

 
} ?>