<?php
class Marques{
    public function marquesSectionPage($marques,$type)
    {
        
        $numSlides = ceil(count($marques) / 3);
          ?>
         <div class="marquesContainer">
            <div id="carouselExample" class="carousel slide">
                <div class="carousel-inner">
                    <?php for ($i = 0; $i < $numSlides; $i++) : ?>
                        <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
                            <div style="display:flex; justify-content:space-around; align-items:center;">
                                <?php
                                for ($j = $i * 3; $j < min(($i + 1) * 3, count($marques)); $j++) :
                                ?>
                                <div style="height:400px;display:flex;flex-direction:column;justify-content:center;align-items:center;gap:10px;">
                                <div style="height:300px;display:flex;justify-content:center;align-items:center;">
                                 <a href="<?php if ($type==="avis") echo "./index.php?action=avis";else echo "./index.php?action=marques";?>&id=<?php echo $marques[$j]['id'] ?>">   <img src="./img/marques/<?php echo $marques[$j]['images'][0] ?? ''; ?>" alt="..." style="width:300px; height:auto;"></a>
                                 </div>
                                 <p style="font-size:40px;"> <?php echo $marques[$j]["nom"] ?></p>
                                </div>
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
    
     >                </span>
                    <span class="visually-hidden">Next</span>
                 </button>
              </div>
                   </div>
              <?php
    }
    public function marqueDetails($marque)
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
                    
                        displayCard(`./img/vehicules/${element.image_paths[0].chemin}`,element.vehicule_name,"Voir details",element.vehicule_id);
                    

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
            displayCharacteristics(selectedVehicule);
        }
    });
 }

 function displayCharacteristics(vehicule) {
    $('#characteristicsContainer').empty();
    var container=$("<div>",{
        style: 'width: 80%; margin: 10px auto;display:flex;justify-content:space-evenly;align-items:center;',

    });
    var img=$("<img>").addClass('card-img-top w-25').attr('src', `./img/vehicules/${vehicule.image_paths[0].chemin}`);
    container.append('<h2>' + vehicule.vehicule_name + '</h2>');
    container.append(img);
    $('#characteristicsContainer').append(container);

    var tableElement = $('<table>', {
        style: 'width: 80%; margin: 10px auto; border-collapse: collapse; text-align: left;font-size:20px;font-weight:200px;border:solid 1px;padding:10px;border-radius:5px;',
        
    });

    vehicule.characteristics.forEach(characteristic => {
        var characteristicValue = vehicule.characteristics_values[characteristic.id];

        var rowElement = $('<tr>');

        rowElement.append($('<td>', { text: characteristic.nom }));

        rowElement.append($('<td>', { text: characteristicValue }));

        tableElement.append(rowElement);
    });

    $('#characteristicsContainer').append(tableElement);
    var button = $('<a>',{style: "border:none;"}).addClass('btn btn-primary').attr('href', `./index.php?action=detailVehicule&idVehicule=${vehicule.vehicule_id}`).text("Voir details").css('background-color', '#F41F11');
    $('#characteristicsContainer').append(button);


 }


           
 function displayCard(imageSrc, cardTitle, buttonText,id) {
   

   var card = $('<div>').addClass('card').css('width', '18rem');

   var cardImage = $('<img>').addClass('card-img-top').attr('src', imageSrc).attr('alt', 'Card Image');

   var cardBody = $('<div>').addClass('card-body');

   var cardTitleElement = $('<h5>').addClass('card-title').text(cardTitle);

   var button = $('<a>',{style: "border:none;"}).addClass('btn btn-primary').attr('href', `./index.php?action=detailVehicule&idVehicule=${id}`).text(buttonText).css('background-color', '#F41F11');

   cardBody.append(cardTitleElement, button);

   card.append(cardImage, cardBody);

   $('#cardContainer').append(card);
 } 
  </script>
        <?php
}






}

?>