<?php
require_once("./model/admin.php");
require_once("./view/commun.php");

class AuthController{
    public function auth(){
        $commun=new Commun();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $userModel = new Admin(); 
            $user = $userModel->auth($username, $password);
            if ($user) {
                        # code...
                        echo "Logged in";
                        session_start();
                $_SESSION['admin'] = $user;
                header("Location: ./index.php?action=home");
                   
                
                
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
    
        if (isset($_SESSION)) unset($_SESSION['admin']);
        header("Location: ./index.php?action=auth");
    
    }
    
}

?>