<?php
require_once("./controller/accueilController.php");
$controllerModel=new accueilController();
$controllerModel->showHead();
$controllerModel->showHeader();
$controllerModel->displayNewsSection();
$controllerModel->showNavbar();
$controllerModel->showMarquesSection();
$controllerModel->showSeparator();
$controllerModel->showComp();

?>