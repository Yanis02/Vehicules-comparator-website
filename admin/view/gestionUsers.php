<?php
require_once("commun.php");

class GestionUsers{
    function generateDataTable($users)
    {   
        echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
        echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
        echo '<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>';
        echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>';
    
        echo '<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">';
        echo '<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>';
        echo '<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>';
        echo '<style>
        
       
        a.page-link {
            background-color: #F41F11 !important;
            border-color: white !important;
            color: #fff !important;
        }
     </style>';
    
        echo '<script>
            $(document).ready(function() {
                $("#dataTable").DataTable();
            });
        </script>';
    
        echo '<div class="container mt-4">
             <h1>Gestion des utilisateurs</h1>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr><th scope="col">Utilisateur</th>
                <th scope="col">Status</th>
                <th scope="col">Valider</th>
                <th scope="col">Action utilisateur</th>
                <th scope="col">Profiles</th>


                </tr></thead><tbody>';
    
        foreach ($users as $user) {
            echo '<tr><td class="firstcol" scope="row">' . $user['nom'] ." " . $user['prenom'] . '</td>';
            echo '<td class="firstcol" scope="row">';
            if ($user['valide'] == 0) {
                echo 'Non validé';
            } elseif ($user['valide'] == 1) {
                echo 'Validé';
            } 
            echo '</td>';
            echo '<td class="firstcol" scope="row"> <a class="btn btn-primary" style="border:none;background-color:#F41F11" href="./index.php?action=validerUser&id=' . $user['id'] . '"> Valider </a></td>';  

          echo '<td class="firstcol" scope="row">';

          if ($user["bloque"] == 1) {
              echo '<a class="btn btn-primary" style="border:none;background-color:#F41F11" href="./index.php?action=debloquerUtilisateur&id=' . $user["id"] . '"> Débloquer utilisateur </a>';
          } else {
              echo '<a class="btn btn-primary" style="border:none;background-color:#F41F11" href="./index.php?action=bloquerUtilisateur&id=' . $user["id"] . '"> Bloquer utilisateur </a>';
          }
          
          echo '</td>';
          echo '<td class="firstcol" scope="row"> <a class="btn btn-primary" style="border:none;background-color:#F41F11" href="./index.php?action=profileUser&id=' . $user['id'] . '"> Profile </a></td>';  

                      echo '</tr>';
        }
    
        echo '</tbody></table>
        
        
        </div>';
        
    }
    public function profile($favoris,$user){
        $commun=new Commun();
        
            $numSlides = ceil(count($favoris) / 3);
    
            ?>
        <div style="display:flex;flex-direction:column;align-items:center;width:100%;gap:50px;margin-top:50px;">
        <h1>Informations generales :</h1>
             <div style="display:flex;flex-direction:column;justify-content:space-around;align-items:center; border:solid 2px #F41F11; border-radius:10px;padding:10px;">
               
               <div style="display:flex;flex-direction:row; width:500px;gap:20px;">
                <h1 style="font-size:27px;font-weight:200;">Nom :<h1><p style="color:#F41F11;font-size:27px;"> <?php echo $user[0]["nom"] ?></p>
               </div>
               <div style="display:flex;flex-direction:row; width:500px;gap:20px;">
                <h1 style="font-size:27px;font-weight:200;">Prénom :<h1><p style="color:#F41F11;font-size:27px;"> <?php echo $user[0]["prenom"] ?></p>
               </div>
               <div style="display:flex;flex-direction:row; width:500px;gap:20px;">
                <h1 style="font-size:27px;font-weight:200;">Sexe :<h1><p style="color:#F41F11;font-size:27px;"> <?php echo $user[0]["sexe"] ?></p>
               </div>
               <div style="display:flex;flex-direction:row; width:500px;gap:20px;">
                <h1 style="font-size:27px;font-weight:200;">Date de naissance :<h1><p style="color:#F41F11;font-size:27px;"> <?php echo $user[0]["dateNaissance"] ?></p>
               </div>
             </div> 
             <div style="width:90%;height:5px;background-color:#F41F11;margin-top:50px;"></div>
            <h1>Favoris</h1>
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
                                    $commun->displayCard("../client/img/vehicules/".$favoris[$j][0]["image_paths"][0]["chemin"],$favoris[$j][0]["vehicule_name"],"Voir Details",$favoris[$j][0]["vehicule_id"]);
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
                <h1>Cet utilisateur n'a pas de favoris</h1>
                
                <?php
            
            ?>
            
        </div>
            <?php
        }
    } 

}
?>