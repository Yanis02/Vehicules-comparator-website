<?php
class Avis{

    public function avisMarque($a,$isAppreciated){
        ?>
        <div style="display:flex;flex-direction:column;align-items:center;width:100%;justify-content:center;gap:10px;margin-top:50px;">
        
    
         
             <div style="width:800px;display:flex;flex-direction:row;align-items:center;justify-content:space-evenly;">
        <label for="avis" ><?php echo $a["utilisateur"]["nom"];echo " "; echo $a["utilisateur"]["prenom"] ?></label>
        <input name="avis" type="text" style="width:60%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;border:solid 2px black;" disabled value="<?php echo $a["valeur"] ?>" >
        <label><?php echo $a["nbAppreciations"]  ?>  appreciations</label>
        <?php
        if (isset($_SESSION['user'])) {
            if($isAppreciated===false){
            ?>
            <a class="btn btn-primary" href="./index.php?action=appreciateAvisMarque&idAvis=<?php echo $a["avis_id"]?>&idMarque=<?php echo $a["marque_id"]?>" style="text-align:center;width:100px;height:40px;background-color:#F41F11;border-radius:10px;border:none;display:flex;align-items:center;justify-content:center">Apprecier</a>
    
            <?php
            }else {
              ?>
                  <a class="btn btn-primary" href="./index.php?action=deleteAppreciationMarque&idAvis=<?php echo $a["avis_id"]?>&idMarque=<?php echo $a["marque_id"]?>" style="text-align:center;width:120px;height:50px;background-color:#F41F11;border-radius:10px;border:none;display:flex;align-items:center;justify-content:center">Retirer appreciation</a>
    
              <?php  
            }
        }
        ?>
    
     </div>
           
        </div>
        <?php
        
    }
    public function avisVehicule($a,$isAppreciated){
        ?>
        <div style="display:flex;flex-direction:column;align-items:center;width:100%;justify-content:center;gap:10px;margin-top:50px;">
        
    
         
             <div style="width:800px;display:flex;flex-direction:row;align-items:center;justify-content:space-evenly;">
        <label for="avis" ><?php echo $a["utilisateur"]["nom"];echo " "; echo $a["utilisateur"]["prenom"] ?></label>
        <input name="avis" type="text" style="width:60%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;border:solid 2px black;" disabled value="<?php echo $a["valeur"] ?>" >
        <label><?php echo $a["nbAppreciations"]  ?>  appreciations</label>
        <?php
        if (isset($_SESSION['user'])) {
            if($isAppreciated===false){
            ?>
            <a class="btn btn-primary" href="./index.php?action=appreciateAvis&idAvis=<?php echo $a["avis_id"]?>&idVehicule=<?php echo $a["vehicule_id"]?>" style="text-align:center;width:100px;height:40px;background-color:#F41F11;border-radius:10px;border:none;display:flex;align-items:center;justify-content:center">Apprecier</a>
    
            <?php
            }else {
              ?>
                  <a class="btn btn-primary" href="./index.php?action=deleteAppreciation&idAvis=<?php echo $a["avis_id"]?>&idVehicule=<?php echo $a["vehicule_id"]?>" style="text-align:center;width:120px;height:50px;background-color:#F41F11;border-radius:10px;border:none;display:flex;align-items:center;justify-content:center">Retirer appreciation</a>
    
              <?php  
            }
        }
        ?>
    
     </div>
           
        </div>
        <?php
        
    }
    public function allAvisBtn($idVehicule){
        ?>
         <div style="display:flex;flex-direction:column;align-items:center;width:100%;justify-content:center;margin-top:10px;">
         <a class="btn btn-primary" href="./index.php?action=avisVehicule&idVehicule=<?php echo $idVehicule?>" style="text-align:center;width:150px;height:50px;background-color:#F41F11;border-radius:10px;border:none;display:flex;align-items:center;justify-content:center">Voir tous</a>
      </div>
        <?php
    }
    public function vehiculeAvis($vehicule){
        echo '<div style="width: 80%; margin: 10px auto; display: flex; justify-content: space-evenly; align-items: center;">';
        echo '<h2>' . $vehicule[0]['vehicule_name'] . '</h2>';
        echo '<img class="card-img-top w-25" src="./img/vehicules/' . $vehicule[0]['image_paths'][0]['chemin'] . '" alt="' . $vehicule[0]['vehicule_name'] . '">';
        echo '</div>';
    
       
    }
    public function AvisNotFound()
{
    ?>
    <div style="display:flex;flex-direction:column;align-items:center;width:100%;justify-content:center;margin-top:10px;">
    Pas d avis pour le moment :( 
  </div>
  <?php
}
public function AvisPage($marque)
{
        ?>
       <div style="padding:20px;width:80%;display:flex;flex-direction:column;justify-content:space-around;align-items:center;margin-left:10%;border:solid 2px #F41F11;border-radius:10px;margin-top:50px;">
        <div style="width:100%;display:flex;flex-direction:row;justify-content:space-between;align-items:center;">
        <div style="display:flex;flex-direction:column;justify-content:space-around;align-items:center;">
        <div style="display:flex;flex-direction:row; width:500px;gap:20px;">
         <h1 style="font-size:27px;font-weight:200;">Nom:<h1><p style="color:#F41F11;font-size:27px;"> <?php echo $marque[0]["nom"] ?></p>
         </div>
         <div style="display:flex;flex-direction:row; width:500px;gap:20px;">
         <h1 style="font-size:27px;font-weight:200;">Payes:<h1><p style="color:#F41F11;font-size:27px;"> <?php echo $marque[0]["pays"] ?></p>
         </div>
         <div style="display:flex;flex-direction:row; width:500px;gap:20px;">
         <h1 style="font-size:27px;font-weight:200;">Siege:<h1><p style="color:#F41F11;font-size:27px;"> <?php echo $marque[0]["siege"] ?></p>
         </div>
         <div style="display:flex;flex-direction:row; width:500px;gap:20px;">
         <h1 style="font-size:27px;font-weight:200;">Annee de creation:<h1><p style="color:#F41F11;font-size:27px;"> <?php echo $marque[0]["anne_creation"] ?></p>
         </div>
         
     </div>
        
        <img src="./img/marques/<?php echo $marque[0]['images'][0]?>" style="width:300px;height:auto;"></img>
        </div>
        <div style="margin-right:50%;display:flex;flex-direction:row; width:500px;gap:20px;">
         <h1 style="font-size:30px;font-weight:400;margin-top:20px;">Principales voitures:<h1>   
       </div>
        <div class="d-flex justify-content-around mt-5 mb-5 w-100" id="cardContainer"></div>
        <div style="margin-right:50%;display:flex;flex-direction:row; width:500px;gap:20px;">
         <h1 style="font-size:30px;font-weight:400;">Voir toutes les voitures:<h1>   
       </div>
       <div class="d-flex justify-content-around mt-5 mb-5 w-100" id="listContainer"></div>
       <div class="d-flex flex-column justify-content-around align-items-center mt-5 mb-5 w-100" id="characteristicsContainer"></div>

        </div>
        <script>
            $(document).ready(function () {
                $.ajax({
            type: "POST",
            url: "./model/marque.php",
            data: {
                idMarque: <?php echo $marque[0]["id"] ?>,
                
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
                response.forEach((element,index) => {
                    
                        displayCard(`./img/vehicules/${element.image_paths[0].chemin}`,element.vehicule_name,"Voir avis",element.vehicule_id);
                    

            });
            },
            error: function (xhr, status, error) {
                console.log("failed");
                console.error("AJAX Error:", status, error);
            }
        });
        $.ajax({
            type: "POST",
            url: "./model/marque.php",
            data: {
                id: <?php echo $marque[0]["id"] ?>,
                
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
               
            createSelect(response);
            },
            error: function (xhr, status, error) {
                console.log("failed");
                console.error("AJAX Error:", status, error);
            }
        });

            })
  function createSelect(vehicules) {
    var formElement = $('<form>', {
        id: 'vehiculeForm',
        style: 'width: 80%; margin: 20px auto; text-align: center;',
    });

    var selectElement = $('<select>', {
        name: 'vehicule', 
        id: 'vehicule',
        class: 'modeleDropdown',
        style: 'width: 100%; height: 40px; padding: 5px; color: #F41F11; outline: none; border-radius: 5px;height:50px; border: solid 2px black;',
    });

    selectElement.append($('<option>', {
        value: '',
        text: 'Vehicule'
    }));

    vehicules.forEach(element => {
        selectElement.append($('<option>', {
            value: element.vehicule_name,
            text: element.vehicule_name,
        }));
    });

    formElement.append(selectElement);

    var submitButton = $('<input>', {
        type: 'submit',
        value: 'Consulter',
        style: "margin-top:30px;width:250px;height:50px;color:white;text-align:center;background-color:#F41F11;border-radius:10px;border:none;font-size:20px;",
    });

    formElement.append(submitButton);

    $('#listContainer').append(formElement);

    formElement.submit(function (e) {
        e.preventDefault(); 

        var selectedName = $('#vehicule').val();
        var selectedVehicule = vehicules.find(vehicle => vehicle.vehicule_name === selectedName);

        if (selectedVehicule) {
       
        var button = $('<a>',{style: "border:none;"}).addClass('btn btn-primary').attr('href', `./index.php?action=avisVehicule&idVehicule=${selectedVehicule.vehicule_id}`).text("Voir avis").css('background-color', '#F41F11');
        $('#characteristicsContainer').append(button); }
    });
 }

 


           
 function displayCard(imageSrc, cardTitle, buttonText,id) {
   

   var card = $('<div>').addClass('card').css('width', '18rem');

   var cardImage = $('<img>').addClass('card-img-top').attr('src', imageSrc).attr('alt', 'Card Image');

   var cardBody = $('<div>').addClass('card-body');

   var cardTitleElement = $('<h5>').addClass('card-title').text(cardTitle);

   var button = $('<a>',{style: "border:none;"}).addClass('btn btn-primary').attr('href', `./index.php?action=avisVehicule&idVehicule=${id}`).text(buttonText).css('background-color', '#F41F11');

   cardBody.append(cardTitleElement, button);

   card.append(cardImage, cardBody);

   $('#cardContainer').append(card);
 } 
  </script>
        <?php
} 

}

?>