<?php

class GestionVehicules{
    public function displayTable($vehicules) {
        echo '<div style="display:flex;flex-direction:column;align-items:center;width:100%;gap:50px;margin-top:50px;">';
        echo '<div style="display:flex;align-items:center;width:80%;justify-content:center;">';
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr><th scope="col">Nom</th>';
        echo '<th scope="col">Marque</th>';
        echo '<th scope="col">Modele</th>';
        echo '<th scope="col">Version</th>';
        echo '<th scope="col">Annee</th>';
        echo '<th scope="col">Details</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
    
        foreach ($vehicules as $vehicule) {
            echo '<tr><td class="firstcol" scope="row">' . $vehicule['vehicule_name'] . '</td>';
            echo '<td class="firstcol" scope="row">' . $vehicule['marque_nom'] . '</td>';
            echo '<td class="firstcol" scope="row">' . $vehicule['modele_nom'] . '</td>';
            echo '<td class="firstcol" scope="row">' . $vehicule['version_nom'] . '</td>';
            echo '<td class="firstcol" scope="row">' . $vehicule['annee'] . '</td>';
            echo '<td class="firstcol" scope="row"> <a class="btn btn-primary" style="border:none;background-color:#F41F11" href="./index.php?action=detailVehicule&idVehicule=' . $vehicule['vehicule_id'] . '"> Voir plus </a></td>';
            echo '</tr>';
        }
    
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
        echo '<a class="btn btn-primary" style="border:none;background-color:#F41F11" href="./index.php?action=ajouterVehicule">Ajouter un vehicule</a>';
        echo '</div>';

    }

    function generateDataTable($vehicules,$idMarque)
    {   
        echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
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
             <h1>Gestion des véhicules</h1>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr><th scope="col">Nom</th>
                <th scope="col">Marque</th>
                <th scope="col">Modele</th>
                <th scope="col">Version</th>
                <th scope="col">Annee</th>
                <th scope="col">Details</th>
                </tr></thead><tbody>';
    
        foreach ($vehicules as $vehicule) {
            echo '<tr><td class="firstcol" scope="row">' . $vehicule['vehicule_name'] . '</td>';
            echo '<td class="firstcol" scope="row">' . $vehicule['marque_nom'] . '</td>';
            echo '<td class="firstcol" scope="row">' . $vehicule['modele_nom'] . '</td>';
            echo '<td class="firstcol" scope="row">' . $vehicule['version_nom'] . '</td>';
            echo '<td class="firstcol" scope="row">' . $vehicule['annee'] . '</td>';
            echo '<td class="firstcol" scope="row"> <a class="btn btn-primary" style="border:none;background-color:#F41F11" href="./index.php?action=detailVehicule&idVehicule=' . $vehicule['vehicule_id'] . '"> Voir plus </a></td>';
            echo '</tr>';
        }
    
        echo '</tbody></table>';
        echo '<a class="btn btn-primary" style="border:none;background-color:#F41F11" href="./index.php?action=ajouterVehicule&idMarque=' . $idMarque . '">Ajouter un vehicule</a>
       
        
        </div>';
        
    }

    public function vehiculeDetails($vehicule)
{
        echo '<div style="width: 100%; margin: 10px auto; display: flex;flex-direction:column ; align-items: center;gap:10px;">';
        echo '<div style="width: 80%; margin: 10px auto; display: flex; justify-content: space-evenly; align-items: center;">';
        echo '<h2>' . $vehicule[0]['vehicule_name'] . '</h2>';
        echo '<img class="card-img-top w-25" src="../client/img/vehicules/' . $vehicule[0]['image_paths'][0]['chemin'] . '" alt="' . $vehicule[0]['vehicule_name'] . '">';
        ?>
                 <button id="btn_img"  onclick="updateImage()" class="btn btn-primary" style="width:150px;border:none;background-color:#F41F11">Modifier la photo</button>

               <form enctype="multipart/form-data" method="POST" id="formImg" action="./index.php?action=editVehiculeImage" style="display:none;">
                <div style="display: flex; justify-content: start; align-items: center; gap: 50px;">
                  <div style="border-radius: 7px; font-size: 20px; font-weight: 300; width:250px;height:50px; outline: none; background: white; color: black; border: 1px solid #F41F11; position: relative;">
                  <input  name="idVimg" id="idVimg" style="display:none" value="<?php echo $vehicule[0]['vehicule_id']?>">
                   <input type="file" name="photo" id="imageV" style="position: absolute;left: -9999px;" required accept="image/*">
                    <label for="imageV" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; cursor: pointer;">Selectioner une image</label>
                  </div>
                </div>
                <button   type="submit" class="btn btn-primary" style="margin-top:20px;width:100px;border:none;background-color:#F41F11">Modifier</button>
                <form>
                <?php
        echo '</div>';
        echo '<div style="width: 80%; margin: 10px auto; display: flex;flex-direction:column; justify-content: space-evenly;">';
        ?>
          <div style="display:flex;justify-content:start;align-items:center;gap:50px;">
          <h3>Type :  </h3>
          <input id="typeV" style="border-radius:7px;font-size:20px;font-weight:300;width:40%;outline:none;background:white;color:black;border:none" disabled value="<?php echo $vehicule[0]['vehicule_type'] ?>"  >
        </div>
        <div style="display:flex;justify-content:start;align-items:center;gap:50px;">
        <h3>Année :  </h3>
          <input id="anneeV" style="border-radius:7px;font-size:20px;font-weight:300;width:40%;outline:none;background:white;color:black;border:none" disabled value="<?php echo $vehicule[0]['vehicule_annee'] ?>"  >
        </div>
        <div id="imgContainer" style="display:none">

        

     </div>
        <button id="btn_vehicule" onclick="updateVehicule(<?php echo $vehicule[0]['vehicule_id']?>)" type="button" class="btn btn-primary" style="width:150px;border:none;background-color:#F41F11">Modifier</button>

        <?php
        echo '</div>';
        echo '<table style="width: 80%; margin: 10px auto; border-collapse: collapse; text-align: left; font-size: 20px; font-weight: 200px; border: solid 1px; padding: 10px; border-radius: 5px;">';
        echo '<tr><th>Characteristic</th><th>Value</th><th>Modification</th></tr>';
    
        foreach ($vehicule[0]['characteristics'] as $characteristic) {
            $characteristicValue = $vehicule[0]['characteristics_values'][$characteristic['id']];
            echo '<tr>';
            echo '<td>' . $characteristic['nom'] . '</td>';
            echo '<td><input  type="text" style="border-radius:7px;outline:none;background:white;color:black;border:none" disabled id=value'. $characteristic['id'] . ' value="' . $characteristicValue . '"></td>';
            echo '<td><button id="btn'. $characteristic['id'] . '" onclick="editValues('. $characteristic['id'] .', ' . $vehicule[0]['vehicule_id'] .')" class="btn btn-primary" style="border:none;background-color:#F41F11">Modifier</button></td>';
            echo '</tr>';
        }
    
        echo '</table>';
        ?>
        <button style="border:none;background-color:#F41F11" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Supprimer le vehicule</button>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Voulez-vous vraiment supprimer cet vehicule?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" style="border:none;background-color:#F41F11" data-bs-dismiss="modal">Non</button>
        <a class="btn btn-primary" style="border:none;background-color:#F41F11" href="./index.php?action=deleteVehicule&id=<?php echo $vehicule[0]['vehicule_id']?>">Oui</a>      </div>
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
        function updateVehicule(idVehicule){
            var typeInput=$('#typeV');
            var anneeInput=$('#anneeV');
            //var imageInput=$('#imageV');
            //var imageContainer=$("#imgContainer");
            var btn=$('#btn_vehicule');
            if (btn.text()=== 'Modifier') {
                btn.text('Submit');
                typeInput.prop('disabled', false).css('border', '1px solid #F41F11');
                anneeInput.prop('disabled', false).css('border', '1px solid #F41F11');
                //imageContainer.css("display", "block");

            } else {
                typeInput.prop('disabled', true).css('border', 'none');
                anneeInput.prop('disabled', true).css('border', 'none');
                //imageContainer.css("display", "none");
                type=typeInput.val();
                annee=anneeInput.val();
                //image=imageInput.val().split('\\').pop();;
                //console.log(image);
                $.ajax({
            type: "POST",
            url: "./model/vehicule.php",
            data: {idVehicule: idVehicule,
                   type:type,
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
        function editValues(idCharacteristic, idVehicule) {
                console.log(idCharacteristic);
            var inputElement = $('#value' + idCharacteristic);
            var buttonElement = $('#btn' + idCharacteristic);

            if (buttonElement.text() === 'Modifier') {
                buttonElement.text('Submit');

                inputElement.prop('disabled', false).css('border', '1px solid #F41F11');
            } else {
                inputElement.prop('disabled', true).css('border', 'none');

                var characteristicValue = inputElement.val();
                console.log('Characteristic Value:', characteristicValue);

                $.ajax({
            type: "POST",
            url: "./model/vehicule.php",
            data: {idVehicule: idVehicule,
                idCharacteristic:idCharacteristic,
                newValue:characteristicValue},
            dataType: "json",
            success: function (data) {
                console.log("updated");
            },
            error: function (xhr, status, error) {
                console.log("failed");
                console.error("AJAX Error:", status, error);
            }
        });
                buttonElement.text('Modifier');

            }}
        </script>
        
        <?php

}
    
    public function addVehicule($idMarque,$caracteristics)
{
        ?><div style="display:flex;flex-direction:column;justify-content:space-between;align-items:center">
        <h1>Ajouter un vehicule</h1>
        <form enctype="multipart/form-data" method="POST" id="form" action="./index.php?action=addVehicule" style="width:800px;display:flex;flex-direction:column;align-items:center;gap:15px">
        <input type="hidden" name="marque" value="<?php echo $idMarque ?>">
                    
                
                <label for="modele">Modele</label>
                <input name="modele" id="modele"  style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required>
                <label for="version">Version</label>
                <input name="version" id="version"  style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required>
                <label for="annee">Année</label>
                <input name="annee" id="annee" type="number"  style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required>
                <label for="type">Type</label>
                <input name="type" id="type"  style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required>
                 <?php
                 foreach ($caracteristics as $caracteristic) {
                    ?>
                    <label for="car_<?php echo $caracteristic["id"]?>"><?php echo $caracteristic["nom"]?></label>
                    <input name="car_<?php echo $caracteristic["id"]?>" id="car_<?php echo $caracteristic["id"]?>"  style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required>
                  
                    <?php
                 }
                 ?>
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
   public function deleteCarac($caracs){
    ?>
    <form method="POST"  action="./index.php?action=deleteCarac" style="width:800px;display:flex;justify-content:center;align-items:center">
    <label for="carac">Selectioner la caracteristique à supprimer</label>
            <select name="carac" id="carac" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;"  required>
                    <option value="">Caracteristique</option>
                    <?php foreach ($caracs as $carac) : ?>
                        <option value='<?php echo $carac['id']; ?>'><?php echo $carac['nom']; ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" style="width:150px;height:40px;color:white;text-align:center;background-color:#F41F11;border-radius:10px;border:none;font-size:20px;">Supprimer</button>
         
    </form>
    <?php
   }
   public function addCarac(){
    ?>
    <form method="POST" id="form" action="./index.php?action=addCarac" style="width:800px;display:flex;flex-direction:column;align-items:center;">
        <div id="caracContainer">
            <label for="carac1">Caracteristique 1 :</label>
            <input name="carac[]" id="carac1" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required>
        </div>
        <button type="button" id="more" style="width:100px;height:30px;color:white;text-align:center;background-color:#F41F11;border-radius:10px;border:none;font-size:20px;margin-top:10px;">Plus</button>
        <button type="button" id="less" style="width:100px;height:30px;color:white;text-align:center;background-color:#F41F11;border-radius:10px;border:none;font-size:20px;margin-top:10px;">Moins</button>
        <button type="submit" style="width:100px;height:40px;color:white;text-align:center;background-color:#F41F11;border-radius:10px;border:none;font-size:20px;margin-top:10px;">Ajouter</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            var caracCount = 1;

            $("#more").click(function () {
                caracCount++;
                var newCaracInput = '<div id="caracContainer' + caracCount + '" style="margin-top:10px;">' +
                    '<label for="carac' + caracCount + '">Caracteristique ' + caracCount + ' :</label>' +
                    '<input name="carac[]" id="carac' + caracCount + '" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required>' +
                    '</div>';
                $("#caracContainer").append(newCaracInput);
            });

            $("#less").click(function () {
                if (caracCount > 1) {
                    $("#caracContainer" + caracCount).remove();
                    caracCount--;
                }
            });
        });
    </script>
    <?php
}




}
?>