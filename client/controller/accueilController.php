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
require_once("./model/avisMarque.php");
require_once("./model/noteMarque.php");
require_once("./model/comparaison.php");






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
    $accuilModel->marquesSectionPage($marques,"marques");
   }
   public function showMarquesSectionPageForAvis(){
    $accuilModel=new accueil();
    $marquesModel=new marqueModel();
    $marques=$marquesModel->getAllMarques();
    $accuilModel->marquesSectionPage($marques,"avis");
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
    public function showAvisPage()
{
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    $marquesModel=new marqueModel();
    $marque=$marquesModel->getMarqueById($id);
    $accuilModel=new accueil();
    $accuilModel->avisPage($marque);}
    
}
    public function showMarque(){
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        $marquesModel=new marqueModel();
        $marque=$marquesModel->getMarqueById($id);
        $accuilModel=new accueil();
        $accuilModel->marqueDetails($marque);
        $noteModel=new NoteMarqueModel();
        $avg=$noteModel->getAverageNoteForMarque($id);
        $accuilModel->avgNote($avg);
        $this->showSeparator();
        if(isset($_SESSION['user'])){
            $idUser=$_SESSION['user']["id"];
         $accuilModel->personalSection($id,"","marque"); 
        
        }
        $avisModele=new AvisMarqueModel();
        $topAvis=$avisModele->getTopAvisMarques($id);
        if ($topAvis) {
            $accuilModel->AvisText();
            foreach ($topAvis as $avis) {
                if(isset($_SESSION['user'])){
                    $idUser=$_SESSION['user']["id"];
                $isAppreciated=$avisModele->checkAppreciation($idUser,$avis["avis_id"]);
               
                 $accuilModel->avisMarque($avis,$isAppreciated);

            }else {
                $accuilModel->avisMarque($avis,false);

            }}
        } 
        }
        
    }
    public function showVehiculeAvis()
    {
        if (isset($_GET['idVehicule'])) {
            $id = $_GET['idVehicule'];
            $vehiculeModel = new VehiculeModel();
            $vehicule = $vehiculeModel->getVehiculeById($id);
            $accuilModel = new accueil();
            $accuilModel->vehiculeAvis($vehicule);
            $noteModel = new NoteVehiculeModel();
            $avg = $noteModel->getAverageNoteForVehicule($id);
            $accuilModel->avgNote($avg);
            $this->showSeparator();
            $avisModele = new AvisVehiculeModel();
    
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
            $avisPerPage = 5;
    
            $topAvis = $avisModele->getAllAvisVehicules($id, $currentPage, $avisPerPage);
    
            if ($topAvis) {
                $accuilModel->AvisText();
                foreach ($topAvis as $avis) {
                    if (isset($_SESSION['user'])) {
                        $idUser = $_SESSION['user']["id"];
                        $isAppreciated = $avisModele->checkAppreciation($idUser, $avis["avis_id"]);
    
                        $accuilModel->avisVehicule($avis, $isAppreciated);
                    } else {
                        $accuilModel->avisVehicule($avis, false);
                    }
                }
            } else {
                $accuilModel->AvisNotFound();
            }
    
            $totalAvis = $avisModele->getTotalAvisCount($id);
            $totalPages = ceil($totalAvis / $avisPerPage);
    
            $accuilModel->pagination($currentPage, $totalPages);
            $accuilModel->vehiculeDetailsBtn($id);
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
        
        $avisModele=new AvisVehiculeModel();
        $topAvis=$avisModele->getTopAvisVehicules($id);
        if ($topAvis) {
            $accuilModel->AvisText();
            foreach ($topAvis as $avis) {
                if(isset($_SESSION['user'])){
                    $idUser=$_SESSION['user']["id"];
                $isAppreciated=$avisModele->checkAppreciation($idUser,$avis["avis_id"]);
               
                 $accuilModel->avisVehicule($avis,$isAppreciated);

            }else {
                $accuilModel->avisVehicule($avis,false);

            }}
            $accuilModel->allAvisBtn($id);
        } 
        if(isset($_SESSION['user'])){
            $idUser=$_SESSION['user']["id"];
            $favorisModel=new FavorisModel();
        $result=$favorisModel->checkFavoris($idUser,$id);
        $accuilModel->personalSection($id,$result,"vehicule"); 

        }

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
     
     public function handleAvis(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_SESSION['user'])){
                $id=$_SESSION['user']["id"];
                    $valeur=filter_input(INPUT_POST, 'avis', FILTER_SANITIZE_STRING);;
                    $idVehicule=filter_input(INPUT_POST, 'idVehicule', FILTER_SANITIZE_STRING);
                 $avisModel=new AvisVehiculeModel();
                 $result=$avisModel->addAvis($id,$idVehicule,$valeur);
                 if ($result) {
                    $accuilModel=new accueil();
                    $text="Avis is waiting to be approuved!";
                    $accuilModel->waitingApprouval($text,"vehicule");
                } else {
                    echo "Add Avis failed failed. Please try again.";
                    
                }
            } else echo "user not found";
        }
        
     }
     public function handleAvisMarque(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_SESSION['user'])){
                $id=$_SESSION['user']["id"];
                    $valeur=filter_input(INPUT_POST, 'avis', FILTER_SANITIZE_STRING);;
                    $idMarque=filter_input(INPUT_POST, 'idMarqueAvis', FILTER_SANITIZE_STRING);
                 $avisModel=new AvisMarqueModel();
                 $result=$avisModel->addAvis($id,$idMarque,$valeur);
                 if ($result) {
                    $accuilModel=new accueil();
                    $text="Avis is waiting to be approuved!";
                    $accuilModel->waitingApprouval($text,"marque");
                } else {
                    echo "Add Avis failed failed. Please try again.";
                    
                }
            } else echo "user not found";
        }
        
     }
     public function handleNoteMarque(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_SESSION['user'])){
                $id=$_SESSION['user']["id"];
                    $valeur=filter_input(INPUT_POST, 'note', FILTER_SANITIZE_STRING);;
                    $idMarqueNote=filter_input(INPUT_POST, 'idMarqueNote', FILTER_SANITIZE_STRING);
                 $noteModel=new NoteMarqueModel();
                 $result=$noteModel->addNote($id,$idMarqueNote,$valeur);
                    header("Location: ./index.php?action=home");
                    echo "Add Note failed failed. Please try again.";
                    
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
                    header("Location: ./index.php?action=home");
                    
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
            if ($success) {
                $accuilModel=new accueil();
                $text="Registration is waiting to be approuved!";
                $id="";
                $accuilModel->waitingApprouval($text,"register");
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
                } else {
                    $accuilModel=new accueil();
                    $text="Registration is waiting to be approuved!";
                    $id="";
                    $accuilModel->waitingApprouval($text,"register");
                } 
                
            } else {
                $accuilModel=new accueil();
                $text="Wrong credentials";
                $id="";
                $accuilModel->waitingApprouval($text,"login");                
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
 public function showPopularComps(){
    $compModel=new ComparaisonModel();
    $VehiculeModel=new VehiculeModel();
    $popularComps=$compModel->getTopPopularComparisons();
    $accuilModel=new accueil();
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
   $accuilModel->popularComps($comps);
 }
} ?>