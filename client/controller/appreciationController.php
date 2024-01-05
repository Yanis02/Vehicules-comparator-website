<?php
 require_once("./model/avisVehicule.php");
 require_once("./model/avisMarque.php");

class AppreciationController{
    public function handleAppreciation(){
        if(isset($_SESSION['user'])){
            $idUser=$_SESSION['user']["id"];
                if(isset($_GET["idAvis"]) && isset($_GET["idVehicule"])){
                    $idAvis=$_GET["idAvis"];
                    $idVehicule=$_GET["idVehicule"];
                    $avisModel=new AvisVehiculeModel();
                    $result=$avisModel->addAppreciation($idUser,$idAvis);
                    if ($result) {
                        header("Location: ./index.php?action=avisVehicule&idVehicule=" . $idVehicule);
                    } else {
                        echo "Add appreciation failed failed. Please try again.";
                        
                    }
                }
                
                
             
            
        } else echo "user not found";
     }
     public function deleteAppreciation(){
        if(isset($_SESSION['user'])){
            $idUser=$_SESSION['user']["id"];
                if(isset($_GET["idAvis"]) && isset($_GET["idVehicule"])){
                    $idAvis=$_GET["idAvis"];
                    $idVehicule=$_GET["idVehicule"];
                    $avisModel=new AvisVehiculeModel();
                    $result=$avisModel->deleteAppreciation($idUser,$idAvis);
                        header("Location: ./index.php?action=avisVehicule&idVehicule=" . $idVehicule);
                        
                    }
                } else echo "user not found";
                
                
             
            
        } 
        public function handleAppreciationMarque(){
            if(isset($_SESSION['user'])){
                $idUser=$_SESSION['user']["id"];
                    if(isset($_GET["idAvis"]) && isset($_GET["idMarque"])){
                        $idAvis=$_GET["idAvis"];
                        $idMarque=$_GET["idMarque"];
                        $avisModel=new AvisMarqueModel();
                        $result=$avisModel->addAppreciation($idUser,$idAvis);
                        if ($result) {
                            header("Location: ./index.php?action=marques&id=" . $idMarque);
                        } else {
                            echo "Add appreciation failed failed. Please try again.";
                            
                        }
                    }
                    
                    
                 
                
            } else echo "user not found";
         }
         public function deleteAppreciationMarque(){
            if(isset($_SESSION['user'])){
                $idUser=$_SESSION['user']["id"];
                    if(isset($_GET["idAvis"]) && isset($_GET["idMarque"])){
                        $idAvis=$_GET["idAvis"];
                        $idMarque=$_GET["idMarque"];
                        $avisModel=new AvisMarqueModel();
                        $result=$avisModel->deleteAppreciation($idUser,$idAvis);
                        header("Location: ./index.php?action=marques&id=" . $idMarque);
                            
                        }
                    } else echo "user not found";
                    
                    
                 
                
            } 
}
?>