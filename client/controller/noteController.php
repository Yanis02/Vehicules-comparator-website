<?php
require_once("./model/noteVehicule.php");
require_once("./model/noteMarque.php");
require_once("./view/news.php");
class NoteController{
    
    public function handleNote(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_SESSION['user'])){
                $id=$_SESSION['user']["id"];
                    $valeur=filter_input(INPUT_POST, 'note', FILTER_SANITIZE_STRING);;
                    $idVehicule=filter_input(INPUT_POST, 'idVehicule', FILTER_SANITIZE_STRING);
                 $noteModel=new NoteVehiculeModel();
                 $result=$noteModel->addNote($id,$idVehicule,$valeur);
                 header("Location: ./index.php?action=detailVehicule&idVehicule=" . $idVehicule);
                    
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
                 header("Location: ./index.php?action=marques&id=" . $idMarqueNote);
                 #echo "Add Note failed failed. Please try again.";
                    
            } else echo "user not found";
        }
     }
}
?>