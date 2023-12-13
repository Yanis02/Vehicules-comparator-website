<?php
require_once("./model/news.php");
require_once("./view/accueil.php");

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

    public function displayNewsSection(){

        $newsModel=new newsModel();
        $news=$newsModel->getAllNews();
        $accuilModel=new accueil();
        $accuilModel->newsSection($news);
    }

}