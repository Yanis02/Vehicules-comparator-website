<?php
class GestionMarques{

    function generateDataTable($marques)
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
             <h1>Gestion des marques</h1>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr><th scope="col">Nom</th>
                <th scope="col">Pays</th>
                <th scope="col">Siege</th>
                <th scope="col">Annee de creation</th>
                <th scope="col">Details</th>
                </tr></thead><tbody>';
    
        foreach ($marques as $marque) {
            echo '<tr><td class="firstcol" scope="row">' . $marque['nom'] . '</td>';
            echo '<td class="firstcol" scope="row">' . $marque['pays'] . '</td>';
            echo '<td class="firstcol" scope="row">' . $marque['siege'] . '</td>';
            echo '<td class="firstcol" scope="row">' . $marque['anne_creation'] . '</td>';
            echo '<td class="firstcol" scope="row"> <a class="btn btn-primary" style="border:none;background-color:#F41F11" href="./index.php?action=detailMarque&idMarque=' . $marque['id'] . '"> Voir plus </a></td>';
            echo '</tr>';
        }
    
        echo '</tbody></table>';
        echo '<a class="btn btn-primary" style="border:none;background-color:#F41F11" href="./index.php?action=ajouterMarque">Ajouter une Marque</a>
        
        
        </div>';
        
    }

    public function marqueDetails($marque)
{
        echo '<div style="width: 100%; margin: 10px auto; display: flex;flex-direction:column ; align-items: center;gap:10px;">';
        echo '<div style="width: 80%; margin: 10px auto; display: flex; justify-content: space-evenly; align-items: center;">';
        echo '<h2>' . $marque[0]['nom'] . '</h2>';
        echo '<img class="card-img-top w-25" src="../client/img/marques/' . $marque[0]['images'][0] . '" alt="' . $marque[0]['nom'] . '">';
        ?>
                 <button id="btn_img"  onclick="updateImage()" class="btn btn-primary" style="width:150px;border:none;background-color:#F41F11">Modifier la photo</button>

               <form enctype="multipart/form-data" method="POST" id="formImg" action="./index.php?action=editMarqueImage" style="display:none;">
                <div style="display: flex; justify-content: start; align-items: center; gap: 50px;">
                  <div style="border-radius: 7px; font-size: 20px; font-weight: 300; width:250px;height:50px; outline: none; background: white; color: black; border: 1px solid #F41F11; position: relative;">
                  <input  name="idVimg" id="idVimg" style="display:none" value="<?php echo $marque[0]['images'][0]?>">
                  <input  name="idMimg" id="idVimg" style="display:none" value="<?php echo $marque[0]['id']?>">
                   <input type="file" name="photo" id="imageV" style="position: absolute;left: -9999px;" required accept="image/*">
                    <label for="imageV" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; cursor: pointer;">Selectioner une image</label>
                  </div>
                </div>
                <button   type="submit" class="btn btn-primary" style="margin-top:20px;width:100px;border:none;background-color:#F41F11">Modifier</button>
                <form>
                <?php
        echo '</div>';
        echo '<div style="width: 80%; margin: 10px auto; display: flex;flex-direction:column;gap:20px">';
        ?>
          <div style="display:flex;justify-content:start;align-items:center;gap:50px;">
          <h3>Nom :  </h3>
          <input id="nom" style="border-radius:7px;font-size:20px;font-weight:300;width:40%;outline:none;background:white;color:black;border:none" disabled value="<?php echo $marque[0]['nom'] ?>"  >
        </div>
        <div style="display:flex;justify-content:start;align-items:center;gap:50px;">
        <h3>Payes :  </h3>
          <input id="pays" style="border-radius:7px;font-size:20px;font-weight:300;width:40%;outline:none;background:white;color:black;border:none" disabled value="<?php echo $marque[0]['pays'] ?>"  >
        </div>
        <div style="display:flex;justify-content:start;align-items:center;gap:50px;">
        <h3>Siege :  </h3>
          <input id="siege" style="border-radius:7px;font-size:20px;font-weight:300;width:40%;outline:none;background:white;color:black;border:none" disabled value="<?php echo $marque[0]['siege'] ?>"  >
        </div>
        <div style="display:flex;justify-content:start;align-items:center;gap:50px;">
        <h3>Annee de creation :  </h3>
          <input id="annee" style="border-radius:7px;font-size:20px;font-weight:300;width:40%;outline:none;background:white;color:black;border:none" disabled value="<?php echo $marque[0]['anne_creation'] ?>"  >
        </div>
        <div id="imgContainer" style="display:none">

        

     </div>
        <button id="btn_vehicule" onclick="updateMarque(<?php echo $marque[0]['id']?>)" type="button" class="btn btn-primary" style="width:150px;border:none;background-color:#F41F11">Modifier</button>

       
        <button style="border:none;background-color:#F41F11;width:150px;" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Supprimer la marque</button>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Voulez-vous vraiment supprimer cette marque?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" style="border:none;background-color:#F41F11" data-bs-dismiss="modal">Non</button>
        <a class="btn btn-primary" style="border:none;background-color:#F41F11" href="./index.php?action=deleteMarque&id=<?php echo $marque[0]['id']?>">Oui</a>      </div>
      </div>
     </div>
     </div>
        <?php
        echo '</div>';

        ?>

        <script>
         function updateImage(){
                var btn=$('#btn_img');
                var form=$('#formImg'); 
                if (btn.text()=== 'Modifier la photo') {
                btn.text('Fermer');
                
                form.css("display", "block");

            }else {
                btn.text('Modifier la photo');
                
                form.css("display", "none");
            }

            }
        function updateMarque(idMarque){
            var nomInput=$('#nom');
            var paysInput=$('#pays');
            var siegeInput=$('#siege');
            var anneeInput=$('#annee');
            var btn=$('#btn_vehicule');
            if (btn.text()=== 'Modifier') {
                btn.text('Submit');
                nomInput.prop('disabled', false).css('border', '1px solid #F41F11');
                paysInput.prop('disabled', false).css('border', '1px solid #F41F11');
                siegeInput.prop('disabled', false).css('border', '1px solid #F41F11');
                anneeInput.prop('disabled', false).css('border', '1px solid #F41F11');

                //imageContainer.css("display", "block");

            } else {
                nomInput.prop('disabled', true).css('border', 'none');
                paysInput.prop('disabled', true).css('border', 'none');
                siegeInput.prop('disabled', true).css('border', 'none');
                anneeInput.prop('disabled', true).css('border', 'none');

                nom=nomInput.val();
                pays=paysInput.val();
                siege=siegeInput.val();
                annee=anneeInput.val();
                console.log(idMarque);
                console.log(nom);
                console.log(pays);
                console.log(siege);
                console.log(annee);
                $.ajax({
            type: "POST",
            url: "./model/marques.php",
            data: {idMarque:idMarque,
                   nom:nom,
                   pays:pays,
                   siege:siege,
                   annee:annee},
            dataType: "json",
            success: function (data) {
                console.log("updated");
            },
            error: function (xhr, status, error) {
                console.log("failed");
                console.error("AJAX Error:", status, error);
            }
        });
               btn.text('Modifier');

                
            }
        }
       
        </script>
        
        <?php

}
    public function addMarque()
{
        ?><div style="display:flex;flex-direction:column;justify-content:space-between;align-items:center">
        <h1>Ajouter une marque</h1>
        <form enctype="multipart/form-data" method="POST" id="form" action="./index.php?action=addMarque" style="width:800px;display:flex;flex-direction:column;align-items:center;gap:15px">
                <label for="nom">Nom</label>
                <input name="nom" id="nom"  style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required>
                <label for="pays">Payes</label>
                <input name="pays" id="pays"  style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required>
                <label for="siege">Siege</label>
                <input name="siege" id="siege"  style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required>
                <label for="annee">Annee de creation</label>
                <input name="annee" id="annee" type="number" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required>
                <label for="photo">photo</label>
                <div style="border-radius: 7px; font-size: 20px; font-weight: 300; width:70%;height:50px; outline: none; background: white; color: black; border: 2px solid; position: relative;">
                   <input type="file" name="photo" id="photo" style="position: absolute;left: -9999px;" required accept="image/*">
                    <label for="photo" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; cursor: pointer;">Selectioner une image</label>
                  </div>
                <button type="submit" style="width:150px;height:40px;color:white;text-align:center;background-color:#F41F11;border-radius:10px;border:none;font-size:20px;">Ajouter</button>


               


        </form>
                </div>
        <?php
}

}
?>