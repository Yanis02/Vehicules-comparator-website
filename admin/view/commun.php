<?php
class Commun{
    public function head($title, $description)
 {
 ?>
  <!DOCTYPE html>
  <html>
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="pragma" content="no cache" />
            <title><?php echo $title ?></title>
            <meta name="description" content=<?php echo $description ?> />
            
            <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <link rel="stylesheet" href="styles.css">

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  </head>
    <?php
}
public function footer (){
    ?>
    </html>
    <?php
}
public function displayCard($imageSrc, $cardTitle, $buttonText, $id) {
    $card = '<div class="card" style="width: 18rem;">';
    
    $cardImage = '<img class="card-img-top" src="' . $imageSrc . '" alt="Card Image">';

    $cardBody = '<div class="card-body">';

    $cardTitleElement = '<h5 class="card-title">' . $cardTitle . '</h5>';

    $button = '<a class="btn btn-primary" style="border:none;background-color:#F41F11" href="./index.php?action=detailVehicule&idVehicule=' . $id . '">' . $buttonText . '</a>';

    $cardBody .= $cardTitleElement . $button;

    $card .= $cardImage . $cardBody . '</div></div>';

    // Output the card
    echo $card;
}
public function navBar()
{
    $currentAction = isset($_GET['action']) ? $_GET['action'] : '';

    ?>
    <div style="width: 100%; display: flex; justify-content: center; align-items: center; height: 100px; border-bottom: solid 2px #F41F11; margin-bottom:60px; position: sticky; top: 0; background-color: #fff; z-index: 1000;">
        <ul style="width: 90%; display: flex; flex-direction: row; justify-content: space-around; align-items: center; list-style: none; font-size: 20px;">
            <li><a href="./index.php?action=home" style="text-decoration: none; color: <?= $currentAction === 'home' ? 'red' : '#000'; ?>">Accueil</a></li>
            <li><a href="./index.php?action=marques" style="text-decoration: none; color: <?= $currentAction === 'marques' ? 'red' : '#000'; ?>">Marques & vehicules</a></li>
            <li><a href="./index.php?action=avisMarques" style="text-decoration: none; color: <?= $currentAction === 'avisMarques' ? 'red' : '#000'; ?>">Avis marques</a></li>
            <li><a href="./index.php?action=avis" style="text-decoration: none; color: <?= $currentAction === 'avis' ? 'red' : '#000'; ?>">Avis vehicules</a></li>
            <li><a href="./index.php?action=users" style="text-decoration: none; color: <?= $currentAction === 'users' ? 'red' : '#000'; ?>">Utilisateurs</a></li>
            <li><a href="./index.php?action=news" style="text-decoration: none; color: <?= $currentAction === 'news' ? 'red' : '#000'; ?>">News</a></li>
            <li><a href="./index.php?action=parametres" style="text-decoration: none; color: <?= $currentAction === 'parametres' ? 'red' : '#000'; ?>">Parametres</a></li>
            <li><a href="./index.php?action=logout" style="text-decoration: none; color: <?= $currentAction === 'logout' ? 'red' : '#000'; ?>">logout</a></li>

        </ul>
    </div>
    <?php
}

public function dashBoard(){
    ?>
    <div style="display:flex;justify-content:center;align-items:center;width:100%;flex-direction:column;">
    <h1>Admin dashboard</h1>
    <div style="flex-wrap:wrap;width:80%;height:700px;display:flex;align-items:center;border:solid 2px #F41F11;border-radius:10px;justify-content:space-evenly;padding:20px;">
           <a href="./index.php?action=marques" style="text-decoration:none;color:black"><div style="width:250px;height:320px;display:flex;flex-direction:column;gap:10px;border:solid 2px #F41F11;border-radius:5px;padding:10px">
              <img style="width:100%;object:cover;" src="./assets/gestionMv.png">
              <h5>Gestion des marques et des vehicules</h5>
          </div></a>
          <a href="./index.php?action=avisMarques" style="text-decoration:none;color:black"><div style="width:250px;height:320px;display:flex;flex-direction:column;gap:10px;border:solid 2px #F41F11;border-radius:5px;padding:10px">
              <img style="width:100%;object:cover;" src="./assets/gestionAvis.png">
              <h5>Gestion des Avis marques</h5>
          </div></a>
          <a href="./index.php?action=avis" style="text-decoration:none;color:black"><div style="width:250px;height:320px;display:flex;flex-direction:column;gap:10px;border:solid 2px #F41F11;border-radius:5px;padding:10px">
              <img style="width:100%;object:cover;" src="./assets/gestionAvis.png">
              <h5>Gestion des Avis vehicules</h5>
          </div></a>
          <a href="./index.php?action=users" style="text-decoration:none;color:black"><div style="width:250px;height:320px;display:flex;flex-direction:column;gap:10px;border:solid 2px #F41F11;border-radius:5px;padding:10px">
              <img style="width:100%;object:cover;" src="./assets/gestionUser.png">
              <h5>Gestion des utilisateurs</h5>
          </div></a>
          <a href="./index.php?action=news" style="text-decoration:none;color:black"><div style="width:250px;height:320px;display:flex;flex-direction:column;gap:10px;border:solid 2px #F41F11;border-radius:5px;padding:10px">
              <img style="width:100%;object:cover;" src="./assets/gestionNews.png">
              <h5>Gestion des news</h5>
          </div></a>
          <a href="./index.php?action=parametres" style="text-decoration:none;color:black"><div style="width:250px;height:320px;display:flex;flex-direction:column;gap:10px;border:solid 2px #F41F11;border-radius:5px;padding:10px">
              <img style="width:100%;object:cover;" src="./assets/settings.png">
              <h5>Parametres</h5>
          </div></a>
          
   </div>
</div>
    <?php
}


public function parametres(){
    ?>
    <div style="display:flex;justify-content:center;align-items:center;width:100%;flex-direction:column;">
    <h1>Gestion des parametres</h1>
    <div style="flex-wrap:wrap;width:80%;height:700px;display:flex;align-items:center;border:solid 2px #F41F11;border-radius:10px;justify-content:space-evenly;padding:20px;">
           <a href="./index.php?action=contact" style="text-decoration:none;color:black"><div style="width:250px;height:320px;display:flex;flex-direction:column;gap:10px;border:solid 2px #F41F11;border-radius:5px;padding:10px">
              <img style="width:100%;object:cover;" src="./assets/contact.png">
              <h5>Gestion de contact</h5>
          </div></a>
          <a href="./index.php?action=diaporama" style="text-decoration:none;color:black"><div style="width:250px;height:320px;display:flex;flex-direction:column;gap:10px;border:solid 2px #F41F11;border-radius:5px;padding:10px">
              <img style="width:100%;object:cover;" src="./assets/diaporama.png">
              <h5>Gestion de diaporama</h5>
          </div></a>
          
          
   </div>
</div>
    <?php
}

public function login(){
    ?>
    
    <div style="display:flex;justify-content:center;align-items:center;width:100%;height:100vh;" >
      <form method="post" action="./index.php?action=loginHandler" style="padding:10px;width: 700px; height: 500px; border: 2px solid #F41F11; border-radius: 10px;display:flex;flex-direction:column;justify-content:space-around;align-items:center" >
        <h1>Connectez-vous :</h1>
        <label for="username" style="margin-right:50%;">Nom utilisateur :</label>
        <input name="username" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required>
        <label for="password" style="margin-right:50%;">Mot de passe :</label>
        <input name="password" type="password" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required>
        <button type="submit" style="width:150px;height:50px;color:white;text-align:center;background-color:#F41F11;border-radius:10px;border:none;font-size:20px;">Se connecter</button>
     </form>
    </div>
    <?php
}
public function waitingApprouval($text,$type){
    ?>
    <!-- Button trigger modal -->
 <button id="btn" style="display:none" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
 </button>

 <!-- Modal -->
 <div class="modal fade " id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <?php echo $text ; ?>      </div>
      <div class="modal-footer">
        <button id="close" type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background:#F41F11">Fermer</button>
      </div>
    </div>
  </div>
 </div>
    <script>
 $(document).ready(function() {
        $("#btn").click();
        $("#close").click(function() {
            <?php
            if($type=="vehicule"){
                ?>
          window.location.href = `./index.php?action=home`;

                <?php
            }else if($type=="register"){
                ?>
                window.location.href = `./index.php?action=home`;
      
                      <?php
            }else if($type=="login"){
                ?>
                window.location.href = `./index.php?action=auth`;
      
                      <?php
            } 
                ?>
    });
    });
    </script>
    <?php
}
}
?>