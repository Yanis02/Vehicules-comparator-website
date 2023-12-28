<?php
require_once('./model/modele.php');
require_once('./model/version.php');

$marqueModel = new MarqueModel();
$modeleModel = new ModeleModel();
$versionModel = new VersionModel();
class accueil {

    public function navBar()
    {
        // Get the current action from the URL
        $currentAction = isset($_GET['action']) ? $_GET['action'] : '';
    
        ?>
        <div style="display: flex; justify-content: center; align-items: center;">
    
            <div>
                <ul style="display: flex; flex-direction: row; justify-content: center; align-items: center; list-style: none; gap: 150px; font-size: 20px;">
                    <li><a href="./index.php?action=home" style="text-decoration: none; color: <?= $currentAction === 'home' ? 'red' : '#000'; ?>">Accueil</a></li>
                    <li><a href="./index.php?action=marques" style="text-decoration: none; color: <?= $currentAction === 'marques' ? 'red' : '#000'; ?>">Marques</a></li>
                    <li><a href="./index.php?action=avis" style="text-decoration: none; color: <?= $currentAction === 'avis' ? 'red' : '#000'; ?>">Avis</a></li>

                    <li><a href="./index.php?action=comparateur" style="text-decoration: none; color: <?= $currentAction === 'comparateur' ? 'red' : '#000'; ?>">Comparateur</a></li>
                    <li><a href="./index.php?action=news" style="text-decoration: none; color: <?= $currentAction === 'news' ? 'red' : '#000'; ?>">News</a></li>
                    <li><a href="./index.php?action=guide" style="text-decoration: none; color: <?= $currentAction === 'guide' ? 'red' : '#000'; ?>">Guides d'achats</a></li>
                    <li><a href="./index.php?action=contact" style="text-decoration: none; color: <?= $currentAction === 'contact' ? 'red' : '#000'; ?>">Contact</a></li>
                </ul>
            </div>
        </div>
        <?php
    }
    
public function header(){
    ?>
    <header>
        <div class="header">
        <a href="./index.php?action=home"> <h1>Logo</h1></a>
        <div class="socialContainer">
           <a href="https://www.google.com/"> <img src="./img/assets/google.png"></img></a>
           <a href="https://www.facebook.com"><img src="./img/assets/facebook.png"></img></a>
           <a href="https://www.twitter.com"><img src="./img/assets/twitter.png"></img></a>
           <?php
             if(isset($_SESSION['user']
             )){
                $loggedInUser = $_SESSION['user'];
                ?>
              <a href="./index.php?action=logoutHandler"><?php echo $loggedInUser["nom"]?></a>

             <a href="./index.php?action=logoutHandler">Logout</a>
             <?php
             }else {
                ?>
                <a href="./index.php?action=auth">Se connecter</a>
                <?php
             } 
           ?>
        </div>
        </div>
        
    </header>
    <?php
}
public function register(){
    ?>
     <div style="display:flex;justify-content:center;align-items:center;width:100%;" >
      <form method="post" action="./index.php?action=handleRegister" style="padding:10px;width: 700px; height: 700px; border: 2px solid #F41F11; border-radius: 10px;display:flex;flex-direction:column;justify-content:space-around;align-items:center" >
        <h1>Veuillez remplir le formulaire suivant</h1>
        <label for="nom" style="margin-right:50%;">Nom :</label>
        <input name="nom" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required >
        <label for="prenom" style="margin-right:50%;">Prenom :</label>
        <input name="prenom" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required >
        <label for="sexe" style="margin-right:50%;">Sexe :</label>
        <select name="sexe"  style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required >
                       <option value="Male">Male</option>
                       <option value="Femelle">Femelle</option>
        </select>
        <label for="date_naissance" style="margin-right:50%;">Date de naissance :</label>
        <input name="date_naissance" type="date" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required >
        <label for="username" style="margin-right:50%;">Nom utilisateur :</label>
        <input name="username" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required>
        <label for="password" style="margin-right:50%;">Mot de passe :</label>
        <input name="password" type="password" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required>
        <button type="submit" style="width:150px;height:50px;color:white;text-align:center;background-color:#F41F11;border-radius:10px;border:none;font-size:20px;">Inscrire</button>
     </form>
    </div>
    <?php
}
public function login(){
    ?>
    <div style="display:flex;justify-content:center;align-items:center;width:100%;" >
      <form method="post" action="./index.php?action=loginHandler" style="padding:10px;width: 700px; height: 500px; border: 2px solid #F41F11; border-radius: 10px;display:flex;flex-direction:column;justify-content:space-around;align-items:center" >
        <h1>Vous avez deja un compte? connectez-vous :</h1>
        <label for="username" style="margin-right:50%;">Nom utilisateur :</label>
        <input name="username" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required>
        <label for="password" style="margin-right:50%;">Mot de passe :</label>
        <input name="password" type="password" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required>
        <button type="submit" style="width:150px;height:50px;color:white;text-align:center;background-color:#F41F11;border-radius:10px;border:none;font-size:20px;">Se connecter</button>
        <a href="./index.php?action=register">Vous n avez pas de compte? inscrivez-vous</a>
     </form>
    </div>
    <?php
}
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

public function newsSection($news){

 ?>

    <div class="newsContainer" style="display:flex;flex-direction:column;align-items-center;width:100%;height: 400px;">
        <?php 
        if(empty($news)){
            ?>
        <p>Nothing to display</p>
        <?php
        } else {
            $delay=0;
            foreach ($news as $singleNews) {
                ?>
                <div class="newsItem" style="animation-delay: <?php echo $delay; ?>s;">
                    <div class="titleContainer"> 
                        <h2><?php echo $singleNews['title']; ?></h2>
                    </div>
                    <div class="imageContainer">
                        <?php 
                        if (!empty($singleNews['images'])) {
                            ?>
                            <img src="./img/news/<?php echo $singleNews['images'][0]; ?>" alt="News Image">
                            <?php
                        } else {
                            ?>
                            <p>No image available</p>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                $delay+=5;
            }
        }
        ?>
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
                    
                        displayCard(`./img/vehicules/${element.image_paths[0].chemin}.jpg`,element.vehicule_name,"Voir details",element.vehicule_id);
                    

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
                    
                        displayCard(`./img/vehicules/${element.image_paths[0].chemin}.jpg`,element.vehicule_name,"Voir avis",element.vehicule_id);
                    

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
       
        var button = $('<a>',{style: "border:none;"}).addClass('btn btn-primary').attr('href', `./index.php?action=avis&idVehicule=${selectedVehicule.vehicule_id}`).text("Voir avis").css('background-color', '#F41F11');
        $('#characteristicsContainer').append(button); }
    });
 }

 


           
 function displayCard(imageSrc, cardTitle, buttonText,id) {
   

   var card = $('<div>').addClass('card').css('width', '18rem');

   var cardImage = $('<img>').addClass('card-img-top').attr('src', imageSrc).attr('alt', 'Card Image');

   var cardBody = $('<div>').addClass('card-body');

   var cardTitleElement = $('<h5>').addClass('card-title').text(cardTitle);

   var button = $('<a>',{style: "border:none;"}).addClass('btn btn-primary').attr('href', `./index.php?action=avis&idVehicule=${id}`).text(buttonText).css('background-color', '#F41F11');

   cardBody.append(cardTitleElement, button);

   card.append(cardImage, cardBody);

   $('#cardContainer').append(card);
 } 
  </script>
        <?php
} 
public function vehiculeDetails($vehicule){
    echo '<div style="width: 80%; margin: 10px auto; display: flex; justify-content: space-evenly; align-items: center;">';
    echo '<h2>' . $vehicule[0]['vehicule_name'] . '</h2>';
    echo '<img class="card-img-top w-25" src="./img/vehicules/' . $vehicule[0]['image_paths'][0]['chemin'] . '" alt="' . $vehicule[0]['vehicule_name'] . '">';
    echo '</div>';

    echo '<table style="width: 80%; margin: 10px auto; border-collapse: collapse; text-align: left; font-size: 20px; font-weight: 200px; border: solid 1px; padding: 10px; border-radius: 5px;">';
    echo '<tr><th>Characteristic</th><th>Value</th></tr>';

    foreach ($vehicule[0]['characteristics'] as $characteristic) {
        $characteristicValue = $vehicule[0]['characteristics_values'][$characteristic['id']];
        echo '<tr>';
        echo '<td>' . $characteristic['nom'] . '</td>';
        echo '<td>' . $characteristicValue . '</td>';
        echo '</tr>';
    }

    echo '</table>';
}
public function marquesSection($marques)
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
                             <a href="./index.php?action=marques&id=<?php echo $marques[$j]['id'] ?>">   <img src="./img/marques/<?php echo $marques[$j]['images'][0] ?? ''; ?>.png" alt="..." style="width:200px; height:auto;"></a>
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
    </div>
    <?php
}
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
                             <a href="<?php if ($type==="avis") echo "./index.php?action=avis";else echo "./index.php?action=marques";?>
&id=<?php echo $marques[$j]['id'] ?>">   <img src="./img/marques/<?php echo $marques[$j]['images'][0] ?? ''; ?>.png" alt="..." style="width:300px; height:auto;"></a>
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

    public function footer (){
        ?>
        </html>
        <?php
    }

    public function separator(){
        ?>
        <div style="display:flex;justify-content:center;">
        <div style="width:90%;height:5px;background-color:#F41F11;margin-top:50px;"></div></div>
        <?php
    }
    
    public function comparaisonPage($marques){
        ?>
     <div style="display:flex;flex-direction:column;align-items-center;width:100%;">
     <h1 style="margin-top:50px;text-align:center">Comparez vos vehicules</h1>
     <form  method="post" action="./index.php?action=comparateur" id="comparisonForm" style="margin-top:50px;margin-left:5%;width: 90%;display:flex;flex-direction:column;justify-content:center;align-items:center;gap:50px;">
        <div style="width:100%; display: flex; flex-direction: row; height:fit-content; justify-content: space-around; align-items: center;" class="comparaison_container">
            <?php for ($i = 0; $i < 4; $i++) : ?>
                <div id="container_<?php echo $i; ?>" style="width: 300px; height: 400px; border: 2px solid #F41F11; border-radius: 10px;display:flex;flex-direction:column;justify-content:space-around;align-items:center">
                    <!-- Marque Dropdown 54-->
                    <select name="marque_<?php echo $i; ?>" id="marque_<?php echo $i; ?>" class="marqueDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" onchange="updateModeles(this, <?php echo $i; ?>)">
                        <option value="">Marque</option>
                        <?php foreach ($marques as $marque) : ?>
                            <option value='<?php echo $marque['id']; ?>'><?php echo $marque['nom']; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <!-- Modele Dropdown -->
                    <select name="modele_<?php echo $i; ?>" id="modele_<?php echo $i; ?>" class="modeleDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" onchange="updateVersions(this, <?php echo $i; ?>)" disabled>
                        <option value="">Modele</option>
                    </select>

                    <!-- Version Dropdown -->
                    <select name="version_<?php echo $i; ?>" id="version_<?php echo $i; ?>" class="versionDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" onchange="updateAnnee(this, <?php echo $i; ?>)" disabled>
                        <option value="">Version</option>
                    </select>
                    <!-- Annee Dropdown -->
                    <select name="annee_<?php echo $i; ?>" id="annee_<?php echo $i; ?>" class="anneeDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" disabled>
                        <option value="">Annee</option>
                    </select>
                </div>
            <?php endfor; ?>
        </div>
        <button type="button" onclick="submitForm()"    style="width:250px;height:50px;color:white;text-align:center;background-color:#F41F11;border-radius:10px;border:none;font-size:20px;">Comparer</button>
     </form>
      <div class="d-flex justify-content-around mt-5 " id="cardContainer"></div>
     <div class="d-flex justify-content-center mt-5" id="table_container" >
     <table class="table table-bordered table-sm w-50">
     <thead>
                <tr id="lineOne">                   
                </tr>
            </thead>
            <tbody id="tbody">
           </tbody>
     </table>
     </div>
     </div>
    
     <script>
 
 
        function updateModeles(element, containerIndex) {
            var container = $("#container_" + containerIndex);
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

        function updateVersions(element, containerIndex) {
            var container = $("#container_" + containerIndex);
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
        function updateAnnee(element, containerIndex) {
            var container = $("#container_" + containerIndex);
            var modeleId = $(element).val();
            console.log(modeleId);

            var versionDropdown = container.find('.anneeDropdown');
            
            $.ajax({
                type: "POST",
                url: "./model/vehicule.php",
                data: { versionId: modeleId },
                dataType: "json",
                success: function (data) {
                    versionDropdown.empty();
                    versionDropdown.append('<option value="">Annee</option>');
                    $.each(data, function (index, version) {
                        versionDropdown.append($("<option>").attr("value", version.id).text(version.annee));
                    });
                    versionDropdown.prop("disabled", false);
                },
                error: function (xhr, status, error) {
                    console.log("failed");
                    console.error("AJAX Error:", status, error);
                }
            });
        }
        function isSelected(num){
            const marque=$(`#marque_${num}`);
            if(marque.val()) return true;
            else return false;
        }
        function isReady(num){
         const marque=$(`#marque_${num}`);
         const modele=$(`#modele_${num}`);
         const version=$(`#version_${num}`);
         const annee=$(`#annee_${num}`);
         if(marque.val() && modele.val() && version.val() && annee.val()  ) return true;
         else return false;
        }
      
        function submitForm() {
         let cpt = 0;
    
     let data=[];
     for (let index = 0; index < 4; index++) {
        
        if (isReady(index)) {
            let res={marque:"",modele:"",version:"",id:""};
            res.marque=$(`#marque_${index}`).val();
            res.modele=$(`#modele_${index}`).val();
            res.version=$(`#version_${index}`).val();
            res.id=$(`#annee_${index}`).val();
            data.push(res);
            cpt++;
        } else if (isSelected(index)) {
            alert("Please fill in all fields.");
            return;
        }
     }

     if (cpt >= 2) {
        //
        console.log("passed");
       console.log(data);
       result=[];
       var promises = data.map(element => {
     return new Promise((resolve, reject) => {
        $.ajax({
            type: "POST",
            url: "./model/vehiculeCaracteristique.php",
            data: {
                idMarque: element.marque,
                idModele: element.modele,
                idVersion: element.version,
                idVehicule: element.id
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
                result.push(response);
                resolve(); 
            },
            error: function (xhr, status, error) {
                console.log("failed");
                console.error("AJAX Error:", status, error);
                reject(); 
            }
        });
     });
     });

      Promise.all(promises)
        .then(() => {
        console.log("result", result);
        if (result.length > 1) {
            $('#cardContainer').empty();
            console.log(result);
            sessionStorage.setItem('compResults', JSON.stringify(result));
            $('#comparisonForm').submit();
        }
     })
     .catch(() => {
        console.log("One or more AJAX requests failed");
     });
     } else {
        alert("Please enter at least 2 vehicles.");
     }
        }        
     </script> 
     <?php
    }
  public function comparaison($marques)
  {
    ?>
    <div id="container" style="display:flex;flex-direction:column;align-items-center;width:100%;">
    <h1 style="margin-top:50px;text-align:center">Comparez vos vehicules</h1>
    <form id="comparisonForm" style="margin-top:50px;margin-left:5%;width: 90%;display:flex;flex-direction:column;justify-content:center;align-items:center;gap:50px;">
        <div style="width:100%; display: flex; flex-direction: row; height:fit-content; justify-content: space-around; align-items: center;" class="comparaison_container">
            <?php for ($i = 0; $i < 4; $i++) : ?>
                <div id="container_<?php echo $i; ?>" style="width: 300px; height: 400px; border: 2px solid #F41F11; border-radius: 10px;display:flex;flex-direction:column;justify-content:space-around;align-items:center">
                    <!-- Marque Dropdown 54-->
                    <select name="marque_<?php echo $i; ?>" id="marque_<?php echo $i; ?>" class="marqueDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" onchange="updateModeles(this, <?php echo $i; ?>)">
                        <option value="">Marque</option>
                        <?php foreach ($marques as $marque) : ?>
                            <option value='<?php echo $marque['id']; ?>'><?php echo $marque['nom']; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <!-- Modele Dropdown -->
                    <select name="modele_<?php echo $i; ?>" id="modele_<?php echo $i; ?>" class="modeleDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" onchange="updateVersions(this, <?php echo $i; ?>)" disabled>
                        <option value="">Modele</option>
                    </select>

                    <!-- Version Dropdown -->
                    <select name="version_<?php echo $i; ?>" id="version_<?php echo $i; ?>" class="versionDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" onchange="updateAnnee(this, <?php echo $i; ?>)" disabled>
                        <option value="">Version</option>
                    </select>
                    <!-- Annee Dropdown -->
                    <select name="annee_<?php echo $i; ?>" id="annee_<?php echo $i; ?>" class="anneeDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" disabled>
                        <option value="">Annee</option>
                    </select>
                </div>
            <?php endfor; ?>
        </div>
        <button type="button" onclick="submitForm()" style="width:250px;height:50px;color:white;text-align:center;background-color:#F41F11;border-radius:10px;border:none;font-size:20px;">Comparer</button>
       </form>
       <div class="d-flex justify-content-around mt-5 " id="textContainer"></div>
      <div class="d-flex justify-content-around mt-5 " id="cardContainer"></div>
     <div class="d-flex justify-content-center mt-5" id="table_container" >
     <table class="table table-bordered table-sm w-50">
     <thead>
                <tr id="lineOne" >                   
                </tr>
            </thead>
            <tbody id="tbody">
           </tbody>
    </table>
   </div>
    </div>
    <script>
    $(document).ready(function () {
        
     var compData=sessionStorage.getItem('compResults');
     var compResults=JSON.parse(compData);
     if(compResults!=null){
      var text=$("<h1>").text("Votre derniere comparaison :");  
     $('#textContainer').append(text); 
    displayTable(compResults);
    compResults.forEach(element => {
                displayCard(`./img/vehicules/${element.image_paths[0].chemin}.jpg`,element.vehicule_name,"Voir details",element.vehicule_id);
            });}
            
    var storedData = sessionStorage.getItem('data');
    var result = JSON.parse(storedData);
    
    })

     function displayCard(imageSrc, cardTitle, buttonText,id) {
   

    var card = $('<div>').addClass('card').css('width', '18rem');

    var cardImage = $('<img>').addClass('card-img-top').attr('src', imageSrc).attr('alt', 'Card Image');

    var cardBody = $('<div>').addClass('card-body');

    var cardTitleElement = $('<h5>').addClass('card-title').text(cardTitle);

    var button = $('<a>',{style: "border:none;"}).addClass('btn btn-primary').attr('href', `./index.php?action=detailVehicule&idVehicule=${id}`).text(buttonText).css('background-color', '#F41F11');

    cardBody.append(cardTitleElement, button);

    card.append(cardImage, cardBody);

    // Append the new card to #cardContainer
    $('#cardContainer').append(card);
   }

        function updateModeles(element, containerIndex) {
            var container = $("#container_" + containerIndex);
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

        function updateVersions(element, containerIndex) {
            var container = $("#container_" + containerIndex);
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
        function updateAnnee(element, containerIndex) {
            var container = $("#container_" + containerIndex);
            var modeleId = $(element).val();
            console.log(modeleId);

            var versionDropdown = container.find('.anneeDropdown');
            
            $.ajax({
                type: "POST",
                url: "./model/vehicule.php",
                data: { versionId: modeleId },
                dataType: "json",
                success: function (data) {
                    versionDropdown.empty();
                    versionDropdown.append('<option value="">Annee</option>');
                    $.each(data, function (index, version) {
                        versionDropdown.append($("<option>").attr("value", version.id).text(version.annee));
                    });
                    versionDropdown.prop("disabled", false);
                },
                error: function (xhr, status, error) {
                    console.log("failed");
                    console.error("AJAX Error:", status, error);
                }
            });
        }
        function isSelected(num){
            const marque=$(`#marque_${num}`);
            if(marque.val()) return true;
            else return false;
        }
        function isReady(num){
         const marque=$(`#marque_${num}`);
         const modele=$(`#modele_${num}`);
         const version=$(`#version_${num}`);
         const annee=$(`#annee_${num}`);
         if(marque.val() && modele.val() && version.val() && annee.val()  ) return true;
         else return false;
        }
        function displayTable(data){
         var $table = $("table"); 
         $table.find("tbody").empty(); 
         var $thead = $table.find("thead");
         $thead.empty();
         var headerRow = '<tr><th scope="col">Features</th>';
         data.forEach(element => {
            headerRow += '<th>' + element.vehicule_name + '</th>';  
         });
         headerRow += '</tr>';
         $thead.append(headerRow);
         var $tbody = $table.find("tbody");
         data[0].characteristics.forEach(feature => {
            var featureRow = '<tr><th class="firstcol" scope="row">' + feature.nom + '</th>';
            data.forEach(element => {
                let values=[];
               values.push(element.characteristics_values[feature.id]);
               for (let index = 0; index < values.length; index++) {
                    featureRow += '<td>' + values[index] + '</td>';
                }        
            

            });
            featureRow += '</tr>';
            $tbody.append(featureRow);
         });
        
        }
    function submitForm() {
         let cpt = 0;
    
     let data=[];
      for (let index = 0; index < 4; index++) {
        
        if (isReady(index)) {
            let res={marque:"",modele:"",version:"",id:""};
            res.marque=$(`#marque_${index}`).val();
            res.modele=$(`#modele_${index}`).val();
            res.version=$(`#version_${index}`).val();
            res.id=$(`#annee_${index}`).val();
            data.push(res);
            cpt++;
        } else if (isSelected(index)) {
            alert("Please fill in all fields.");
            return;
        }
     }

     if (cpt >= 2) {
        //$('#comparisonForm').submit();
        console.log("passed");
       console.log(data);
       result=[];
       var promises = data.map(element => {
     return new Promise((resolve, reject) => {
        $.ajax({
            type: "POST",
            url: "./model/vehiculeCaracteristique.php",
            data: {
                idMarque: element.marque,
                idModele: element.modele,
                idVersion: element.version,
                idVehicule: element.id
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
                result.push(response);
                resolve(); 
            },
            error: function (xhr, status, error) {
                console.log("failed");
                console.error("AJAX Error:", status, error);
                reject(); 
            }
        });
     });
     });

      Promise.all(promises)
        .then(() => {
        console.log("result", result);
        if (result.length > 1) {
            $('#cardContainer').empty();
            console.log(result);
            sessionStorage.setItem("compResults",JSON.stringify(result));
            result.forEach(element => {
                displayCard(`./img/vehicules/${element.image_paths[0].chemin}.jpg`,element.vehicule_name,"Voir details",element.vehicule_id);
            });
            displayTable(result);
        }
     })
     .catch(() => {
        console.log("One or more AJAX requests failed");
     });
     } else {
        alert("Please enter at least 2 vehicles.");
     }
        }     
    </script>
    <?php
 }
 public function comparaisonV($marques,$idVehicule,$idMarque,$idModele,$idVersion)
 {
   ?>
   <div style="display:flex;flex-direction:column;align-items-center;width:100%;">
   <h1 style="margin-top:50px;text-align:center">Comparez ce vehicule</h1>
   <form id="comparisonForm" style="margin-top:50px;margin-left:5%;width: 90%;display:flex;flex-direction:column;justify-content:center;align-items:center;gap:50px;">
       <div style="width:100%; display: flex; flex-direction: row; height:fit-content; justify-content: space-around; align-items: center;" class="comparaison_container">
       <div id="container_0" style="width: 300px; height: 400px; border: 2px solid #F41F11; border-radius: 10px;display:flex;flex-direction:column;justify-content:space-around;align-items:center;display:none;">
                   <!-- Marque Dropdown 54-->
                   <select name="marque_0" id="marque_0" class="marqueDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" disabled >
                       <option value="<?php echo $idMarque ?>">Marque</option>
                       
                   </select>

                   <!-- Modele Dropdown -->
                   <select name="modele_0" id="modele_0" class="modeleDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;"  disabled>
                       <option value="<?php echo $idModele ?>">Modele</option>
                   </select>

                   <!-- Version Dropdown -->
                   <select name="version_0" id="version_0" class="versionDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;"  disabled>
                       <option value="<?php echo $idVersion?>">Version</option>
                   </select>
                   <!-- Annee Dropdown -->
                   <select name="annee_0" id="annee_0" class="anneeDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" disabled>
                       <option value="<?php echo $idVehicule ?>">Annee</option>
                   </select>
               </div>    
       <?php for ($i = 1; $i < 4; $i++) : ?>
               <div id="container_<?php echo $i; ?>" style="width: 300px; height: 400px; border: 2px solid #F41F11; border-radius: 10px;display:flex;flex-direction:column;justify-content:space-around;align-items:center">
                   <!-- Marque Dropdown 54-->
                   <select name="marque_<?php echo $i; ?>" id="marque_<?php echo $i; ?>" class="marqueDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" onchange="updateModeles(this, <?php echo $i; ?>)">
                       <option value="">Marque</option>
                       <?php foreach ($marques as $marque) : ?>
                           <option value='<?php echo $marque['id']; ?>'><?php echo $marque['nom']; ?></option>
                       <?php endforeach; ?>
                   </select>

                   <!-- Modele Dropdown -->
                   <select name="modele_<?php echo $i; ?>" id="modele_<?php echo $i; ?>" class="modeleDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" onchange="updateVersions(this, <?php echo $i; ?>)" disabled>
                       <option value="">Modele</option>
                   </select>

                   <!-- Version Dropdown -->
                   <select name="version_<?php echo $i; ?>" id="version_<?php echo $i; ?>" class="versionDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" onchange="updateAnnee(this, <?php echo $i; ?>)" disabled>
                       <option value="">Version</option>
                   </select>
                   <!-- Annee Dropdown -->
                   <select name="annee_<?php echo $i; ?>" id="annee_<?php echo $i; ?>" class="anneeDropdown" style="width:70%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" disabled>
                       <option value="">Annee</option>
                   </select>
               </div>
           <?php endfor; ?>
       </div>
       <button type="button" onclick="submitForm()" style="width:250px;height:50px;color:white;text-align:center;background-color:#F41F11;border-radius:10px;border:none;font-size:20px;">Comparer</button>
      </form>
      <div class="d-flex justify-content-around mt-5 " id="textContainer"></div>

     <div class="d-flex justify-content-around mt-5 " id="cardContainer"></div>
    <div class="d-flex justify-content-center mt-5" id="table_container" >
    <table class="table table-bordered table-sm w-50">
    <thead>
               <tr id="lineOne" >                   
               </tr>
           </thead>
           <tbody id="tbody">
          </tbody>
   </table>
  </div>
   </div>
   <script>
   $(document).ready(function () {
    var compData=sessionStorage.getItem('compResults');
     var compResults=JSON.parse(compData);
     if(compResults!=null){
      var text=$("<h1>").text("Votre derniere comparaison :");  
     $('#textContainer').append(text); 
    displayTable(compResults);
    compResults.forEach(element => {
                displayCard(`./img/vehicules/${element.image_paths[0].chemin}.jpg`,element.vehicule_name,"Voir details",element.vehicule_id);
            });}
   })

   function displayCard(imageSrc, cardTitle, buttonText,id) {
  

   var card = $('<div>').addClass('card').css('width', '18rem');

   var cardImage = $('<img>').addClass('card-img-top').attr('src', imageSrc).attr('alt', 'Card Image');

   var cardBody = $('<div>').addClass('card-body');

   var cardTitleElement = $('<h5>').addClass('card-title').text(cardTitle);

   var button = $('<a>',{style:"border:none"}).addClass('btn btn-primary').attr('href', `./index.php?action=detailVehicule&idVehicule=${id}`).text(buttonText).css('background-color', '#F41F11');

   cardBody.append(cardTitleElement, button);

   card.append(cardImage, cardBody);

   // Append the new card to #cardContainer
   $('#cardContainer').append(card);
   }

       function updateModeles(element, containerIndex) {
           var container = $("#container_" + containerIndex);
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

       function updateVersions(element, containerIndex) {
           var container = $("#container_" + containerIndex);
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
       function updateAnnee(element, containerIndex) {
           var container = $("#container_" + containerIndex);
           var modeleId = $(element).val();
           console.log(modeleId);

           var versionDropdown = container.find('.anneeDropdown');
           
           $.ajax({
               type: "POST",
               url: "./model/vehicule.php",
               data: { versionId: modeleId },
               dataType: "json",
               success: function (data) {
                   versionDropdown.empty();
                   versionDropdown.append('<option value="">Annee</option>');
                   $.each(data, function (index, version) {
                       versionDropdown.append($("<option>").attr("value", version.id).text(version.annee));
                   });
                   versionDropdown.prop("disabled", false);
               },
               error: function (xhr, status, error) {
                   console.log("failed");
                   console.error("AJAX Error:", status, error);
               }
           });
       }
       function isSelected(num){
           const marque=$(`#marque_${num}`);
           if(marque.val()) return true;
           else return false;
       }
       function isReady(num){
        const marque=$(`#marque_${num}`);
        const modele=$(`#modele_${num}`);
        const version=$(`#version_${num}`);
        const annee=$(`#annee_${num}`);
        if(marque.val() && modele.val() && version.val() && annee.val()  ) return true;
        else return false;
       }
       function displayTable(data){
        var $table = $("table"); 
        $table.find("#tbody").empty(); 
        var $thead = $table.find("thead");
        $thead.empty();
        var headerRow = '<tr ><th scope="col">Features</th>';
        data.forEach(element => {
           headerRow += '<th>' + element.vehicule_name + '</th>';  
        });
        headerRow += '</tr>';
        $thead.append(headerRow);
        var $tbody = $table.find("#tbody");
        data[0].characteristics.forEach(feature => {
           var featureRow = '<tr><th  scope="row">' + feature.nom + '</th>';
           data.forEach(element => {
               let values=[];
              values.push(element.characteristics_values[feature.id]);
              for (let index = 0; index < values.length; index++) {
                   featureRow += '<td>' + values[index] + '</td>';
               }        
           

           });
           featureRow += '</tr>';
           $tbody.append(featureRow);
        });
       
       }
   function submitForm() {
        let cpt = 0;
   
    let data=[];
     for (let index = 0; index < 4; index++) {
       
       if (isReady(index)) {
           let res={marque:"",modele:"",version:"",id:""};
           res.marque=$(`#marque_${index}`).val();
           res.modele=$(`#modele_${index}`).val();
           res.version=$(`#version_${index}`).val();
           res.id=$(`#annee_${index}`).val();
           data.push(res);
           cpt++;
       } else if (isSelected(index)) {
           alert("Please fill in all fields.");
           return;
       }
    }

    if (cpt >= 2) {
       //$('#comparisonForm').submit();
       console.log("passed");
      console.log(data);
      result=[];
      var promises = data.map(element => {
    return new Promise((resolve, reject) => {
       $.ajax({
           type: "POST",
           url: "./model/vehiculeCaracteristique.php",
           data: {
               idMarque: element.marque,
               idModele: element.modele,
               idVersion: element.version,
               idVehicule: element.id
           },
           dataType: "json",
           success: function (response) {
               console.log(response);
               result.push(response);
               resolve(); 
           },
           error: function (xhr, status, error) {
               console.log("failed");
               console.error("AJAX Error:", status, error);
               reject(); 
           }
       });
    });
    });

     Promise.all(promises)
       .then(() => {
       console.log("result", result);
       if (result.length > 1) {
           $('#cardContainer').empty();
           console.log(result);
           sessionStorage.setItem("compResults",JSON.stringify(result));

           result.forEach(element => {
               displayCard(`./img/vehicules/${element.image_paths[0].chemin}.jpg`,element.vehicule_name,"Voir details",element.vehicule_id);
           });
           displayTable(result);
       }
    })
    .catch(() => {
       console.log("One or more AJAX requests failed");
    });
    } else {
       alert("Veuillez selectionner au moin un vehicule.");
    }
       }     
   </script>
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
public function allAvisBtn($idVehicule){
    ?>
     <div style="display:flex;flex-direction:column;align-items:center;width:100%;justify-content:center;margin-top:10px;">
     <a class="btn btn-primary" href="./index.php?action=avis&idVehicule=<?php echo $idVehicule?>" style="text-align:center;width:150px;height:50px;background-color:#F41F11;border-radius:10px;border:none;display:flex;align-items:center;justify-content:center">Voir tous</a>
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
public function personalSection($id,$notAdded,$type){
    if(isset($_SESSION['user'])){
    ?>
    <div style="display:flex;flex-direction:column;align-items:center;width:100%;justify-content:center;">
    <form method="post" action="    <?php if($type==="vehicule") echo "./index.php?action=handleAvis"; else echo "./index.php?action=handleAvisMarque";  ?>
" style="width:700px;padding-left:50px;margin:20px;">
    <input name="        <?php if($type==="vehicule") echo "idVehicule"; else echo "idMarqueAvis";  ?>
" type="text" style="width:80%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;display:none" required value=<?php echo $id?>>
    <label for="avis" style="margin-right:50%;">Ajouter un avis :</label>
    <input name="avis" type="text" style="width:80%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;" required >
    <button type="submit" style="width:120px;height:40px;color:white;text-align:center;background-color:#F41F11;border-radius:10px;border:none;font-size:20px;">Ajouter</button>
    </form>
    <form method="post" action="    <?php if($type==="vehicule") echo "./index.php?action=handleNote"; else echo "./index.php?action=handleNoteMarque";  ?>
" style="width:700px;padding-left:50px;margin:20px;">
    <input name="        <?php if($type==="vehicule") echo "idVehicule"; else echo "idMarqueNote";  ?>
" type="text" style="width:80%;height:40px;padding:5px;color:#F41F11; outline:none;border-radius:5px;display:none" required value=<?php echo $id?>>    <label for="note" style="margin-right:50%;">Ajouter une note :</label>
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
public function AvisText(){
    ?>
 <div style="display:flex;flex-direction:column;align-items:center;width:100%;justify-content:center;gap:10px;margin-top:50px;"><h1>Avis</h1></div>
    <?php
}
}
?>
