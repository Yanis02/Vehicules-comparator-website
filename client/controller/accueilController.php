<?php
require_once("./model/news.php");
require_once("./model/marque.php");
require_once("./view/accueil.php");
require_once("./model/caracteristique.php");


class accueilController{
   public function showHead(){
    $accuilModel=new accueil();
    $accuilModel->head("AUTOCOMP","Comparateur de vehicules");
   }
   public function showHeader(){
    $accuilModel=new accueil();
    $accuilModel->header();
   }
   public function showNavbar(){
    $accuilModel=new accueil();
    $accuilModel->navBar();
   }
   public function showMarquesSection(){
    $accuilModel=new accueil();
    $marquesModel=new marqueModel();
    $marques=$marquesModel->getAllMarques();
    $accuilModel->marquesSection($marques);
   }
   public function showMarquesSectionPage(){
    $accuilModel=new accueil();
    $marquesModel=new marqueModel();
    $marques=$marquesModel->getAllMarques();
    $accuilModel->marquesSectionPage($marques);
   }

    public function displayNewsSection(){

        $newsModel=new newsModel();
        $news=$newsModel->getAllNews();
        $accuilModel=new accueil();
        $accuilModel->newsSection($news);
    }
    public function showSeparator(){
        $accuilModel=new accueil();
        $accuilModel->separator();
    }
    public function showCompPage(){
        $accuilModel=new accueil();
        $marquesModel=new marqueModel();
        $caracModel=new CaracModel();
        $marques=$marquesModel->getAllMarques();
        $carac=$caracModel->getCarac();
         $accuilModel->comparaisonPage($marques,$carac);
    }
    public function showComp(){
        $accuilModel=new accueil();
        $marquesModel=new marqueModel();
        $caracModel=new CaracModel();
        $marques=$marquesModel->getAllMarques();
        $carac=$caracModel->getCarac();
         $accuilModel->comparaison($marques,$carac);
    }

    public function showMarque(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $marquesModel=new marqueModel();
        $marque=$marquesModel->getMarqueById($id);
        $accuilModel=new accueil();
        $accuilModel->marqueDetails($marque);
        }
        
    }

}