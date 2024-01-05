<?php
require_once("./view/commun.php");

class layoutController{
    private $communView;

    public function __construct() {
        $this->communView = new Commun();
    }
    public function showHead(){
        $this->communView->head("AdminPanel","site pour l admin de autocomp");
    }
}
?>