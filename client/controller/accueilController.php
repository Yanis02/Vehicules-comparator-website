<?php
require_once("./model/news.php");
require_once("./model/marque.php");
require_once("./view/accueil.php");
require_once("./model/caracteristique.php");
require_once("./model/vehicule.php");
require_once("./model/utilisateur.php");
require_once("./model/avisVehicule.php");
require_once("./model/noteVehicule.php");
require_once("./model/favoris.php");




class accueilController{
   public function showHead(){
    $accuilModel=new accueil();
    $accuilModel->head("AUTOCOMP","Comparateur de vehicules");
   }
   public function showHeader(){
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
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
        $marques=$marquesModel->getAllMarques();
         $accuilModel->comparaison($marques);
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

    public function showVehiculeDetails(){
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if(isset($_GET['idVehicule'])){
            $id = $_GET['idVehicule'];
        $vehiculeModel=new VehiculeModel();
        $vehicule=$vehiculeModel->getVehiculeById($id);
        $accuilModel=new accueil();
        $accuilModel->vehiculeDetails($vehicule);
        $noteModel=new NoteVehiculeModel();
        $avg=$noteModel->getAverageNoteForVehicule($id);
        $accuilModel->avgNote($avg);
        $this->showSeparator();
        $marquesModel=new marqueModel();
        $marques=$marquesModel->getAllMarques();
        $accuilModel->comparaisonV($marques,$vehicule[0]["vehicule_id"],$vehicule[0]["marque_id"],$vehicule[0]["modele_id"],$vehicule[0]["version_id"]);
        $this->showSeparator();
        if(isset($_SESSION['user'])){
            $idUser=$_SESSION['user']["id"];
        }else echo "user not found";
        $favorisModel=new FavorisModel();
        $result=$favorisModel->checkFavoris($idUser,$id);
        if($result===false) $accuilModel->personalSection($id,false); else $accuilModel->personalSection($id,true);
        
        }
       
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
     public function handleAvis(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_SESSION['user'])){
                $id=$_SESSION['user']["id"];
                    $valeur=filter_input(INPUT_POST, 'avis', FILTER_SANITIZE_STRING);;
                    $idVehicule=filter_input(INPUT_POST, 'idVehicule', FILTER_SANITIZE_STRING);
                 $avisModel=new AvisVehiculeModel();
                 $result=$avisModel->addAvis($id,$idVehicule,$valeur);
                 if ($result) {
                    echo "Avis is waiting to be approuved!";
                    header("Location: ./index.php?action=detailVehicule&idVehicule=" . $idVehicule);
                } else {
                    echo "Add Avis failed failed. Please try again.";
                    
                }
            } else echo "user not found";
        }
        
     }
     public function handleNote(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_SESSION['user'])){
                $id=$_SESSION['user']["id"];
                    $valeur=filter_input(INPUT_POST, 'note', FILTER_SANITIZE_STRING);;
                    $idVehicule=filter_input(INPUT_POST, 'idVehicule', FILTER_SANITIZE_STRING);
                 $noteModel=new NoteVehiculeModel();
                 $result=$noteModel->addNote($id,$idVehicule,$valeur);
                 if ($result) {
                    header("Location: ./index.php?action=detailVehicule&idVehicule=" . $idVehicule);
                } else {
                    echo "Add Note failed failed. Please try again.";
                    
                }
            } else echo "user not found";
        }
        
     }

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
    public function showLoginPage(){
        $accuilModel=new accueil();
        $accuilModel->login();  
    }
    public function showRegisterPage(){
        $accuilModel=new accueil();
        $accuilModel->register();  
    }

    public function handleRegister() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
            $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
            $sexe = filter_input(INPUT_POST, 'sexe', FILTER_SANITIZE_STRING);
            $dateNaissance = filter_input(INPUT_POST, 'date_naissance', FILTER_SANITIZE_STRING);
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    
    
            $userModel = new UserModel(); 
            $success = $userModel->addUser($nom, $prenom, $sexe, $dateNaissance, $username, $password);
             echo $success;
            if ($success) {
                echo "Registration is waiting to be approuved!";
            } else {
                echo "Registration failed. Please try again.";
                
            }
        } else {
            header("Location: ./index.php?action=register");
            exit();
        }
    }
    
    public function handleLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $userModel = new UserModel(); 
            $user = $userModel->auth($username, $password);
            if ($user) {
                if($user["valide"]==1){
                    echo "Logged in";
                        session_start();
                $_SESSION['user'] = $user;
                header("Location: ./index.php?action=home");
                } else echo "Waiting to be approuved";
                
            } else {
                echo "Login failed. Please try again.";
                
            }
        } 
}
public function handleLogout(){
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (isset($_SESSION)) session_destroy();
    header("Location: ./index.php?action=home");

}
} ?>