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
    public function vehiculeDetails($vehicule){
        echo '<div style="width: 80%; margin: 10px auto; display: flex; justify-content: space-evenly; align-items: center;">';
        echo '<h2>' . $vehicule[0]['vehicule_name'] . '</h2>';
        echo '<img class="card-img-top w-25" src="./img/vehicules/' . $vehicule[0]['image_paths'][0]['chemin'] . '" alt="' . $vehicule[0]['vehicule_name'] . '">';
        echo '</div>';
    
        echo '<table style="width: 80%; margin: 10px auto; border-collapse: collapse; text-align: left; font-size: 20px; font-weight: 200px; border: solid 1px; padding: 10px; border-radius: 5px;">';
        echo '<tr><th>Characteristic</th><th>Value</th><th>Modification</th></tr>';
    
        foreach ($vehicule[0]['characteristics'] as $characteristic) {
            $characteristicValue = $vehicule[0]['characteristics_values'][$characteristic['id']];
            echo '<tr>';
            echo '<td>' . $characteristic['nom'] . '</td>';
            echo '<td><input type="text" style="outline:none;background:white;color:black;border:none" disabled id=value'. $characteristic['id'] . ' value="' . $characteristicValue . '"></td>';
            echo '<td><button id="btn'. $characteristic['id'] . '" onclick="editValues('. $characteristic['id'] .', ' . $vehicule[0]['vehicule_id'] .')" class="btn btn-primary" style="border:none;background-color:#F41F11">Modifier</button></td>';
            echo '</tr>';
        }
    
        echo '</table>';
        ?>
        <script>
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
    
    public function addVehicule($marques,$caracteristics){
        ?>
        <form enctype="multipart/form-data" method="POST" id="form" action="./index.php?action=addVehicule" style="width:800px;display:flex;flex-direction:column;align-items:center;gap:15px">
            <!-- Marque Dropdown 54-->
            <label for="marque">Marque</label>
            <select name="marque" id="marque" class="marqueDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" onchange="updateModeles(this)" required>
                    <option value="">Marque</option>
                    <?php foreach ($marques as $marque) : ?>
                        <option value='<?php echo $marque['id']; ?>'><?php echo $marque['nom']; ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Modele Dropdown -->
                <label for="modele">Modele</label>
                <select name="modele" id="modele" class="modeleDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" onchange="updateVersions(this)" disabled required>
                    <option value="">Modele</option>
                </select>

                <!-- Version Dropdown -->
                <label for="version">Version</label>
                <select name="version" id="version" class="versionDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;"  disabled required>
                    <option value="">Version</option>
                </select>
                <label for="annee">Année</label>
                <input name="annee" id="annee"  style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required>
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
                 <label for="photo">Photo</label>
                <input name="photo" id="photo" type="file"  style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required accept="image/*">
                <button type="submit" style="width:150px;height:40px;color:white;text-align:center;background-color:#F41F11;border-radius:10px;border:none;font-size:20px;">Ajouter</button>

        </form>
        <script>


function updateModeles(element) {
    var container = $("#form");
    var marqueId = $(element).val();
    console.log(marqueId);
    
    var modeleDropdown = container.find('.modeleDropdown');
    
    $.ajax({
        type: "POST",
        url: "./model/modele.php",
        data: { marqueId: marqueId },
        dataType: "json",
        success: function (data) {
            console.log("success");
            modeleDropdown.empty();
            modeleDropdown.append('<option value="">Modele</option>');
            $.each(data, function (index, modele) {
                modeleDropdown.append($("<option>").attr("value", modele.id).text(modele.nom));
            });
            modeleDropdown.prop("disabled", false);
        },
        error: function (xhr, status, error) {
            console.log("failed");
            console.error("AJAX Error:", status, error);
        }
    });
}

function updateVersions(element) {
    var container = $("#form");
    var modeleId = $(element).val();
    console.log(modeleId);

    var versionDropdown = container.find('.versionDropdown');
    
    $.ajax({
        type: "POST",
        url: "./model/version.php",
        data: { modeleId: modeleId },
        dataType: "json",
        success: function (data) {
            versionDropdown.empty();
            versionDropdown.append('<option value="">Version</option>');
            $.each(data, function (index, version) {
                versionDropdown.append($("<option>").attr("value", version.id).text(version.nom));
            });
            versionDropdown.prop("disabled", false);
        },
        error: function (xhr, status, error) {
            console.log("failed");
            console.error("AJAX Error:", status, error);
        }
    });
}

   </script>
        <?php
    }
}
?>