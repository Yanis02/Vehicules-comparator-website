<?php
class Commun{
    public function AvisText(){
        ?>
     <div style="display:flex;flex-direction:column;align-items:center;width:100%;justify-content:center;gap:10px;margin-top:50px;"><h1>Avis</h1></div>
        <?php
    }
    public function avgNote($value){
        ?>
        <div style="display:flex;flex-direction:column;align-items:center;width:100%;justify-content:center;" >
            <div>Note moyenne des utilisateurs :</div>
            <div style="color:#F41F11;"><?php echo $value ?></div>
        </div>
        <?php
    }
    public function separator(){
        ?>
        <div style="display:flex;justify-content:center;">
        <div style="width:90%;height:5px;background-color:#F41F11;margin-top:50px;"></div></div>
        <?php
    }
    public function personalSection($id,$notAdded,$type)
{
    if(isset($_SESSION['user'])){
    ?>
    <div style="display:flex;flex-direction:column;align-items:center;width:100%;justify-content:center;">
    <form method="post" action="    <?php if($type==="vehicule") echo "./index.php?action=handleAvis"; else echo "./index.php?action=handleAvisMarque";  ?>" style="width:700px;padding-left:50px;margin:20px;">
    <input name="        <?php if($type==="vehicule") echo "idVehicule"; else echo "idMarqueAvis";  ?>" type="text" style="width:80%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;display:none" required value=<?php echo $id?>>
    <label for="avis" style="margin-right:50%;">Ajouter un avis :</label>
    <input name="avis" type="text" style="width:80%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required >
    <button style="width:120px;height:40px;color:white;text-align:center;background-color:#F41F11;border-radius:10px;border:none;font-size:20px;" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Ajouter</button>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Votre avis sera publier une fois validé par un administrateur
      </div>
      <div class="modal-footer">
      <button type="submit" style="width:120px;height:40px;color:white;text-align:center;background-color:#F41F11;border-radius:10px;border:none;font-size:20px;">Compris</button>
    </div>
    </div>
  </div>
 </div>
    </form>
    <form method="post" action="    <?php if($type==="vehicule") echo "./index.php?action=handleNote"; else echo "./index.php?action=handleNoteMarque";  ?>" style="width:700px;padding-left:50px;margin:20px;">
    <input name="        <?php if($type==="vehicule") echo "idVehicule"; else echo "idMarqueNote";  ?>" type="text" style="width:80%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;display:none" required value=<?php echo $id?>>    <label for="note" style="margin-right:50%;">Ajouter une note :</label>
    <input name="note" type="number" style="width:80%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;"min="0" step="0.01" max="10" required >
    <button type="submit" style="width:120px;height:40px;color:white;text-align:center;background-color:#F41F11;border-radius:10px;border:none;font-size:20px;">Ajouter</button>
    </form>
    <?php
    if($type==="vehicule"){
        if(!($notAdded)){
            ?>
                <a class="btn btn-primary" href="./index.php?action=deleteFavoris&idVehicule=<?php echo $id?>" style="text-align:center;width:150px;height:50px;background-color:#F41F11;border-radius:10px;border:none;display:flex;align-items:center;justify-content:center">Retirer des favoris</a>
    
            <?php
          }else { ?> 
        <a class="btn btn-primary" href="./index.php?action=addFavoris&idVehicule=<?php echo $id?>" style="text-align:center;width:150px;height:50px;background-color:#F41F11;border-radius:10px;border:none;display:flex;align-items:center;justify-content:center">Ajouter au favoris</a>
    
          <?php }
    }
      
    ?>
    </div>
    <?php
    }
}
public function card($imageSrc, $cardTitle) {
    echo '<div class="card" style="width:250px;height:300px">';
    echo '<img src="' . $imageSrc . '" alt="Card Image" class="card-img-top">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $cardTitle . '</h5>';
    echo '</div></div>';
}
public function pagination($currentPage, $totalPages)
{
    ?>
     <style>
        
       
        a.page-link {
            background-color: #F41F11 !important;
            border-color: white !important;
            color: #fff !important;
        }
     </style>
    <nav aria-label="...">
        <ul class="pagination d-flex justify-content-center mt-5">
            <li class="page-item <?php echo $currentPage <= 1 ? 'disabled' : ''; ?> ">
                <a class="page-link " href="./index.php?action=avisVehicule&idVehicule=<?php echo $_GET['idVehicule']; ?>&page=<?php echo $currentPage - 1; ?>">Previous</a>
            </li>

            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item <?php echo $i == $currentPage ? 'active' : ''; ?>">
                    <a class="page-link " href="./index.php?action=avisVehicule&idVehicule=<?php echo $_GET['idVehicule']; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <li class="page-item <?php echo $currentPage >= $totalPages ? 'disabled' : ''; ?>">
                <a class="page-link" href="./index.php?action=avisVehicule&idVehicule=<?php echo $_GET['idVehicule']; ?>&page=<?php echo $currentPage + 1; ?>">Next</a>
            </li>
        </ul>
    </nav>
    <?php
}
public function vehiculeDetailsBtn($idVehicule){
    ?>
     <div style="display:flex;flex-direction:column;align-items:center;width:100%;justify-content:center;margin-top:10px;">
     <a class="btn btn-primary" href="./index.php?action=detailVehicule&idVehicule=<?php echo $idVehicule?>" style="text-align:center;width:150px;height:50px;background-color:#F41F11;border-radius:10px;border:none;display:flex;align-items:center;justify-content:center">Voir Details</a>
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
      <?php echo $text ?>      </div>
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
            } else   ?>
            window.location.href = `./index.php?action=home`;
  
                  <?php
                ?>
    });
    });
    </script>
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
public function footer(){
    ?>
    <div style="margin-top:50px;width:100%;display:flex;justify-content:center;align-items:center;background:black;height:150px">
<h5 style="color:red">&copy; 2024 AutoComp. All rights reserved</h5>  
</div>
    <?php
}
}
?>