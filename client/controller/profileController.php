<?php
require_once("./view/profile.php");
require_once("./model/vehicule.php");
require_once("./model/favoris.php");



class ProfileController{
    private $profileView;
public function __construct() {
        $this->profileView = new Profile();
    }
    public function showProfile(){
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (isset($_SESSION['user'])) {
              $idUser=$_SESSION['user']["id"];
              $favorisModel=new FavorisModel();
              $vehiculeModel=new VehiculeModel();
              $favoris=$favorisModel->getAllFavoris($idUser);
              $favoris_tab=array();
              
                foreach ($favoris as $fav) {
                $vehicule=$vehiculeModel->getVehiculeById($fav["idVehicule"]);
                array_push($favoris_tab,$vehicule);
                }
                ##var_dump($favoris_tab);
                $this->profileView->profile($favoris_tab);
              
        }
     }
}
?>