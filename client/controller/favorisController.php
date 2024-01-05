<?php
require_once("./model/favoris.php");

class FavorisController{
   
    public function handleFavoris(){
        if(isset($_SESSION['user'])){
            $id=$_SESSION['user']["id"];
                if(isset($_GET["idVehicule"])){
                    $idVehicule=$_GET["idVehicule"];
                    $favorisModel=new FavorisModel();
                    $result=$favorisModel->addFavoris($id,$idVehicule);
                    if ($result) {
                        header("Location: ./index.php?action=detailVehicule&idVehicule=" . $idVehicule);
                    } else {
                        echo "Add Favoris failed failed. Please try again.";
                        
                    }
                }
                
                
             
            
        } else echo "user not found";
     }
     public function deleteFavoris(){
        if(isset($_SESSION['user'])){
            $id=$_SESSION['user']["id"];
                if(isset($_GET["idVehicule"])){
                    $idVehicule=$_GET["idVehicule"];
                    $favorisModel=new FavorisModel();
                    $favorisModel->deleteFavoris($id,$idVehicule);
                    
                        header("Location: ./index.php?action=detailVehicule&idVehicule=" . $idVehicule);
                    }
                 } else echo "user not found";
     }
}
?>