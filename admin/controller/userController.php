<?php
require_once("./view/gestionUsers.php");
require_once("./model/user.php");
require_once("./model/vehicule.php");

class UserController{
    private $gestionUsersView;

    public function __construct() {
        $this->gestionUsersView = new GestionUsers();
    }
    
    public function bloquerUser(){
    if (isset($_GET["id"])) {
    $id=$_GET["id"];
    $userModel=new UserModel();
    $userModel->bloquer($id);  
    header("Location: ./index.php?action=users");
            }    
    
}
public function debloquerUser(){
    if (isset($_GET["id"])) {
    $id=$_GET["id"];
    $userModel=new UserModel();
    $userModel->debloquer($id);  
    header("Location: ./index.php?action=users");
            }    
    
}
public function validerUser(){
    if (isset($_GET["id"])) {
    $id=$_GET["id"];
    $userModel=new UserModel();
    $userModel->valider($id);  
    header("Location: ./index.php?action=users");
            }    
    
}
public function showUserTable(){
    $userModel=new UserModel();
   $users= $userModel->getAllUsers();
   $this->gestionUsersView->generateDataTable($users);
}
public function profile(){
    if (isset($_GET["id"])) {
    $id=$_GET["id"];
    $userModel=new UserModel();
    $vehiculeModel=new VehiculeModel();
    $favoris=$userModel->getAllFavoris($id);  
    $favoris_tab=array();
    $user=$userModel->getUserById($id);
    foreach ($favoris as $fav) {
        $vehicule=$vehiculeModel->getVehiculeById($fav["idVehicule"]);
        array_push($favoris_tab,$vehicule);
        }
        $this->gestionUsersView->profile($favoris_tab,$user);
            }    
    
}
}
?>