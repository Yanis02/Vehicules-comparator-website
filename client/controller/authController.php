<?php
require_once("./view/auth.php");
require_once("./view/commun.php");
require_once("./model/utilisateur.php");

class AuthController{
    private $authView;
    public function __construct() {
        $this->authView = new Auth();
    }
    public function showLoginPage(){
        
        $this->authView->login();  
    }
    public function showRegisterPage(){
        
        $this->authView->register();  
    }
    public function handleRegister() {
        $commun=new Commun();
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
                
                $text="Registration is waiting to be approuved!";
                $id="";
                #$commun->waitingApprouval($text,"register");
                header("Location: ./index.php?action=home");

            } else {
                echo "Registration failed. Please try again.";
                
            }
        } else {
            header("Location: ./index.php?action=register");
            exit();
        }
    }
    public function handleLogin() {
        $commun=new Commun();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $userModel = new UserModel(); 
            $user = $userModel->auth($username, $password);
            if ($user) {
                if($user["valide"]==1){
                    if ($user["bloque"]==0) {
                        # code...
                        echo "Logged in";
                        session_start();
                $_SESSION['user'] = $user;
                header("Location: ./index.php?action=home");
                    }else echo "VOUS ETES BLOQUE";
                   
                } else {
                    
                    $text="Registration is waiting to be approuved!";
                    $id="";
                    $commun->waitingApprouval($text,"register");
                } 
                
            } else {
                
                $text="Wrong credentials";
                $id="";
                $commun->waitingApprouval($text,"login");                
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
}
?>