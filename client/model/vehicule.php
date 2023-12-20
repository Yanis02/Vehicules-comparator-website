<?php
require_once("modele.php");
$modeleModel = new ModeleModel();

// Check if marqueId is set in the POST data
if (isset($_POST['marqueId'])) {
    $marqueId = $_POST['marqueId'];
    $modeleModel->getModelesByMarqueId($marqueId);
}
 ?>