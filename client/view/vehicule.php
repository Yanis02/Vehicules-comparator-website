<?php
class Vehicule{
    public function vehiculeDetails($vehicule){
        echo '<div style="width: 80%; margin: 10px auto; display: flex; justify-content: space-evenly; align-items: center;">';
        echo '<h2>' . $vehicule[0]['vehicule_name'] . '</h2>';
        echo '<img class="card-img-top w-25" src="./img/vehicules/' . $vehicule[0]['image_paths'][0]['chemin'] . '" alt="' . $vehicule[0]['vehicule_name'] . '">';
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
        <?php
                echo '</div>';

        echo '<table style="width: 80%; margin: 10px auto; border-collapse: collapse; text-align: left; font-size: 20px; font-weight: 200px; border: solid 1px; padding: 10px; border-radius: 5px;">';
        echo '<tr><th>Caracteristique</th><th>Valeur</th></tr>';
    
        foreach ($vehicule[0]['characteristics'] as $characteristic) {
            $characteristicValue = $vehicule[0]['characteristics_values'][$characteristic['id']];
            echo '<tr>';
            echo '<td>' . $characteristic['nom'] . '</td>';
            echo '<td>' . $characteristicValue . '</td>';
            echo '</tr>';
        }
    
        echo '</table>';
    }
    public function avgNote($value){
        ?>
        <div style="display:flex;flex-direction:column;align-items:center;width:100%;justify-content:center;" >
            <div>Note moyenne des utilisateurs :</div>
            <div style="color:#F41F11;"><?php echo $value ?></div>
        </div>
        <?php
    }    
}

?>