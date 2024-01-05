<?php
require_once("commun.php");

class Profile{
    public function profile($favoris){
        $commun=new Commun();
        if (isset($_SESSION['user'])) {
            $user=$_SESSION['user'];
            $numSlides = ceil(count($favoris) / 3);
    
            ?>
        <div style="display:flex;flex-direction:column;align-items:center;width:100%;gap:50px;margin-top:50px;">
        <h1>Informations generales :</h1>
             <div style="display:flex;flex-direction:column;justify-content:space-around;align-items:center; border:solid 2px #F41F11; border-radius:10px;padding:10px;">
               
               <div style="display:flex;flex-direction:row; width:500px;gap:20px;">
                <h1 style="font-size:27px;font-weight:200;">Nom :<h1><p style="color:#F41F11;font-size:27px;"> <?php echo $user["nom"] ?></p>
               </div>
               <div style="display:flex;flex-direction:row; width:500px;gap:20px;">
                <h1 style="font-size:27px;font-weight:200;">Prénom :<h1><p style="color:#F41F11;font-size:27px;"> <?php echo $user["prenom"] ?></p>
               </div>
               <div style="display:flex;flex-direction:row; width:500px;gap:20px;">
                <h1 style="font-size:27px;font-weight:200;">Sexe :<h1><p style="color:#F41F11;font-size:27px;"> <?php echo $user["sexe"] ?></p>
               </div>
               <div style="display:flex;flex-direction:row; width:500px;gap:20px;">
                <h1 style="font-size:27px;font-weight:200;">Date de naissance :<h1><p style="color:#F41F11;font-size:27px;"> <?php echo $user["dateNaissance"] ?></p>
               </div>
             </div> 
             <div style="width:90%;height:5px;background-color:#F41F11;margin-top:50px;"></div>
            <h1>Vos favoris</h1>
            <?php
            if ($favoris) {
                ?>
            <div id="carouselExample" class="carousel slide" style="width:100%;height:400px;">
                <div class="carousel-inner">
                    <?php for ($i = 0; $i < $numSlides; $i++) : ?>
                        <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
                            <div style="display:flex; justify-content:space-around; align-items:center;">
                                <?php
                                for ($j = $i * 3; $j < min(($i + 1) * 3, count($favoris)); $j++) :
                                    $commun->displayCard("./img/vehicules/".$favoris[$j][0]["image_paths"][0]["chemin"],$favoris[$j][0]["vehicule_name"],"Voir Details",$favoris[$j][0]["vehicule_id"]);
                                ?>
                                
                                <?php endfor; ?>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true" style="background-image: url('data:image/svg+xml;charset=utf8,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'%23F41F11\' viewBox=\'0 0 8 8\'%3E%3Cpath d=\'M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z\'/%3E%3C/svg%3E') !important;"
     >                </span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true" style="background-image: url('data:image/svg+xml;charset=utf8,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'%23F41F11\' viewBox=\'0 0 8 8\'%3E%3Cpath d=\'M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z\'/%3E%3C/svg%3E') !important;"
    
     ></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div> 
            <?php
            }else {
                ?>
                <h1>Vous n'avez pas de favoris</h1>
                
                <?php
            }
            ?>
            
        </div>
            <?php
        }
    } 
}
?>